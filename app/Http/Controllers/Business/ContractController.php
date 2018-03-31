<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\ContractModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContractController extends Controller
{
    function show() {
        $contracts = ContractModel::where('disable', '=', '0')->where('is_finished', '=', '0')->orderBy('id', 'DESC')->paginate(6);
        $links     = $contracts->links("pagination::bootstrap-4");
        $total     = $contracts->total();

        $menu = array();
        foreach (ProductModel::PRODUCT_TYPES as $key => $type) {
            $product = ProductModel::where('product_type', '=', $type)->get();
            $menu[] = array(
                'label' => ProductModel::PRODUCT_TYPES_LANG[$key],
                'data'  => $product->toArray()
            );
        }

        return view('contract\show')->with(array(
            'contracts' => $contracts,
            'links'     => $links,
            'total'     => $total,
            'menu'      => $menu
        ));
    }

    function create(Request $request) {
        if ($request->isMethod('post')) {
            if ($this->_process_form_validation(__FUNCTION__, $request)) {
                try {
                    DB::beginTransaction();
                        $new_contract = new ContractModel();
                        $new_contract->staff_name    = 'Duy Tran';
                        $new_contract->customer_name = $request->customer_name;
                        $new_contract->table_number  = $request->table_number;
                        if (!$new_contract->save()) {
                            throw new \Exception('Can not create new contract');
                        }
                    DB::commit();

                    $request->session()->flash('message', 'Tạo thông tin khách hàng thành công. Xin hãy thêm món vào hóa đơn ở mục 2');
                    return Redirect::to('business/contract/edit/contract_id/'.$new_contract->id)->send();
                    exit;
                } catch (\Exception $e) {
                    DB::rollback();
                    $request->session()->flash('error', 'Không thể tạo hóa đơn mới. Xin vui lòng thử lại');
                }
            }
        }

        return view('contract\create')->with(array(
            'tables' => ContractModel::TABLES_NAME,
        ));
    }

    function edit(Request $request) {
        if (!($contract_id = $request->route('contract_id'))) {
            $request->session()->flash('error', 'Không tìm thấy mã hóa đơn');
            Redirect::to('business/contract/show')->send();
        }

        if (!($contract = ContractModel::find($contract_id))) {
            $request->session()->flash('error', 'Không tìm thấy mã hóa đơn HD00'. $contract_id);
            Redirect::to('business/contract/show')->send();
        }

        if ($request->isMethod('post')) {
            if ($this->_process_form_validation(__FUNCTION__, $request)) {
                try {
                    DB::beginTransaction();
                        $contract->customer_name = $request->customer_name;
                        $contract->table_number  = $request->table_number;
                        if (!$contract->save()) {
                            throw new \Exception('Can not update contract');
                        }
                    DB::commit();

                    $request->session()->flash('message', 'Cập nhật thông tin khách hàng thành công');
                    return Redirect::to('business/contract/edit/contract_id/'.$contract->id)->send();
                    exit;
                } catch (\Exception $e) {
                    DB::rollback();
                    $request->session()->flash('error', 'Không thể cập nhật hóa đơn này. Xin vui lòng thử lại');
                }
            }
        }

        $menu = array();
        foreach (ProductModel::PRODUCT_TYPES as $key => $type) {
            $product = ProductModel::where('product_type', '=', $type)->get();
            $menu[] = array(
                'label' => ProductModel::PRODUCT_TYPES_LANG[$key],
                'data'  => $product->toArray()
            );
        }

        return view('contract\edit')->with(array(
            'contract' => $contract,
            'tables'   => ContractModel::TABLES_NAME,
            'menu'     => $menu
        ));
    }

    function delete(Request $request){
        if (!($contract_id = $request->route('contract_id'))) {
            $request->session()->flash('error', 'Không tìm thấy mã hóa đơn');
            Redirect::to('business/contract/show')->send();
        }

        if (!($contract = ContractModel::find($contract_id))) {
            $request->session()->flash('error', 'Không tìm thấy mã hóa đơn HD00'. $contract_id);
            Redirect::to('business/contract/show')->send();
        }

        if ($request->isMethod('post')) {
            $contract->disable  = 1;
            if (!$contract->save()) {
                $request->session()->flash('error', 'Không thể xóa hóa đơn này. Xin vui lòng thử lại');
            }
            return Redirect::to('business/contract/edit/contract_id/'.$contract->id)->send();
            exit;
        }
    }

    protected function _process_form_validation($stage, $request) {
        switch ($stage) {
            case "create":
            case "edit":
                $this->validate($request,[
                    'customer_name' => 'required|max:30',
                    'table_number' => 'required|in:'.implode(",",array_keys(ContractModel::TABLES_NAME)),
                ],[
                    'customer_name.required' => 'Bạn phải nhập mục này',
                    'customer_name.max'      => 'Vượt quá số kí tự cho phép',
                    'table_number.required'  => 'Bạn phải nhập mục này',
                    'table_number.in'        => 'Số bàn không tồn tại'
                ]);
        }

        return $this->errorBag();
    }

    function ajax_change_payment_state(Request $request) {
        if (!$request->ajax() || !$request->isMethod('post')) {
            return response()->json(['code' => '0', 'message' => 'The request is not ajax post']);
        }

        if (!($contract_id = $request->get('contract_id')) && !is_numeric($contract_id)) {
            return response()->json(['code' => '0', 'message' => 'Can not get contract id']);
        }

        $response_data    = array();
        $response_message = "";

        try {
            if (!ContractModel::update_item_by_id($contract_id, array('is_finished' => 1))) {
                throw new \Exception('Can not update contract');
            }
            $result_update = true;
        } catch (\Exception $e) {
            $result_update    = false;
            $response_message = $e->getMessage();
        }

        return response()->json([
            'code'    => $result_update ? 1 : 0,
            'data'    => $response_data,
            'message' => $response_message
        ]);
    }
}
