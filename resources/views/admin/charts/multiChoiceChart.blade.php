@extends('admin.layout')

@section('page-wrapper')
    <input type="hidden" id="chartType" value="{{$type}}"/>
    <input type="hidden" id="chartTitle" value="{{$title}}"/>

    <div class="col-lg-8" style="">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$title}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <select class="form-control" v-on:change="provinceChange" v-model="selProvince">
                    <option value="0">กรุณาเลือกจังหวัด</option>
                    <option v-for="option in provinces"
                            v-bind:value="option.PROVINCE_ID">@{{ option.PROVINCE_NAME }}</option>
                </select>
            </div>
            <div class="col-lg-12">
                <div id="container"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-4" style="margin-top: 2em;">
        @include('share.chart_menu',["PREFIX"=>"/admin"])
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {
                chartData: {},
                chartType: "",
                chartTitle: "",
                provinces: [],
                selProvince: 0,

            },
            methods: {
                provinceChange: function () {
                    this.$http.get('chart/multi/choices/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: self.chartTitle,
                        },
                        xAxis: {
                            categories: self.chartData.xAxis.categories,

                            labels: {
                                style: {
                                    fontSize: '16px',
                                }
                            },
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: self.chartTitle,
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: self.chartData.tooltip,
                        plotOptions: {
                            column: {
                                dataLabels: {
                                    enabled: true,
                                formatter: function () {
                                    // display only if larger than 1
                                    return this.y >= 1 ? '<b>' + this.y + ' คน' : null;
                                }
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 0,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: self.chartData.series,
                    });

                }
                ,
                loadData: function () {
                    this.$http.get("api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });

                    this.$http.get('chart/multi/choices/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                this.chartType = $("#chartType").val();
                this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })


    </script>
@endsection