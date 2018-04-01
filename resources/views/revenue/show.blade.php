@extends('template')

@section('title')
    <span>Quản lí bán hàng</span>
    <i class="fa fa-angle-right"></i>
    <span>Danh sách hóa đơn</span>
@endsection

@section('content')
    <h5>Lợi nhuận theo tháng</h5>
    <form action="{{Request::url()}}" class="navbar-form navbar-left" role="search">
        <div class="form-group" style="width: 700px;display: inline-table; margin-top: 15px; margin-bottom: 0px">
            <select name="month" class="form-control" style="width: 500px; float: left">
                <option value="">== Chọn tháng ở đây ==</option>
                <?php for ($i = 1; $i <= 12; $i++): ?>
                    <?php if ($month == $i): ?>
                        <option value="<?php echo $i ?>" selected="selected">Tháng <?php echo $i ?></option>
                    <?php else: ?>
                        <option value="<?php echo $i ?>">Tháng <?php echo $i ?></option>
                    <?php endif; ?>
                <?php endfor; ?>
            </select>
            <button type="submit" class="btn btn-default" style="float: left; margin-left: 5px"><i class="fa fa-search"></i>Tìm kiếm</button>
        </div>
    </form>
    <hr>
    <div class="table-responsive" style="width: 500px">
        <table class="table table-bordered" style="margin-top: 10px">
            <thead class="thead-dark">
                <tr>
                    <th>Ngày bán hàng</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($revenues as $r)
                    <tr>
                        <th>{{$r->date}}</th>
                        <td>{{format_money($r->total)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection