@extends('template')

@section('title')
    <span>Quản lí bán hàng</span>
    <i class="fa fa-angle-right"></i>
    <span>Số HĐ: <a href="{{ url('/business/contract/edit/contract_id/' . $contract->id) }}">HD00{{$contract->id}}</a></span>
    <i class="fa fa-angle-right"></i>
    <span>Phần 2: Sửa thông tin khách hàng và gọi thêm món</span>
@endsection

@section('extra_css')
    <style>
        table.table-contract {
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
            float: left;
            text-align: center;
            margin-bottom: 10px
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
        .column_table_order_detail table thead th {
            text-align: center;
        }
        .column_table_order_detail table thead th:nth-child(2) {
            text-align: left;
        }
        .text-danger {
            margin-top: 5px;
            float: left;
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
    @if ($contract->disable)
        <div class="alert alert-danger" role="alert">
            <i class="fa fa-lock" style="color: red"></i> LƯU Ý: Hóa đơn này đã bị xóa. Mọi thao tác đều không thể thực hiện
        </div>
    @endif

    <h5>Phần 1: Thông tin khách hàng</h5>
    <div class="table-responsive" style="margin-top: 15px">
        {!! Form::open(['url' => Request::url()]) !!}
            {!! csrf_field() !!}
            <table class="table table-contract">
                <tr>
                    <th class="head1" rowspan="5" style="border-top: 1px dotted black;">
                        <span>Số HĐ: <a href="">HD00{{$contract->id}}</a></span><br/>
                        <span style="font-weight: normal">{{$contract->created_at}}</span>
                    </th>
                </tr>
                <tr>
                    <th class="head2" style="border-top: 1px dotted black;">Tên khách hàng</th>
                    <td class="child" style="border-top: 1px dotted black;">
                        {!!  Form::text('customer_name', count($errors->all()) > 0 ? old('customer_name') : $contract->customer_name, ['class' => 'form-control', 'placeholder' => 'Nhập tên khách hàng...']) !!}
                        <span class="text-danger" @if(!$errors->has('customer_name'))style="display: none"@endif><i class="fa fa-times-circle"></i> {{ $errors->first('customer_name') }}</span>
                    </td>
                    <th class="head2" style="border-top: 1px dotted black; border-left: 1px dotted #adadad;">Số bàn</th>
                    <td class="table-number" style="border-top: 1px dotted black;">
                        {!!  Form::select('table_number', $tables, count($errors->all()) > 0 ? old('table_number') : $contract->table_number, ['class' => 'form-control']) !!}
                        <span class="text-danger" @if(!$errors->has('table_number'))style="display: none"@endif><i class="fa fa-times-circle"></i> {{ $errors->first('table_number') }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="child" style="border-bottom: 1px dotted black;">
                        @if (!$contract->disable)
                            @if (!$contract->is_finished)
                                <button type="submit" class="btn btn-secondary btn-sm btn_update_contract"><i class="fa fa-plus"></i> Lưu thay đổi</button>
                            @endif
                            <button type="submit" formaction="{{ url('/business/contract/delete/contract_id/' . $contract->id) }}" class="btn btn-danger btn-sm btn_remove_contract"><i class="fa fa-remove"></i> Xóa hóa đơn</button>
                        @else
                            Liên hệ admin để mở lại hóa đơn này. ()
                        @endif
                    </td>
                </tr>
            </table>
        {!! Form::close() !!}
    </div>

    <h5>Phần 2: Gọi món</h5>

    <div class="table-contract">
        <div style="display: none">
            <input type="hidden" class="contract_id" name="contract_id" value="{{$contract->id}}">
            <div class="table-number">
                {{get_table_name_by_key($contract->table_number)}}
            </div>
        </div>

        @if (!$contract->is_finished && !$contract->disable)
            <span class="bound-button">
                <button type="button" style="margin-right: 10px" class="btn btn-secondary btn-sm add_order"><i class="fa fa-plus"></i> Thêm món</button>
            </span>
            <span class="bound-button">
                <button type="button" style="margin-right: 10px" class="@if ($contract->total_price == 0) hide @endif edit btn btn-success btn-sm process_payment"><i class="fa fa-hand-o-right"></i> Click thanh toán!</button>
            </span>
        @endif
        <span class="bound-button">
            <button type="button" class="@if ($contract->total_price == 0) hide @endif print btn btn-primary btn-sm" onclick="get_order_detail_printing({{$contract->id}})"><i class="fa fa-print"></i> In hóa đơn</button>
        </span>
        <div class="table-responsive column_table_order_detail">
            <table class="table table-bordered ">
                <thead>
                    <th>No</th>
                    <th>Tên món</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Thêm/Xóa</th>
                </thead>
                <tbody>
                    @foreach ($contract->order_detail as $key => $o)
                        @if($o->amount > 0)
                            <tr>
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td>{{$o->product_name}}</td>
                                <td style="text-align: center">{{format_money($o->unit_price)}}</td>
                                <td style="text-align: center"x{{$o->amount}}</td>
                                <td style="text-align: center">{{format_money($o->total_price)}}</td>
                                <td style="text-align: center">
                                    @if (!$contract->disable && !$contract->is_finished)
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
        <div style="float: left; width: 100%">
            <h5 style="float: left">
                Tổng tiền: <span class="column_total_price">{{format_money($contract->total_price)}}</span>
            </h5>
            <h5 style="float: right">
                Tình trạng:
                <span class="column_state">
                    @if ($contract->total_price == 0)
                        <span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa gọi món</span>
                    @elseif ($contract->is_finished)
                        <span style="color: green"><i class="fa fa-check" style="color: green"></i> Đã thanh toán</span>
                    @else
                        <span style="color: red"><i class="fa fa-warning" style="color: red"></i> Chưa thanh toán</span>
                    @endif
            </span>
            </h5>
        </div>
    </div>

    <div style="float: left; width: 100%; margin-top: 20px">
        <a class="btn btn-warning" style="margin-right: 5px" href="{{ url('/business/contract/show') }}" role="button"><i class="fa fa-arrow-left"></i> Quay về màn hình chính</a>
        <a class="btn btn-warning" href="{{ url('/business/contract/create') }}" role="button"><i class="fa fa-file-text-o"></i> Tạo hóa đơn khác</a>
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
                            <option value="<?php echo $p['id'] ?>"><?php echo $p['product_name'] ?></option>
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