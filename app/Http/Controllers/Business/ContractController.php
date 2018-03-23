<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\ContractModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    function index() {
        $contracts = ContractModel::paginate(6);
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

        return view('home')->with(array(
            'contracts' => $contracts,
            'links'     => $links,
            'total'     => $total,
            'menu'      => $menu
        ));
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

    function process_auto_insert_example() {
        for ($i = 0; $i < 10; $i++) {
            $nContract = new ContractModel;
            $nContract->customer_name = 'Tony';
            $nContract->staff_name    = 'Duy';
            $nContract->table_number  = 'A1';
            $nContract->total_price  = 1000 * $i;
            $nContract->save();
        }
    }
}
