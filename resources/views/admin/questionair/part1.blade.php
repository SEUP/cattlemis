<form class="form-horizontal">
    <fieldset id="1.1">
        <legend>1.1 ข้อมูลทั่วไป</legend>
        <question-text-field label="ชื่อ" :model.sync="newFarmer.first_name"></question-text-field>

        <div class="form-group">
            <label class="col-sm-2 control-label">นามสกุล</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.last_name" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">รหัสประจำตัวประชาชน</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="newFarmer.person_id"
                       placeholder="รหัสประจำตัวประชาชน">
            </div>
        </div>
    </fieldset>

    <fieldset id="1.2">
        <legend>1.2 ที่อยู่ตามสำเนาทะเบียนบ้าน</legend>
        <div class="form-group">
            <label for="newFarmer.house_no"
                   class="col-sm-2 control-label">บ้านเลขที่</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="newFarmer.house_no"
                       placeholder="บ้านเลขที่">
            </div>
        </div>

        <div class="form-group">
            <label for="หมู่" class="col-sm-2 control-label">หมู่</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="newFarmer.house_moo"
                       placeholder="หมู่">
            </div>
        </div>
        <div class="form-group">
            <label for="ตำบล" class="col-sm-2 control-label">ตำบล</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.house_suburb" class="form-control" id="ตำบล" placeholder="ตำบล">
            </div>
        </div>
        <div class="form-group">
            <label for="อำเภอ" class="col-sm-2 control-label">อำเภอ</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.house_district" class="form-control" id="อำเภอ"
                       placeholder="อำเภอ">
            </div>
        </div>
        <div class="form-group">
            <label for="จังหวัด" class="col-sm-2 control-label">จังหวัด</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.house_province" class="form-control" id="จังหวัด"
                       placeholder="จังหวัด">
            </div>
        </div>
        <div class="form-group">
            <label for="รหัสไปรษณีย์" class="col-sm-2 control-label">รหัสไปรษณีย์</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="newFarmer.house_postcode"
                       placeholder="รหัสไปรษณีย์">
            </div>
        </div>
        <div class="form-group">
            <label for="โทรศัพท์บ้าน" class="col-sm-2 control-label">โทรศัพท์บ้าน</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="newFarmer.house_phone"
                       placeholder="โทรศัพท์บ้าน">
            </div>
        </div>
        <div class="form-group">
            <label for="โทรศัพท์มือถือ" class="col-sm-2 control-label">โทรศัพท์มือถือ</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="newFarmer.mobile_no"
                       placeholder="โทรศัพท์มือถือ">
            </div>
        </div>
        <div class="form-group">
            <label for="E-mail" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" v-model="newFarmer.email"
                       placeholder="E-mail">
            </div>
        </div>
    </fieldset>

    <fieldset id="1.3">
        <legend>1.3 ที่อยู่ฟาร์ม</legend>

        <div class="form-group">
            <label for="ที่ตั้งฟาร์มเลขที่"
                   class="col-sm-2 control-label">ที่ตั้งฟาร์มเลขที่</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.farm_no" class="form-control" id="ที่ตั้งฟาร์มเลขที่"
                       placeholder="ที่ตั้งฟาร์มเลขที่">
            </div>
        </div>
        <div class="form-group">
            <label for="หมู่" class="col-sm-2 control-label">หมู่</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.farm_moo" class="form-control" id="หมู่" placeholder="หมู่">
            </div>
        </div>
        <div class="form-group">
            <label for="ตำบล" class="col-sm-2 control-label">ตำบล</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.farm_suburb" class="form-control" id="ตำบล" placeholder="ตำบล">
            </div>
        </div>

        <div class="form-group">
            <label for="อำเภอ" class="col-sm-2 control-label">อำเภอ</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.farm_district" class="form-control" id="อำเภอ"
                       placeholder="อำเภอ">
            </div>
        </div>
        <div class="form-group">
            <label for="จังหวัด" class="col-sm-2 control-label">จังหวัด</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.farm_province" class="form-control" id="จังหวัด"
                       placeholder="จังหวัด">
            </div>
        </div>
    </fieldset>
    <fieldset id="1.4">
        <legend>1.4 ตำแหน่งพิกัด GPS ของฟาร์ม</legend>
        <div class="form-group">
            <label for="พิกัดฟาร์ม (lat)" class="col-sm-2 control-label">พิกัดฟาร์ม (lat)</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.farm_lat" class="form-control" id="พิกัดฟาร์ม (lat)"
                       placeholder="พิกัดฟาร์ม (lat)">
            </div>
        </div>
        <div class="form-group">
            <label for="พิกัดฟาร์ม (lng)" class="col-sm-2 control-label">พิกัดฟาร์ม (lng)</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.farm_long" class="form-control" id="พิกัดฟาร์ม (lng)"
                       placeholder="พิกัดฟาร์ม (lng)">
            </div>
        </div>
    </fieldset>

    <fieldset id="1.5">
        <legend>1.5 สถานะทางครอบครัว</legend>
        <!-- sample select -->
        <question-select label="เพศ" :model.sync="newFarmer.sex" :options.sync="options.sex"></question-select>

        <div class="form-group">
            <label for="อายุ" class="col-sm-2 control-label">อายุ</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.age" class="form-control" id="อายุ" placeholder="อายุ">
            </div>
        </div>

        <question-select label="สถานภาพ" :model.sync="newFarmer.personal_status"
                         :options.sync="options.personal_status"></question-select>

        <div class="form-group">
            <label for="สถานภาพในครอบครัว" class="col-sm-2 control-label">สถานภาพในครอบครัว</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control " v-model="newFarmer.family_status">
                            <option value="">กรุณาเลือก</option>
                            <option v-for="option in options.family_status"
                                    v-bind:value="option">@{{ option.choice }}</option>
                        </select>
                    </div>
                    <div class="col-sm-6" v-if="newFarmer.family_status.has_text==1">
                        <input type="text" v-model="newFarmer.family_status.pivot.remark"
                               class="form-control col-sm-6" placeholder="โปรดระบุ"/>
                    </div>

                </div>

            </div>
        </div>
    </fieldset>

    <fieldset id="1.6">
        <legend>1.6 การศึกษา</legend>

        <div class="form-group">
            <label for="การศึกษา" class="col-sm-2 control-label">การศึกษา</label>
            <div class="col-sm-10">

                <select class="form-control " v-model="newFarmer.education">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.education"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>
    <fieldset id="1.7">
        <legend>1.7 สถานภาพทางสังคม</legend>
        <question-select-with-text label="สถานภาพทางสังคม" :model.sync="newFarmer.social_status"
                                   :options.sync="options.social_status"></question-select-with-text>

    </fieldset>
    <fieldset id="1.8">
        <legend>1.8 การเลี้ยงโคเนื้อ</legend>
        <div class="form-group">
            <label for="การเลี้ยงโคเนื้อเป็น"
                   class="col-sm-2 control-label">การเลี้ยงโคเนื้อเป็น</label>
            <div class="col-sm-10">
                <select class="form-control " v-model="newFarmer.cattle_job">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.cattle_job"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>

            </div>
        </div>
    </fieldset>
    <fieldset id="1.9">
        <legend>1.9 ท่านมีรายได้จากการประกอบอาชีพอะไรบ้าง (เลือกได้มากกว่า 1 ข้อ)</legend>
        <question-multi-checkbox label="ท่านมีรายได้จากการประกอบอาชีพอะไรบ้าง (เลือกได้มากกว่า 1 ข้อ)"
                                 :model.sync="newFarmer.jobtypes"
                                 :options.sync="options.jobtypes">

        </question-multi-checkbox>

    </fieldset>

    <fieldset id="1.10">
        <legend>1.10 ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)</legend>
        <div class="form-group">
            <label for="ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)"
                   class="col-sm-2 control-label">ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่
                (บาท/ปี)</label>
            <div class="col-sm-10">
                <select class="form-control " v-model="newFarmer.income_range">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.income_range"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>

    </fieldset>

    <fieldset id="1.11">
        <legend>1.11 รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)</legend>
        <div class="form-group">
            <label for="รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)" class="col-sm-2 control-label">รายได้เฉลี่ยต่อปีของการขายโคเนื้อ
                (บาท)</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.avg_cattle_income" class="form-control"
                       id="รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)"
                       placeholder="รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)">
            </div>
        </div>
    </fieldset>
</form>
