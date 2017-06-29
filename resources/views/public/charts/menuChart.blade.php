@extends('public.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">แผนภูมิรายงานเกษตรกรผู้เลี้ยงโคเนื้อ 4 จังหวัด พะเยา เชียงราย แพร่ น่าน</h1>
            <div class="row">
                <div class="col-lg-6">
                    @include('share.chart_menu',["PREFIX"=>""])
                </div>

                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                จำนวนเกษตรกรผู้เลี้ยงโคเนื้อ 4 จังหวัด
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-container"></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดพะเยา
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-container-phayao"></div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดน่าน
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-container-nan"></div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดแพร่
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-container-phrae"></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดเชียงราย
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-container-chiangrai"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection

@section('javascript')
    <script type="text/javascript" src="{{asset("/mapdata/th-north.js")}}"></script>

    @parent


    <script>
        $(function () {
            $.getJSON(window.root_url + "/chart/map-data", function (response) {
                $('#map-container').highcharts('Map', {
                    title: {
                        text: 'จำนวนเกษตรกรผู้เลี้ยงโคเนื้อ 4 จังหวัดภาคเหนือ'
                    },
                    chart: {
                        height: 500
                    },
                    colorAxis: {},
                    plotOptions: {
                        series: {
                            point: {
                                events: {
                                    click: function () {
                                        console.log(this);
                                        window.location = window.root_url + "/charts/menuchart/" + this.province_id
                                    }
                                }
                            }
                        }
                    },
                    series: [
                        {
                            cursor: 'pointer',
                            name: "จำนวนเกษตรกร",
                            type: "map",
                            data: response,
                            mapData: Highcharts.maps["countries/th/th-north/mapdata"],
                            joinBy: ['id', 'province_id'],
                            dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                format: '{point.province_name}<br/>{point.value} คน'
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{series.name}</span><br/>',
                                pointFormat: '{point.province_name}: <b>{point.value} คน</b><br/>',
                            },

                        }
                    ]
                });
            });


            $.getJSON(window.root_url + "/chart/map-data/44", function (response) {
                $('#map-container-phayao').highcharts('Map', {
                    title: {
                        text: 'จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดพะเยา'
                    },
                    chart: {
                        height: 500
                    },
                    colorAxis: {},
                    plotOptions: {
                        series: {
                            point: {
                                events: {
                                    click: function () {
                                        console.log(this);
                                        var province = this.province_id ? this.province_id : this.properties.province_id;
                                        window.location = window.root_url + "/charts/menuchart/" + province + "/" + this.amphur_id
                                    }
                                }
                            }
                        }
                    },
                    series: [
                        {
                            cursor: 'pointer',
                            name: "จำนวนเกษตรกร",
                            type: "map",
                            data: response,
                            mapData: Highcharts.maps["countries/th/th-44/mapdata"],
                            joinBy: ['id', 'amphur_id'],
                            dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                formatter: function () {
                                    var amphurName = this.point.amphur_name ? this.point.amphur_name : this.point.properties.amphur_name;
                                    var value = this.point.value ? this.point.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{series.name}</span><br/>',
                                pointFormatter: function () {

                                    var amphurName = this.amphur_name ? this.amphur_name : this.properties.amphur_name;
                                    var value = this.value ? this.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },

                        }
                    ]
                });
            });

            $.getJSON(window.root_url + "/chart/map-data/43", function (response) {
                $('#map-container-nan').highcharts('Map', {
                    title: {
                        text: 'จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดน่าน'
                    },
                    chart: {
                        height: 500
                    },
                    colorAxis: {},
                    plotOptions: {
                        series: {
                            point: {
                                events: {
                                    click: function () {
                                        console.log(this);
                                        var province = this.province_id ? this.province_id : this.properties.province_id;
                                        window.location = window.root_url + "/charts/menuchart/" + province + "/" + this.amphur_id
                                    }
                                }
                            }
                        }
                    },
                    series: [

                        {
                            cursor: 'pointer',
                            name: "จำนวนเกษตรกร",
                            type: "map",
                            data: response,
                            mapData: Highcharts.maps["countries/th/th-43/mapdata"],
                            joinBy: ['amphur_id', 'amphur_id'],
                            dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                formatter: function () {
                                    var amphurName = this.point.amphur_name ? this.point.amphur_name : this.point.properties.amphur_name;
                                    var value = this.point.value ? this.point.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{series.name}</span><br/>',
                                pointFormatter: function () {

                                    var amphurName = this.amphur_name ? this.amphur_name : this.properties.amphur_name;
                                    var value = this.value ? this.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },

                        }
                    ]
                });
            });

            $.getJSON(window.root_url + "/chart/map-data/42", function (response) {
                $('#map-container-phrae').highcharts('Map', {
                    title: {
                        text: 'จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดแพร่'
                    },
                    chart: {
                        height: 500
                    },
                    colorAxis: {},
                    plotOptions: {
                        series: {
                            point: {
                                events: {
                                    click: function () {
                                        console.log(this);
                                        var province = this.province_id ? this.province_id : this.properties.province_id;
                                        window.location = window.root_url + "/charts/menuchart/" + province + "/" + this.amphur_id
                                    }
                                }
                            }
                        }
                    },
                    series: [

                        {
                            cursor: 'pointer',
                            name: "จำนวนเกษตรกร",
                            type: "map",
                            data: response,
                            mapData: Highcharts.maps["countries/th/th-42/mapdata"],
                            joinBy: ['amphur_id', 'amphur_id'],
                            dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                formatter: function () {
                                    var amphurName = this.point.amphur_name ? this.point.amphur_name : this.point.properties.amphur_name;
                                    var value = this.point.value ? this.point.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{series.name}</span><br/>',
                                pointFormatter: function () {

                                    var amphurName = this.amphur_name ? this.amphur_name : this.properties.amphur_name;
                                    var value = this.value ? this.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },

                        },
                    ]
                });
            });


            $.getJSON(window.root_url + "/chart/map-data/45", function (response) {
                $('#map-container-chiangrai').highcharts('Map', {
                    title: {
                        text: 'จำนวนเกษตรกรผู้เลี้ยงโคเนื้อจังหวัดเชียงราย'
                    },
                    chart: {
                        height: 500
                    },
                    colorAxis: {},
                    plotOptions: {
                        series: {
                            point: {
                                events: {
                                    click: function () {
                                        console.log(this);
                                        var province = this.province_id ? this.province_id : this.properties.province_id;
                                        window.location = window.root_url + "/charts/menuchart/" + province + "/" + this.amphur_id
                                    }
                                }
                            }
                        }
                    },
                    series: [

                        {
                            cursor: 'pointer',
                            name: "จำนวนเกษตรกร",
                            type: "map",
                            data: response,
                            mapData: Highcharts.maps["countries/th/th-45/mapdata"],
                            joinBy: ['amphur_id', 'amphur_id'],
                            dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                formatter: function () {
                                    var amphurName = this.point.amphur_name ? this.point.amphur_name : this.point.properties.amphur_name;
                                    var value = this.point.value ? this.point.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{series.name}</span><br/>',
                                pointFormatter: function () {

                                    var amphurName = this.amphur_name ? this.amphur_name : this.properties.amphur_name;
                                    var value = this.value ? this.value : 0;

                                    return amphurName + " : " + value + " คน";
                                }
                            },

                        }
                    ]
                });
            });


        })
        // Initiate the chart

        ;
    </script>
@endsection