@extends('admin.layout')

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
                chartType: "239",
                chartTitle: "ราคาของโคเนื้อที่ขาย",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/price_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#male_cattle_price_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/price_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
               // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "239",
                chartTitle: "ระยะเวลาในการเลี้ยง",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/age_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#male_cattle_age_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/age_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "240",
                chartTitle: "ราคาของโคเนื้อที่ขาย",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/price_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#female_cattle_price_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/price_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "240",
                chartTitle: "ระยะเวลาในการเลี้ยง",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/age_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#female_cattle_age_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/age_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })


        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "241",
                chartTitle: "ราคาของโคเนื้อที่ขาย",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/price_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#khoon_cattle_price_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/price_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "241",
                chartTitle: "ระยะเวลาในการเลี้ยง",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/age_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#khoon_cattle_age_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/age_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "242",
                chartTitle: "ราคาของโคเนื้อที่ขาย",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/price_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#teen_cattle_price_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/price_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "242",
                chartTitle: "ระยะเวลาในการเลี้ยง",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/age_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#teen_cattle_age_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/age_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "243",
                chartTitle: "ราคาของโคเนื้อที่ขาย",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/price_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#other_cattle_price_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/price_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })

        var app = new AdminApp({
            el: 'body',

            data: {
                chartData: {},
                chartType: "243",
                chartTitle: "ระยะเวลาในการเลี้ยง",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {
                    this.$http.get('/chart/age_range_sale/' + this.chartType + '/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                },
                displayChart: function () {
                    var self = this;
                    $('#other_cattle_age_range_sale').highcharts({
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
                                    },
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
                    this.$http.get('/chart/age_range_sale/' + this.chartType).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                        this.displayChart();
                    });
                }
            },
            ready: function () {
                //this.chartType = $("#chartType").val();
                // this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })
    </script>
@endsection