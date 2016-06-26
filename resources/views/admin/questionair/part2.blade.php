<form class="form-horizontal">
    <fieldset id="2.1">
        <legend>2.1 การเลียงโคเนื้อขอท่านมีวัตถุประสงค์เพื่ออะไร (เลือกได้มากกว่า 1 ข้อ)</legend>
        <div class="form-group">
            <div class="col-sm-3">
                <label>การเลียงโคเนื้อขอท่านมีวัตถุประสงค์เพื่ออะไร (เลือกได้มากกว่า 1 ข้อ)</label>
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
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
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
                <input type="text" class="form-control" placeholder="ค่าใช้จ่ายโดยประมาณ (บาท/เดือน)">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ค่ายา (บาท/เดือน)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="ค่ายา (บาท/เดือน)">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">ค่าอาหารและแร่ธาตุ (บาท/เดือน)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="ค่าอาหารและแร่ธาตุ (บาท/เดือน)">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">อื่นๆ</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="รายละเอียด">
            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="ค่าใช้จ่าย (บาท/เดือน)">
            </div>
        </div>
    </fieldset>

    <fieldset id="2.11">
        <legend>2.11 ท่านมีประสบการณ์การเลี้ยงโคเนื้อมานานแค่ไหน</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
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
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset id="2.14">
        <legend>2.14 ประวัติการตรวจโรคสัตว์ในฟาร์มของท่าน</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
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
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">โรควัณโรค</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">โรคปากและเท้าเปื่อย</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset id="1.5">
        <legend>1.5 สถานะทางครอบครัว</legend>
        <div class="form-group">
            <label for="เพศ" class="col-sm-2 control-label">เพศ</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.sex">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.sex"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="อายุ" class="col-sm-2 control-label">อายุ</label>
            <div class="col-sm-10">
                <input type="text" v-model="newFarmer.age" class="form-control" id="อายุ" placeholder="อายุ">
            </div>
        </div>
        <div class="form-group">
            <label for="สถานภาพ" class="col-sm-2 control-label">สถานภาพ</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="newFarmer.personal_status">
                    <option value="">กรุณาเลือก</option>
                    <option v-for="option in options.personal_status"
                            v-bind:value="option">@{{ option.choice }}</option>
                </select>
            </div>
        </div>
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

        <div class="form-group">
            <label for="สถานภาพทางสังคม" class="col-sm-2 control-label">สถานภาพทางสังคม</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control " v-model="newFarmer.social_status">
                            <option selected value="">กรุณาเลือก</option>
                            <option v-for="option in options.social_status"
                                    v-bind:value="option">@{{ option.choice }}</option>
                        </select>
                    </div>
                    <div class="col-sm-6" v-if="newFarmer.social_status.has_text==1">
                        <input type="text" v-model="newFarmer.social_status.pivot.remark"
                               class="form-control col-sm-6" placeholder="โปรดระบุ"/>
                    </div>
                </div>

            </div>
        </div>
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

        <div class="form-group">
            <div class="col-sm-3">
                <label>ท่านมีรายได้จากการประกอบอาชีพอะไรบ้าง (เลือกได้มากกว่า 1 ข้อ)</label>
            </div>
            <div class="col-sm-9">
                <label class="checkbox" v-for="option in options.jobtypes">
                    <input type="checkbox" v-model="newFarmer.jobtypes" v-bind:value="option">
                    @{{ option.choice }}:
                    <input v-if="option.has_text" type="text" class="form-control"
                           v-model="option['pivot']['remark']">
                </label>
            </div>
        </div>
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
