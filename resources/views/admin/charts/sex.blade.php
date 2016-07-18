@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sex</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="container"></div>
        </div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {
                chartData: {}
            },
            methods: {
                displayChart: function () {
                    $('#container').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Historic World Population by Region'
                        },
                        subtitle: {
                            text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
                        },
                        xAxis: {
                            categories: app.chartData.xAxis.categories,
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Population (millions)',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' millions'
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 80,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: app.chartData.series,
                    });

                }
                ,
                loadData: function () {
                    this.$http.get('/chart/normal/sex').then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                this.loadData();
            }
        })


    </script>
@endsection