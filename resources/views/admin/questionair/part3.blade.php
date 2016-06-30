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
            <question-multi-checkbox
                    :model.sync="newFarmer.sub_own_lands"
                    :options.sync="options.sub_own_lands">

            </question-multi-checkbox>

        </div>


    </fieldset>
    <fieldset id="3.5">
        <legend>3.5 การเช่าที่ดินเพื่อใช้ในการเลี้ยง (ไร่/ครัวเรือน)</legend>
        <question-select :model.sync="newFarmer.rent_land"
                         :options.sync="options.rent_land">

        </question-select>
        <div class="col-sm-3" ></div>
        <div class="form-group col-sm-6" v-if="newFarmer.rent_land.has_text==1">

            <input type="text" v-model="newFarmer.rent_land.pivot.remark"
                   class="form-control col-sm-6" placeholder="จำนวน(ไร่)"/>
            <input type="text" v-model="newFarmer.rent_land.pivot.price"
                   class="form-control col-sm-6" placeholder="ค่าเช่าที่ดิน(บาท/ไร่)"/>
        </div>
    </fieldset>
    <fieldset id="3.6">
        <legend>3.6 พื้นที่ที่ใช้ในการเลี้ยงโคเนื้อ (ไร่/ครัวเรือน)</legend>
        <question-select :model.sync="newFarmer.use_land"
                         :options.sync="options.use_land">

        </question-select>

        <div class="form-group" v-if="newFarmer.use_land.children.length!=0">
            <question-multi-checkbox
                    :model.sync="newFarmer.sub_use_lands"
                    :options.sync="options.sub_use_lands">

            </question-multi-checkbox>

        </div>
    </fieldset>
    <fieldset id="3.7">
        <legend> 3.7 อาหารที่ท่านใช้เลี้ยงโคเนื้อเป็นอาหารประเภทใด (ตอบได้มากกว่า 1 ข้อ)</legend>
            <question-multi-checkbox
                    :model.sync="newFarmer.feed_types"
                    :options.sync="options.feed_types">

            </question-multi-checkbox>

    </fieldset>
    <fieldset id="3.8">
        <legend> 3.8 แหล่งที่มาของอาหารข้นหรืออาหารผสมครบส่วน</legend>
        <question-multi-checkbox
                :model.sync="newFarmer.feed_sources"
                :options.sync="options.feed_sources">
        </question-multi-checkbox>
    </fieldset>
    <fieldset id="3.9">
        <legend> 3.9 ท่านเคยให้แร่ธาตุก้อนหรือไม่</legend>
        <question-select :model.sync="newFarmer.minerals_feed"
                         :options.sync="options.minerals_feed">

        </question-select>

        <div class="form-group" v-if="newFarmer.minerals_feed.children.length!=0">
            <question-select label="ความถี่การให้แร่ธาตุก้อน"
                    :model.sync="newFarmer.sub_minerals_feed"
                    :options.sync="options.sub_minerals_feed">

            </question-select>

        </div>
    </fieldset>
    <fieldset id="3.10">
        <legend>3.10 ท่านมีการสำรองฟางข้าว หรือเปลือกข้าวโพดไว้ใช้เลี้ยงโคหรือไม่</legend>
        <question-select :model.sync="newFarmer.feedstock"
                         :options.sync="options.feedstock">

        </question-select>
        <div class="form-group" v-if="newFarmer.feedstock.children.length!=0">
        <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-9">
                <label class="checkbox" v-for="option in options.feedstock_types">
                    <input type="checkbox" v-model="newFarmer.feedstock_types" v-bind:value="option">
                    @{{ option.choice }}:

                    <input v-if="option.choice!='ฟางข้าวหรือเปลือกข้าวโพดหมักหรือปรุงแต่ง'"
                           placeholder="เก็บไว้ในโรงเรือนขนาดกว้าง(เมตร)" type="text" class="form-control"
                           v-model="option['pivot']['width']">
                    <input v-if="option.choice!='ฟางข้าวหรือเปลือกข้าวโพดหมักหรือปรุงแต่ง'"
                           placeholder="เก็บไว้ในโรงเรือนขนาดยาว(เมตร)" type="text" class="form-control"
                           v-model="option['pivot']['height']">

                    <input v-if="option.choice=='ฟางข้าวหรือเปลือกข้าวโพดหมักหรือปรุงแต่ง'"
                           placeholder="เก็บไว้ในบ่อเก็บขนาดกว้าง(เมตร)" type="text" class="form-control"
                           v-model="option['pivot']['width']">
                    <input v-if="option.choice=='ฟางข้าวหรือเปลือกข้าวโพดหมักหรือปรุงแต่ง'"
                           placeholder="เก็บไว้ในบ่อเก็บขนาดยาว(เมตร)" type="text" class="form-control"
                           v-model="option['pivot']['height']">
                    <input v-if="option.choice=='ฟางข้าวหรือเปลือกข้าวโพดหมักหรือปรุงแต่ง'"
                           placeholder="หรือ ถังหมัก จำนวน(ถัง)" type="text" class="form-control"
                           v-model="option['pivot']['amount']">
                </label>
            </div>
        </div>
        </div>
    </fieldset>
    <fieldset id="3.11">
        <legend>3.11  ท่านใช้แหล่งอาหารหยาบในฤดูแล้งจาก</legend>
            <question-multi-checkbox
                    :model.sync="newFarmer.feed_summer_sources"
                    :options.sync="options.feed_summer_sources">
            </question-multi-checkbox>

    </fieldset>



</form>
