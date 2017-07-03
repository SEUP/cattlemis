@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-10">
            <h1 class="page-header">บันทึกข้อมูลเกษตรกรใหม่</h1>

            <div class="row" v-if="isLoaded">

                <div class="col-lg-12">
                    <accordion :one-at-atime="true" v-ref:questionforms>
                        <panel v-ref:panel1 header="ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร" id="panel_1">
                            @include('admin.questionaire.part1')
                        </panel>
                        <panel v-ref:panel2 header="ส่วนที่ 2 ข้อมูลการเลี้ยงและสถานภาพฟาร์ม"
                               id="panel_2">
                            @include('admin.questionaire.part2')
                        </panel>
                        <panel v-ref:panel3 header="ส่วนที่ 3 ข้อมูลแรงงาน พื้นที่ในการเลี้ยง และการจัดการอาหาร"
                               id="panel_3">
                            @include('admin.questionaire.part3')

                        </panel>
                        <panel v-ref:panel4 header="ส่วนที่ 4 การผสมพันธ์ุ ประสิทธิภาพการผลิต และการรักษาโรค"
                               id="panel_4">
                            @include('admin.questionaire.part4')
                        </panel>
                        <panel v-ref:panel5 header="ส่วนที่ 5 ข้อมูลแหล่งเงินทุนที่ใช้ในการเลี้ยงโคเนื้อ" id="panel_5">
                            @include('admin.questionaire.part5')
                        </panel>
                        <panel v-ref:panel6
                               header="ส่วนที่ 6 ข้อมูลการตลาด การรวมกลุ่มของสมาชิก(วิสาหกิจชุมชนและสหกรณ์)"
                               id="panel_6">
                            @include('admin.questionaire.part6')
                        </panel>
                        <panel v-ref:panel7 header="ส่วนที่ 7 การได้รับบริการ การส่งเสริมและสนับสนุนจากหน่วยงานต่างๆ"
                               id="panel_7">
                            @include('admin.questionaire.part7')
                        </panel>
                        <panel v-ref:panel8 header="ส่วนที่ 8 ปัญหา อุปสรรค และข้อเสนอแนะ" id="panel_8">
                            @include('admin.questionaire.part8')
                        </panel>
                    </accordion>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <affix>
                <div style="margin-top:20px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-primary btn-block" v-on:click="save()">Save</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <li class="">
                                    <a href="#panel_1" @click="showPanel($refs.panel1,$event)">ส่วนที่ 1</a>
                                </li>
                                <li class="">
                                    <a href="#panel_2" @click="showPanel($refs.panel2,$event)">ส่วนที่ 2</a>
                                </li>
                                <li class="">
                                    <a href="#panel_3" @click="showPanel($refs.panel3,$event)">ส่วนที่ 3</a>
                                </li>
                                <li class="">
                                    <a href="#panel_4" @click="showPanel($refs.panel4,$event)">ส่วนที่ 4</a>
                                </li>
                                <li class="">
                                    <a href="#panel_5" @click="showPanel($refs.panel5,$event)">ส่วนที่ 5</a>
                                </li>
                                <li class="">
                                    <a href="#panel_6" @click="showPanel($refs.panel6,$event)">ส่วนที่ 6</a>
                                </li>
                                <li class="">
                                    <a href="#panel_7" @click="showPanel($refs.panel7,$event)">ส่วนที่ 7</a>
                                </li>
                                <li class="">
                                    <a href="#panel_8" @click="showPanel($refs.panel8,$event)">ส่วนที่ 8</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </affix>
        </div>

    </div>
@endsection


