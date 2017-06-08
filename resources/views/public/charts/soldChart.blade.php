@extends('public.layout')

@section('page-wrapper')

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ราคาของโคเนื้อที่ขาย และระยะเวลาในการเลี้ยง</h1>
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

            <div class="col-lg-12">
                <h1 >
                    <b> พ่อพันธุ์ </b>
                </h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                           <b> พ่อพันธุ์ </b>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div id="male_cattle_price_range_sale"></div>
                            <div id="male_cattle_age_range_sale"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <h1 >
                    <b> แม่พันธุ์ </b>
                </h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <b>แม่พันธุ์ </b>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div id="female_cattle_price_range_sale"></div>
                            <div id="female_cattle_age_range_sale"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <h1 >
                    <b> โคขุน </b>
                </h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <b>  โคขุน </b>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div id="khoon_cattle_price_range_sale"></div>
                            <div id="khoon_cattle_age_range_sale"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <h1 >
                    <b> โครุ่น </b>
                </h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                          <b>  โครุ่น </b>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div id="teen_cattle_price_range_sale"></div>
                            <div id="teen_cattle_age_range_sale"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <h1 >
                    <b> อื่นๆ </b>
                </h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                           <b> อื่นๆ </b>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div id="other_cattle_price_range_sale"></div>
                            <div id="other_cattle_age_range_sale"></div>
                        </div>
                    </div>
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
                chartData: [
                    {}, {}, {}, {}, {}, {}, {}, {}, {}, {}
                ],
              //  chartType: "239",
              //  chartTitle: "ราคาของโคเนื้อที่ขาย",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {

                    this.$http.get('/chart/price_range_sale/239/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                    });
                    this.$http.get('/chart/age_range_sale/239/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[1] = data;
                        this.displayChart(1);
                    });
                    this.$http.get('/chart/price_range_sale/240/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[2] = data;
                        this.displayChart(2);
                    });
                    this.$http.get('/chart/age_range_sale/240/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[3] = data;
                        this.displayChart(3);
                    });
                    this.$http.get('/chart/price_range_sale/241/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[4] = data;
                        this.displayChart(4);
                    });
                    this.$http.get('/chart/age_range_sale/241/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[5] = data;
                        this.displayChart(5);
                    });
                    this.$http.get('/chart/price_range_sale/242/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[6] = data;
                        this.displayChart(6);
                    });
                    this.$http.get('/chart/age_range_sale/242/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[7] = data;
                        this.displayChart(7);
                    });
                    this.$http.get('/chart/price_range_sale/243/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[8] = data;
                        this.displayChart(8);
                    });
                    this.$http.get('/chart/age_range_sale/243/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[9] = data;
                        this.displayChart(9);
                    });


                },
                displayChart: function (chartnumber) {
                    var self = this;
                    if (chartnumber == 0) {
                        $('#male_cattle_price_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ราคาของโคเนื้อที่ขาย',
                            },
                            xAxis: self.chartData[0].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[0].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[0].series
                        })

                    }else   if (chartnumber == 1) {
                        $('#male_cattle_age_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ระยะเวลาการเลี้ยง',
                            },
                            xAxis: self.chartData[1].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[1].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[1].series
                        })

                    }else if (chartnumber == 2) {
                        $('#female_cattle_price_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ราคาของโคเนื้อที่ขาย',
                            },
                            xAxis: self.chartData[2].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[2].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[2].series
                        })

                    }else   if (chartnumber == 3) {
                        $('#female_cattle_age_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ระยะเวลาการเลี้ยง',
                            },
                            xAxis: self.chartData[3].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[3].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[3].series
                        })

                    }else if (chartnumber == 4) {
                        $('#khoon_cattle_price_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ราคาของโคเนื้อที่ขาย',
                            },
                            xAxis: self.chartData[4].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[4].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[4].series
                        })

                    }else   if (chartnumber == 5) {
                        $('#khoon_cattle_age_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ระยะเวลาการเลี้ยง',
                            },
                            xAxis: self.chartData[5].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[5].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[5].series
                        })

                    }else if (chartnumber == 6) {
                        $('#teen_cattle_price_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ราคาของโคเนื้อที่ขาย',
                            },
                            xAxis: self.chartData[6].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[6].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[6].series
                        })

                    }else   if (chartnumber == 7) {
                        $('#teen_cattle_age_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ระยะเวลาการเลี้ยง',
                            },
                            xAxis: self.chartData[7].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[7].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[7].series
                        })

                    }else if (chartnumber == 8) {
                        $('#other_cattle_price_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ราคาของโคเนื้อที่ขาย',
                            },
                            xAxis: self.chartData[8].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[8].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[8].series
                        })

                    }else   if (chartnumber == 9) {
                        $('#other_cattle_age_range_sale').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ระยะเวลาการเลี้ยง',
                            },
                            xAxis: self.chartData[9].xAxis,
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '',
                                    align: 'high'
                                }
                                ,
                                labels: {
                                    overflow: 'justify',
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            }
                            ,
                            legend: {
                                enabled: false
                            }
                            ,
                            tooltip: self.chartData[9].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            }
                            ,

                            series: self.chartData[9].series
                        })

                    }


                },
                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });
                    // this.$http.get('/chart/cattle/' + this.chartType).then(function (r) {
                    this.$http.get('/chart/price_range_sale/239').then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                    });
                    this.$http.get('/chart/age_range_sale/239').then(function (r) {
                        data = r.data;
                        this.chartData[1] = data;
                        this.displayChart(1);
                    });
                    this.$http.get('/chart/price_range_sale/240').then(function (r) {
                        data = r.data;
                        this.chartData[2] = data;
                        this.displayChart(2);
                    });
                    this.$http.get('/chart/age_range_sale/240').then(function (r) {
                        data = r.data;
                        this.chartData[3] = data;
                        this.displayChart(3);
                    });
                    this.$http.get('/chart/price_range_sale/241').then(function (r) {
                        data = r.data;
                        this.chartData[4] = data;
                        this.displayChart(4);
                    });
                    this.$http.get('/chart/age_range_sale/241').then(function (r) {
                        data = r.data;
                        this.chartData[5] = data;
                        this.displayChart(5);
                    });
                    this.$http.get('/chart/price_range_sale/242').then(function (r) {
                        data = r.data;
                        this.chartData[6] = data;
                        this.displayChart(6);
                    });
                    this.$http.get('/chart/age_range_sale/242').then(function (r) {
                        data = r.data;
                        this.chartData[7] = data;
                        this.displayChart(7);
                    });
                    this.$http.get('/chart/price_range_sale/243').then(function (r) {
                        data = r.data;
                        this.chartData[8] = data;
                        this.displayChart(8);
                    });
                    this.$http.get('/chart/age_range_sale/243').then(function (r) {
                        data = r.data;
                        this.chartData[9] = data;
                        this.displayChart(9);
                    });


                }
                },
            ready: function () {
                this.loadData();
            }
        })
    </script>
@endsection