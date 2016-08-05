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
            @foreach($farmOwner->water_source_types as $j)
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
        <label class="header">3.3 ลักษณะการเลี้ยงโคเนื้อของท่าน</label>
        <ol style="margin-top: 0px;">
            @foreach($farmOwner->take_care_types as $j)
                <li>
                    {{$j->choice}}
                </li>
            @endforeach
        </ol>
    </div>
    <div class="line-report">
        <label class="header">3.4 พื้นที่ถือครองทางการเกษตร(ไร่/ครัวเรือน)</label>
        <br>{{$farmOwner->own_land->choice or '-'}}

    </div>


</div>
