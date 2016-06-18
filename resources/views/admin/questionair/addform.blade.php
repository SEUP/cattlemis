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
            <accordion :one-at-time="true">
                <panel header="ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร">
                    <form class="form-horizontal">
                        <formset>
                            <legend>1.1 ข้อมูลทั่วไป</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ชื่อ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="farmOwner[first_name]" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">นามสกุล</label>
                                <div class="col-sm-10">
                                    <input type="text" name="farmOwner[last_name]" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">รหัสประจำตัวประชาชน</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="farmOwner[personal_id]"
                                           placeholder="รหัสประจำตัวประชาชน">
                                </div>
                            </div>
                        </formset>

                        <formset>
                            <legend>1.2 ที่อยู่ตามสำเนาทะเบียนบ้าน</legend>
                            <div class="form-group">
                                <label for="farmOwner[house_no]"
                                       class="col-sm-2 control-label">บ้านเลขที่</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="farmOwner[house_no]"
                                           placeholder="บ้านเลขที่">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="บ้านเลขที่" class="col-sm-2 control-label">บ้านเลขที่</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="บ้านเลขที่" placeholder="บ้านเลขที่">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="หมู่" class="col-sm-2 control-label">หมู่</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="หมู่" placeholder="หมู่">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ตำบล" class="col-sm-2 control-label">ตำบล</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ตำบล" placeholder="ตำบล">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="อำเภอ" class="col-sm-2 control-label">อำเภอ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="อำเภอ" placeholder="อำเภอ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="จังหวัด" class="col-sm-2 control-label">จังหวัด</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="จังหวัด" placeholder="จังหวัด">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="รหัสไปรษณีย์" class="col-sm-2 control-label">รหัสไปรษณีย์</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="รหัสไปรษณีย์"
                                           placeholder="รหัสไปรษณีย์">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="โทรศัพท์บ้าน" class="col-sm-2 control-label">โทรศัพท์บ้าน</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="โทรศัพท์บ้าน"
                                           placeholder="โทรศัพท์บ้าน">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="โทรศัพท์มือถือ" class="col-sm-2 control-label">โทรศัพท์มือถือ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="โทรศัพท์มือถือ"
                                           placeholder="โทรศัพท์มือถือ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="E-mail" class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="E-mail" placeholder="E-mail">
                                </div>
                            </div>
                        </formset>

                        <formset>
                            <legend>1.3 ที่อยู่ฟาร์ม</legend>

                            <div class="form-group">
                                <label for="ที่ตั้งฟาร์มเลขที่"
                                       class="col-sm-2 control-label">ที่ตั้งฟาร์มเลขที่</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ที่ตั้งฟาร์มเลขที่"
                                           placeholder="ที่ตั้งฟาร์มเลขที่">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="หมู่" class="col-sm-2 control-label">หมู่</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="หมู่" placeholder="หมู่">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ตำบล" class="col-sm-2 control-label">ตำบล</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ตำบล" placeholder="ตำบล">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ตำบล" class="col-sm-2 control-label">ตำบล</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ตำบล" placeholder="ตำบล">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="อำเภอ" class="col-sm-2 control-label">อำเภอ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="อำเภอ" placeholder="อำเภอ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="จังหวัด" class="col-sm-2 control-label">จังหวัด</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="จังหวัด" placeholder="จังหวัด">
                                </div>
                            </div>
                        </formset>
                        <formset>
                            <legend>1.4 ตำแหน่งพิกัด GPS ของฟาร์ม</legend>
                            <div class="form-group">
                                <label for="พิกัดฟาร์ม (lat)" class="col-sm-2 control-label">พิกัดฟาร์ม (lat)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="พิกัดฟาร์ม (lat)"
                                           placeholder="พิกัดฟาร์ม (lat)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="พิกัดฟาร์ม (lng)" class="col-sm-2 control-label">พิกัดฟาร์ม (lng)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="พิกัดฟาร์ม (lng)"
                                           placeholder="พิกัดฟาร์ม (lng)">
                                </div>
                            </div>
                        </formset>

                        <formset>
                            <legend>1.5 สถานะทางครอบครัว</legend>
                            <div class="form-group">
                                <label for="เพศ" class="col-sm-2 control-label">เพศ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="เพศ" placeholder="เพศ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="อายุ" class="col-sm-2 control-label">อายุ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="อายุ" placeholder="อายุ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="สถานภาพ" class="col-sm-2 control-label">สถานภาพ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="สถานภาพ" placeholder="สถานภาพ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="สถานภาพในครอบครัว" class="col-sm-2 control-label">สถานภาพในครอบครัว</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="สถานภาพในครอบครัว"
                                           placeholder="สถานภาพในครอบครัว">
                                </div>
                            </div>
                        </formset>

                        <formset>
                            <legend>1.6 การศึกษา</legend>

                            <div class="form-group">
                                <label for="การศึกษา" class="col-sm-2 control-label">การศึกษา</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="การศึกษา" placeholder="การศึกษา">
                                </div>
                            </div>
                        </formset>
                        <formset>
                            <legend>1.7 สถานภาพทางสังคม</legend>

                            <div class="form-group">
                                <label for="สถานภาพทางสังคม" class="col-sm-2 control-label">สถานภาพทางสังคม</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="สถานภาพทางสังคม"
                                           placeholder="สถานภาพทางสังคม">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="สถานภาพทางสังคม อื่นๆ" class="col-sm-2 control-label">สถานภาพทางสังคม
                                    อื่นๆ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="สถานภาพทางสังคม อื่นๆ"
                                           placeholder="สถานภาพทางสังคม อื่นๆ">
                                </div>
                            </div>
                        </formset>
                        <formset>
                            <legend>1.8 การเลี้ยงโคเนื้อ</legend>
                            <div class="form-group">
                                <label for="การเลี้ยงโคเนื้อเป็น"
                                       class="col-sm-2 control-label">การเลี้ยงโคเนื้อเป็น</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="การเลี้ยงโคเนื้อเป็น"
                                           placeholder="การเลี้ยงโคเนื้อเป็น">
                                </div>
                            </div>
                        </formset>
                        <formset>
                            <legend>1.9</legend>
                        </formset>

                        <formset>
                            <legend>1.10 ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)</legend>
                            <div class="form-group">
                                <label for="ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)"
                                       class="col-sm-2 control-label">ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่
                                    (บาท/ปี)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           id="ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)"
                                           placeholder="ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)">
                                </div>
                            </div>

                        </formset>

                        <formset>
                            <legend>1.11 รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)</legend>
                            <div class="form-group">
                                <label for="รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)" class="col-sm-2 control-label">รายได้เฉลี่ยต่อปีของการขายโคเนื้อ
                                    (บาท)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)"
                                           placeholder="รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)">
                                </div>
                            </div>
                        </formset>
                    </form>
                </panel>
                <panel header="ส่วนที่ 2 ข้อมูลการเลี้ยงและสถานภาพฟาร์ม">ส่วนที่ 2</panel>
                <panel header="ส่วนที่ 3 ข้อมูลแรงงาน พื้นที่ในการเลี้ยง และการจัดการอาหาร">ส่วนที่ 3</panel>
                <panel header="ส่วนที่ 4 การผสมพันธ์ุ ประสิทธิภาพการผลิต และการรักษาโรค">ส่วนที่ 4</panel>
                <panel header="ส่วนที่ 5 ข้อมูลแหล่งเงินทุนที่ใช้ในการเลี้ยงโคเนื้อ">ส่วนที่ 5</panel>
                <panel header="ส่วนที่ 6 ข้อมูลการตลาด การรวมกลุ่มของสมาชิก(วิสาหกิจชุมชนและสหกรณ์)">ส่วนที่ 6</panel>
                <panel header="ส่วนที่ 7 การได้รับบริการ การส่งเสริมและสนับสนุนจากหน่วยงานต่างๆ">ส่วนที่ 6</panel>
                <panel header="ส่วนที่ 8 ปัญหา อุปสรรค และข้อเสนอแนะ">ส่วนที่ 6</panel>
            </accordion>
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