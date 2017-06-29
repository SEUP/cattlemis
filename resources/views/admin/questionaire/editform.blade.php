@extends('admin.layout')

@section('page-wrapper')




    <div class="row">
        <div class="col-lg-10">
            <h1 class="page-header">แก้ไขข้อมูลเกษตรกร</h1>


            <input type="hidden" id="newFamer_id" value="{{$farmOwner->id}}"/>
            <div class="row" v-show="isLoaded">

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

            <affix v-show="isLoaded">
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

                <alert
                        :show.sync="showRight"
                        :duration="3000"
                        type="success"
                        dismissable>
                    <span class="icon-ok-circled alert-icon-float-left"></span>
                    <strong>Well Done!</strong>
                    <p>Save Complete</p>
                </alert>

                <alert
                        :show.sync="showTop"
                        :duration="3000"
                        type="danger"
                        dismissable>
                    <span class="icon-info-circled alert-icon-float-left"></span>
                    <strong>Danger !</strong>
                    <p>Save Error</p>
                </alert>
            </affix>


        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript" src="{{asset("/js/admin/questionaire/QuestionTextField.js")}}"></script>
    <script type="text/javascript" src="{{asset("/js/admin/questionaire/edit.js")}}"></script>
@endsection