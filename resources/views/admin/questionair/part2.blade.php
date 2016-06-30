<form class="form-horizontal">
    <fieldset id="2.1">
        <legend>2.1 การเลียงโคเนื้อของท่านมีวัตถุประสงค์เพื่ออะไร (เลือกได้มากกว่า 1 ข้อ)</legend>
        <!-- sample multi choices -->
        <question-multi-checkbox :model.sync="newFarmer.farm_purposes"
                                 :options.sync="options.farm_purposes">

        </question-multi-checkbox>

    </fieldset>

    <fieldset id="2.2">
        <legend>2.2 ท่านมีการจดบันทึกข้อมูลหรือทำประวัติโคเนื้อหรือไม่</legend>
        <question-select :model.sync="newFarmer.farm_record"
                         :options.sync="options.farm_record">
        </question-select>

    </fieldset>

    <fieldset id="2.3">
        <legend>2.3 จำนวนโคเนื้อที่เกษตกรเลี้ยงทั้งหมด (ตัว)</legend>
        <div class="form-group">
            <div class="col-sm-10">
                <!-- <input type="text" v-model="newFarmer.farm_info.total_master_breeding_types" class="form-control"
                        readonly>-->
                <input type="text" v-model="newFarmer.total_master_breeding_types" class="form-control"
                       readonly>
            </div>
        </div>
    </fieldset>
    <!--v-model="newFarmer.farm_info['total_'+option.children[0].type]"-->
    <template v-for="option in options.master_breeding_types">
        <fieldset id="2.@{{ 4+$index }}">
            <legend>2.@{{ 4+$index }} @{{ option.choice }}</legend>

            <div class="form-group">
                <label class="col-sm-2 control-label">จำนวน</label>
                <div class="col-sm-10">
                    <input type="text"
                           v-model="newFarmer['total_'+option.children[0].type]"
                           v-bind:value="sumCattle(newFarmer[option.children[0].type])" class="form-control"
                           placeholder="" readonly>
                </div>
            </div>
            <div class="form-group" v-for="child in options[option.children[0].type]">
                <label class="col-sm-2 checkbox control-label">
                    <input type="checkbox" v-model="newFarmer[child.type]" v-bind:value="child">@{{ child.choice }}
                    <input type="hidden" v-model="child['pivot']['amount']"
                           v-bind:value="sumSubChildCattle(options[child.children[0].type])"
                    />
                </label>
                <div class="col-sm-10">
                    <templace v-for="subchild in options[child.children[0].type]">
                        <label class="checkbox">
                            <input type="checkbox" v-model="newFarmer[subchild.type]" v-bind:value="subchild">
                            @{{ subchild.choice }}:
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" v-model="subchild['pivot']['amount']" class="form-control"
                                           placeholder="จำนวน">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" v-model="subchild['pivot']['source']" class="form-control"
                                           placeholder="แหล่งที่มา">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" v-model="subchild['pivot']['price']" class="form-control"
                                           placeholder="ราคา">

                                </div>
                            </div>
                        </label>
                    </templace>
                    <templace v-if="child.children.length==0">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" v-model="child['pivot']['remark']" class="form-control"
                                       placeholder="ระบุ">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text" v-model="child['pivot']['amount']" class="form-control"
                                       placeholder="จำนวน">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" v-model="child['pivot']['source']" class="form-control"
                                       placeholder="แหล่งที่มา">
                            </div>

                            <div class="col-sm-4">
                                <input type="text" v-model="child['pivot']['price']" class="form-control"
                                       placeholder="ราคา">
                            </div>
                        </div>
                    </templace>
                </div>
            </div>
        </fieldset>

    </template>

    <fieldset id="2.10">
        <legend>2.10 ค่าใช้จ่ายในการเลี้ยงโคเนื้อ</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">ค่าใช้จ่ายโดยประมาณ (บาท/เดือน)</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.total_expense_amount" class="form-control"
                       placeholder="ค่าใช้จ่ายโดยประมาณ (บาท/เดือน)" readonly>
            </div>
        </div>
        <question-text-field label="ค่ายา (บาท/เดือน)" placeholder="ค่ายา (บาท/เดือน)"
                             :model.sync="newFarmer.drug_price"></question-text-field>
        <question-text-field label="ค่าอาหารและแร่ธาตุ (บาท/เดือน)"
                             placeholder="ค่าอาหารและแร่ธาตุ (บาท/เดือน)"
                             :model.sync="newFarmer.food_price"></question-text-field>

        <div class="form-group">
            <label class="col-sm-2 control-label">อื่นๆ</label>
            <div class="col-sm-5">
                <input type="text" v-model="newFarmer.expense_remark" class="form-control" placeholder="รายละเอียด">
            </div>
            <div class="col-sm-5">
                <input type="text" v-model="newFarmer.expense_price" class="form-control"
                       placeholder="ค่าใช้จ่าย (บาท/เดือน)">
            </div>
        </div>
    </fieldset>

    <fieldset id="2.11">
        <legend>2.11 ท่านมีประสบการณ์การเลี้ยงโคเนื้อมานานแค่ไหน</legend>
        <question-select :model.sync="newFarmer.farm_exp" :options.sync="options.farm_exp"></question-select>
    </fieldset>

    <fieldset id="2.12">
        <legend>2.12 ท่านมีเป้าหมายในการเลี้ยงในอนาคตอย่างไร</legend>
        <question-select :model.sync="newFarmer.farm_future" :options.sync="options.farm_future"></question-select>

    </fieldset>

    <fieldset id="2.13">
        <legend>2.13 การขึ้นทะเบียนฟาร์มกับภาครัฐ</legend>
        <question-select :model.sync="newFarmer.farm_register_status"
                         :options.sync="options.farm_register_status"></question-select>
        <question-select :model.sync="newFarmer.farm_register"
                         label="ระบุ"
                         v-show="newFarmer.farm_register_status.children.length > 0"
                         :options.sync="options.farm_register"></question-select>

    </fieldset>


    <fieldset id="2.14">
        <legend>2.14 ประวัติการตรวจโรคสัตว์ในฟาร์มของท่าน</legend>
        <question-select :model.sync="newFarmer.farm_disease_check"
                         :options.sync="options.farm_disease_check"></question-select>
    </fieldset>

    <fieldset id="2.15">
        <legend>2.15 สถานภาพการระบาดของโรคในฟาร์มของท่านเป็นอย่างไร</legend>
        <question-select label="โรคแท้งติดต่อ" :model.sync="newFarmer.abortion"
                         :options.sync="options.abortion"></question-select>
        <question-select label="โรควัณโรค" :model.sync="newFarmer.tuberculosis"
                         :options.sync="options.tuberculosis"></question-select>
        <question-select label="โรคปากและเท้าเปื่อย" :model.sync="newFarmer.foot_mouth_disease"
                         :options.sync="options.foot_mouth_disease"></question-select>
    </fieldset>


</form>
