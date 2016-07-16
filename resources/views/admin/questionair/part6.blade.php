<form class="form-horizontal">
    <fieldset id="6.1">
        <legend>6.1 ท่านจำหน่ายโคเนื้อให้กับใคร</legend>
        <question-multi-checkbox :model.sync="newFarmer.seller_types"
                                 :options.sync="options.seller_types">
        </question-multi-checkbox>
    </fieldset>
    <fieldset id="6.2">
        <legend>6.2 อายุของโคเนื้อที่ท่านจำหน่าย(ปี)</legend>
        <question-select :model.sync="newFarmer.age_sale" :options.sync="options.age_sale"></question-select>
    </fieldset>
    <fieldset id="6.3">
        <legend>6.3 น้ำหนักของโคเนื้อที่ท่านจำหน่าย(กิโลกรัม)</legend>
        <question-select :model.sync="newFarmer.weight_range_sale" :options.sync="options.weight_range_sale"></question-select>
    </fieldset>
    <fieldset id="6.4">
        <legend>6.4 ลักษณะการจำหน่าย</legend>
        <question-multi-checkbox :model.sync="newFarmer.cattle_sale_methods"
                                 :options.sync="options.cattle_sale_methods">
        </question-multi-checkbox>
    </fieldset>
    <fieldset id="6.5">
        <legend>6.5 ถ้าท่านรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อเมื่อใด</legend>
        <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-9">
                <label class="checkbox" v-for="option in options.group_joins">
                    <input type="checkbox" v-model="newFarmer.group_joins" v-bind:value="option">
                    @{{ option.choice }}:
                    <input placeholder="ชื่อกลุ่มวืสาหกิจชุมชน/ชื่อสหกรณ์โคเนื้อ"
                           type="text" class="form-control"
                           v-model="option['pivot']['remark']">
                    <input placeholder="เข้าร่วมเมื่อ"
                           type="text" class="form-control"
                           v-model="option['pivot']['joined']">
                </label>
            </div>
        </div>
    </fieldset>
    <fieldset id="6.6">
        <legend>6.6 ถ้ายังไม่เข้ารวมกลุ่มท่านมีความประสงค์ในการรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อหรือไม่</legend>
        <question-select :model.sync="newFarmer.group_join_future"
                         :options.sync="options.group_join_future">
        </question-select>
    </fieldset>
    <fieldset id="6.7">
        <legend>6.7 ท่านต้องการให้สหกรณ์ช่วยเหลือในด้านใด</legend>
        <question-multi-checkbox :model.sync="newFarmer.cooperative_help_types"
                                 :options.sync="options.cooperative_help_types">
        </question-multi-checkbox>
    </fieldset>
    <fieldset id="6.8">
        <legend>6.8 ท่านต้องการซื้ออาหารข้นในนามสหกรณ์หรือไม่</legend>
        <question-select :model.sync="newFarmer.feed_purchase_cooperative"
                         :options.sync="options.feed_purchase_cooperative">
        </question-select>
    </fieldset>
    <fieldset id="6.9">
        <legend>6.9 ท่านขายโคเนื้อได้ราคาเท่าไหร่ และใช้เวลาในการเลี้ยงนานเท่าใด</legend>
        <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-9">
                <label class="checkbox" v-for="option in options.cattle_sales">
                    <input type="checkbox" v-model="newFarmer.cattle_sales" v-bind:value="option">
                    @{{ option.choice }}:
                    <input placeholder="(บาท/ตัว)"
                           type="text" class="form-control"
                           v-model="option['pivot']['remark']">
                    <input placeholder="ระยะเวลาที่เลี้ยงตัว(ปี)"
                           type="text" class="form-control"
                           v-model="option['pivot']['duration']">
                </label>
            </div>
        </div>
    </fieldset>
    <fieldset id="6.10">
        <legend>6.10 ท่านพอใจกับราคาที่ขายได้หรือไม่</legend>
        <question-select :model.sync="newFarmer.sale_satisfaction"
                         :options.sync="options.sale_satisfaction">
        </question-select>
    </fieldset>
</form>