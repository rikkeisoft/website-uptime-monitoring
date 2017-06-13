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
            console.log({{ json_encode($listChart) }});
            var listCharts = {{ json_encode($listChart) }}
            Highcharts.chart('request', {
                title: {
                    text: 'Request Time'
                },

                subtitle: {
                    text: 'Source: Website Uptime'
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
            $(document).ready(function () {
                var listDonut = {{json_encode($listDonut)}}
                // Build the chart
                Highcharts.chart('uptime', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Website Up/Down'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Availability',
                        colorByPoint: true,
                        data: listDonut
                    }]
                });
            });
        </script>
    </div>
@endsection