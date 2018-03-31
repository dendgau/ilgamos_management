<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\ContractModel;
use App\Models\OrderDetailModel;
use App\Models\ProductDetailModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    function ajax_add_order_detail(Request $request) {
        if (!$request->ajax() || !$request->isMethod('post')) {
            return response()->json(['code' => '0', 'message' => 'The request is not ajax post']);
        }

        if (!($contract_id = $request->get('contract_id')) && !is_numeric($contract_id)) {
            return response()->json(['code' => '0', 'message' => 'Can not get contract id']);
        }

        if (!($product_ids = $request->get('product_ids')) && !is_array($product_ids)) {
            return response()->json(['code' => '0', 'message' => 'Can not get product id']);
        }

        if (!($quantity = $request->get('quantity')) && !is_numeric($quantity)) {
            return response()->json(['code' => '0', 'message' => 'Can not get contract id']);
        }

        $response_data    = array();
        $response_message = "";

        try {

            DB::beginTransaction();

            // START ADD ORDER DETAIL
            if (!$contract = ContractModel::where('id', '=', $contract_id)->first()) {
                throw new \Exception('Can not get contract');
            }

            if ($contract->is_finished) {
                throw new \Exception('Contract is finished');
            }

            foreach ($product_ids as $product_id) {
                if (!$order_detail = OrderDetailModel::where('product_id', '=', $product_id)->where('contract_id', '=', $contract_id)->first()) {
                    $product_info         = ProductModel::find($product_id);
                    $product_price_detail = ProductDetailModel::where('product_id', '=', $product_id)->orderBy('version_no', 'desc')->first();

                    // Initial new order detail
                    $new_order_detail = new OrderDetailModel();
                    $new_order_detail->amount           = 1;
                    $new_order_detail->contract_id      = $contract_id;
                    $new_order_detail->product_id       = $product_id;
                    $new_order_detail->product_name_vi  = $product_info->product_name_vi;
                    $new_order_detail->product_name_en  = $product_info->product_name_en;
                    $new_order_detail->unit_price       = $product_price_detail->price;
                    $new_order_detail->total_price      = $product_price_detail->price;

                    if (!$new_order_detail->save()) {
                        throw new \Exception('Can not add order detail');
                    }
                } else {
                    $order_detail->amount     += $quantity; // Add one in quantity
                    $order_detail->total_price = $order_detail->unit_price * $order_detail->amount; // Calculate total price again
                    if (!$order_detail->save()) {
                        throw new \Exception('Can not update order detail');
                    }
                }
            }

            // START CALCULATE CONTRACT PRICE
            $order_details = OrderDetailModel::where('contract_id', '=', $contract_id)->get();
            $total_price   = calculate_total_price($order_details->toArray());
            $contract->total_price = $total_price;
            if (!$contract->save()) {
                throw new \Exception('Can not update total price contract');
            }

            // START SET RESPONSE
            $response_data['html_order_detail'] = ajax_response_order_detail($contract->toArray(), $order_details->toArray());
            $response_data['html_total_price']  = format_money($total_price);
            $result_update = true;

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $result_update    = false;
            $response_message = $e->getMessage();
        }

        return response()->json([
            'code'    => $result_update ? 1 : 0,
            'data'    => $response_data,
            'message' => $response_message
        ]);
    }

    function ajax_change_quantity_order_detail(Request $request) {
        if (!$request->ajax() || !$request->isMethod('post')) {
            return response()->json(['code' => '0', 'message' => 'The request is not ajax post']);
        }

        if (!($contract_id = $request->get('contract_id')) && !is_numeric($contract_id)) {
            return response()->json(['code' => '0', 'message' => 'Can not get contract id']);
        }

        if (!($order_detail_id = $request->get('order_detail_id')) && !is_numeric($order_detail_id)) {
            return response()->json(['code' => '0', 'message' => 'Can not get contract id']);
        }

        if (!($quantity = $request->get('quantity')) && !is_numeric($quantity)) {
            return response()->json(['code' => '0', 'message' => 'Can not get contract id']);
        }

        $response_data    = array();
        $response_message = "";

        try {

            DB::beginTransaction();

                // START UPDATE PRICE IN ORDER DETAIL
                if (!$contract = ContractModel::where('id', '=', $contract_id)->first()) {
                    throw new \Exception('Can not get contract');
                }

                if ($contract->is_finished) {
                    throw new \Exception('Contract is finished');
                }

                if (!$order_detail = OrderDetailModel::where('id', '=', $order_detail_id)->where('contract_id', '=', $contract_id)->first()) {
                    throw new \Exception('Can not get order detail');
                }

                $order_detail->amount     += $quantity; // Add one in quantity
                $order_detail->total_price = $order_detail->unit_price * $order_detail->amount; // Calculate total price again
                if (!$order_detail->save()) {
                    throw new \Exception('Can not update order detail');
                }

                // START CALCULATE CONTRACT PRICE
                $order_details = OrderDetailModel::where('contract_id', '=', $contract_id)->get();
                $total_price   = calculate_total_price($order_details->toArray());
                $contract->total_price = $total_price;
                if (!$contract->save()) {
                    throw new \Exception('Can not update total price contract');
                }

                // START SET RESPONSE
                $response_data['html_order_detail'] = ajax_response_order_detail($contract->toArray(), $order_details->toArray());
                $response_data['html_total_price']  = format_money($total_price);
                $result_update = true;

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $result_update    = false;
            $response_message = $e->getMessage();
        }

        return response()->json([
            'code'    => $result_update ? 1 : 0,
            'data'    => $response_data,
            'message' => $response_message
        ]);
    }

    function ajax_get_order_detail_printing(Request $request) {
        if (!$request->ajax() || !$request->isMethod('post')) {
            return response()->json(['code' => '0', 'message' => 'The request is not ajax post']);
        }

        if (!($contract_id = $request->get('contract_id')) && !is_numeric($contract_id)) {
            return response()->json(['code' => '0', 'message' => 'Can not get contract id']);
        }

        if (!$contract = ContractModel::where('id', '=', $contract_id)->first()) {
            throw new \Exception('Can not get contract');
        }

        if (!$order_details = $contract->order_detail) {
            throw new \Exception('Can not get order detail');
        }

        $response_data['html_order_detail'] = ajax_get_order_detail_printing($contract->toArray(), $order_details->toArray());

        return response()->json([
            'code'    => 1,
            'data'    => $response_data,
            'message' => ''
        ]);
    }
}
