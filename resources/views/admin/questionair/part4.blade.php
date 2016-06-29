<form class="form-horizontal">
    <fieldset id="4.1">
        <legend>4.1 ผสมพันธุ์โคเนื้อในฟาร์มของท่าน</legend>
        <question-select label="ผสมพันธุ์โคเนื้อในฟาร์มของท่าน" :model.sync="newFarmer.farm_breeding_types"
                         :options.sync="options.farm_breeding_types"></question-select>


    </fieldset>
    <fieldset id="4.2">
        <legend>4.2 การผสมเทียมใช้น้ำเชื้อจากแหล่งใด</legend>
        <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-9">
                <label class="checkbox" v-for="option in options.inseminate_sources">
                    <input type="checkbox" v-model="newFarmer.inseminate_sources" v-bind:value="option">
                    @{{ option.choice }}:

                    <input v-if="option.choice=='สถานศึกษา'||option.choice=='เอกชน'
||option.choice=='อื่นๆ'" placeholder="ชื่อหน่วยงาน" type="text" class="form-control"
                           v-model="option['pivot']['amount']">
                    <input placeholder="ราคาต่อโด๊ส"
                           type="text" class="form-control"
                           v-model="option['pivot']['price']">


                </label>
            </div>
        </div>

    </fieldset>
    <fieldset id="4.3">
        <legend>4.3 การใช้พ่อพันธุ์คุมฝูง</legend>
        <question-text-field label="อัตราส่วนพ่อพันธุ์คุมฝูง 1 ตัวต่อแม่พันธุ์ (ตัว)"
                             :model.sync="newFarmer.breeding_rate">
        </question-text-field>
     </fieldset>

    <fieldset id="4.4">
        <legend>4.4 การตายของโคในรอบปี </legend>
        <question-select-with-text :model.sync="newFarmer.cattle_death"
                                   :options.sync="options.cattle_death">
            </question-select-with-text>
        <legend>4.4.1 สาเหตุการตาย </legend>
        <question-multi-checkbox :model.sync="newFarmer.cattle_death_causes"
                                 :options.sync="options.cattle_death_causes">
        </question-multi-checkbox>
    </fieldset>
    <fieldset id="4.5">
        <legend>4.5 เมื่อโคเจ็บป่วย บุคคลที่ทำการรักษาให้ (ตอบได้มากกว่า 1 ข้อ)</legend>
        <question-multi-checkbox :model.sync="newFarmer.disease_cured_by"
                                 :options.sync="options.disease_cured_by">
        </question-multi-checkbox>
    </fieldset>
    <fieldset id="4.6">
        <legend>4.6 การถ่ายพยาธิ(ครั้ง/ปี)</legend>
        <question-select-with-text :model.sync="newFarmer.dewormed_amount"
                                   :options.sync="options.dewormed_amount">
        </question-select-with-text>
    </fieldset>
    <fieldset id="4.7">
        <legend>4.7 ท่านได้ทำวัคซีนป้องกันโรคให้กับโคเนื้อที่เลี้ยงหรือไม่</legend>
    </fieldset>

    <fieldset id="4.8">
        <legend>4.8 ท่านมีการจัดการมูลโคในฟาร์มของท่านอย่างไร (เลือกได้มากกว่า 1 ข้อ)</legend>
        <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-9">
                <label class="checkbox" v-for="option in options.cattle_dung_uses">
                    <input type="checkbox" v-model="newFarmer.cattle_dung_uses" v-bind:value="option">
                    @{{ option.choice }}:
                    <input v-if="option.hastext==1" placeholder="(บาท/ปี)"
                           type="text" class="form-control"
                           v-model="option['pivot']['remark']">
                </label>
            </div>
        </div>
    </fieldset>


</form>
