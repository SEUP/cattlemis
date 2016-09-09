@extends('public.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ยินดีต้อนรับสู่ระบบฐานข้อมูลเกษตรกรผู้เลี้ยงโคเนื้อ</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <a href="/questionaire/search">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-search fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">ค้นหา</div>
                                <div>เกษตรกร</div>

                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left">ค้นหาข้อมูลเกษตรกร</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right" style="color: #5cb85c;"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <a href="/charts/menuchart">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bar-chart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">รายงาน</div>
                                <div>กราฟ แผนภูมิ แผนที่</div>

                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-left">รายงานสถิติต่างๆ</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right" style="color: #f0ad4e;"></i></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </a>
        </div>

    </div>
@endsection