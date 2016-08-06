<div style="page-break-before: auto">
    <h2>ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร</h2>
    <div class="line-report">
        <label class="header">1.1 ชื่อ - นามสกุล : </label>
        {{$farmOwner->first_name}} {{$farmOwner->last_name}}
    </div>
    <div class="line-report">
        <label class="header">รหัสประจำตัวประชาชน : </label>
        {{$farmOwner->person_id}}
    </div>

    <div class="line-report">
        <label class="header">1.2 ที่อยู่ตามสำเนาทะเบียนบ้าน: </label>
        <div style="text-indent: 5%;">
            <b>เลขที่ </b>{{$farmOwner->house_no or '-'}}
            <b>หมู่ </b>{{$farmOwner->house_moo or '-'}}
            <b>ตำบล </b>{{$farmOwner->district_house->DISTRICT_NAME or '-'}}
            <b>อำเภอ </b>{{$farmOwner->amphur_house->AMPHUR_NAME or '-'}}
            <b>จังหวัด </b>{{$farmOwner->province_house->PROVINCE_NAME or '-'}}
            <b>รหัสไปรษณีย์ </b>{{$farmOwner->house_postcode or '-'}}
            <b>โทรศัพท์บ้าน </b>{{$farmOwner->house_phone or '-'}}
            <b>โทรศัพท์มือถือ </b>{{$farmOwner->mobile_no or '-'}}
        </div>


    </div>

    <div class="line-report">
        <label class="header">1.3 ที่อยู่ฟาร์ม: </label><br/>
        <div style="text-indent: 5%;">
            <b>เลขที่ </b>{{$farmOwner->farm_no or '-'}}
            <b>หมู่ </b>{{$farmOwner->farm_moo or '-'}}
            <b>ตำบล </b>{{$farmOwner->district_farm->DISTRICT_NAME or '-'}}
            <b>อำเภอ </b>{{$farmOwner->amphur_farm->AMPHUR_NAME or '-'}}
            <b>จังหวัด </b>{{$farmOwner->province_farm->PROVINCE_NAME or '-'}}
        </div>
    </div>

    <div class="line-report">
        <label class="header">1.4 พิกัด: </label>{{$farmOwner->farm_lat or '-'}},{{$farmOwner->farm_long or '-'}}
    </div>

    <div class="line-report">
        <label class="header">1.5 เพศ: </label>{{$farmOwner->sex? $farmOwner->sex->choice : '-'}}
    </div>

    <div class="line-report">
        <label class="header"> อายุ: </label>{{$farmOwner->age}} ปี
    </div>

    <div class="line-report">
        <label class="header"> สถานภาพ : </label>{{$farmOwner->personal_status->choice or '-'}}
    </div>

    <div class="line-report">
        <label class="header"> สถานภาพในครอบครัว : </label>{{$farmOwner->family_status->choice or '-'}}
    </div>

    <div class="line-report">
        <label class="header">1.6 การศึกษา : </label>{{$farmOwner->education->choice or '-'}}
    </div>
    <div class="line-report">
        <label class="header">1.7 สถานภาพทางสังคม : </label>{{$farmOwner->social_status->choice or '-'}}
    </div>

    <div class="line-report">
        <label class="header">1.8 สถานะการเลี้ยงโคเนื้อ : </label>{{$farmOwner->cattle_job->choice or '-'}}
    </div>
    <div class="line-report">
        <label class="header">1.9 รายได้จากการประกอบอาชีพ : </label>
        <ol style="margin-top: 0px;">
            @foreach($farmOwner->jobtypes as $j)
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
        <label class="header">1.10 รายได้รวมเฉลี่ยของครัวเรือน : </label>{{$farmOwner->income_range->choice or '-'}}
    </div>
    <div class="line-report">
        <label class="header">1.11 รายได้เฉลี่ยต่อปีของการขายโคเนื้อ : </label>{{$farmOwner->avg_cattle_income  or '-'}} บาท
    </div>
</div>