@section('javascript')
    <script type="text/javascript" src="{{asset("/js/admin/questionaire/QuestionTextField.js")}}"></script>
    <script type="text/javascript">

        var app = new AdminApp({
            el: 'body',
            components: {
                'question-text-field': QuestionTextField,
                'question-textarea-field': QuestionTextAreaField,
                'question-select': QuestionSelect,
                'question-radio': QuestionRadio,

                'question-select-with-text': QuestionSelectWithText,
                'question-multi-checkbox': QuestionMultiCheckbox,
                'province-amphur-district': ProvinceAmphurDistrict,
            },
            data: {
                newFarmer: {},
                options: {},
                isLoaded: false,
            },
            methods: {
                updateSource : function(source){
                    console.log("test")
                },
                showPanel: function (panel, event) {
                    event.preventDefault();
                    if (panel.isOpen) {

                    } else {
                        panel.toggleIsOpen();
                    }
                    setTimeout(function () {
                        window.location = $(event.target).attr('href');
                    }, 500)

                },

                sumWorkers: function () {
                    var newFarmer = this.newFarmer;
                    var sum = 0;
                    sum = (parseInt(newFarmer.family_workers_amount)? parseInt(newFarmer.family_workers_amount) : 0)
                            + (parseInt(newFarmer.external_workers_amount)? parseInt(newFarmer.external_workers_amount) : 0);
                    return sum;
                }
                    ,
                sumOwnLand: function () {
                    var newFarmer = this.newFarmer;
                    if (newFarmer.own_land.children.length == 0) {
                        return [0, 0];
                    } else {
                        var sum = 0;
                        var sub_sum = 0;
                        for (var i = 0; i < newFarmer.sub_own_lands.length; i++) {
                            var subOwnLand = newFarmer.sub_own_lands[i];
                            sum += parseFloat(subOwnLand.pivot.remark, 0)?parseFloat(subOwnLand.pivot.remark, 0):0;
                            sub_sum += parseFloat(subOwnLand.pivot.subarea, 0)?parseFloat(subOwnLand.pivot.subarea, 0):0;


                        }
                        sum = sum + Math.floor(sub_sum / 4);
                        sub_sum = sub_sum % 4;

                        return [sum, sub_sum];
                    }
                },
                    sumUseLand: function () {
                        var newFarmer = this.newFarmer;
                        if (newFarmer.use_land.children.length == 0) {
                            return 0;
                        } else {
                            var sum = 0;
                            for (var i = 0; i < newFarmer.sub_use_lands.length; i++) {
                                var subUseLand = newFarmer.sub_use_lands[i];
                                sum += parseFloat(subUseLand.pivot.area, 0);
                            }
                            return sum;
                        }
                    },
                    sumBudget: function () {
                        var budgetSourcePrice = 0;
                        if (this.newFarmer['budget_source']['has_text']) {
                            budgetSourcePrice = parseFloat(this.newFarmer['budget_source']['pivot']['amount']);
                        }

                        var loneTypesSum = 0;
                        try {


                            for (var i = 0; i < this.newFarmer.loan_types.length; i++) {
                                var loneType = this.newFarmer.loan_types[i];
                                var amount = 0;
                                if (loneType.hasOwnProperty('pivot')) {
                                    amount = parseFloat(loneType.pivot.amount)
                                } else {
                                    Vue.set(loneType, 'pivot', {
                                        amount: 0
                                    })
                                }
                                if (amount) {
                                    loneTypesSum += amount;
                                }

                            }
                        } catch (e) {
                            console.log(e);
                        }
                        var sum = 0;
                        sum += budgetSourcePrice;
                        sum += loneTypesSum;
                        return sum;
                    },
                sumCattle: function (option) {
                    var sum = 0;
                    //console.log('option', option);

                    for (var i = 0; i < option.length; i++) {
                        var objOption = option[i];
                        //console.log('objOption', objOption);
                        sum += parseInt(objOption.pivot.amount) ? parseInt(objOption.pivot.amount) : 0;
                    }

                    return sum;
                },
                sumSubChildCattle: function (option) {
                    var subChildOption = this.newFarmer[option[0].type];
                    //console.log("sumSubChildCattle", subChildOption);
                    var sum = 0;
                    for (var i = 0; i < subChildOption.length; i++) {
                        var subOption = subChildOption[i];
                        sum += parseInt(subOption.pivot.amount) ? parseInt(subOption.pivot.amount) : 0;
                    }

                    return sum;

                },
                save: function () {
                    // this.newFarmer["total_master_breeding_types"] = 500;
                    this.formError = {};
                    console.log(this.newFarmer);
                    this.$http.post('api/farm-owner', this.newFarmer).then(function (response) {
                        console.log(response.data);
                        window.location.href = "{{url("/")}}/admin/questionaire/" + response.data.id + '/edit';
                    }, function (error) {
                        this.formError = error.data;
                    })
                },
                initial: function () {

                    var self = this;


                    this.$http.get('api/choice').then(function(response){
                        self.options = response.data;


                        this.$http.get('api/farm-owner/create').then(function(response){
                            self.newFarmer = response.data;
                            self.isLoaded = true;
                        })
                    })




//                    $.ajax({
//                        url: 'api/farm-owner/create',
//                        type: 'get',
//                        dataType: 'json',
//                        async: 'false',
//                        success: function (response) {
//
//                        }
//                    })

//                    $.ajax({
//                        url: '/api/choice',
//                        type: 'get',
//                        dataType: 'json',
//                        async: 'false',
//                        success: function (response) {
//
//                        }
//                    })
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