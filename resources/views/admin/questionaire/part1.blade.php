<form class="form-horizontal">
    <fieldset id="1.1">
        <legend>1.1 ข้อมูลทั่วไป</legend>
        <question-text-field label="ชื่อ" placeholder="กรุณากรอกชื่อ"
                             :model.sync="newFarmer.first_name"></question-text-field>
        <question-text-field label="นามสกุล" placeholder="กรุณากรอกนามสกุล"
                             :model.sync="newFarmer.last_name"></question-text-field>
        <question-text-field label="รหัสประจำตัวประชาชน" placeholder="กรุณากรอกรหัสประจำตัวประชาชน"
                             :model.sync="newFarmer.person_id"></question-text-field>


    </fieldset>

    <fieldset id="1.2">
        <legend>1.2 ที่อยู่ตามสำเนาทะเบียนบ้าน</legend>

        <question-text-field label="บ้านเลขที่" :model.sync="newFarmer.house_no"></question-text-field>
        <question-text-field label="หมู่" :model.sync="newFarmer.house_moo"></question-text-field>
        <province-amphur-district v-if="newFarmer.house_province != null"
                                  :model_province.sync="newFarmer.house_province"
                                  :model_amphur.sync="newFarmer.house_amphur"
                                  :model_district.sync="newFarmer.house_district">
        </province-amphur-district>

        <question-text-field label="รหัสไปรษณีย์" :model.sync="newFarmer.house_postcode"></question-text-field>
        <question-text-field label="โทรศัพท์บ้าน" :model.sync="newFarmer.house_phone"></question-text-field>
        <question-text-field label="โทรศัพท์มือถือ" :model.sync="newFarmer.mobile_no"></question-text-field>

        <question-text-field label="Email" placeholder="Email" type="email"
                                      :model.sync="newFarmer.email"></question-text-field>

    </fieldset>

    <fieldset id="1.3">
        <legend>1.3 ที่อยู่ฟาร์ม</legend>
        <question-text-field label="ที่ตั้งฟาร์มเลขที่" :model.sync="newFarmer.farm_no"></question-text-field>
        <question-text-field label="หมู่" :model.sync="newFarmer.farm_moo"></question-text-field>
        <province-amphur-district v-if="newFarmer.farm_province != null"
                                  :model_province.sync="newFarmer.farm_province"
                                  :model_amphur.sync="newFarmer.farm_amphur"
                                  :model_district.sync="newFarmer.farm_district">
        </province-amphur-district>
    </fieldset>
    <fieldset id="1.4">
        <legend>1.4 ตำแหน่งพิกัด GPS ของฟาร์ม</legend>
        <question-text-field label="พิกัดฟาร์ม (lat)" :model.sync="newFarmer.farm_lat"></question-text-field>
        <question-text-field label="พิกัดฟาร์ม (lng)" :model.sync="newFarmer.farm_long"></question-text-field>
    </fieldset>

    <fieldset id="1.5">
        <legend>1.5 สถานะทางครอบครัว</legend>
        <!-- sample select -->
        <question-select label="เพศ" :model.sync="newFarmer.sex" :options.sync="options.sex"></question-select>

        <question-text-field type="number" label="อายุ" :model.sync="newFarmer.age"></question-text-field>

        <question-select label="สถานภาพ" :model.sync="newFarmer.personal_status"
                         :options.sync="options.personal_status"></question-select>
        <!-- sample select with text-->
        <question-select-with-text label="สถานภาพในครอบครัว" :model.sync="newFarmer.family_status"
                                   :options.sync="options.family_status">

        </question-select-with-text>
    </fieldset>

    <fieldset id="1.6">
        <legend>1.6 การศึกษา</legend>
        <question-select-with-text label="การศึกษา" :model.sync="newFarmer.education"
                                   :options.sync="options.education">

        </question-select-with-text>

    </fieldset>
    <fieldset id="1.7">
        <legend>1.7 สถานภาพทางสังคม</legend>
        <!-- refactor -->
        <question-select-with-text label="สถานภาพทางสังคม" :model.sync="newFarmer.social_status"
                                   :options.sync="options.social_status">

        </question-select-with-text>

    </fieldset>
    <fieldset id="1.8">
        <legend>1.8 การเลี้ยงโคเนื้อ</legend>

        <question-select label="การเลี้ยงโคเนื้อเป็น"
                         :model.sync="newFarmer.cattle_job"
                         :options.sync="options.cattle_job">

        </question-select>

    </fieldset>
    <fieldset id="1.9">
        <legend>1.9 ท่านมีรายได้จากการประกอบอาชีพอะไรบ้าง (เลือกได้มากกว่า 1 ข้อ)</legend>
        <!-- sample multi choices -->

        <question-multi-checkbox :model.sync="newFarmer.jobtypes"
                                 :options.sync="options.jobtypes">

        </question-multi-checkbox>

    </fieldset>

    <fieldset id="1.10">
        <legend>1.10 ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)</legend>
        <question-select label="ท่านมีรายได้รวมของครัวเรือนเฉลี่ยเท่าไหร่ (บาท/ปี)" :model.sync="newFarmer.income_range"
                         :options.sync="options.income_range"></question-select>
    </fieldset>

    <fieldset id="1.11">
        <legend>1.11 รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)</legend>
        <question-text-field type="number" label="รายได้เฉลี่ยต่อปีของการขายโคเนื้อ (บาท)"
                             :model.sync="newFarmer.avg_cattle_income"></question-text-field>

    </fieldset>
</form>
