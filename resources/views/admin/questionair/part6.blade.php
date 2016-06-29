<form class="form-horizontal">
    <fieldset id="6.1">
        <legend>6.1 ท่านจำหน่ายโคเนื้อให้กับใคร</legend>
        <question-multi-checkbox :model.sync="newFarmer.seller_types"
                                 :options.sync="options.seller_types">

        </question-multi-checkbox>

    </fieldset>
    <fieldset id="6.2">
        <legend>6.2 อายุของโคเนื้อที่ท่านจำหน่าย(ปี)</legend>
        <question-text-field label="อายุของโคเนื้อที่ท่านจำหน่าย(ปี)" :model.sync="newFarmer.cattle_sold_age"></question-text-field>
    </fieldset>
    <fieldset id="6.3">
        <legend>6.3 น้ำหนักของโคเนื้อที่ท่านจำหน่าย(กิโลกรัม)</legend>
        <question-text-field label="น้ำหนักของโคเนื้อที่ท่านจำหน่าย(กิโลกรัม)" :model.sync="newFarmer.cattle_sold_weight"></question-text-field>
    </fieldset>



</form>
