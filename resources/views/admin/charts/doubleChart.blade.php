@extends('admin.layout')

@section('page-wrapper')
    <input type="hidden" id="chartType" value="{{$type}}"/>
    <input type="hidden" id="chartTitle" value="{{$title}}"/>
    <input type="hidden" id="chartAction" value="{{$action}}"/>
    <input type="hidden" id="chartElement" value="{{$element}}"/>

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$title}}</h1>
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
                                {{$title}}
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="farm_regis"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                {{$title}}
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="sub_farm_regis"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-4" style="margin-top:2em;">
            @include('admin.charts.chart_menu')
        </div>
    </div>


@endsection


@section('javascript')

    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: [
                    {},{}
                ],
                chartType: "",
                chartTitle: "",
                chartAction: "",
                chartElement: "",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {

                    this.$http.get('/chart/double/' + this.chartTitle + '/' + this.chartType + '/' + this.chartAction + '/' + this.chartElement + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                    });


                    this.$http.get('/chart/double/' + this.chartTitle + '/' + this.chartType + '/' + 'count/' + 'farm_owners.id/' + this.selProvince).then(function (r) {
                        //this.$http.get('/chart/double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status/'+this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[1] = data;
                        this.displayChart(1);
                    });
                },
                displayChart: function (number) {
                    var self = this;

                    if(number ==0){
                        $('#farm_regis').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: self.chartTitle,
                            },
                            tooltip: self.chartData[0].tooltip,
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
                            series: self.chartData[0].series,
                        });

                    }else if(number == 1){
                        $('#sub_farm_regis').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: self.chartTitle,
                            },
                            xAxis: self.chartData[1].xAxis,

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
                            tooltip: self.chartData[1].tooltip,
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

                            series: self.chartData[1].drilldown,
                        });
                    }




                }
                ,
                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });
                    // this.$http.get('/chart/cattle/' + this.chartType).then(function (r) {
                    this.$http.get('/chart/double/' + this.chartTitle + '/' + this.chartType + '/' + this.chartAction + '/' + this.chartElement + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                    });


                    this.$http.get('/chart/double/' + this.chartTitle + '/' + this.chartType + '/' + 'count/' + 'farm_owners.id/' + this.selProvince).then(function (r) {
                        //this.$http.get('/chart/double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status').then(function (r) {
                        data = r.data;
                        this.chartData[1] = data;
                        this.displayChart(1);
                    });
                }
            },
            ready: function () {
                this.chartType = $("#chartType").val();
                this.chartTitle = $("#chartTitle").val();
                this.chartAction = $("#chartAction").val();
                this.chartElement = $("#chartElement").val();
                this.loadData();
            }
        })


    </script>

@endsection