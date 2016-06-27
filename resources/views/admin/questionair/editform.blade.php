@extends('admin.layout')

@section('page-wrapper')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">แก้ไขข้อมูลเกษตรกร
            </h1>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-10">
            <accordion :one-at-time="false">
                <panel header="ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร" :is-open="true">
                    @include('admin.questionair.part1')
                </panel>
                <panel header="ส่วนที่ 2 ข้อมูลการเลี้ยงและสถานภาพฟาร์ม" :is-open="true">
                    @include('admin.questionair.part2')
                </panel>
                <panel header="ส่วนที่ 3 ข้อมูลแรงงาน พื้นที่ในการเลี้ยง และการจัดการอาหาร">ส่วนที่ 3</panel>
                <panel header="ส่วนที่ 4 การผสมพันธ์ุ ประสิทธิภาพการผลิต และการรักษาโรค">ส่วนที่ 4</panel>
                <panel header="ส่วนที่ 5 ข้อมูลแหล่งเงินทุนที่ใช้ในการเลี้ยงโคเนื้อ">ส่วนที่ 5</panel>
                <panel header="ส่วนที่ 6 ข้อมูลการตลาด การรวมกลุ่มของสมาชิก(วิสาหกิจชุมชนและสหกรณ์)">ส่วนที่ 6</panel>
                <panel header="ส่วนที่ 7 การได้รับบริการ การส่งเสริมและสนับสนุนจากหน่วยงานต่างๆ">ส่วนที่ 6</panel>
                <panel header="ส่วนที่ 8 ปัญหา อุปสรรค และข้อเสนอแนะ">ส่วนที่ 6</panel>
            </accordion>
        </div>
        <div class="col-lg-2">
            <affix>
                <div style="margin-top:20px;">
                    <button type="button" class="btn btn-primary btn-block" v-on:click="save()">Save</button>
                </div>
            </affix>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {
                newFarmer: {},
                options: {}
            },

            methods: {
                sumCattle: function (option) {
                    var optType = option;
                    var sum = 0;
                    for (var i = 0; i < optType.length; i++) {
//                        console.log("opttype", optType[i]);
                        if (optType[i].pivot.amount != null) {
//                            console.log(optType[i].pivot.amount, sum);
                            sum += parseInt(optType[i].pivot.amount) ? parseInt(optType[i].pivot.amount) : 0;
                        } else {
                            var childtype = this.newFarmer[optType[i].children[0].type]
//                            console.log("opttype for children", childtype);
                            for (var j = 0; j < childtype.length; j++) {
                                if (childtype[j].pivot.amount != null) {
//                                    console.log(childtype[j].pivot.amount, sum);
                                    sum += parseInt(childtype[j].pivot.amount) ? parseInt(childtype[j].pivot.amount) : 0;
                                }
                            }
                        }
                        console.log("total_" + optType[i].type);
                        this.newFarmer.farm_info["total_" + optType[i].type] = sum;
                    }

                    return sum;
                },
                save: function () {
                    this.$http.patch('/api/farm-owner/' + this.newFarmer.id, this.newFarmer).then(function (response) {
                        data = response.data;
                        this.newFarmer = data;
                        this.reSelectedOption();
                    })
                },
                reInitialOption: function (opt) {
                    for (var i = 0; i < this.options[opt].length; i++) {
                        if (this.options[opt][i].id == this.newFarmer[opt].id) {

                            if (this.options[opt][i].has_text == 1 && this.newFarmer[opt].has_text == 1) {
                                this.options[opt][i].pivot = this.newFarmer[opt].pivot;
                                this.newFarmer[opt] = this.options[opt][i];
                            } else {
                                this.newFarmer[opt] = this.options[opt][i];
                            }
                        }
                    }
                },
                reInitialMultiOption: function (opt) {

                    var choiceOpt = this.options[opt];
                    var userOpt = this.newFarmer[opt];

                    for (var i = 0; i < choiceOpt.length; i++) {
                        //console.log("choice", choiceOpt[i].id, choiceOpt[i].choice)

                        for (var j = 0; j < userOpt.length; j++) {

                            //console.log("user", userOpt[j])
                            if (choiceOpt[i].id == userOpt[j].id) {
                                choiceOpt.splice(i, 1, userOpt[j]);
                                break;
                            }
                        }
                    }
                },
                reSelectedOption: function () {

                    var attributes = [
                        'sex', 'family_status', 'education', 'social_status', 'personal_status',
                        'cattle_job', 'income_range',
                        //part2
                        'farm_record', 'farm_exp', 'farm_future',
                        'farm_register_status', 'farm_register', 'farm_disease_check', 'abortion',
                        'tuberculosis', 'foot_mouth_disease'];

                    for (var i = 0; i < attributes.length; i++) {
//                        console.log(attributes[i]);
                        this.reInitialOption(attributes[i]);
                    }

                    var multipleAttributes = [
                        'jobtypes',
                        //part 2
                        'farm_purposes', 'male_breeding_types',
                        'male_int_breeding_types', 'male_mixed_breeding_types', 'female_breeding_types',
                        'female_int_breeding_types', 'female_mixed_breeding_types', 'male_over_six_breeding_types',
                        'male_over_six_int_breeding_types', 'male_over_six_mixed_breeding_types',
                        'female_over_six_breeding_types', 'female_over_six_int_breeding_types',
                        'female_over_six_mixed_breeding_types', 'male_under_six_breeding_types',
                        'male_under_six_int_breeding_types', 'male_under_six_mixed_breeding_types',
                        'female_under_six_breeding_types', 'female_under_six_int_breeding_types',
                        'female_under_six_mixed_breeding_types'
                    ]

                    for (var i = 0; i < multipleAttributes.length; i++) {
                        this.reInitialMultiOption(multipleAttributes[i]);
                    }

                },
                initial: function () {


                }
            },
            created: function () {
                var self = this;

                $.ajax({
                    url: '/api/choice',
                    type: 'get',
                    dataType: 'json',
                    async: 'false',
                    success: function (response) {

                        self.options = response;

                        self.$http.get('/api/farm-owner/{{$farmOwner->id}}/edit').then(
                                function (response) {
                                    this.newFarmer = response.data;
                                    this.reSelectedOption();
                                }
                        )

                    }
                })
            },
            ready: function () {


            }
        })
    </script>
@endsection