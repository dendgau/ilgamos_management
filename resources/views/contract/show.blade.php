@extends('template')

@section('title')
    <span>Quản lí bán hàng</span>
    <i class="fa fa-angle-right"></i>
    <span>Danh sách hóa đơn</span>
@endsection

@section('extra_css')
    <style>
        .table-contract {
            border: 1px dotted black;
            margin-bottom: 2rem;
        }
        .table-contract .head1 {
            width: 180px;
            background-color: #F5F6EA;
            border-right: 1px dotted #adadad;
        }
        .table-contract .head1 button {
            width: 100%;
        }
        .table-contract .head2 {
            width: 220px;
            background-color: #F5F6EA;
            border-top: 1px dotted #adadad;
            border-right: 1px dotted #adadad;
        }
        .table-contract .add_order_detail, .table-contract .remove_order_detail {
            padding: 0px 4px;
            font-size: 11px;
        }
        .bound-button {
            width: 100%;
            float: left;
            text-align: center;
        }
        .column_table_order_detail table thead th:nth-child(6){
            width: 100px!important;
            text-align: center;
        }
        .column_table_order_detail table thead th:nth-child(1){
            width: 45px!important;
        }
        .column_table_order_detail table thead th:nth-child(3), .column_table_order_detail table thead th:nth-child(5){
            width: 120px!important;
        }
        .column_table_order_detail table thead th:nth-child(4){
            width: 90px!important;
        }
        .column_table_order_detail table thead th, .modal_table_order_detail thead th {
            text-align: center;
        }
        .column_table_order_detail table thead th:nth-child(2), .modal_table_order_detail thead th:nth-child(1) {
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <h5>Danh sách hóa đơn</h5>
    <hr>
    <div class="row">
        <div class="col-8">
            {{$links}}
        </div>
        <div class="col-4" style="text-align: right">
            <a class="btn btn-warning" href="{{ url('/business/contract/create') }}" role="button"><i class="fa fa-file-text-o"></i> Tạo hóa đơn</a>
        </div>
    </div>
    <div class="table-responsive">
        @if($contracts)
            @foreach ($contracts as $contract)
                <table class="table table-contract" style="margin-top: 10px">
                    <tr>
                        <th class="head1" rowspan="5" style="border-top: 1px dotted black;">
                            <span>Số HĐ: <a href="{{ url('/business/contract/edit/contract_id/' . $contract->id) }}">HD00{{$contract->id}}</a></span><br/>
                            <span style="font-weight: normal">{{$contract->created_at}}</span>
                            @if (!$contract->is_finished)
                                <span class="bound-button" style="margin-top: 20px;">
                                    <button type="button" class="@if ($contract->total_price == 0) hide @endif btn btn-success btn-sm process_payment" style="margin-top: 10px"><i class="fa fa-hand-o-right"></i> Click thanh toán!</button>
                                </span>
                            @endif
                            <span class="bound-button">
                                <button type="button" class="@if ($contract->total_price == 0) hide @endif print btn btn-primary btn-sm" style="margin-top: 10px" onclick="get_order_detail_printing({{$contract->id}})"><i class="fa fa-print"></i> In hóa đơn</button>
                            </span>
                            <input type="hidden" class="contract_id" name="contract_id" value="{{$contract->id}}">
                        </th>
                    </tr>
                    <tr>
                        <th class="head2" style="border-top: 1px dotted black;">Tên khách hàng</th>
                        <td class="child" style="border-top: 1px dotted black;">{{$contract->customer_name}}</td>
                        <th class="head2" style="border-top: 1px dotted black; border-left: 1px dotted #adadad;">Số bàn</th>
                        <td class="table-number" style="border-top: 1px dotted black;">{{get_table_name_by_key($contract->table_number)}}</td>
                    </tr>
                    <tr>
                        <th class="head2">Món đã gọi</th>
                        <td colspan="3" class="child">
                            <div class="table-responsive column_table_order_detail @if ($contract->total_price == 0) hide @endif">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th>Tên món</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Thêm/Xóa</th>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($contract->order_detail as $key => $o)
                                            @if($o->amount > 0)
                                                <?php $count++; ?>
                                                <tr>
                                                    <td style="text-align: center">{{$count}}</td>
                                                    <td>{{$o->product_name_vi}}</td>
                                                    <td style="text-align: center">{{format_money($o->unit_price)}}</td>
                                                    <td style="text-align: center">x{{$o->amount}}</td>
                                                    <td style="text-align: center">{{format_money($o->total_price)}}</td>
                                                    <td style="text-align: center">
                                                        @if (!$contract->is_finished)
                                                            <button data-order_detail_id="{{$o->id}}" class="add_order_detail btn-default btn-sm"><i class="fa fa-plus"></i></button>
                                                            <button data-order_detail_id="{{$o->id}}" class="remove_order_detail btn-default btn-sm"><i class="fa fa-minus"></i></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if (!$contract->is_finished)
                                <button type="button" class="btn btn-secondary btn-sm add_order"><i class="fa fa-plus"></i> Thêm món</button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="head2">Trạng thái</th>
                        <td colspan="3" class="child column_state">
                            @if ($contract->total_price == 0)
                                <span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa gọi món</span>
                            @elseif ($contract->is_finished)
                                <span style="color: green"><i class="fa fa-check" style="color: green"></i> Đã thanh toán</span>
                            @else
                                <span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa thanh toán</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="head2">Tổng tiền</th>
                        <td colspan="3" class="column_total_price child">{{ format_money($contract->total_price) }}</td>
                    </tr>
                </table>
            @endforeach
        @else
            <p>Không có hóa đơn nào</p>
        @endif
    </div>
    <div class="row">
        <div class="col-8">
            {{$links}}
        </div>
    </div>

    <!-- For add order -->
    <div class="modal fade" id="modal_add_order" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    Thêm món mới
                </div>
                <div class="modal-body">
                    <input type="hidden" name="modal_hidden_contract_id">
                    <label for="menu-select2" style="width: 100%; float: left"><strong>Món ăn</strong></label>
                    <select id="menu-select2" style="width: 50%; float: left">
                        <option value="-1">== Chọn món ở đây ==</option>
                        <?php foreach ($menu as $r): ?>
                            <optgroup label="<?php echo $r['label'] ?>">
                                <?php foreach ($r['data'] as $p): ?>
                                    <option value="<?php echo $p['id'] ?>"><?php echo $p['product_name_vi'] ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    </select>

                    <div class="table-responsive">
                        <table class="table table-bordered modal_table_order_detail" style="display: none; margin-top: 20px">
                            <thead>
                                <tr>
                                    <th>Tên món</th>
                                    <th style="width: 90px;">Số lượng</th>
                                    <th style="width: 70px;">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-default save">Đồng ý thêm món</button>
                </div>
            </div>
        </div>
    </div>
@endsection