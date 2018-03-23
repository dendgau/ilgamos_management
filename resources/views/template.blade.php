<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=0">
        <title>Ilgamos Bar</title>

        <!-- Start Styles -->
        <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/business/common.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @section('extra_css')
        @show
        <!-- End Styles -->
    </head>
    <body>
        <div id="sidebar">
            <div id="header-wrapper">
                <div id="header">
                    <h5>ILGAMOS BAR</h5>
                </div>
                <ul class="left-menu-bar">
                    <li class="active"><a href=""><i class="fa fa-cart-plus"></i> Quản lý bán hàng</a></li>
                    <li><a href=""><i class="fa fa-coffee"></i> Quản lý sản phẩm</a></li>
                    <li><a href=""><i class="fa fa-bank"></i> Quản lý phiếu chi</a></li>
                    <li><a href=""><i class="fa fa-area-chart"></i> Thống kê doanh thu</a></li>
                </ul>
                <section id="footer">
                    <p>Develop by <a href="https://github.com/dendgau">Duy Trần</a></p>
                    <p>Built with <a href="https://laravel.com/">Laravel 5.6</a> - The PHP Framework For Web Artisans</p>
                </section>
            </div>
        </div>
        <div id="body">
            <div class="ILcontainer">
                <div class="alert alert-dark">
                    <span>Ilgamos Bar</span>
                    <i class="fa fa-angle-right"></i>
                    @section('title')
                    @show
                </div>
                @section('content')
                @show
            </div>
        </div>
        <!-- For inform error system -->
        <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start JS -->
        <script src="{{asset('js/jquery/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap/select2.min.js')}}"></script>
        <script src="{{asset('js/business/admin.app.js')}}"></script>
        <script src="{{asset('js/helpers/common.js')}}"></script>
        <script>
            // Common JS
            function get_csrf_token() {
                return "{{csrf_token()}}";
            }
        </script>
        @section('extra_js')
        @show
        <!-- End JS -->
    </body>
</html>
