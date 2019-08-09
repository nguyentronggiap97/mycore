@extends('backend::layout')

@section('title', 'Publisher Dashboard')
@section('description', 'Publisher Dashboard')

@section('content')
<!-- Main content -->
<section class="content section-report">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $stats['orders'] }}<sup style="font-size: 20px">đơn</sup></h3>
                <p>Tổng số đơn hàng</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('orders.index') }}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $stats['revenues'] }}<sup style="font-size: 20px">m</sup></h3>
                <p>Tổng doanh thu tạm tính</p>
            </div>
            <div class="icon">
                <i class="ion ion-social-usd-outline"></i>
            </div>
            <a href="{{ route('reports.index') }}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $stats['purchases'] }}<sup style="font-size: 20px">%</sup></h3>
                <p>Tỷ lệ mua hàng</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('orders.index') }}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $stats['discount'] }}<sup style="font-size: 20px">%</sup></h3>
                <p>Giảm giá</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('products.index') }}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Chart</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> Bán hàng</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 400px;"></div>
                </div>
            </div><!-- /.nav-tabs-custom -->
        </section>
    </div>

    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Đơn hàng mới nhất</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Tên sách</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-info">Processing</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer clearfix"> -->
                    <!-- <a href="{{ route('orders.index') }}" class="btn btn-sm btn-info btn-flat pull-left">Xem thêm</a> -->
                    <!-- <a href="{{ route('orders.index') }}" class="btn btn-sm btn-default btn-flat pull-right">Xem thêm</a> -->
                <!-- </div> -->

                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

        </section>

    </div><!-- /.row (main row) -->

</section><!-- /.content -->
@endsection

@push('styles')
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <style>
    .section-report .inner p {
        text-transform: uppercase;
    }
    .small-box > .small-box-footer {
        background: rgba(0, 0, 0, 0.04);
    }
    </style>
@endpush

@push('scripts')
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- jvectormap -->
    <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin/plugins/knob/jquery.knob.js') }}"></script>

    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

    <!-- FastClick -->
    <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
@endpush

@push('scripts')
    <script>
    (function($) {
        /**
         * Show notification when access dashboard
         */
        $('body').pgNotification({
            style: 'circle',
            title: 'Demen Message',
            message: "Welcome {{ Auth::user()->name }}",
            position: "top-right",
            timeout: 3000,
            type: "success",
            thumbnail: '<img width="40" height="40" style="display: inline-block;" src="{{ Auth::user()->avatar->thumb }}" data-src="{{ Auth::user()->avatar->thumb }}" alt="">'
        }).show();

        /**
         * Sortable
         */
        $(".connectedSortable").sortable({
            placeholder: "sort-highlight",
            connectWith: ".connectedSortable",
            handle: ".box-header, .nav-tabs",
            forcePlaceholderSize: true,
            zIndex: 999999
        });

        $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

        /**
         * Sales Chart
         */

        var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            data: [
                { y: '2019-10-01', books: 2666, revenue: 2666 },
                { y: '2019-10-02', books: 2778, revenue: 2294 },
                { y: '2019-10-03', books: 4912, revenue: 1969 },
                { y: '2019-10-04', books: 3767, revenue: 3597 },
                { y: '2019-10-05', books: 6810, revenue: 1914 },
                { y: '2019-10-06', books: 5670, revenue: 4293 },
                { y: '2019-10-07', books: 4820, revenue: 3795 },
                { y: '2019-10-08', books: 15073, revenue: 5967 },
                { y: '2019-10-09', books: 10687, revenue: 4460 },
                { y: '2019-10-10', books: 8432, revenue: 5713 },
            ],
            xkey: 'y',
            ykeys: ['books', 'revenue'],
            labels: ['Số sách', 'Doanh thu'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover: 'auto'
        });

        /**
         * Fix for charts under tabs
         */
        $('.box ul.nav a').on('shown.bs.tab', function () {
            area.redraw();
        });
    })(window.jQuery);
    </script>
@endpush