@extends('admin.layout')

@section('page-wrapper')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">แก้ไขข้อมูลเกษตรกร
            </h1>
        </div>
    </div>

    <input type="hidden" id="newFamer_id" value="{{$farmOwner->id}}"/>



    <div class="row" v-show="isLoaded">
        <spinner id="spinner-box" :size="lg" :fixed="true"
                 text="Loading..." v-ref:spinner></spinner>
        <div class="col-lg-10">
            <accordion :one-at-time="false">
                <panel header="ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร" :is-open="true">
                    @include('admin.questionair.part1')
                </panel>
                <panel header="ส่วนที่ 2 ข้อมูลการเลี้ยงและสถานภาพฟาร์ม" :is-open="true">
                    @include('admin.questionair.part2')
                </panel>
                <panel header="ส่วนที่ 3 ข้อมูลแรงงาน พื้นที่ในการเลี้ยง และการจัดการอาหาร">
                    @include('admin.questionair.part3')

                </panel>
                <panel header="ส่วนที่ 4 การผสมพันธ์ุ ประสิทธิภาพการผลิต และการรักษาโรค">
                    @include('admin.questionair.part4')
                </panel>
                <panel header="ส่วนที่ 5 ข้อมูลแหล่งเงินทุนที่ใช้ในการเลี้ยงโคเนื้อ">
                    @include('admin.questionair.part5')
                </panel>
                <panel header="ส่วนที่ 6 ข้อมูลการตลาด การรวมกลุ่มของสมาชิก(วิสาหกิจชุมชนและสหกรณ์)">
                    @include('admin.questionair.part6')
                </panel>
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
    <script type="text/javascript" src="/js/admin/questionair/edit.js"></script>
@endsection