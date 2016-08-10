@extends('admin.layout')

@section('page-wrapper')
    <input type="hidden" id="chartType" value="{{$type}}"/>
    <input type="hidden" id="chartTitle" value="{{$title}}"/>
    <input type="hidden" id="min" value="{{$min}}"/>
    <input type="hidden" id="max" value="{{$max}}"/>
    <input type="hidden" id="step" value="{{$step}}"/>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$title}}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <select class="form-control" v-on:change="provinceChange" v-model="selProvince">
                <option value="0">กรุณาเลือก</option>
                <option v-for="option in provinces"
                        v-bind:value="option.PROVINCE_ID">@{{ option.PROVINCE_NAME }}</option>
            </select>
        </div>

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
                chartData: {},
                chartType: "",
                chartTitle: "",
                min: 0,
                max: 0,
                step: 0,

                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {

                    var api = "/chart/range/farm-owner/" +
                            this.chartType + "/" + this.min + "/" + this.max + "/" + this.step+"/"+this.selProvince;

                    this.$http.get(api).then(function (r) {
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
                        series: self.chartData.series,
                    });

                }
                ,
                loadData: function () {

                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });

                    var api = "/chart/range/farm-owner/" +
                            this.chartType + "/" + this.min + "/" + this.max + "/" + this.step;
                    this.$http.get(api).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                this.chartType = $("#chartType").val();
                this.chartTitle = $("#chartTitle").val();
                this.min = $("#min").val();
                this.max = $("#max").val();
                this.step = $("#step").val();
                this.loadData();
            }
        })


    </script>
@endsection