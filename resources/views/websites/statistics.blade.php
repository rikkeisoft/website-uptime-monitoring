@extends('template_Dashboard')

@section('title')
    List Websites
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')
            @endcomponent
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div id="request"></div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div id="uptime"></div>
                </div>
            </div>

            <!-- /.col-lg-12 -->
        </div>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
        <script>
            var listRequests = {{ json_encode($listRequest) }};
            var websiteName = '{{ $websiteName }}';
            var listCreateds = '{{ $listCreated}}'.split('|');

            Highcharts.chart('request', {
                title: {
                    text: 'Time Request'
                },
                subtitle: {
                    text: websiteName
                },
                xAxis: {
                    categories: listCreateds
                },
                yAxis: {
                    title: {
                        text: 'Time Request(s)'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        pointStart: 0,
                        dataLabels: {
                            enabled: true,
                            x: 2,
                            y: -10,
                            format: '{point.y:.2f} s '
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.y:.2f} s '
                },
                series: [{
                    name: 'Time Request',
                    data: listRequests
                }]
            });
        </script>
        <script>
            var listDown = {{ $listUpDown['down'] }};
            var listUp = {{ $listUpDown['up'] }};
            var websiteName = '{{ $websiteName }}';

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
                            format: '<b>{point.name}</b>: {point.percentage:.0f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    colorByPoint: true,
                    data: [
                        {
                            'name': 'Up',
                            'y': listUp,
                        },
                        {
                            'name': 'Down',
                            'y': listDown,
                        }
                    ],
                    sliced: true,
                    selected: true
                }]
            });
        </script>

    </div>
@endsection