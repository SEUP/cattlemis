@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">บันทึกข้อมูลเกษตรกรใหม่</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <tabs :active="0">
                <tab header="ส่วนที่ 1">ส่วนที่ 1</tab>
                <tab header="ส่วนที่ 2">ส่วนที่ 2</tab>
                <tab header="ส่วนที่ 3">ส่วนที่ 3</tab>
                <tab header="ส่วนที่ 4">ส่วนที่ 4</tab>
                <tab header="ส่วนที่ 5">ส่วนที่ 5</tab>
                <tab header="ส่วนที่ 6">ส่วนที่ 6</tab>

            </tabs>
        </div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">

        var app = new AdminApp({
            el: 'body',
            data: {},
            methods: {},
            ready: function () {

            }
        })

    </script>
@endsection