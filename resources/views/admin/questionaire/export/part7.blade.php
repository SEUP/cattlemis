<div style="page-break-before: always">
    <h2>ส่วนที่ 7 การได้รับบริการ การส่งเสริมและสนับสนุนจากหน่วยงานต่างๆ</h2>
    <div class="line-report">
        <label class="header">หน่วยงานที่ให้บริการส่งเสริมการเลี้ยงโคเนื้อ(ตอบได้มากกว่า 1 ข้อ)</label>
        <ol style="margin-top: 0px;">
            @foreach($farmOwner->support_sources as $j)
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
        <label class="header">ท่านเคยได้รับการเยี่ยมเยือนฟาร์มจากหน่วยงานตามข้อบนหรือไม่</label>
        <br>
        {{$farmOwner->support_visit->choice or '-'}}
        @if($farmOwner->support_visit->has_text)
            <b>ระบุ : </b>{{$farmOwner->support_visit->pivot->remark or '-'}}
        @endif
    </div>
    <div class="line-report">
        <label class="header">ท่านเคยได้รับการสนับสนุนปัจจัยการผลิตหรือไม่</label>
        <br>
        {{$farmOwner->production_support->choice or '-'}}
        @if($farmOwner->production_support->has_text)
            <b>ระบุ : </b>{{$farmOwner->production_support->pivot->remark or '-'}}
        @endif
    </div>
    <div class="line-report">
        <label class="header">การใช้บริการด้านสุขภาพโคจากหน่วยงานของกรมปศุสัตว์</label>
        <br>
        {{$farmOwner->cattle_heath_support->choice or '-'}}
        @if($farmOwner->cattle_heath_support->has_text)
            <b>ระบุ : </b>{{$farmOwner->cattle_heath_support->pivot->remark or '-'}}
        @endif
    </div>
    <div class="line-report">
        <label class="header">ท่านเคยเข้ารับการฝึกอบรมเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่</label>
        <br>
        {{$farmOwner->training_support->choice or '-'}}
        @if($farmOwner->training_support->has_text)
            <b>ระบุ : </b>{{$farmOwner->training_support->pivot->remark or '-'}}
        @endif
    </div>
    <div class="line-report">
        <label class="header">ท่านเคยไปดูงานเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่</label>
        <br>
        {{$farmOwner->observe_support->choice or '-'}}
        @if($farmOwner->observe_support->has_text)
            <b>ระบุ : </b>{{$farmOwner->observe_support->pivot->remark or '-'}}
        @endif
    </div>
    <div class="line-report">
        <label class="header">ท่านเคยได้้รับการสนับสนุนให้แม่พันธุ์โคเนื้อมาเลี้ยงเพื่อผลิตลูกหรือไม่</label>
        <br>
        {{$farmOwner->female_breeder_support->choice or '-'}}
        @if($farmOwner->female_breeder_support->has_text)
            <b>ระบุ : </b>{{$farmOwner->female_breeder_support->pivot->remark or '-'}}
        @endif
    </div>
</div>
