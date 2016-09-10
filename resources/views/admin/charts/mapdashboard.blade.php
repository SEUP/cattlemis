@extends('admin.layout')

@section('page-wrapper')
    <input type="hidden" id="sel_province" value="{{$province}}"/>
    <input type="hidden" id="sel_amphur" value="{{$amphur}}"/>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">รายงานเกษตรกรผู้เลี้ยงโคเนื้อ
                <span v-show="provinceData.PROVINCE_NAME">จังหวัด@{{provinceData.PROVINCE_NAME}}</span>
            </h1>
            <div class="row">
                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                จำนวนเกษตรกรผู้เลี้ยงโคเนื้อ
                                <span v-show="provinceData.PROVINCE_NAME">จังหวัด@{{provinceData.PROVINCE_NAME}}</span>

                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id="map-container"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                จำนวนเกษตรกรผู้เลี้ยงโคเนื้อ
                                <span v-show="provinceData.PROVINCE_NAME">จังหวัด@{{provinceData.PROVINCE_NAME}}</span>

                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <td>อำเภอ</td>
                                        <td>จำนวนเกษตกร</td>
                                        <td>จำนวนวัว</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="map in mapResponse">
                                        <td>@{{ map.amphur_name }}</td>
                                        <td>@{{ map.value }}</td>
                                        <td>@{{ map.totcattle }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <button @click="reset()" class="btn btn-xs btn-default">รีเซ็ตผลค้นหา</button>
                    </div>
                    <h4 class="panel-title">

                        รายชื่อเกษตรกรผู้เลี้ยงโคเนื้อ
                        <span v-show="amphurData.AMPHUR_NAME">อำเภอ@{{amphurData.AMPHUR_NAME}}</span>
                        <span v-show="provinceData.PROVINCE_NAME">จังหวัด@{{provinceData.PROVINCE_NAME}}</span>


                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                <tr>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>จังหวัด</th>
                                    <th>อำเภอ</th>
                                    <th>ตำบล</th>
                                    <th>จำนวนวัวที่เลี้ยง</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="owner in farmOwners">
                                    <td>@{{ owner.first_name }} @{{ owner.last_name }}</td>
                                    <td>@{{ owner.province_name}}</td>
                                    <td>@{{ owner.amphur_name}}</td>
                                    <td>@{{ owner.district_name}}</td>
                                    <td class="hidden-md">@{{ owner.total_master_breeding_types }}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div>
                                            จำนวนทั้งหมด @{{ farmOwnerPage.total }} รายการ
                                        </div>
                                        <ul class="pagination">
                                            <li v-bind:class="{ 'active' : (farmOwnerPage.current_page == n+1) }"
                                                v-for="n in farmOwnerPage.last_page ">
                                                <a v-on:click="gotoPage(n+1)">@{{ n+1 }}</a>
                                            </li>

                                        </ul>
                                    </td>
                                </tr>

                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript" src="/mapdata/th-north.js"></script>

    <script>

        var app = new AdminApp({
            el: 'body',
            data: {
                provinceId: $("#sel_province").val(),
                amphurId: $("#sel_amphur").val(),
                mapResponse: [],
                provinceData: {},
                amphurData: {},
                farmOwners: [],
                farmOwnerPage: {},
                form: {
                    keyword: "",
                    page: "",
                }

            },
            methods: {
                reloadProvinceAmphure: function () {
                    this.$http.get('/api/thailand/province/' + this.provinceId).then(
                            function (response) {
                                this.provinceData = response.data;
                            },
                            function (error) {

                            }
                    );

                    if(this.amphurId){
                        this.$http.get("/api/thailand/province/" + this.provinceId + "/amphure/" + this.amphurId).then(
                                function (response) {
                                    this.amphurData = response.data;
                                },
                                function (error) {

                                }
                        );
                    }



                },
                reloadData: function () {
                    var query = "/chart/map-data/";
                    var mapData = Highcharts.maps["countries/th/th-north/mapdata"];
                    var self = this;
                    if (this.provinceId) {
                        query = query + this.provinceId
                        mapData = Highcharts.maps["countries/th/th-" + this.provinceId + "/mapdata"]
                    }

                    this.reloadProvinceAmphure();
                    $.getJSON(query, function (response) {
                        self.mapResponse = response;
                        $('#map-container').highcharts('Map', {
                            title: {
                                text: 'จำนวนเกษตรกรผู้เลี้ยงโคเนื้อ จังหวัด' + self.provinceData.PROVINCE_NAME
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
                                                self.amphurId = this.amphur_id;
                                                self.search();
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
                                    mapData: mapData,
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
                    self.search();

                },
                reset: function () {
                    this.amphurId = null;
                    this.search();
                },
                search: function () {

                    this.reloadProvinceAmphure();

                    var query = "/api/thailand/province/" + this.provinceId + "/farm_owners";
                    if (this.amphurId) {
                        query = "/api/thailand/province/" + this.provinceId + "/amphure/" + this.amphurId + "/farm_owners";
                    }
                    this.$http.get(query, {params: this.form}).then(
                            function (response) {

                                this.farmOwnerPage = response.data;
                                this.farmOwners = this.farmOwnerPage.data;
                            },
                            function (error) {

                            }
                    );
                }
                , gotoPage: function (page) {
                    this.form.page = page;
                    this.search();
                }
            }
            ,
            ready: function () {
                this.reloadData(this.provinceId, this.amphurId);

            }
        });
    </script>
@endsection