<div style="page-break-before: always">
    <h2>ส่วนที่ 2 ข้อมูลการเลี้ยงและสถานภาพฟาร์ม</h2>
            <div class="line-report">
                <label class="header">2.1 การเลี้ยงโคเนื้อของท่านมีวัตถุประสงค์เพื่ออะไร</label>
                <ol style="margin-top: 0px;">
                    @foreach($farmOwner->farm_purposes as $j)
                        <li>
                            {{$j->choice}}
                            @if($j->has_text)
                                <b>ระบุ : </b>{{$j->pivot->remark}}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
    <div class="line-report">
        <label class="header">2.2 ท่านมีการจดบันทึกข้อมูลหรือทำประวัติโคเนื้อหรือไม่</label>
        : {{$farmOwner->farm_record->choice or '-'}}
    </div>

    <div class="line-report">
        <label class="header">2.3 จำนวนโคเนื้อที่เกษตกรเลี้ยงทั้งหมด </label>
        : {{$farmOwner->total_master_breeding_types or '-'}} ตัว
    </div>

    <div class="line-report">
        <label class="header">2.10 ค่าใช้จ่ายโดยประมาณ </label>
        : {{$farmOwner-> total_expense_amount or '-'}} บาท/เดือน
    </div>
    <div class="line-report">
        <label class="header" style="padding-left: 15px">ค่ายา </label>
        : {{$farmOwner-> drug_price or '-'}} บาท/เดือน
    </div>
    <div class="line-report">
        <label class="header" style="padding-left: 15px">ค่าอาหารและแร่ธาตุ</label>
        : {{$farmOwner-> food_price or '-'}} บาท/เดือน
    </div>
    <div class="line-report">
        <label class="header" style="padding-left: 15px">อื่นๆ</label>
        : {{$farmOwner-> expense_price or '-'}} บาท/เดือน
    </div>
    <div class="line-report">
        <label class="header">2.11 ท่านมีประสบการณ์การเลี้ยงโคเนื้อมานานแค่ไหน </label>
        : {{$farmOwner-> farm_exp->choice or '-'}}
    </div>
    <div class="line-report">
        <label class="header">2.12 ท่านมีเป้าหมายในการเลี้ยงในอนาคตอย่างไร </label>
        : {{$farmOwner-> farm_future->choice or '-'}}
    </div>
    <div class="line-report">
        <label class="header">2.13 การขึ้นทะเบียนฟาร์มกับภาครัฐ </label>
        : {{$farmOwner->farm_register_status->choice or '-'}}
        @if($farmOwner->farm_register_status->choice=="ขึ้นทะเบียนแล้ว")
            <b> ระบุ : </b>{{$farmOwner->farm_register->choice or '-'}}
        @endif
    </div>
    <div class="line-report">
        <label class="header">2.14 ประวัติการตรวจโรคสัตว์ในฟาร์มของท่าน </label>
        : {{$farmOwner->farm_disease_check->choice or '-'}}
    </div>
    <div class="line-report">
        <label class="header">2.15 สถานภาพการระบาดของโรคในฟาร์มของท่านเป็นอย่างไร</label>
    </div>
    <div class="line-report">
        <label style="padding-left: 22px">
            โรคแท้งติดต่อ : {{$farmOwner->abortion->choice or '-'}}
        </label>
    </div>
    <div class="line-report">
        <label style="padding-left: 22px">
            โรควัณโรค : {{$farmOwner->tuberculosis->choice or '-'}}
        </label>
    </div>
    <div class="line-report">
        <label style="padding-left: 22px">
            โรคปากและเท้าเปื่อย : {{$farmOwner->foot_mouth_disease->choice or '-'}}
        </label>
    </div>

</div>
