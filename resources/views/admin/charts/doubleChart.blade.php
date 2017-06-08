@extends('admin.layout')

@section('page-wrapper')
    <input type="hidden" id="chartType" value="{{$type}}"/>
    <input type="hidden" id="chartTitle" value="{{$title}}"/>

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
                                <div id="master"></div>
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
                                <div id="sub"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($type == "use_land")
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    {{$title}}
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div id="sum_use_land"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif

            </div>

        </div>
        <div class="col-lg-4" style="margin-top:2em;">
            @include('share.chart_menu',["PREFIX"=>"/admin"])
        </div>
    </div>


@endsection


@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {
                chartData: [
                    {}, {},{}
                ],
                chartType: "",
                chartTitle: "",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {

                    this.$http.get('/chart/double/' + this.chartTitle + '/' + this.chartType + '/'+ this.selProvince).then(function (r) {
                        //this.$http.get('/chart/double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status/'+this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                        this.displayChart(1);
                        this.displayChart(2);
                    });
                },
                displayChart: function (chartnumber) {
                    var self = this;
                    if(chartnumber==0) {
                        $('#master').highcharts({
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
                                            return this.y >= 1 ? '<b>' + this.point.name + ': </b> ' + this.y + ' คน' : null;
                                        }


                                    },

                                }
                            }
                            ,
                            series: self.chartData[0].series,
                        });
                    }else if(chartnumber==1){
                        $('#sub').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: self.chartTitle,
                            },
                            xAxis: self.chartData[0].xAxis,

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
                            tooltip: self.chartData[0].tooltip,
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        style: {
                                            fontSize: '20px'
                                        },
                                        formatter: function () {
                                            // display only if larger than 1
                                            return this.y >= 1 ? '<b>' + this.y + ' คน' : null ;
                                        }
                                    }
                                }
                            },

                            series: self.chartData[0].drilldown,
                        });
                    }else if(chartnumber==2){
                        $('#sum_use_land').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: "รวมขนาดพื้นที่(ไร่) แยกตามพื้นที่ที่ใช้ในการเลี้ยงโคเนื้อ",
                            },
                            xAxis: self.chartData[0].xAxis,

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
                            tooltip: self.chartData[0].tooltip,
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        style: {
                                            fontSize: '20px'
                                        },
                                        formatter: function () {
                                            // display only if larger than 1
                                            return this.y >= 1 ? '<b>' + this.y + ' ไร่' : null ;
                                        }
                                    }
                                }
                            },

                            series: self.chartData[0].area,
                        });

                    }

                }
                ,
                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });

                    this.$http.get('/chart/double/' + this.chartTitle + '/' + this.chartType).then(function (r) {
                        //this.$http.get('/chart/double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status').then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                        this.displayChart(1);
                        this.displayChart(2);

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