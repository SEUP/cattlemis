<div style="page-break-before: always">
    <h2>ส่วนที่ 5 ข้อมูลแหล่งเงินทุนที่ใช้ในการเลี้ยงโคเนื้อ</h2>
    <div class="line-report">
        <label class="header">5.1 เงินทุนที่ท่านใช้เลี้ยงโคเนื้อ</label>
        <br>{{$farmOwner->budget_source->choice or '-'}}
        @if($farmOwner->budget_source->has_text)
            <b>จำนวนเงิน : </b>{{$farmOwner->budget_source->pivot->amount}} <b>บาท</b>
        @endif
    </div>
    <div class="line-report">
        <label class="header">5.2 แหล่งเงินทุนกู้ยืม</label>
        <ol style="margin-top: 0px;">
            @foreach($farmOwner->loan_types as $j)
                <li>
                    {{$j->choice or '-'}}
                    @if($j->choice=="เงินกู้จากธนาคารพาณิชย์")
                        <b>ชื่อธนาคาร : </b>{{$j->pivot->remark or '-'}}
                    @endif
                    @if($j->pivot->amount)
                        <b>จำนวนเงิน : </b>{{$j->pivot->amount or '-'}} <b>บาท</b>
                    @endif
                    @if($j->pivot->rate)
                        <b>อัตราดอกเบี้ย : </b>{{$j->pivot->rate or '-'}} <b>%</b>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
    <div class="line-report">
        <label class="header">เงินทุนในการเลี้ยงโคเนื้อรวมทั้งหมด (รวมจาก 5.1 และ 5.2)</label>
        {{$farmOwner->total_budget or '-'}} บาท
    </div>
</div>
