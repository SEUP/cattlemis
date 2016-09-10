@extends('admin.layout')

@section('page-wrapper')

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">จำนวนโคเนื้อที่เลี้ยง</h1>
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
                                พ่อพันธุ์โคเนื้อที่เลี้ยง
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-male-breeding"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                แม่พันธุ์โคเนื้อที่เลี้ยง
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-female-breeding"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                โคเพศผู้อายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-male-over-six-breeding"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                โคเพศเมียอายุมากกว่า 6 เดือนขึ้นไปแต่ยังไม่ตั้งท้อง
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-female-over-six-breeding"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                ลูกโคเพศผู้อายุน้อยกว่า 6 เดือน
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-male-under-six-breeding"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                ลูกโคเพศเมียอายุน้อยกว่า 6 เดือน
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-female-under-six-breeding"></div>
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
                    {}, {}, {}, {}, {}, {}
                ],
                provinces: [],
                selProvince: 0,
                fontSize: "16px",
            },
            methods: {
                provinceChange: function () {
                    // this.$http.get('/chart/cattle/' + this.chartType+'/'+this.selProvince).then(function (r) {
                    this.$http.get('/chart/cattle/พ่อพันธุ์โคเนื้อที่เลี้ยง/male_breeding_types/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                    });

                    this.$http.get('/chart/cattle/แม่พันธุ์โคเนื้อที่เลี้ยง/female_breeding_types/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[1] = data;
                        this.displayChart(1);
                    });

                    this.$http.get('/chart/cattle/โคเพศผู้อายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง/male_over_six_breeding_types/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[2] = data;
                        this.displayChart(2);
                    });

                    this.$http.get('/chart/cattle/โคเพศเมียอายุมากกว่า 6 เดือนขึ้นไปแต่ยังไม่ตั้งท้อง/female_over_six_breeding_types/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[3] = data;
                        this.displayChart(3);
                    });

                    this.$http.get('/chart/cattle/ลูกโคเพศผู้อายุน้อยกว่า 6 เดือน/male_under_six_breeding_types/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[4] = data;
                        this.displayChart(4);
                    });

                    this.$http.get('/chart/cattle/ลูกโคเพศเมียอายุน้อยกว่า 6 เดือน/female_under_six_breeding_types/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData[5] = data;
                        this.displayChart(5);
                    });

                },
                displayChart: function (chartnumber) {
                    var self = this;

                    if (chartnumber == 0) {
                        $('#map-male-breeding').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'พ่อพันธุ์โคเนื้อที่เลี้ยง',
                            },
                            xAxis: {
                                type: 'category',

                                labels: {
                                    style: {
                                        fontSize: self.fontSize
                                    }
                                }
                            },
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

                            series: self.chartData[0].series,
                            drilldown: self.chartData[0].drilldown,
                        })

                    } else if (chartnumber == 1) {
                        $('#map-female-breeding').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'แม่พันธุ์โคเนื้อที่เลี้ยง',
                            },
                            xAxis: {
                                type: 'category',

                                labels: {
                                    style: {
                                        fontSize: self.fontSzie
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
                                        fontSize: self.fontSzie
                                    }
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: self.chartData[1].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            },

                            series: self.chartData[1].series,
                            drilldown: self.chartData[1].drilldown,
                        });

                    } else if (chartnumber == 2) {
                        $('#map-male-over-six-breeding').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'โคเพศผู้อายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง',
                            },
                            xAxis: {
                                type: 'category',

                                labels: {
                                    style: {
                                        fontSize: self.fontSzie
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
                                        fontSize: self.fontSzie
                                    }
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: self.chartData[2].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            },

                            series: self.chartData[2].series,
                            drilldown: self.chartData[2].drilldown,
                        });

                    } else if (chartnumber == 3) {
                        $('#map-female-over-six-breeding').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'โคเพศเมียอายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง',
                            },
                            xAxis: {
                                type: 'category',

                                labels: {
                                    style: {
                                        fontSize: self.fontSzie
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
                                        fontSize: self.fontSzie
                                    }
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: self.chartData[3].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            },

                            series: self.chartData[3].series,
                            drilldown: self.chartData[3].drilldown,
                        });

                    } else if (chartnumber == 4) {
                        $('#map-male-under-six-breeding').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ลูกโคเพศผู้อายุน้อยกว่า 6 เดือน',
                            },
                            xAxis: {
                                type: 'category',

                                labels: {
                                    style: {
                                        fontSize: self.fontSzie
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
                                        fontSize: self.fontSzie
                                    }
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: self.chartData[4].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            },

                            series: self.chartData[4].series,
                            drilldown: self.chartData[4].drilldown,
                        });

                    } else if (chartnumber == 5) {
                        $('#map-female-under-six-breeding').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'ลูกโคเพศเมียอายุน้อยกว่า 6 เดือน',
                            },
                            xAxis: {
                                type: 'category',

                                labels: {
                                    style: {
                                        fontSize: self.fontSzie
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
                                        fontSize: self.fontSzie
                                    }
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: self.chartData[5].tooltip,
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            },

                            series: self.chartData[5].series,
                            drilldown: self.chartData[5].drilldown,
                        });

                    }

                },
                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });
                    // this.$http.get('/chart/cattle/' + this.chartType).then(function (r) {
                    this.$http.get('/chart/cattle/พ่อพันธุ์โคเนื้อที่เลี้ยง/male_breeding_types').then(function (r) {
                        data = r.data;
                        this.chartData[0] = data;
                        this.displayChart(0);
                    });

                    this.$http.get('/chart/cattle/แม่พันธุ์โคเนื้อที่เลี้ยง/female_breeding_types').then(function (r) {
                        data = r.data;
                        this.chartData[1] = data;
                        this.displayChart(1);
                    });

                    this.$http.get('/chart/cattle/โคเพศผู้อายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง/male_over_six_breeding_types').then(function (r) {
                        data = r.data;
                        this.chartData[2] = data;
                        this.displayChart(2);
                    });

                    this.$http.get('/chart/cattle/โคเพศเมียอายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง/female_over_six_breeding_types').then(function (r) {
                        data = r.data;
                        this.chartData[3] = data;
                        this.displayChart(3);
                    });


                    this.$http.get('/chart/cattle/ลูกโคเพศผู้อายุน้อยกว่า 6 เดือน/male_under_six_breeding_types').then(function (r) {
                        data = r.data;
                        this.chartData[4] = data;
                        this.displayChart(4);
                    });

                    this.$http.get('/chart/cattle/ลูกโคเพศเมียอายุน้อยกว่า 6 เดือน/female_under_six_breeding_types').then(function (r) {
                        data = r.data;
                        this.chartData[5] = data;
                        this.displayChart(5);
                    });
                }
            },
            ready: function () {
                this.loadData();
            }
        })


    </script>
@endsection