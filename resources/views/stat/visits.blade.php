@extends('layouts.default')

@section('content')
    <script src="/bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="/bower_components/moment/min/moment.min.js"></script>
    <script src="/bower_components/semantic-ui-daterangepicker-master/daterangepicker.js"></script>
    <link rel="stylesheet" href="/bower_components/semantic-ui-daterangepicker-master/daterangepicker.css"/>

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <a class="section" href="/statistics">Quản lý</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>

        <h3 class="ui huge header">Thống kê</h3>
        <div class="ui one column grid">
            <div class="column">
                <div class="ui right floated buttons">
                    <button id="reportrange" class="ui  icon labeled  button">
                        <i class="calendar icon" style="margin:0"></i>
                        <span>{{old('start')}} - {{old('end')}}</span>
                    </button>
                </div>
            </div>
        </div>

        @include('dashboard.total')

        <h3 class="ui header">Đơn hàng</h3>
        <canvas id="orders_chart"></canvas>
        <br>
        <h3 class="ui header">Doanh thu</h3>
        <canvas id="revenue_chart"></canvas>
        <br>
        <h3 class="ui header">Lượt khách xem trang</h3>
        <canvas id="visits_chart"></canvas>
        <br>
    </div>
    <form method="get" id="time_form">
        <input type="hidden" id="start_time" name="start" value="{{old('start')}}">
        <input type="hidden" id="end_time" name="end" value="{{old('end')}}">
    </form>
    <script>
        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $("#start_time").val(start.format('MMMM D, YYYY'));
            $("#end_time").val(end.format('MMMM D, YYYY'));
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#time_form').submit();
        };

        var optionSet = {
            startDate: moment().subtract(7, 'days'),
            endDate: moment(),
            opens: 'left',
            ranges: {
                'Trong 1 tuần': [moment().subtract(6, 'days'), moment()],
                'Trong 1 tháng': [moment().subtract(29, 'days'), moment()],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        };

        $(function () {
            $('#reportrange').daterangepicker(optionSet, cb);
        });

        //visits chart
        visits_chart_canvas = $('#visits_chart').get(0).getContext('2d');
        new Chart(visits_chart_canvas, {
            type: 'line',
            data: {
                labels: {!! $logs->pluck('label') !!},
                datasets: [{
                    label: 'Lượt xem',
                    data: {!! $logs->pluck(\App\Log::VIEWS) !!},
                    borderColor: '#3c8dbc',
                    borderWidth: 2
                }]
            }
        });
        revenue_chart_canvas = $('#revenue_chart').get(0).getContext('2d');
        new Chart(revenue_chart_canvas, {
            type: 'line',
            data: {
                labels: {!! $logs->pluck('label') !!},
                datasets: [{
                    label: 'Doanh thu ({{$logs->pluck(\App\Log::REVENUE)->sum()}})$',
                    data: {!! $logs->pluck(\App\Log::REVENUE) !!},
                    borderColor: '#a035bc',
                    borderWidth: 2
                }]
            }
        });

        orders_chart_canvas = $('#orders_chart').get(0).getContext('2d');
        new Chart(orders_chart_canvas, {
            type: 'bar',
            data: {
                labels: {!! $logs->pluck('label') !!},
                datasets: [{
                    label: 'Có ({{$logs->pluck(\App\Log::CHECKOUT)->sum()}}) đơn hàng mới',
                    data: {!! $logs->pluck(\App\Log::CHECKOUT) !!},
                    borderColor: '#58cd73',
                    borderWidth: 2
                }, {
                    label: 'Xác nhận ({{$logs->pluck(\App\Log::ORDER_CONFIRMED)->sum()}}) đơn',
                    data: {!! $logs->pluck(\App\Log::ORDER_CONFIRMED) !!},
                    borderColor: '#2773cd',
                    borderWidth: 2
                }, {
                    label: 'Vận chuyển ({{$logs->pluck(\App\Log::ORDER_SHIP)->sum()}}) đơn',
                    data: {!! $logs->pluck(\App\Log::ORDER_SHIP) !!},
                    borderColor: '#cdc71e',
                    borderWidth: 2
                }, {
                    label: 'Hủy ({{$logs->pluck(\App\Log::ORDER_DISPOSE)->sum()}}) đơn',
                    data: {!! $logs->pluck(\App\Log::ORDER_DISPOSE) !!},
                    borderColor: '#cd2923',
                    borderWidth: 2
                }]
            }
        });
    </script>
@endsection