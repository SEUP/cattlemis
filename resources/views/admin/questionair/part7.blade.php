<form class="form-horizontal">
    <fieldset id="7.1">
        <legend>7.1 หน่วยงานที่ให้บริการส่งเสริมการเลี้ยงโคเนื้อ(ตอบได้มากกว่า 1 ข้อ)</legend>
        <!-- sample select with text-->

        <question-multi-checkbox
                                 :model.sync="newFarmer.support_sources"
                                 :options.sync="options.support_sources">

        </question-multi-checkbox>
    </fieldset>

        <fieldset id="7.2">
            <legend>7.2 ท่านเคยได้รับการเยี่ยมเยือนฟาร์มจากหน่วยงานในข้อ 7.1 หรือไม่</legend>
            <question-select-with-text
                                       :model.sync="newFarmer.support_visit"
                                       :options.sync="options.support_visit">

            </question-select-with-text>
        </fieldset>

        <fieldset id="7.3">
            <legend>7.3  ท่านเคยได้รับการสนับสนุนปัจจัยการผลิตหรือไม่</legend>
                <question-select-with-text
                                           :model.sync="newFarmer.production_support"
                                           :options.sync="options.production_support">
                </question-select-with-text>
        </fieldset>

        <fieldset id="7.4">
            <legend>7.4 การใช้บริการด้านสุขภาพโคจากหน่วยงานของกรมปศุสัตว์</legend>
                <question-select-with-text
                                           :model.sync="newFarmer.cattle_heath_support"
                                           :options.sync="options.cattle_heath_support">
                </question-select-with-text>
        </fieldset>

        <fieldset id="7.5">
            <legend>7.5 ท่านเคยเข้ารับการฝึกอบรมเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่</legend>
            <question-select-with-text
                                       :model.sync="newFarmer.training_support"
                                       :options.sync="options.training_support">
            </question-select-with-text>
        </fieldset>

        <fieldset id="7.6">
            <legend>7.6 ท่านเคยไปดูงานเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่</legend>
            <question-select-with-text
                                       :model.sync="newFarmer.observe_support"
                                       :options.sync="options.observe_support">
            </question-select-with-text>
        </fieldset>

        <fieldset id="7.7">
            <legend>7.7 ท่านเคยได้รับการสนับสนุนให้แม่พันธุ์โคเนื้อมาเลี้ยงเพื่อผลิตลูกหรือไม่</legend>
            <question-select-with-text
                                       :model.sync="newFarmer.female_breeder_support"
                                       :options.sync="options.female_breeder_support">
            </question-select-with-text>
        </fieldset>
</form>
