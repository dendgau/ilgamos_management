@extends('template')

@section('title')
    <span>Quản lí sản phẩm</span>
    <i class="fa fa-angle-right"></i>
    <span>Thêm sản phẩm mới</span>
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
    <h5>Thêm sản phẩm mới</h5>
    <div class="table-responsive" style="margin-top: 15px">
        {!! Form::open(['url' => Request::url()]) !!}
            {!! csrf_field() !!}
            <table class="table table-contract" style="margin-bottom: 20px;">
                <tr>
                    <th class="head1" rowspan="5" style="border-top: 1px dotted black;">
                        Thông tin sản phẩm
                    </th>
                </tr>
                <tr>
                    <th class="head2" style="border-top: 1px dotted black;">Tên sản phẩm</th>
                    <td class="child" style="border-top: 1px dotted black; border-right: 1px dotted black;">
                        {!!  Form::text('product_name', old('product_name'), ['class' => 'form-control', 'placeholder' => 'Nhập tên sản phẩm...']) !!}
                        <span class="text-danger" @if(!$errors->has('product_name'))style="display: none"@endif><i class="fa fa-times-circle"></i> {{ $errors->first('product_name') }}</span>
                    </td>
                </tr>
                <tr>
                    <th class="head2" style="border-left: 1px dotted #adadad;">Loại sản phẩm</th>
                    <td class="child" style="border-right: 1px dotted black;">
                        {!!  Form::select('product_type', $product_type, old('product_type'), ['class' => 'form-control', 'style' => 'width: 300px']) !!}
                        <span class="text-danger" @if(!$errors->has('product_type'))style="display: none"@endif><i class="fa fa-times-circle"></i> {{ $errors->first('product_type') }}</span>
                    </td>
                </tr>
                <tr>
                    <th class="head2" style="border-left: 1px dotted #adadad;">Giá / 1 sản phẩm</th>
                    <td class="child" style="border-right: 1px dotted black;">
                        {!!  Form::input('number', 'price', old('price'), ['class' => 'form-control', 'placeholder' => 'Nhập giá tiền...', 'style' => 'width: 300px']) !!}
                        <span class="text-danger" @if(!$errors->has('price'))style="display: none"@endif><i class="fa fa-times-circle"></i> {{ $errors->first('price') }}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="child" style="border-bottom: 1px dotted black;">
                        <button type="submit" class="btn btn-secondary btn-sm btn_update_contract"><i class="fa fa-plus"></i> Tạo sản phẩm</button>
                    </td>
                </tr>
            </table>
        {!! Form::close() !!}
    </div>
    <a class="btn btn-warning" href="{{ url('/business/product/show') }}" role="button"><i class="fa fa-arrow-left"></i> Quay về màn hình chính</a>
@endsection