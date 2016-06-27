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
                <input type="hidden" id="newFamer_id" value="{{$farmOwner->id}}"/>
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
    <script type="text/html" src="/js/admin/questionair/QuestionTextField.vue"></script>
    <script type="text/javascript" src="/js/admin/questionair/edit.js"></script>
@endsection