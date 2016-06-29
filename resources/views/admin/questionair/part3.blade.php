<form class="form-horizontal">
    <fieldset id="3.1">
        <legend>3.1 จำนวนแรงงานที่ใช้เลี้ยงโค (คน)</legend>

        <question-text-field label="3.1.1 จำนวนแรงงานภายในครอบครัว" placeholder="จำนวนแรงงานภายในครอบครัว"
                             :model.sync="newFarmer.family_workers_amount">
        </question-text-field>
        <question-text-field label="3.1.2 จำนวนแรงงานภายนอก" placeholder="จำนวนแรงงานภายนอก"
                             :model.sync="newFarmer.external_workers_amount">
        </question-text-field>

    </fieldset>
    <fieldset id="3.2">
        <legend>3.2 แหล่งน้ำที่ใช้ในการเลี้ยง</legend>
        <question-multi-checkbox label="แหล่งน้ำที่ใช้ในการเลี้ยง (เลือกได้มากกว่า 1 ข้อ)"
                                 :model.sync="newFarmer.water_source_types"
                                 :options.sync="options.water_source_types">

        </question-multi-checkbox>
    </fieldset>
    <fieldset id="3.3">
        <legend>3.3 ลักษณะการเลี้ยงโคเนื้อของท่าน</legend>
        <question-multi-checkbox
                                 :model.sync="newFarmer.take_care_types"
                                 :options.sync="options.take_care_types">

        </question-multi-checkbox>
    </fieldset>
    <fieldset id="3.4">
        <legend>3.4 พื้นที่ถือครองทางการเกษตร(ไร่/ครัวเรือน)</legend>

        <question-select :model.sync="newFarmer.own_land"
                         :options.sync="options.own_land">

        </question-select>

        <div class="form-group" v-if="newFarmer.own_land.children.length!=0">
            <question-select label="โปรดระบุ" :model.sync="newFarmer[newFarmer.own_land.children[0].type]"
                             :options.sync="options[newFarmer.own_land.children[0].type]">

            </question-select>

        </div>


    </fieldset>


</form>
