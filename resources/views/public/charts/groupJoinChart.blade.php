@extends('public.layout')

@section('page-wrapper')
    <input type="hidden" id="chartType" value="{{$type}}"/>
    <input type="hidden" id="chartTitle" value="{{$title}}"/>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$title}}</h1>
                </div>
            </div>
            <div class="row" style="padding-bottom: 1em;">
                <div class="col-xs-12">
                    <select class="form-control" v-on:change="provinceChange" v-model="selProvince">
                        <option value="0">กรุณาเลือกจังหวัด</option>
                        <option v-for="option in provinces"
                                v-bind:value="option.PROVINCE_ID">@{{ option.PROVINCE_NAME }}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="container"></div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-4" style="margin-top: 2em;">
            @include('share.chart_menu',["PREFIX"=>""])
        </div>
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
                    this.$http.get('/chart/groupJoin/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#container').highcharts({
                        chart: {
                            type: 'column',
                            height: 600,
                        },
                        title: {
                            text: self.chartTitle,
                        },
                        xAxis: {
                            categories: self.chartData.xAxis.categories,
                            labels: {
                                rotation: -45, align: 'right',
                                staggerLines: 1,
                                style: {
                                    fontSize: '14px',
                                    "fontWeight": "bold",
                                    autoRotationLimit: 40,
                                    textOverflow: 'none',
                                    whiteSpace: 'initial',
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: '',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify',
                                style: {
                                    fontSize: '20px'
                                }
                            }
                        },
                        tooltip: self.chartData.tooltip,
                        plotOptions: {
                            column: {
                                // animation: false,
                                dataLabels: {
                                    enabled: true,
                                    style: {
                                        fontSize: '20px'
                                    },formatter: function () {
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
                            y: 80,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                            shadow: true,
                            enabled : false,
                        },
                        credits: {
                            enabled: false
                        },
                        series: self.chartData.series,
                    });

                }
                ,
                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });
                    this.$http.get('/chart/groupJoin/' + this.chartType).then(function (r) {
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