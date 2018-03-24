@extends('template')

@section('title')
    <span>Tạo hóa đơn</span>
    <i class="fa fa-angle-right"></i>
    <span>Bước 1: Thông tin khách hàng</span>
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
            width: 80px!important;
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
        .text-danger {
            margin-top: 5px;
            float: left;
        }
    </style>
@endsection

@section('content')
    <h5>Bước 1: Thông tin khách hàng</h5>
    <div class="table-responsive" style="margin-top: 15px">
        {!! Form::open(['url' => Request::url()]) !!}
            {!! csrf_field() !!}
            <table class="table table-contract">
                <tr>
                    <th class="head1" rowspan="5" style="border-top: 1px dotted black;">
                        <span>Hóa đơn ngày:</span><br/>
                        <span style="font-weight: normal">{{Carbon\Carbon::now()}}</span>
                    </th>
                </tr>
                <tr>
                    <th class="head2" style="border-top: 1px dotted black;">Tên khách hàng</th>
                    <td class="child" style="border-top: 1px dotted black;">
                        {!!  Form::text('customer_name', old('customer_name'), ['class' => 'form-control', 'placeholder' => 'Nhập tên khách hàng...']) !!}
                        <span class="text-danger" @if(!$errors->has('customer_name'))style="display: none"@endif><i class="fa fa-times-circle"></i> {{ $errors->first('customer_name') }}</span>
                    </td>
                    <th class="head2" style="border-top: 1px dotted black; border-left: 1px dotted #adadad;">Số bàn</th>
                    <td class="table-number" style="border-top: 1px dotted black;">
                        {!!  Form::select('table_number', $tables, old('table_number'), ['class' => 'form-control']) !!}
                        <span class="text-danger" @if(!$errors->has('table_number'))style="display: none"@endif><i class="fa fa-times-circle"></i> {{ $errors->first('table_number') }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="child" style="border-bottom: 1px dotted black;">
                        <button type="submit" class="btn btn-secondary btn-sm "><i class="fa fa-plus"></i> Tạo</button>
                    </td>
                </tr>
            </table>
        {!! Form::close()  !!}
    </div>
@endsection