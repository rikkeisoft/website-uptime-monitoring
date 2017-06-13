@extends('template_Dashboard')

@section('title')
    List Websites
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')
            @endcomponent
            <div id="request"></div>
            <div id="uptime"></div>

            <!-- /.col-lg-12 -->
        </div>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script>
            var listCharts = {{ json_encode($listChart) }};
            var websiteName = '{{ $websiteName }}'
            Highcharts.chart('request', {
                title: {
                    text: 'Request Time'
                },

                subtitle: {
                    text: websiteName
                },

                yAxis: {
                    title: {
                        text: 'Number of Employees'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                plotOptions: {
                    series: {
                        pointStart: 0
                    }
                },

                series: [{
                    name: 'Time Request',
                    data: listCharts
                }]

            });

        </script>
        <script>
            var listDonutFail =
                    {{ $listDonut['fail'] }}
            var listDonutSuccess =
                    {{ $listDonut['success'] }}

            var websiteName = '{{ $websiteName }}'
            // Build the chart
            Highcharts.chart('uptime', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Up/Down'
                },
                subtitle: {
                    text: websiteName
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Up/Down',
                    colorByPoint: true,
                    data: [{
                        'name': 'Down',
                        'y': listDonutFail,
                    },
                        {
                            'name': 'Up',
                            'y': listDonutSuccess,
                        }],
                    sliced: true,
                    selected: true
                }]
            });

        </script>

    </div>
@endsection