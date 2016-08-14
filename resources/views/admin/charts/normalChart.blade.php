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
        <div class="col-lg-4" style="padding-top: 2em;">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse1">ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <li><a href="pie/เพศ/sex">เพศ</a></li>
                            <li><a href="range-farmowner/อายุ/age/15/70/8">อายุ</a></li>
                            <li><a href="normal/การศึกษา/education">การศึกษา</a></li>
                            <li><a href="pie/อาชีพการเลี้ยงโคเนื้อ(อาชีพหลัก-เสริม)/cattle_job">อาชีพการเลี้ยงโคเนื้อ(อาชีพหลัก-เสริม)</a>
                            </li>
                            <li>
                                <a href="normal/เฉลี่ยรายได้รวมของครอบครัว/income_range">เฉลี่ยรายได้รวมของครอบครัว</a>
                            </li>
                            <li>
                                <a href="range-farmowner/รายได้เฉลี่ยต่อปีของการขายโคเนื้อ/avg_cattle_income/50000/200000/6">รายได้เฉลี่ยต่อปีของการขายโคเนื้อ</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse2">ส่วนที่ 2
                                ข้อมูลการเลี้ยงและสถานภาพฟาร์ม</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <li><a href="normal/วัตถุประสงค์ของการเลี้ยงโคเนื้อ/farm_purposes">วัตถุประสงค์ของการเลี้ยงโคเนื้อ</a>
                            </li>
                            <li><a href="pie/การทำประวัติโคเนื้อ/farm_record">การทำประวัติโคเนื้อ</a></li>
                            <li><a href="cattle/">จำนวนโคเนื้อที่เลี้ยง</a></li>
                            <li>
                                <a href="normal/ประสบการณ์การเลี้ยงโคเนื้อ/farm_exp">ประสบการณ์การเลี้ยงโคเนื้อ</a>
                            </li>
                            <li>
                                <a href="normal/เป้าหมายการเลี้ยงในอนาคต/farm_future">เป้าหมายการเลี้ยงในอนาคต</a>
                            </li>
                            <li><a href="double/การขึ้นทะเบียนฟาร์มกับภาครัฐ/farm_register_status/count/farm_owners.id">การขึ้นทะเบียนฟาร์มกับภาครัฐ</a>
                            </li>
                            <li>
                                <a href="multi-choice/สถานภาพการระบาดของโรคในฟาร์ม/abortion,tuberculosis,foot_mouth_disease">สถานภาพการระบาดของโรคในฟาร์ม</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse3">ส่วนที่ 3 ข้อมูลแรงงาน
                                พื้นที่ในการเลี้ยง
                                และการจัดการอาหาร</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <li><a href="range-farmowner/จำนวนแรงงานที่เลี้ยงโคเนื้อ/family_workers_amount/1/10/5">จำนวนแรงงานที่เลี้ยงโคเนื้อ</a>
                            </li>
                            <li>
                                <a href="normal/ลักษณะการเลี้ยงโคเนื้อ/take_care_types">ลักษณะการเลี้ยงโคเนื้อ</a>
                            </li>
                            <li>
                                <a href="double/พื้นที่ที่ใช้ในการเลี้ยงโคเนื้อ (ไร่ต่อครัวเรือน)/use_land/sum/choice_farm_owner.area">พื้นที่ที่ใช้ในการเลี้ยงโคเนื้อ
                                    (ไร่/ครัวเรือน)</a></li>
                            <li><a href="pie/อาหารที่ท่านใช้เลี้ยงโคเนื้อ/feed_types">อาหารที่ท่านใช้เลี้ยงโคเนื้อ</a>
                            </li>
                            <li><a href="pie/การให้แร่ธาตุก้อน/minerals_feed">การให้แร่ธาตุก้อน</a></li>
                            <li><a href="***">การสำรองฟางข้าว หรือเปลือกข้าวโพด</a></li>
                            <li>
                                <a href="normal/แหล่งอาหารหยาบในฤดูแล้ง/feed_summer_sources">แหล่งอาหารหยาบในฤดูแล้ง</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse4">ส่วนที่ 4 การผสมพันธ์ุ
                                ประสิทธิภาพการผลิต
                                และการรักษาโรค</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <li>
                                <a href="pie/การผสมพันธุ์โคเนื้อในฟาร์ม/farm_breeding_type">การผสมพันธุ์โคเนื้อในฟาร์ม</a>
                            </li>
                            <li>
                                <a href="normal/แหล่งน้ำเชื้อการผสมเทียท/inseminate_sources">แหล่งน้ำเชื้อการผสมเทียม</a>
                            </li>
                            <li><a href="normal/ผู้ให้บริการผสมเทียท/breeders">ผู้ให้บริการผสมเทียม</a></li>
                            <li><a href="range-farmowner/อัตราส่วนพ่อพันธ์คุมฝูง/breeding_rate/5/10/3">อัตราส่วนพ่อพันธ์คุมฝูง</a>
                            </li>
                            <li><a href="double/วัคซีนป้องกันโรค/vaccine_ever/count/farm_owners.id">วัคซีนป้องกันโรค</a>
                            </li>
                            <li><a href="double/การจัดการมูลโคในฟาร์ม/cattle_dung_uses">การจัดการมูลโคในฟาร์ม</a></li>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse5">ส่วนที่ 5
                                ข้อมูลแหล่งเงินทุนที่ใช้ในการเลี้ยงโคเนื้อ</a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <li><a href="budget/">เงินทุนการเลี้ยงโคเนื้อ</a></li>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse6">ส่วนที่ 6 ข้อมูลการตลาด
                                การรวมกลุ่มของสมาชิก(วิสาหกิจชุมชนและสหกรณ์)</a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <li><a href="normal/การจำหน่ายโค/seller_types">การจำหน่ายโคเนื้อให้กับใคร</a></li>
                            <li><a href="normal/อายุของโคเนื้อที่จำหน่าย(ปี)/age_sale">อายุของโคเนื้อที่จำหน่าย(ปี)</a>
                            </li>
                            <li>
                                <a href="pie/ลักษณะการจำหน่าย/cattle_sale_methods">ลักษณะการจำหน่ายโคเนื้อ</a>
                            </li>
                            <li><a href="normal/การรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อ/group_joins">การรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อ</a>
                            </li>
                            <li>
                                <a href="pie/ความประสงค์ในการรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อ/group_join_future">ความประสงค์ในการรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อ</a>
                            </li>
                            <li><a href="#collaps1">ราคาของโคเนื้อที่ขาย และระยะเวลาในการเลี้ยง</a></li>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse7">ส่วนที่ 7 การได้รับบริการ
                                การส่งเสริมและสนับสนุนจากหน่วยงานต่างๆ</a>
                        </h4>
                    </div>
                    <div id="collapse7" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <li><a href="normal/หน่วยงานที่ให้บริการส่งเสริมการเลี้ยงโคเนื้อ/support_sources">หน่วยงานที่ให้บริการส่งเสริมการเลี้ยงโคเนื้อ</a>
                            </li>
                            <li><a href="pie/การเยี่ยมเยือนฟาร์มจากหน่วยงาน/support_visit">การเยี่ยมเยือนฟาร์มจากหน่วยงาน</a>
                            </li>
                            <li>
                                <a href="pie/การใช้บริการด้านสุขภาพโคจากหน่วยงานของกรมปศุสัตว์/cattle_heath_support">การใช้บริการด้านสุขภาพโคจากหน่วยงานของกรมปศุสัตว์</a>
                            </li>
                            <li><a href="pie/การเข้ารับการฝึกอบรมเกี่ยวกับการเลี้ยงโคเนื้อ/training_support">การเข้ารับการฝึกอบรมเกี่ยวกับการเลี้ยงโคเนื้อ</a>
                            </li>
                            <li>
                                <a href="pie/การสนับสนุนให้แม่พันธุ์โคเนื้อมาเลี้ยงเพื่อผลิตลูก/female_breeder_support">การสนับสนุนให้แม่พันธุ์โคเนื้อมาเลี้ยงเพื่อผลิตลูก</a>
                            </li>
                        </div>
                    </div>
                </div>
            </div>

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
                            this.$http.get('/chart/normal/' + this.chartType + '/' + this.selProvince).then(function (r) {
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
                                    labels: {
                                        style: {
                                            fontSize: '20px'
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
                            this.$http.get('/chart/normal/' + this.chartType).then(function (r) {
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