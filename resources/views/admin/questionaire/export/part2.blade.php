<div style="page-break-before: always">
    <h2>ส่วนที่ 2 ข้อมูลการเลี้ยงและสถานภาพฟาร์ม</h2>
    <div class="line-report">
        <label class="header">2.1 การเลี้ยงโคเนื้อของท่านมีวัตถุประสงค์เพื่ออะไร</label>
        <ol style="margin-top: 0px;">
            @if(sizeof($farmOwner->farm_purposes)>0)
                @foreach($farmOwner->farm_purposes as $j)
                    <li>
                        {{$j->choice or '-'}}
                        @if($j->has_text)
                            <b>ระบุ : </b>{{$j->pivot->remark or '-'}}
                        @endif
                    </li>
                @endforeach
            @else
                {{'-'}}
            @endif
        </ol>
    </div>
    <div class="line-report">
        <label class="header">2.2 ท่านมีการจดบันทึกข้อมูลหรือทำประวัติโคเนื้อหรือไม่</label>
        : {{$farmOwner->farm_record->choice or '-'}}
    </div>

    <div class="line-report">
        <label class="header">2.3 จำนวนโคเนื้อที่เกษตกรเลี้ยงทั้งหมด </label>
        จำนวนรวมทั้งหมด {{$farmOwner->total_master_breeding_types or '-'}} ตัว
    </div>

    @if($farmOwner->total_male_breeding_types > 0)
        <div class="line-report">
            <label class="header">2.4 พ่อพันธุ์โคเนื้อที่เลี้ยง</label> จำนวน {{$farmOwner->total_male_breeding_types}}
            ตัว
            @foreach($farmOwner->male_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    @if($j->has_text)
                        {{$j->choice}} | ระบุ:  {{$j->pivot->remark}} | จำนวน {{$j->pivot->amount}} ตัว |
                        ราคา {{$j->pivot->price or '-'}} บาท | แหล่งที่มา {{$j->pivot->source or '-'}}
                    @endif
                </div>
            @endforeach
            @foreach($farmOwner->male_int_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
            @foreach($farmOwner->male_mixed_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach

        </div>
    @endif

    @if($farmOwner->total_female_breeding_types > 0)
        <div class="line-report">
            <label class="header">2.5 แม่พันธุ์โคเนื้อที่เลี้ยง</label>
            จำนวน {{$farmOwner->total_female_breeding_types}} ตัว
            @foreach($farmOwner->female_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    @if($j->has_text)
                        {{$j->choice}} | ระบุ:  {{$j->pivot->remark}} | จำนวน {{$j->pivot->amount}} ตัว |
                        ราคา {{$j->pivot->price or '-'}} บาท | แหล่งที่มา {{$j->pivot->source or '-'}}
                    @endif
                </div>
            @endforeach
            @foreach($farmOwner->female_int_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
            @foreach($farmOwner->female_mixed_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach

        </div>
    @endif

    @if($farmOwner->total_male_over_six_breeding_types > 0)
        <div class="line-report">
            <label class="header">2.6 โคเพศผู้อายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง</label>
            จำนวน {{$farmOwner->total_male_over_six_breeding_types}} ตัว
            @foreach($farmOwner->male_over_six_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    @if($j->has_text)
                        {{$j->choice}} | ระบุ:  {{$j->pivot->remark}} | จำนวน {{$j->pivot->amount}} ตัว |
                        ราคา {{$j->pivot->price or '-'}} บาท | แหล่งที่มา {{$j->pivot->source or '-'}}
                    @endif
                </div>
            @endforeach
            @foreach($farmOwner->male_over_six_int_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
            @foreach($farmOwner->male_over_six_mixed_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
        </div>
    @endif

    @if($farmOwner->total_female_over_six_breeding_types > 0)
        <div class="line-report">
            <label class="header">2.7 โคเพศเมียอายุมากกว่า 6 เดือนขึ้นไปแต่ไม่ใช่พ่อพันธุ์คุมฝูง</label>
            จำนวน {{$farmOwner->total_female_over_six_breeding_types}} ตัว
            @foreach($farmOwner->female_over_six_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    @if($j->has_text)
                        {{$j->choice}} | ระบุ:  {{$j->pivot->remark}} | จำนวน {{$j->pivot->amount}} ตัว |
                        ราคา {{$j->pivot->price or '-'}} บาท | แหล่งที่มา {{$j->pivot->source or '-'}}
                    @endif
                </div>
            @endforeach
            @foreach($farmOwner->female_over_six_int_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
            @foreach($farmOwner->female_over_six_mixed_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
        </div>
    @endif

    @if($farmOwner->total_male_under_six_breeding_types > 0)
        <div class="line-report">
            <label class="header">2.8 ลูกโคเพศผู้อายุน้อยกว่า 6 เดือน</label>
            จำนวน {{$farmOwner->total_male_under_six_breeding_types}} ตัว
            @foreach($farmOwner->male_under_six_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    @if($j->has_text)
                        {{$j->choice}} | ระบุ:  {{$j->pivot->remark}} | จำนวน {{$j->pivot->amount}} ตัว |
                        ราคา {{$j->pivot->price or '-'}} บาท | แหล่งที่มา {{$j->pivot->source or '-'}}
                    @endif
                </div>
            @endforeach
            @foreach($farmOwner->male_under_six_int_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
            @foreach($farmOwner->male_under_six_mixed_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
        </div>
    @endif

    @if($farmOwner->total_female_under_six_breeding_types > 0)
        <div class="line-report">
            <label class="header">2.9 ลูกโคเพศเมียอายุน้อยกว่า 6 เดือน</label>
            จำนวน {{$farmOwner->total_female_under_six_breeding_types}} ตัว
            @foreach($farmOwner->female_under_six_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    @if($j->has_text)
                        {{$j->choice}} | ระบุ:  {{$j->pivot->remark}} | จำนวน {{$j->pivot->amount}} ตัว |
                        ราคา {{$j->pivot->price or '-'}} บาท | แหล่งที่มา {{$j->pivot->source or '-'}}
                    @endif
                </div>
            @endforeach
            @foreach($farmOwner->female_under_six_int_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
            @foreach($farmOwner->female_under_six_mixed_breeding_types as $j)
                <div class="line-report" style="padding-left: 20px">
                    {{$j->choice}} | จำนวน {{$j->pivot->amount}} ตัว | ราคา {{$j->pivot->price or '-'}} บาท |
                    แหล่งที่มา {{$j->pivot->source or '-'}}
                </div>
            @endforeach
        </div>
    @endif

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
        @if($farmOwner->farm_register_status)
            : {{$farmOwner->farm_register_status->choice or '-'}}
            @if($farmOwner->farm_register_status->choice=="ขึ้นทะเบียนแล้ว")
                <b> ระบุ : </b>{{$farmOwner->farm_register->choice or '-'}}
            @endif
        @else
            {{'-'}}
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
    <div class="line-report">
        <label style="padding-left: 22px">
            อื่นๆ :

            @if(sizeof($farmOwner->disease_other)>0)
                @foreach($farmOwner->disease_other as $j)
                    {{$j->pivot->remark or '-'}}
                @endforeach
            @else
                {{'-'}}
            @endif
        </label>
    </div>

</div>
