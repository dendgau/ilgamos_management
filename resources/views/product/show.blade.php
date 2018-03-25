@extends('template')

@section('title')
    <span>Quản lí sản phẩm</span>
    <i class="fa fa-angle-right"></i>
    <span>Danh sách sản phẩm</span>
@endsection

@section('extra_css')
    <style>
        table thead th, table tbody td {
            text-align: center;
        }
        table thead th:nth-child(2) {
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <h5>Danh sách sản phẩm</h5>
    <div class="row">
        <div class="col-8">
            {{$links}}
        </div>
        <div class="col-4" style="text-align: right">
            <a class="btn btn-warning" href="{{ url('/business/product/create') }}" role="button"><i class="fa fa-plus"></i> Tạo sản mới</a>
        </div>
    </div>
    <div class="table-responsive" style="margin-top: 15px">
        <table class="table table-striped" style="margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tên sản phẩm</th>
                    <th>Loại sản phẩm</th>
                    <th>Giá</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key=>$p)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td style="text-align: left">{{$p->product_name}}</td>
                        <td>
                            {{get_product_type_name_by_id($p->product_type)}}
                        </td>
                        <td>
                            <?php
                                $product_details     = $p->product_detail;
                                $version_no          = count($product_details);
                                $last_product_detail = $product_details[$version_no - 1];

                                echo format_money($last_product_detail->price);
                            ?>
                        </td>
                        <td>
                            <a class="btn btn-default btn-sm" href="{{ url('/business/product/edit/product_id/' . $p->id) }}" role="button"><i class="fa fa-pencil-square"></i> Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-8">
            {{$links}}
        </div>
        <div class="col-4" style="text-align: right">
            <a class="btn btn-warning" href="{{ url('/business/product/create') }}" role="button"><i class="fa fa-plus"></i> Tạo sản mới</a>
        </div>
    </div>
@endsection