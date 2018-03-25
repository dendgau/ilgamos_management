<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\ContractModel;
use App\Models\ProductDetailModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    function show() {
        $product_type = ProductModel::PRODUCT_TYPES_LANG;
        $products  = ProductModel::orderBy('update_at', 'DESC')->paginate(20);
        $links     = $products->links("pagination::bootstrap-4");
        $total     = $products->total();

        return view('product\show')->with(array(
            'product_type'  => $product_type,
            'products'      => $products,
            'links'         => $links,
            'total'         => $total,
        ));
    }

    function create(Request $request) {
        $product_type = ProductModel::PRODUCT_TYPES_LANG;

        if ($request->isMethod('post')) {
            if ($this->_process_form_validation(__FUNCTION__, $request)) {
                try {
                    DB::beginTransaction();
                        $new_product = new ProductModel();
                        $new_product->product_name = $request->product_name;
                        $new_product->product_type = get_product_type_id_by_key($request->product_type);
                        if (!$new_product->save()) {
                            throw new \Exception('Can create new product');
                        }

                        $new_product_detail = new ProductDetailModel();
                        $new_product_detail->product_id = $new_product->id;
                        $new_product_detail->price      = $request->price;
                        $new_product_detail->version_no = 1;
                        if (!$new_product_detail->save()) {
                            throw new \Exception('Can create new product detail');
                        }
                    DB::commit();

                    $request->session()->flash('message', 'Tạo sản phẩm mới thanh công. Hãy cập nhật giá mới tại màn hình này');
                    return Redirect::to('business/product/edit/product_id/'.$new_product->id)->send();
                    exit;
                } catch (\Exception $e) {
                    DB::rollback();
                    $request->session()->flash('error', 'Không thể tạo sản phẩm mới. Hãy thử lại lần nữa');
                }
            }
        }

        return view('product\create')->with(array(
            'product_type'  => $product_type,
        ));
    }

    function edit(Request $request) {
        if (!($product_id = $request->route('product_id'))) {
            $request->session()->flash('error', 'Không tìm thấy mã hóa đơn');
            Redirect::to('business/product/show')->send();
        }

        if (!($product = ProductModel::find($product_id))) {
            $request->session()->flash('error', 'Không tìm thấy mã sản phẩm HD00'. $product_id);
            Redirect::to('business/product/show')->send();
        }

        if (!($product_detail = ProductDetailModel::where('product_id', '=', $product_id)->orderBy('version_no', 'DESC')->first())) {
            $request->session()->flash('error', 'Không tìm thấy chi tiết sản phẩm HD00'. $product_id);
            Redirect::to('business/product/show')->send();
        }

        $product->product_type = array_search($product->product_type, ProductModel::PRODUCT_TYPES);
        $product_type = ProductModel::PRODUCT_TYPES_LANG;

        if ($request->isMethod('post')) {
            if ($this->_process_form_validation(__FUNCTION__, $request)) {
                try {
                    DB::beginTransaction();
                        $product->product_name = $request->product_name;
                        $product->product_type = get_product_type_id_by_key($request->product_type);

                        if (!$product->save()) {
                            throw new \Exception('Can not update product detail');
                        }

                        if ($product_detail->price != $request->price) {
                            $new_product_detail = new ProductDetailModel();
                            $new_product_detail->product_id = $product->id;
                            $new_product_detail->price      = $request->price;
                            $new_product_detail->version_no = $product_detail->version_no + 1;
                            if (!$new_product_detail->save()) {
                                throw new \Exception('Can not update product detail');
                            }
                        }
                    DB::commit();

                    $request->session()->flash('message', 'Cập nhật thông tin sản phầm thành công');
                    return Redirect::to('business/product/edit/product_id/'.$product->id)->send();
                    exit;
                } catch (\Exception $e) {
                    DB::rollback();
                    $request->session()->flash('error', 'Không thể cập nhật sản phẩm này. Hãy thử lại lần nữa');
                }
            }
        }

        return view('product\edit')->with(array(
            'product_type'    => $product_type,
            'product'         => $product,
            'product_detail'  => $product_detail,
        ));
    }

    protected function _process_form_validation($stage, $request) {
        switch ($stage) {
            case "create":
            case "edit":
                $this->validate($request,[
                    'product_name' => 'required',
                    'product_type' => 'required|in:'.implode(",",array_keys(ProductModel::PRODUCT_TYPES_LANG)),
                    'price'        => 'required|numeric|max:1000000|min:1000'
                ],[
                    'product_name.required'  => 'Bạn phải nhập mục này',
                    'price.required'         => 'Bạn phải nhập mục này',
                    'product_type.required'  => 'Bạn phải nhập mục này',
                    'product_type.in'        => 'Loại sản phẩm ko tồn tại',
                    'price.max'              => 'Giá tiền này không được chấp nhận <= 1,000,000 vnđ',
                    'price.min'              => 'Giá tiền này không được chấp nhận > 1,000 vnđ',
                    'price.numeric'          => 'Giá tiền là kiểu số',
                ]);
        }

        return $this->errorBag();
    }
}
