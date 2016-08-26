<div style="page-break-before: always">
    <h2>ส่วนที่ 3 ข้อมูลแรงงาน พื้นที่ในการเลี้ยง และการจัดการอาหาร</h2>
    <div class="line-report">
        <label class="header">3.1 จำนวนแรงงานที่ใช้เลี้ยงโค </label>
        {{$farmOwner->total_workers_amount or '-'}} คน
    </div>
    <div class="line-report">
        <label class="header" style="padding-left: 15px">3.1.1 จำนวนแรงงานภายในครอบครัว</label>
        {{$farmOwner->family_workers_amount or '-'}} คน
    </div>
    <div class="line-report">
        <label class="header" style="padding-left: 15px">3.1.2 จำนวนแรงงานภายนอก</label>
        {{$farmOwner->external_workers_amount or '-'}} คน
    </div>
    <div class="line-report">
        <label class="header">3.2 แหล่งน้ำที่ใช้ในการเลี้ยง</label>
        <ol style="margin-top: 0px;">
            @if(sizeof($farmOwner->water_source_types)>0)
                @foreach($farmOwner->water_source_types as $j)
                    <li>
                        {{$j->choice}}
                        @if($j->has_text)
                            <b>ระบุ : </b>{{$j->pivot->remark}}
                        @endif
                    </li>
                @endforeach
            @else
                {{'-'}}
            @endif
        </ol>
    </div>
    <div class="line-report">
        <label class="header">3.3 ลักษณะการเลี้ยงโคเนื้อของท่าน</label>
        <ol style="margin-top: 0px;">
            @if(sizeof($farmOwner->take_care_types)>0)
                @foreach($farmOwner->take_care_types as $j)
                    <li>
                        {{$j->choice}}
                    </li>
                @endforeach
            @else
                {{'-'}}
            @endif
        </ol>
    </div>
    <div class="line-report">
        <label class="header">3.4 พื้นที่ถือครองทางการเกษตร</label>
        <br>{{$farmOwner->own_land->choice or '-'}} รวมพื้นที่ถือครองทางการเกษตร {{$farmOwner->total_own_lands or '-'}}
        (ไร่/ครัวเรือน)
    </div>
    <div class="line-report">
        <label class="header"></label>
        <ol style="margin-top: 0px;">
            @foreach($farmOwner->sub_own_lands as $j)
                <li>
                    {{$j->choice}}
                    @if($j->has_text)
                        <b>ระบุ : </b>{{$j->pivot->remark}} ไร่
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
    <div class="line-report">
        <label class="header">3.5 การเช่าที่ดินเพื่อใช้ในการเลี้ยง</label>
        <br>{{$farmOwner->rent_land->choice or '-'}}
        @if($farmOwner->rent_land)
            @if($farmOwner->rent_land->has_text)
                จำนวน {{$farmOwner->rent_land->choice->pivot->area or '-'}} (ไร่/ครัวเรือน)
                <br>ค่าเช่าที่ดิน {{$farmOwner->rent_land->choice->pivot->area or '-'}} บาท/ไร่
            @endif

        @endif
    </div>

    <div class="line-report">
        <label class="header">3.6 พื้นที่ที่ใช้ในการเลี้ยงโคเนื้อ </label>
        <br>{{$farmOwner->use_land->choice or '-'}} {{$farmOwner->total_use_lands}} (ไร่/ครัวเรือน)
    </div>
    <div class="line-report">
        <label class="header"></label>
        <ol style="margin-top: 0px;">
            @foreach($farmOwner->sub_use_lands as $j)
                <li>
                    {{$j->choice or '-'}}
                    @if($j->has_text)
                        <b>ระบุ : </b>{{$j->pivot->area}} ไร่
                    @endif
                    @if($j->choice=="พื้นที่ปลูกหญ้า")
                        <b>ระบุ : </b>{{$j->pivot->remark}}
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
    <div class="line-report">
        <label class="header">3.7 อาหารที่ท่านใช้เลี้ยงโคเนื้อเป็นอาหารประเภทใด</label>
        <ol style="margin-top: 0px;">
            @if(sizeof($farmOwner->feed_types)>0)
                @foreach($farmOwner->feed_types as $j)
                    <li>
                        {{$j->choice or '-'}}
                    </li>
                @endforeach
            @else
                {{'-'}}
            @endif
        </ol>
    </div>
    <div class="line-report">
        <label class="header">3.8 แหล่งที่มาของอาหารข้นหรืออาหารผสมครบส่วน</label>
        <ol style="margin-top: 0px;">
            @if(sizeof($farmOwner->feed_sources)>0)
                @foreach($farmOwner->feed_sources as $j)
                    <li>
                        {{$j->choice or '-'}}
                        @if($j->has_text)
                            <b>ระบุ : </b>{{$j->pivot->remark}}
                        @endif
                    </li>
                @endforeach
            @else
                {{'-'}}
            @endif
        </ol>
    </div>

    <div class="line-report">
        <label class="header">3.9 ท่านเคยให้แร่ธาตุก้อนหรือไม่</label>

            @if($farmOwner->minerals_feed)
                {{$farmOwner->minerals_feed->choice or '-'}}
                {{$farmOwner->sub_minerals_feed->choice or '-'}}
            @else
                {{'-'}}
            @endif

    </div>

    <div class="line-report">
        <label class="header">3.10 ท่านมีการสำรองฟางข้าว หรือเปลือกข้าวโพดไว้ใช้เลี้ยงโคหรือไม่</label>
        @if($farmOwner->feedstock)
            <br>{{$farmOwner->feedstock->choice or '-'}}
            @if($farmOwner->feedstock->choice == "สำรอง")
                <ol style="margin-top: 0px;">
                    @foreach($farmOwner->feedstock_types as $j)
                        <li>
                            {{$j->choice or '-'}}

                            @if($j->choice == "ฟางข้าวหรือเปลือกข้าวโพดหมักหรือปรุงแต่ง")
                                @if($j->pivot->amount)
                                    ถังหมักจำนวน {{$j->pivot->amount}} ถัง
                                @else
                                    <br>เก็บไว้ในโรงเรือนขนาดกว้าง {{$j->pivot->width or '-'}} เมตร
                                    ยาว {{$j->pivot->height or '-'}} เมตร
                                @endif
                            @else
                                <br>เก็บไว้ในโรงเรือนขนาดกว้าง {{$j->pivot->width or '-'}} เมตร
                                ยาว {{$j->pivot->height or '-'}} เมตร
                            @endif
                        </li>
                    @endforeach
                </ol>

            @endif
        @else
            {{'-'}}
        @endif

    </div>


    <div class="line-report">
        <label class="header">3.11 ท่านใช้แหล่งอาหารหยาบในฤดูแล้งจาก</label>
        <ol style="margin-top: 0px;">
            @if(sizeof($farmOwner->feed_summer_sources))
                @foreach($farmOwner->feed_summer_sources as $j)
                    <li>
                        {{$j->choice or '-'}}
                    </li>
                @endforeach
            @else
                {{'-'}}
            @endif
        </ol>
    </div>


</div>
