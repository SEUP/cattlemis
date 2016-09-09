<form class="form-horizontal">
    <fieldset id="8.1">
        <legend>8.1 ปัญหาและอุปสรรคในการเลี้ยงโคเนื้อของท่านคือ</legend>

        <question-textarea-field
                                 placeholder="ปัญหาและอุปสรรคในการเลี้ยงโคเนื้อของท่าน"
                                 :model.sync="newFarmer.problem">

        </question-textarea-field>
    </fieldset>

    <fieldset id="8.2">
        <legend>8.2 ท่านมีข้อเสนอแนะในการพัฒนาระบบการผลิตและการตลาดโคเนื้อในเขตพื้นที่ เชียงราย พะเยา แพร่ น่าน
            อย่างไร
        </legend>
        <question-textarea-field 
        placeholder="ข้อเสนอแนะในการพัฒนาระบบการผลิตและการตลาดโคเนื้อในเขตพื้นที่ เชียงราย พะเยา แพร่ น่าน"
        :model.sync="newFarmer.suggestion">

        </question-textarea-field>

    </fieldset>


</form>
