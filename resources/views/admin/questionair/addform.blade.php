@extends('admin.layout')

@section('page-wrapper')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">บันทึกข้อมูลเกษตรกรใหม่
            </h1>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-10">
            <accordion :one-at-time="true">
                <panel header="ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร">
                    @include('admin.questionair.part1')
                </panel>
                <panel header="ส่วนที่ 2 ข้อมูลการเลี้ยงและสถานภาพฟาร์ม">
                    @include('admin.questionair.part2')
                </panel>
                <panel header="ส่วนที่ 3 ข้อมูลแรงงาน พื้นที่ในการเลี้ยง และการจัดการอาหาร">

                </panel>
                <panel header="ส่วนที่ 4 การผสมพันธ์ุ ประสิทธิภาพการผลิต และการรักษาโรค">ส่วนที่ 4</panel>
                <panel header="ส่วนที่ 5 ข้อมูลแหล่งเงินทุนที่ใช้ในการเลี้ยงโคเนื้อ">
                    @include('admin.questionair.part5')
                </panel>
                <panel header="ส่วนที่ 6 ข้อมูลการตลาด การรวมกลุ่มของสมาชิก(วิสาหกิจชุมชนและสหกรณ์)">ส่วนที่ 6</panel>
                <panel header="ส่วนที่ 7 การได้รับบริการ การส่งเสริมและสนับสนุนจากหน่วยงานต่างๆ">
                    @include('admin.questionair.part7')
                </panel>
                <panel header="ส่วนที่ 8 ปัญหา อุปสรรค และข้อเสนอแนะ">
                    @include('admin.questionair.part8')
                </panel>
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
    <script type="text/javascript" src="/js/admin/questionair/QuestionTextField.js"></script>
    <script type="text/javascript">

        var app = new AdminApp({
            el: 'body',
            components: {
                'question-text-field': QuestionTextField,
                'question-textarea-field': QuestionTextAreaField,
                'question-select': QuestionSelect,
                'question-select-with-text': QuestionSelectWithText,
                'question-multi-checkbox': QuestionMultiCheckbox,
                'province-amphur-district': ProvinceAmphurDistrict,
            },
            data: {
                newFarmer: {},
                options: {}
            },
            methods: {
                sumCattle: function (option) {
                    var optType = option;
                    var sum = 0;
                    for (var i = 0; i < optType.length; i++) {
                      //  console.log("opttype", optType[i]);
                        if (optType[i].pivot.amount != null) {
                           // console.log(optType[i].pivot.amount, sum);
                            sum += parseInt(optType[i].pivot.amount) ? parseInt(optType[i].pivot.amount) : 0;
                        } else {

                            var childtype = this.newFarmer[optType[i].children[0].type]
                            console.log("opttype for children", childtype);
                            for (var j = 0; j < childtype.length; j++) {
                                if (childtype[j].pivot.amount != null) {
                                 //  console.log(childtype[j].pivot.amount, sum);
                                    sum += parseInt(childtype[j].pivot.amount) ? parseInt(childtype[j].pivot.amount) : 0;
                                }
                            }
                        }
                        //console.log("total_" + optType[i].type);
                        this.newFarmer["total_" + optType[i].type] = sum;
                    }

                    return sum;
                },
                save: function () {
                   // this.newFarmer["total_master_breeding_types"] = 500;

                    console.log(this.newFarmer);
                    this.$http.post('/api/farm-owner', this.newFarmer).then(function (response) {
                        console.log(response.data);
                        window.location.href = "/admin/questionair/" + response.data.id + '/edit';
                    })
                },
                initial: function () {

                    var self = this;

                    $.ajax({
                        url: '/api/farm-owner/create',
                        type: 'get',
                        dataType: 'json',
                        async: 'false',
                        success: function (response) {
                            self.newFarmer = response;
                        }
                    })
                    $.ajax({
                        url: '/api/choice',
                        type: 'get',
                        dataType: 'json',
                        async: 'false',
                        success: function (response) {
                            self.options = response;
                        }
                    })
                }

            },
            created: function () {
                this.initial();
            },
            ready: function () {

            }
        })
    </script>


@endsection