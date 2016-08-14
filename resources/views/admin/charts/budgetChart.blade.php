@extends('admin.layout')

@section('page-wrapper')

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">เงินทุนที่ท่านใช้เลี้ยงโคเนื้อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-xs-12" style="padding-bottom: 1em;">
                    <select class="form-control" v-on:change="provinceChange" v-model="selProvince">
                        <option value="0">กรุณาเลือกจังหวัด</option>
                        <option v-for="option in provinces"
                                v-bind:value="option.PROVINCE_ID">@{{ option.PROVINCE_NAME }}</option>
                    </select>
                </div>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                เงินทุนที่ท่านใช้เลี้ยงโคเนื้อ
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="ิbudget_source"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                แหล่งเงินทุนกู้ยืม
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="loan_types"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                ยอดรวมเงินกู้ทั้งหมด
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="total_budget"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4" style="margin-top: 2em;">
            @include('admin.charts.chart_menu')
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
                chartTitle: "เงินทุนที่ท่านใช้เลี้ยงโคเนื้อ",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/budget/' + this.selProvince).then(function (r) {
                        //this.$http.get('/chart/double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status/'+this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;

                    $('#ิbudget_source').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: self.chartTitle,
                        },
                        tooltip: self.chartData.tooltip,
                        plotOptions: {

                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    formatter: function () {
                                        // display only if larger than 1
                                        return this.y > 1 ? '<b>' + this.point.name + ': </b> ' + this.y + ' คน' : null;
                                    }


                                },

                            }
                        }
                        ,
                        series: self.chartData.series,
                    });

                }
                ,
                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });

                    this.$http.get('/chart/budget/' + this.selProvince).then(function (r) {
                        //this.$http.get('/chart/double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status').then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                //this.chartTitle = $("#chartTitle").val();

                this.loadData();
            }
        })


    </script>
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "",
                chartTitle: "แหล่งเงินทุนกู้ยืม",

                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    // this.$http.get('/chart/cattle/' + this.chartType+'/'+this.selProvince).then(function (r) {
                    // this.$http.get('/chart/double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status/'+this.selProvince).then(function (r) {
                    this.$http.get('/chart/budget/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#loan_types').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: self.chartTitle,
                        },
                        xAxis: self.chartData.xAxis,

                        yAxis: {
                            min: 0,
                            title: {
                                text: '',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify',
                                style: {
                                    fontSize: '10px'
                                }
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: self.chartData.tooltip,
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    style: {
                                        fontSize: '20px'
                                    }
                                }
                            }
                        },

                        series: self.chartData.drilldown,
                    });

                }
                ,
                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });
                    // this.$http.get('/chart/cattle/' + this.chartType).then(function (r) {
                    this.$http.get('/chart/budget/' + this.selProvince).then(function (r) {
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


    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {
                chartData: {},
                chartType: "total_budget",
                chartTitle: "",
                min: 10000,
                max: 1000000,
                step: 5,

                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {

                    var api = "/chart/range/farm-owner/" +
                            this.chartType + "/" + this.min + "/" + this.max + "/" + this.step + "/" + this.selProvince;

                    this.$http.get(api).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#total_budget').highcharts({
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
                // this.chartType = $("#chartType").val();
                //  this.chartTitle = $("#chartTitle").val();
                //this.min = $("#min").val();
                //this.max = $("#max").val();
                //this.step = $("#step").val();
                this.loadData();
            }
        })


    </script>

@endsection