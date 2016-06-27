<form class="form-horizontal">
    <fieldset id="2.1">
        <legend>2.1 การเลียงโคเนื้อของท่านมีวัตถุประสงค์เพื่ออะไร (เลือกได้มากกว่า 1 ข้อ)</legend>
        <div class="form-group">
            <div class="col-sm-3">
                <label>การเลี้ยงโคเนื้อของท่านมีวัตถุประสงค์เพื่ออะไร (เลือกได้มากกว่า 1 ข้อ)</label>
            </div>
            <div class="col-sm-9">
                <label class="checkbox" v-for="option in options.farm_purposes">
                    <input type="checkbox" v-model="newFarmer.farm_purposes" v-bind:value="option">
                    @{{ option.choice }}:
                    <input v-if="option.has_text" type="text" class="form-control"
                           v-model="option['pivot']['remark']">
                </label>
            </div>
        </div>
    </fieldset>

    <fieldset id="2.2">
        <legend>2.2 ท่านมีการจดบันทึกข้อมูลหรือทำประวัติโคเนื้อหรือไม่</legend>
        <div class="form-group">
            <label for="เพศ" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.farm_record">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.farm_record"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset id="2.3">
        <legend>2.3 จำนวนโคเนื้อที่เกษตกรเลี้ยงทั้งหมด (ตัว)</legend>

        <div class="form-group">
            <label
                    class="col-sm-2 control-label "></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="" readonly>
            </div>
        </div>
    </fieldset>

    <template v-for="option in options.master_breeding_types">
        <fieldset id="">
            <legend>@{{ option.choice }}</legend>

            <div class="form-group">
                <label class="col-sm-2 control-label">จำนวน</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="" readonly>
                </div>
            </div>
            <div class="form-group" v-for="child in options[option.children[0].type]">
                <label class="col-sm-2 checkbox control-label">
                    <input type="checkbox" v-model="newFarmer[child.type]" v-bind:value="child">@{{ child.choice }}
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
        <div class="form-group">
            <label class="col-sm-2 control-label">ค่ายา (บาท/เดือน)</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.drug_price" class="form-control" placeholder="ค่ายา (บาท/เดือน)">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ค่าอาหารและแร่ธาตุ (บาท/เดือน)</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.food_price" class="form-control" placeholder="ค่าอาหารและแร่ธาตุ (บาท/เดือน)">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">อื่นๆ</label>
            <div class="col-sm-5">
                <input type="text" v-model="newFarmer.expense_remark" class="form-control" placeholder="รายละเอียด">
            </div>
            <div class="col-sm-5">
                <input type="text" v-model="newFarmer.expense_price" class="form-control" placeholder="ค่าใช้จ่าย (บาท/เดือน)">
            </div>
        </div>
    </fieldset>

    <fieldset id="2.11">
        <legend>2.11 ท่านมีประสบการณ์การเลี้ยงโคเนื้อมานานแค่ไหน</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.farm_exp">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.farm_exp"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset id="2.12">
        <legend>2.12 ท่านมีเป้าหมายในการเลี้ยงในอนาคตอย่างไร</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.farm_future">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.farm_future"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset id="2.13">
        <legend>2.13 การขึ้นทะเบียนฟาร์มกับภาครัฐ</legend>
        <templace v-for="option in options.farm_register_status">
            <div class="form-group">
                <label class="col-sm-4 checkbox control-label">
                    <input type="checkbox" v-model="newFarmer[option.type]" v-bind:value="option">@{{ option.choice }}
                </label>
                <templace v-if="option.children.length!=0">
                    <div class="col-sm-8">
                    <select class="form-control" v-model="newFarmer[child.type]">
                        <option value="">กรุณาเลือก</option>
                        <option v-for="child in options[option.children[0].type]"
                                v-bind:value="child">@{{ child.choice }}
                        </option>
                    </select>
                    </div>
                </templace>
            </div>

        </templace>
    </fieldset>








    <fieldset id="2.14">
        <legend>2.14 ประวัติการตรวจโรคสัตว์ในฟาร์มของท่าน</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.farm_disease_check">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.farm_disease_check"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset id="2.15">
        <legend>2.15 สถานภาพการระบาดของโรคในฟาร์มของท่านเป็นอย่างไร</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">โรคแท้งติดต่อ</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.abortion">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.abortion"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">โรควัณโรค</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.tuberculosis">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.tuberculosis"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">โรคปากและเท้าเปื่อย</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.foot_mouth_disease">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.foot_mouth_disease"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>


</form>
