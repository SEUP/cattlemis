<?php

namespace App\Http\Controllers;

use App\Jobs\ExportFarmOwners;
use App\Models\FarmInfo;
use App\Models\FarmOwner;
use App\Models\FarmOwner2;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

use App\Http\Requests\FarmOwnerRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\CountValidator\Exception;

class FarmOwnerController extends Controller
{

    use DispatchesJobs;

    var $fieldArray = [
        [
            //part1
            'sex', 'family_status', 'education', 'social_status', 'personal_status', 'cattle_job', 'income_range',

            //part2
            'farm_record', 'farm_exp', 'farm_future',
            'farm_register_status', 'farm_register', 'farm_disease_check', 'abortion',
            'tuberculosis', 'foot_mouth_disease',

            //part3
            'own_land', 'rent_land', 'use_land', 'minerals_feed', 'feedstock', 'sub_minerals_feed',

            //part4
            'farm_breeding_type', 'cattle_death', 'dewormed_amount', 'vaccine_ever', 'biogas_status',
            'vaccined_by',


            //part5
            'budget_source',

            //part6
            'age_sale', 'weight_range_sale',
            'group_join_future', 'feed_purchase_cooperative',
            'sale_satisfaction',

            //part7
            'support_visit', 'production_support', 'cattle_heath_support',
            'training_support', 'observe_support', 'female_breeder_support',

        ]
        /*,
        [
            //part2
            'farm_record', 'farm_exp', 'farm_future',
            'farm_register_status', 'farm_register', 'farm_disease_check', 'abortion',
            'tuberculosis', 'foot_mouth_disease'

        ],*/

    ];

    var $multiFieldArray = [
        [
            //part1
            'jobtypes',

            //part2
            'farm_purposes', 'male_breeding_types', 'male_int_breeding_types',
            'male_mixed_breeding_types', 'female_breeding_types',
            'female_int_breeding_types', 'female_mixed_breeding_types', 'male_over_six_breeding_types',
            'male_over_six_int_breeding_types', 'male_over_six_mixed_breeding_types',
            'female_over_six_breeding_types', 'female_over_six_int_breeding_types',
            'female_over_six_mixed_breeding_types', 'male_under_six_breeding_types',
            'male_under_six_int_breeding_types', 'male_under_six_mixed_breeding_types',
            'female_under_six_breeding_types', 'female_under_six_int_breeding_types',
            'female_under_six_mixed_breeding_types',
            'disease_other',


            //part3
            'water_source_types', 'take_care_types', 'sub_own_lands', 'sub_use_lands',
            'feed_types', 'feed_sources', 'feedstock_types',
            'feed_summer_sources',

            //part4
            'inseminate_sources', 'breeders', 'cattle_death_causes', 'disease_cured_by',
            'cattle_dung_uses',
            'vaccine_types',

            //part5
            'loan_types',

            //part6
            'seller_types', 'cattle_sale_methods', 'group_joins', 'cooperative_help_types', 'cattle_sales',

            //part7
            'support_sources'
        ],
        /* [
             //part2
             'farm_purposes', 'male_breeding_types', 'male_int_breeding_types',
             'male_mixed_breeding_types', 'female_breeding_types',
             'female_int_breeding_types', 'female_mixed_breeding_types', 'male_over_six_breeding_types',
             'male_over_six_int_breeding_types', 'male_over_six_mixed_breeding_types',
             'female_over_six_breeding_types', 'female_over_six_int_breeding_types',
             'female_over_six_mixed_breeding_types', 'male_under_six_breeding_types',
             'male_under_six_int_breeding_types', 'male_under_six_mixed_breeding_types',
             'female_under_six_breeding_types', 'female_under_six_int_breeding_types',
             'female_under_six_mixed_breeding_types'
         ],
        */
    ];

    private function generateChoice(Request $request, $form, $choices, $field)
    {

        if ($request->has("$field.id")) {
            if (isset($form[$field]['pivot'])) {

                $pivot = $form[$field]['pivot'];

                $choices[$form[$field]['id']] = $pivot;
            } else {
                $choices[$form[$field]['id']] = [];
            }
        }
        return $choices;
    }

    private function generateManyChoices(Request $request, $form, $choices, $field)
    {

        if ($request->has("$field")) {

            $fields = $request->get("$field");

            foreach ($fields as $item) {

                if (isset($item['pivot'])) {
                    $pivot = $item['pivot'];
                    $choices[$item['id']] = $pivot;
                } else {
                    $choices[$item['id']] = [];
                }
            }
        }
        return $choices;
    }

    private function getChoices(Request $request, $fieldArray, $multiFieldArray)
    {
        $form = $request->all();
        $choices = [];

        foreach ($fieldArray as $field) {
            $choices = $this->generateChoice($request, $form, $choices, $field);
        }

        foreach ($multiFieldArray as $field) {
            $choices = $this->generateManyChoices($request, $form, $choices, "$field");
        }

        return $choices;
    }

    private function filterChoices(Request $request, $choices, $fieldArray, $multiFieldArray)
    {
        $form = $request->all();
        $fchoices = [];
        foreach ($fieldArray as $field) {
            try {

                if ($request->has("$field.parent_id")) {
                    $fieldId = $request->get("$field.id");
                    $parent_id = $request->get("$field.parent_id");
                    if (array_has($choices, $parent_id)) {
                        $fchoices[$fieldId] = $choices[$fieldId];
                    }
                } else {
                    if ($request->has("$field.id")) {
                        $fchoices[$form[$field]['id']] = $choices[$form[$field]['id']];
                    }
                }

            } catch (\Exception $e) {
                return $field;
            }
        }


        foreach ($multiFieldArray as $field) {
            if ($request->has("$field")) {
                $fields = $request->get("$field");
                foreach ($fields as $item) {
                    if (isset($item['parent_id'])) {
                        if (array_has($choices, $item['parent_id'])) {
                            $fchoices[$item['id']] = $choices[$item['id']];
                        }
                    } else {
                        $fchoices[$item['id']] = $choices[$item['id']];
                    }
                }
            }
        }

        return $fchoices;
    }

    public function suggestion(Request $request)
    {
        $query = DB::table('farm_owners');

        $query->leftJoin('thailand_provinces', 'farm_owners.house_province', '=', 'thailand_provinces.province_id');
        $query->leftJoin('thailand_amphures', 'farm_owners.house_amphur', '=', 'thailand_amphures.amphur_id');
        $query->leftJoin('thailand_districts', 'farm_owners.house_district', '=', 'thailand_districts.district_id');

        $query->select([
            'farm_owners.id', 'farm_owners.first_name', 'farm_owners.last_name'
            , 'farm_owners.problem'
            , 'farm_owners.suggestion'
            , 'thailand_provinces.province_name'
            , 'thailand_amphures.amphur_name'
            , 'thailand_districts.district_name'
            , 'farm_owners.house_province'
            , 'farm_owners.house_amphur'
            , 'farm_owners.house_district'

        ]);


        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query->where('farm_owners.problem', 'like', "%$keyword%");
            $query->orWhere('farm_owners.suggestion', 'like', "%$keyword%");
        }

        $query->orWhereNotNull('farm_owners.problem');
        $query->orWhereNotNull('farm_owners.suggestion');

        if ($request->has('breeding') && $request->get('breeding') != 0) {
            $breeding = $request->get('breeding');
            $query->join('choice_farm_owner', function ($join) use ($breeding) {
                $join
                    ->on('choice_farm_owner.farm_owner_id', '=', 'farm_owners.id')
                    ->where('choice_farm_owner.choice_id', '=', $breeding);
            });
            $query->join('choices', function ($join) use ($breeding) {
                $join
                    ->on('choice_farm_owner.choice_id', '=', 'choices.id');
            });


            $query->addSelect('choice_farm_owner.amount');
            $query->addSelect('choices.choice');


            $query->orderBy('amount', 'desc');

        }

        if ($request->has('province') && $request->get('province') != 0) {
            $query->where('farm_owners.house_province', '=', $request->get('province'));
        }

        if ($request->has('amphur') && $request->get('amphur') != 0) {
            $query->where('farm_owners.house_amphur', '=', $request->get('amphur'));
        }

        if ($request->has('district') && $request->get('district') != 0) {
            $query->where('farm_owners.house_district', '=', $request->get('district'));
        }

        $query->orderBy('updated_at', 'desc');
        $farmOwners = $query->paginate(12);

        return $farmOwners;
    }

    public static function getAllQuery(Request $request)
    {
        $query = DB::table('farm_owners');

        $query->leftJoin('thailand_provinces', 'farm_owners.house_province', '=', 'thailand_provinces.province_id');
        $query->leftJoin('thailand_amphures', 'farm_owners.house_amphur', '=', 'thailand_amphures.amphur_id');
        $query->leftJoin('thailand_districts', 'farm_owners.house_district', '=', 'thailand_districts.district_id');

        $query->select([
            'farm_owners.id', 'farm_owners.first_name', 'farm_owners.last_name'
            , 'farm_owners.updated_at'
            , 'thailand_provinces.province_name'
            , 'thailand_amphures.amphur_name'
            , 'thailand_districts.district_name'
            , 'farm_owners.house_province'
            , 'farm_owners.house_amphur'
            , 'farm_owners.house_district'
            , 'farm_owners.mobile_no'
            , 'farm_owners.house_phone'

        ]);

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query->where('farm_owners.person_id', 'like', "%$keyword%");
            $query->orWhere('farm_owners.first_name', 'like', "%$keyword%");
            $query->orWhere('farm_owners.last_name', 'like', "%$keyword%");
        }

        if ($request->has('breeding') && $request->get('breeding') != 0) {
            $breeding = $request->get('breeding');
            $query->join('choice_farm_owner', function ($join) use ($breeding) {
                $join
                    ->on('choice_farm_owner.farm_owner_id', '=', 'farm_owners.id')
                    ->where('choice_farm_owner.choice_id', '=', $breeding);
            });
            $query->join('choices', function ($join) use ($breeding) {
                $join
                    ->on('choice_farm_owner.choice_id', '=', 'choices.id');
            });


            $query->addSelect('choice_farm_owner.amount');
            $query->addSelect('choices.choice');


            $query->orderBy('amount', 'desc');

        }

        if ($request->has('province') && $request->get('province') != 0) {
            $query->where('farm_owners.house_province', '=', $request->get('province'));
        }

        if ($request->has('amphur') && $request->get('amphur') != 0) {
            $query->where('farm_owners.house_amphur', '=', $request->get('amphur'));
        }

        if ($request->has('district') && $request->get('district') != 0) {
            $query->where('farm_owners.house_district', '=', $request->get('district'));
        }

        $query->orderBy('updated_at', 'desc');

        return $query;
    }

    public function index(Request $request)
    {
        $query = $this->getAllQuery($request);
        $farmOwners = $query->paginate(12);

        return $farmOwners;
    }

    public function create()
    {
        $owner = new FarmOwner();
        $owner->house_province = 0;
        $owner->house_district = 0;
        $owner->house_amphur = 0;
        $owner->farm_province = 0;
        $owner->farm_district = 0;
        $owner->farm_amphur = 0;
        return $owner;
    }

    public function store(FarmOwnerRequest $request)
    {
        $form = $request->all();

        $farmOwner = new FarmOwner();

        $farmOwner->fill($form);

        if (strcmp($farmOwner->avg_cattle_income, "") == 0) {
            $farmOwner->avg_cattle_income = null;
        }

        $farmOwner->total_master_breeding_types = $farmOwner->total_male_breeding_types +
            $farmOwner->total_female_breeding_types + $farmOwner->total_male_over_six_breeding_types
            + $farmOwner->total_female_over_six_breeding_types
            + $farmOwner->total_male_under_six_breeding_types
            + $farmOwner->total_female_under_six_breeding_types;
        // return $farmOwner;
        //$farmOwner->save();


        $farmOwner->total_expense_amount = $farmOwner->drug_price +
            $farmOwner->food_price + $farmOwner->expense_price;

        $farmOwner->save();

        $choices = $this->getChoices($request, $this->fieldArray[0], $this->multiFieldArray[0]);
        $farmOwner->choices()->sync($choices);
        // $farmOwner->choices2()->sync($this->getChoices($request, $this->fieldArray[1], $this->multiFieldArray[1]));

        // $farm_info = new FarmInfo();
        // $farm_info->fill($request->get('farm_info'));
        //$farmOwner->farm_info()->save($farm_info);


        return $farmOwner;
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $farmOwner = FarmOwner2::with([])->find($id);
        $output = collect($farmOwner->toArray());
        $choices = collect($farmOwner->choices->toArray());
        $grouped = $choices->groupBy('type');

        $m = collect($this->multiFieldArray[0]);

        foreach ($grouped as $key => $value) {
            if ($m->contains($key)) {
                $output[$key] = $value;
            } else {
                $output[$key] = $value[0];
            }
        }
        return $output;

    }

    private function cannotEdit($owner)
    {

        $user = \Auth::user();
        if ($user->isAdmin()) return false;
        if ($user->hasRole('user_province') && $user->user_province == $owner->house_province) return false;
        if ($user->hasRole('user_amphur') && $user->user_amphur == $owner->house_amphur) return false;
        if ($user->hasRole('user_district') && $user->user_district == $owner->house_district) return false;


        return true;
    }

    public function update(FarmOwnerRequest $request, $id)
    {
        $form = $request->all();
        $farmOwner = FarmOwner::find($id);

        if ($this->cannotEdit($farmOwner)) {
            $returnData = array(
                'message' => "You don't have permission to update this FarmOwner!!!"
            );

            return response()->json($returnData, 500);
        }

        $farmOwner->fill($form);

        if (strcmp($farmOwner->avg_cattle_income, "") == 0) {
            $farmOwner->avg_cattle_income = null;
        }

        $farmOwner->total_master_breeding_types = 0
            + intval($farmOwner->total_male_breeding_types)
            + intval($farmOwner->total_female_breeding_types)
            + intval($farmOwner->total_male_over_six_breeding_types)
            + intval($farmOwner->total_female_over_six_breeding_types)
            + intval($farmOwner->total_male_under_six_breeding_types)
            + intval($farmOwner->total_female_under_six_breeding_types);

        // $farmOwner->save();

        $farmOwner->total_expense_amount = 0
            + intval($farmOwner->drug_price)
            + intval($farmOwner->food_price)
            + intval($farmOwner->expense_price);

        $farmOwner->save();

        $choices = $this->getChoices($request, $this->fieldArray[0], $this->multiFieldArray[0]);
//        $choices = $this->filterChoices($request, $choices, $this->fieldArray[0], $this->multiFieldArray[0]);

        $farmOwner->choices()->sync($choices);

        return $farmOwner;
    }

    public function destroy($id)
    {
        /* @var FarmOwner $farmOwner */
        $farmOwner = FarmOwner::find($id);

        if ($this->cannotEdit($farmOwner)) {
            $returnData = array(
                'message' => "You don't have permission to delete this FarmOwner!!!"
            );

            return response()->json($returnData, 500);
        }

        $farmOwner->choices()->detach();
        // $farmOwner->choices2()->detach();

        $farmOwner->delete();
        return [true];
    }

    private function raw($type, $caption = null, $remark = null)
    {
        if ($caption == null) {
            $caption = $type;
        }
        if ($remark == null) {
            $remark = "c.choice";
        }
        return "max(case when c.type = '$type' THEN $remark END) $caption";
    }

    private function groupRaw($type, $caption = null)
    {
        if ($caption == null) {
            $caption = $type;
        }
        return "GROUP_CONCAT(case when c.type = '$type' then c.choice end SEPARATOR '|') as $caption";
    }

    private function groupRemark($choice, $type, $caption, $remark = "cf.remark")
    {

        $selectStr = "max(case when c.choice = '$choice' and c.type = '$type' THEN $remark END) as $caption";
        return $selectStr;
    }

    private function groupCattle($choice, $type, $caption)
    {
        $selectStr = "max(case when c.choice = '$choice' and c.type = '$type' THEN case when cf.remark is not null then cf.remark else c.choice end END) as $caption";
        $selectStr = $selectStr . "," . "max(case when c.choice = '$choice' and c.type = '$type' THEN cf.amount END) as " . $caption . "_จำนวน";
        $selectStr = $selectStr . "," . "max(case when c.choice = '$choice' and c.type = '$type' THEN cf.price END) as " . $caption . "_ราคา";
        $selectStr = $selectStr . "," . "max(case when c.choice = '$choice' and c.type = '$type' THEN cf.source_opt END) as " . $caption . "_แหล่งที่มา";
        return $selectStr;
    }

    private function normal($choice, $caption)
    {
        return "farm_owners.$choice as $caption";

    }

    public function exportAll()
    {

        $query = DB::table('farm_owners');

        $query->leftJoin('thailand_provinces as hp', 'farm_owners.farm_province', '=', 'hp.province_id');
        $query->leftJoin('thailand_amphures as ha', 'farm_owners.farm_amphur', '=', 'ha.amphur_id');
        $query->leftJoin('thailand_districts as hd', 'farm_owners.farm_district', '=', 'hd.district_id');


        $query->leftJoin('thailand_provinces as up', 'farm_owners.house_province', '=', 'up.province_id');
        $query->leftJoin('thailand_amphures as ua', 'farm_owners.house_amphur', '=', 'ua.amphur_id');
        $query->leftJoin('thailand_districts as ud', 'farm_owners.house_district', '=', 'ud.district_id');


        $query->select([
            //part1
            "farm_owners.id",
            "farm_owners.first_name as ชื่อ",
            "farm_owners.last_name as นามสกุล",
            "farm_owners.person_id as รหัสประจำตัวประชาชน",

            "farm_owners.house_no as บ้าน_เลขที่ ",
            "farm_owners.house_moo as บ้าน_หมู่",

            "up.province_name as บ้าน_จังหวัด ",
            "ua.amphur_name as บ้าน_อำเภอ",
            "ud.district_name as บ้าน_ตำบล",
            "farm_owners.house_postcode as บ้าน_รหัสไปรษณีย์",
            "farm_owners.house_phone as บ้าน_โทรศัพท์",
            "farm_owners.mobile_no as โทรศัพท์มือถือ",
            "farm_owners.email as email",

            "farm_owners.farm_no as ฟาร์ม_เลขที่",
            "farm_owners.farm_moo as ฟาร์ม_หมู่",
            "hp.province_name as ฟาร์ม_จังหวัด",
            "ha.amphur_name as ฟาร์ม_อำเภอ",
            "hd.district_name as ฟาร์ม_ตำบล",

            "farm_owners.farm_lat as ฟาร์ม_ลติจูด",
            "farm_owners.farm_long as ฟาร์ฒ_ลองจิจูด",

            DB::raw($this->raw("sex", "เพศ")),
            "farm_owners.age as อายุ",
            DB::raw($this->raw('personal_status', 'สถานภาพ')),
            DB::raw($this->raw('family_status', 'สถานภาพในครอบครัว')),

            DB::raw($this->raw('education', 'การศึกษา')),
            DB::raw($this->raw('social_status', 'สถานภาพทางสังคม')),
            DB::raw($this->raw('cattle_job', 'การเลี้ยงโคเนื้อเป็น')),

            DB::raw($this->groupRaw("jobtypes", 'รายได้จากการประกอบอาชีพ')),

            DB::raw($this->raw('income_range', 'รายได้รวมของครัวเรือนเฉลี่ย')),

            "farm_owners.avg_cattle_income as รายได้เฉลี่ยต่อปีของการขายโคเนื้อ",

            //part2
            DB::raw($this->groupRaw("farm_purposes", 'วัตถุประสงค์การเลี้ยงโคเนื้อ')),

            DB::raw($this->raw('farm_record', 'การจดบันทึกหรือทำประวัติโคเนื้อ')),

            "farm_owners.total_master_breeding_types as จำนวนโคเนื้อทั้งหมด",
            "farm_owners.total_male_breeding_types as จำนวนพ่อพันธุ์โคเนื้อที่เลี้ยง",
            //พ่อพันธุ์
            "farm_owners.total_male_breeding_types as พ่อพันธุ์_จำนวน",

            DB::raw($this->groupCattle('พันธุ์พื้นเมือง', 'male_breeding_types', 'พ่อพันธุ์_พันธุ์พื้นเมือง')),
            DB::raw($this->groupCattle('บราห์มัน', 'male_int_breeding_types', 'พ่อพันธุ์_บราห์มัน')),
            DB::raw($this->groupCattle('ชาร์โรเล่ส์', 'male_int_breeding_types', 'พ่อพันธุ์_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('อินดูบราซิล', 'male_int_breeding_types', 'พ่อพันธุ์_อินดูบราซิล')),
            DB::raw($this->groupCattle('พื้นเมือง-บราห์มัน', 'male_mixed_breeding_types', 'พ่อพันธุ์_พื้นเมือง_บราห์มัน')),
            DB::raw($this->groupCattle('พื้นเมือง-ชาร์โรเล่ส์', 'male_mixed_breeding_types', 'พ่อพันธุ์_พื้นเมือง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('พื้นเมือง-อินดูบราซิล', 'male_mixed_breeding_types', 'พ่อพันธุ์_พื้นเมือง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พันธุ์อื่นๆ', 'male_breeding_types', 'พ่อพันธุ์_พันธุ์อื่นๆ')),
            //แม่พันธุ์
            "farm_owners.total_female_breeding_types as แม่พันธุ์_จำนวน",

            DB::raw($this->groupCattle('พันธุ์พื้นเมือง', 'female_breeding_types', 'แม่พันธุ์_พันธุ์พื้นเมือง')),
            DB::raw($this->groupCattle('บราห์มัน', 'female_int_breeding_types', 'แม่พันธุ์_บราห์มัน')),
            DB::raw($this->groupCattle('ชาร์โรเล่ส์', 'female_int_breeding_types', 'แม่พันธุ์_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('อินดูบราซิล', 'female_int_breeding_types', 'แม่พันธุ์_อินดูบราซิล')),
            DB::raw($this->groupCattle('พื้นเมือง-บราห์มัน', 'female_mixed_breeding_types', 'แม่พันธุ์_พื้นเมือง_บราห์มัน')),
            DB::raw($this->groupCattle('พื้นเมือง-ชาร์โรเล่ส์', 'female_mixed_breeding_types', 'แม่พันธุ์_พื้นเมือง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('พื้นเมือง-อินดูบราซิล', 'female_mixed_breeding_types', 'แม่พันธุ์_พื้นเมือง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พันธุ์อื่นๆ', 'female_breeding_types', 'แม่พันธุ์_พันธุ์อื่นๆ')),

            //โคเพศผู้อายุเกิน 6 เดือน แต่ไม่ใช้ผู้คุมฝูง
            "farm_owners.total_male_over_six_breeding_types as โคเพศผู้เกินหกเดือนไม่คุมฝูง_จำนวน",

            DB::raw($this->groupCattle('พันธุ์พื้นเมือง', 'male_over_six_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_พันธุ์พื้นเมือง')),
            DB::raw($this->groupCattle('บราห์มัน', 'male_over_six_int_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_บราห์มัน')),
            DB::raw($this->groupCattle('ชาร์โรเล่ส์', 'male_over_six_int_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('อินดูบราซิล', 'male_over_six_int_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พื้นเมือง-บราห์มัน', 'male_over_six_mixed_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_พื้นเมือง_บราห์มัน')),
            DB::raw($this->groupCattle('พื้นเมือง-ชาร์โรเล่ส์', 'male_over_six_mixed_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_พื้นเมือง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('พื้นเมือง-อินดูบราซิล', 'male_over_six_mixed_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_พื้นเมือง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พันธุ์อื่นๆ', 'male_over_six_breeding_types', 'โคเพศผู้เกินหกเดือนไม่คุมฝูง_พันธุ์อื่นๆ')),

            //โคเพศเมียเกินหกเดือนไม่ตั้งท้อง
            "farm_owners.total_female_over_six_breeding_types as โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_จำนวน",
            DB::raw($this->groupCattle('พันธุ์พื้นเมือง', 'female_over_six_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_พันธุ์พื้นเมือง')),
            DB::raw($this->groupCattle('บราห์มัน', 'female_over_six_int_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_บราห์มัน')),
            DB::raw($this->groupCattle('ชาร์โรเล่ส์', 'female_over_six_int_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('อินดูบราซิล', 'female_over_six_int_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พื้นเมือง-บราห์มัน', 'female_over_six_mixed_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_พื้นเมือง_บราห์มัน')),
            DB::raw($this->groupCattle('พื้นเมือง-ชาร์โรเล่ส์', 'female_over_six_mixed_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_พื้นเมือง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('พื้นเมือง-อินดูบราซิล', 'female_over_six_mixed_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_พื้นเมือง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พันธุ์อื่นๆ', 'female_over_six_breeding_types', 'โคเพศเมียเกินหกเดือนไม่ตั้งท้อง_พันธุ์อื่นๆ')),

            //ลูกโคเพศผู้
            "farm_owners.total_male_under_six_breeding_types as ลูกโคเพศผู้_จำนวน",

            DB::raw($this->groupCattle('พันธุ์พื้นเมือง', 'male_under_six_breeding_types', 'ลูกโคเพศผู้_พันธุ์พื้นเมือง')),
            DB::raw($this->groupCattle('บราห์มัน', 'male_under_six_int_breeding_types', 'ลูกโคเพศผู้_บราห์มัน')),
            DB::raw($this->groupCattle('ชาร์โรเล่ส์', 'male_under_six_int_breeding_types', 'ลูกโคเพศผู้_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('อินดูบราซิล', 'male_under_six_int_breeding_types', 'ลูกโคเพศผู้_อินดูบราซิล')),
            DB::raw($this->groupCattle('พื้นเมือง-บราห์มัน', 'male_under_six_mixed_breeding_types', 'ลูกโคเพศผู้_พื้นเมือง_บราห์มัน')),
            DB::raw($this->groupCattle('พื้นเมือง-ชาร์โรเล่ส์', 'male_under_six_mixed_breeding_types', 'ลูกโคเพศผู้_พื้นเมือง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('พื้นเมือง-อินดูบราซิล', 'male_under_six_mixed_breeding_types', 'ลูกโคเพศผู้_พื้นเมือง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พันธุ์อื่นๆ', 'male_under_six_breeding_types', 'ลูกโคเพศผู้_พันธุ์อื่นๆ')),
            //ลูกโคเพศเมีย
            "farm_owners.total_female_under_six_breeding_types as ลูกโคเพศเมีย_จำนวน",

            DB::raw($this->groupCattle('พันธุ์พื้นเมือง', 'female_under_six_breeding_types', 'ลูกโคเพศเมีย_พันธุ์พื้นเมือง')),
            DB::raw($this->groupCattle('บราห์มัน', 'female_under_six_int_breeding_types', 'ลูกโคเพศเมีย_บราห์มัน')),
            DB::raw($this->groupCattle('ชาร์โรเล่ส์', 'female_under_six_int_breeding_types', 'ลูกโคเพศเมีย_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('อินดูบราซิล', 'female_under_six_int_breeding_types', 'ลูกโคเพศเมีย_อินดูบราซิล')),
            DB::raw($this->groupCattle('พื้นเมือง-บราห์มัน', 'female_under_six_mixed_breeding_types', 'ลูกโคเพศเมีย_พื้นเมือง_บราห์มัน')),
            DB::raw($this->groupCattle('พื้นเมือง-ชาร์โรเล่ส์', 'female_under_six_mixed_breeding_types', 'ลูกโคเพศเมีย_พื้นเมือง_ชาร์โรเล่ส์')),
            DB::raw($this->groupCattle('พื้นเมือง-อินดูบราซิล', 'female_under_six_mixed_breeding_types', 'ลูกโคเพศเมีย_พื้นเมือง_อินดูบราซิล')),
            DB::raw($this->groupCattle('พันธุ์อื่นๆ', 'female_under_six_breeding_types', 'ลูกโคเพศเมีย_พันธุ์อื่นๆ')),


            //ค่าใช้จ่ายโดยประมาณ (บาท/เดือน)
            "farm_owners.total_expense_amount as ค่าใช้จ่ายโดยประมาณ",
            "farm_owners.drug_price as ค่ายา",
            "farm_owners.food_price as ค่าอาหาร",
            "farm_owners.expense_price as ค่าอื่นๆ",

            DB::raw($this->raw('farm_exp', 'ประสบการณ์การเลี้ยงโคเนื้อ')),
            DB::raw($this->raw('farm_future', 'เป้าหมายในการเลี้ยงในอนาคต')),
            DB::raw($this->raw('farm_register_status', 'การขึ้นทะเบียนฟาร์มกับภาครัฐ')),
            DB::raw($this->raw('farm_register', 'สถานะการขึ้นทะเบียนกับภาครัฐ')),

            DB::raw($this->raw('farm_disease_check', 'ประวัติการตรวจโรคสัตว์')),
            DB::raw($this->raw('abortion', 'โรคแท้งติดต่อ')),
            DB::raw($this->raw('tuberculosis', 'โรควัณโรค')),
            DB::raw($this->raw('foot_mouth_disease', 'โรคปากและเท้าเปื่อย')),
            DB::raw($this->raw('disease_other', 'โรคอื่นๆ', 'cf.remark')),

            DB::raw($this->normal("total_workers_amount", "จำนวนแรงงานที่ใช้เลี้ยงโค")),
            DB::raw($this->normal("family_workers_amount", "จำนวนแรงงานภายในครอบครัว")),
            DB::raw($this->normal("external_workers_amount", "จำนวนแรงงานภายนอก")),

            DB::raw($this->groupRaw("water_source_types", 'แหล่งน้ำที่ใช้ในการเลี้ยง')),
            DB::raw($this->groupRemark("อื่นๆ", "water_source_types", 'แหล่งน้ำที่ใช้ในการเลี้ยงอื่น')),

            DB::raw($this->groupRaw("take_care_types", 'ลักษณะการเลี้ยงโคเนื้อ')),

            DB::raw($this->groupRaw("own_land", 'มีพื้นที่ถือครองทางการเกษตร')),
            DB::raw($this->normal("total_own_lands", "รวมพื้นที่ถือครองทางการเกษตร")),
            DB::raw($this->groupRemark("โฉนด", "sub_own_lands", 'โฉนด_ไร่', 'cf.remark')),
            DB::raw($this->groupRemark("โฉนด", "sub_own_lands", 'โฉนด_งาน', 'cf.subarea')),
            DB::raw($this->groupRemark("นส.3", "sub_own_lands", 'นส3_ไร่', 'cf.remark')),
            DB::raw($this->groupRemark("นส.3", "sub_own_lands", 'นส3_งาน', 'cf.subarea')),
            DB::raw($this->groupRemark("สปก.", "sub_own_lands", 'สปก_ไร่', 'cf.remark')),
            DB::raw($this->groupRemark("สปก.", "sub_own_lands", 'สปก_งาน', 'cf.subarea')),
            DB::raw($this->groupRemark("อื่นๆ", "sub_own_lands", 'อื่นๆ_ไร่', 'cf.remark')),
            DB::raw($this->groupRemark("อื่นๆ", "sub_own_lands", 'อื่นๆ_งาน', 'cf.subarea')),

            DB::raw($this->groupRaw("rent_land", 'การเช่าที่ดินเพื่อใช้ในการเลี้ยง')),

            DB::raw($this->groupRaw("use_land", 'มีพื้นที่ที่ใช้ในการเลี้ยงโคเนื้อ')),
            DB::raw($this->normal("total_use_lands", "รวมพื้นที่ที่ใช้ในการเลี้ยงโคเนื้อ")),
            DB::raw($this->groupRemark("คอก", "sub_use_lands", 'คอก_ไร่', 'cf.remark')),
            DB::raw($this->groupRemark("คอก", "sub_use_lands", 'คอก_งาน', 'cf.subarea')),
            DB::raw($this->groupRemark("พื้นที่ปลูกหญ้า", "sub_use_lands", 'พื้นที่ปลูกหญ้า_ไร่', 'cf.area')),
            DB::raw($this->groupRemark("พื้นที่ปลูกหญ้า", "sub_use_lands", 'พื้นที่ปลูกหญ้า_งาน', 'cf.subarea')),
            DB::raw($this->groupRemark("พื้นที่ปลูกหญ้า", "sub_use_lands", 'พื้นที่ปลูกหญ้า_ชนิดหญ้า', 'cf.remark')),


            DB::raw($this->raw("feed_types", 'อาหารที่่ใช้เลี้ยงโคเนื้อ')),

            DB::raw($this->groupRemark("บริษัท", "feed_sources", ' แหล่งที่มาของอาหาร_บริษัท', 'cf.remark')),
            DB::raw($this->groupRemark("สหกรณ์", "feed_sources", ' แหล่งที่มาของอาหาร_สหกรณ์', 'cf.remark')),
            DB::raw($this->groupRemark("ผสมเองภายในฟาร์ม", "feed_sources", ' แหล่งที่มาของอาหาร_ผสมเอง', 'c.choice')),

            DB::raw($this->raw("minerals_feed", 'การให้แร่ธาตุก้อน')),
            DB::raw($this->raw("sub_minerals_feed", 'ความถี่การให้แร่ธาตุก้อน')),
            DB::raw($this->raw("feedstock", 'มีการสำรองฟางข้าวหรือเปลือกข้าวโพด')),

            DB::raw($this->groupRaw("feed_summer_sources", 'ท่านใช้แหล่งอาหารหยาบในฤดูแล้งจาก')),

            //part4
            DB::raw($this->raw("farm_breeding_type", 'ผสมพันธุ์โคเนื้อในฟาร์มของท่าน')),
            DB::raw($this->groupRaw("inseminate_sources", 'แหล่งน้ำเชื้อ')),
            DB::raw($this->groupRemark('กรมปศุสัตว์', "inseminate_sources", 'แหล่งน้ำเชื้อ_กรมปศุสัตว์_ราคาต่อโดส', 'cf.price')),

            DB::raw($this->groupRemark('เอกชน', "inseminate_sources", 'แหล่งน้ำเชื้อ_เอกชน', 'cf.remark')),
            DB::raw($this->groupRemark('เอกชน', "inseminate_sources", 'แหล่งน้ำเชื้อ_เอกชน_ราคาต่อโดส', 'cf.price')),

            DB::raw($this->groupRemark('สถานศึกษา', "inseminate_sources", 'แหล่งน้ำเชื้อ_สถานศึกษา_', 'cf.remark')),
            DB::raw($this->groupRemark('สถานศึกษา', "inseminate_sources", 'แหล่งน้ำเชื้อ_สถานศึกษา_ราคาต่อโดส', 'cf.price')),

            DB::raw($this->groupRemark('หน่วยทหารพัฒนา', "inseminate_sources", 'แหล่งน้ำเชื้อ_หน่วยทหารพัฒนา_ราคาต่อโดส', 'cf.price')),

            DB::raw($this->groupRemark('อื่นๆ', "inseminate_sources", 'แหล่งน้ำเชื้อ_อื่นๆ', 'cf.remark')),
            DB::raw($this->groupRemark('อื่นๆ', "inseminate_sources", 'แหล่งน้ำเชื้อ_อื่นๆ_ราคาต่อโดส', 'cf.price')),


            DB::raw($this->groupRaw("breeders", 'ผู้ให้บริการผสมเทียม')),
            DB::raw($this->groupRemark('สถานศึกษา', "breeders", 'ผู้ให้บริการผสมเทียม_สถานศึกษา', 'cf.remark')),
            DB::raw($this->groupRemark('อื่นๆ', "breeders", 'ผู้ให้บริการผสมเทียม_อื่นๆ', 'cf.remark')),

            DB::raw($this->normal("breeding_rate", "อัตราส่วนพ่อพันธุ์คุมฝูง")),
            DB::raw($this->raw("cattle_death", 'การตายของโคในรอบปี')),
            DB::raw($this->groupRaw("cattle_death_causes", 'สาเหตุการตาย')),
            DB::raw($this->groupRaw("disease_cured_by", 'บุคคลที่ทำการรักษาให้เมื่อโคเจ็บป่วย ')),

            DB::raw($this->raw("dewormed_amount", 'การถ่ายพยาธิ')),
            DB::raw($this->groupRemark('ได้ทำ', "dewormed_amount", 'การถ่ายพยาธิ_จำนวนครั้งต่อปี', 'cf.amount')),

            DB::raw($this->raw("vaccine_ever", 'ท่านได้ทำวัคซีนป้องกันโรคให้กับโคเนื้อที่เลี้ยงหรือไม่')),
            DB::raw($this->groupRaw("vaccine_types", 'วัคซีนที่ให้')),
            DB::raw($this->groupRemark('ปากเปื่อยเท้าเปื่อย', "vaccine_types", 'ปากเปื่อยเท้าเปื่อย_ผู้ให้', 'cf.remark')),
            DB::raw($this->groupRemark('ปากเปื่อยเท้าเปื่อย', "vaccine_types", 'ปากเปื่อยเท้าเปื่อย_ครั้งต่อปี', 'cf.amount')),

            DB::raw($this->groupRemark('คอบวม', "vaccine_types", 'คอบวม_ผู้ให้', 'cf.remark')),
            DB::raw($this->groupRemark('คอบวม', "vaccine_types", 'คอบวม_ครั้งต่อปี', 'cf.amount')),

            DB::raw($this->groupRemark('วัณโรค', "vaccine_types", 'วัณโรค_ผู้ให้', 'cf.remark')),
            DB::raw($this->groupRemark('วัณโรค', "vaccine_types", 'วัณโรค_ครั้งต่อปี', 'cf.amount')),


            DB::raw($this->groupRemark('อื่นๆ', "vaccine_types", 'อื่นๆ_ระบุ', 'cf.source')),
            DB::raw($this->groupRemark('อื่นๆ', "vaccine_types", 'อื่นๆ_ผู้ให้', 'cf.remark')),
            DB::raw($this->groupRemark('อื่นๆ', "vaccine_types", 'อื่นๆ_ครั้งต่อปี', 'cf.amount')),

            DB::raw($this->groupRaw("cattle_dung_uses", 'การจัดการมูลโคในฟาร์ม')),
            DB::raw($this->groupRemark('ขายเพื่อเป็นรายได้', "cattle_dung_uses", 'การจัดการมูลโคในฟาร์ม_รายได้จากการขาย', 'cf.price')),
            DB::raw($this->raw('biogas_status', 'การจัดการมูลโคในฟาร์ม_การทำแก๊สชีวภาพ')),

            //part5
            DB::raw($this->raw("budget_source", 'แหล่งเงินทุน')),
            DB::raw($this->raw("budget_source", 'แหล่งเงินทุน_จำนวน', 'cf.amount')),

            DB::raw($this->groupRaw("loan_types", 'แหล่งเงินทุนกู้ยืม')),

            DB::raw($this->groupRemark('เงินทุนกู้จาก ธ.ก.ส.', "loan_types", '`จำนวนเงินทุนกู้จาก ธ.ก.ส.`', 'cf.amount')),
            DB::raw($this->groupRemark('เงินทุนกู้จาก ธ.ก.ส.', "loan_types", '`อัตราดอกเบี้ย ธ.ก.ส.`', 'cf.rate')),


            DB::raw($this->groupRemark('เงินกู้จากธนาคารพาณิชย์', "loan_types", '`เงินกู้จากธนาคารพาณิชย์`', 'cf.remark')),
            DB::raw($this->groupRemark('เงินกู้จากธนาคารพาณิชย์', "loan_types", '`จำนวนเงินกู้จากธนาคารพาณิชย์`', 'cf.amount')),
            DB::raw($this->groupRemark('เงินกู้จากธนาคารพาณิชย์', "loan_types", '`อัตราดอกเบี้ยจากธนาคารพาณิชย์`', 'cf.rate')),

            DB::raw($this->groupRemark('เงินทุนกู้จากกองทุนหมู่บ้าน', "loan_types", '`จำนวนเงินกู้จากเงินทุนกู้จากกองทุนหมู่บ้าน`', 'cf.amount')),
            DB::raw($this->groupRemark('เงินทุนกู้จากกองทุนหมู่บ้าน', "loan_types", '`อัตราดอกเบี้ยจากเงินทุนกู้จากกองทุนหมู่บ้าน`', 'cf.rate')),

            DB::raw($this->groupRemark('เงินทุนกู้ยืมนอกระบบ', "loan_types", '`จำนวนเงินกู้จากเงินทุนกู้ยืมนอกระบบ`', 'cf.amount')),
            DB::raw($this->groupRemark('เงินทุนกู้ยืมนอกระบบ', "loan_types", '`อัตราดอกเบี้ยจากเงินทุนกู้ยืมนอกระบบ`', 'cf.rate')),


            DB::raw($this->normal("total_budget", "`เงินทุนในการเลี้ยงโคเนื้อรวมทั้งหมด`")),

            //part6
            DB::raw($this->groupRaw("seller_types", '`ท่านจำหน่ายโคเนื้อให้กับใคร`')),
            DB::raw($this->groupRemark('อื่นๆ', "seller_types", '`จำหน่ายโคเนื้อ_อื่นๆ`', 'cf.remark')),


            DB::raw($this->raw("age_sale", 'อายุของโคเนื้อที่จำหน่าย')),
            DB::raw($this->raw("weight_range_sale", 'น้ำหนักของโคเนื้อที่จำหน่าย')),
            DB::raw($this->groupRaw("cattle_sale_methods", '`ลักษณะการจำหน่าย`')),

            DB::raw($this->groupRaw("group_joins", '`การรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อ`')),
            DB::raw($this->groupRemark('กลุ่มวิสาหกิจชุมชน', "group_joins", '`ชื่อกลุ่มวิสาหกิจชุมชน`', 'cf.remark')),
            DB::raw($this->groupRemark('กลุ่มวิสาหกิจชุมชน', "group_joins", '`วันเข้าร่วมวิสาหกิจชุมชน`', 'cf.source')),

            DB::raw($this->groupRemark('สหกรณ์โคเนื้อ', "group_joins", '`ชื่อกลุ่มสหกรณ์โคเนื้อ`', 'cf.remark')),
            DB::raw($this->groupRemark('สหกรณ์โคเนื้อ', "group_joins", '`วันเข้าร่วมวสหกรณ์โคเนื้อ`', 'cf.source')),

            DB::raw($this->raw("group_join_future", '`ความประสงค์ในการรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อ`')),

            DB::raw($this->groupRaw("cooperative_help_types", '`ท่านต้องการให้สหกรณ์ช่วยเหลือในด้านใด`')),
            DB::raw($this->groupRemark('อื่นๆ', "cooperative_help_types", '`ความช่วยเหลือด้านอื่นๆ จากสหกรณ์`', 'cf.remark')),

            DB::raw($this->raw("feed_purchase_cooperative", '`ความต้องการซื้ออาหารในนามสหกรณ์`')),

            DB::raw($this->groupRaw("cattle_sales", '`การขายโคเนื้อ`')),
            DB::raw($this->groupRemark('พ่อพันธ์ุ', "cattle_sales", '`ขายพ่อพันธุ์_ราคาต่อตัว`', 'cf.remark')),
            DB::raw($this->groupRemark('พ่อพันธ์ุ', "cattle_sales", '`ขายพ่อพันธุ์_ระยะเวลาที่เลี้ยง`', 'cf.age_range_sale')),

            DB::raw($this->groupRemark('แม่พันธ์ุ', "cattle_sales", '`ขายแม่พันธ์ุ_ราคาต่อตัว`', 'cf.remark')),
            DB::raw($this->groupRemark('แม่พันธ์ุ', "cattle_sales", '`ขายแม่พันธ์ุ_ระยะเวลาที่เลี้ยง`', 'cf.age_range_sale')),

            DB::raw($this->groupRemark('โคขุน', "cattle_sales", '`ขายโคขุน_ราคาต่อตัว`', 'cf.remark')),
            DB::raw($this->groupRemark('โคขุน', "cattle_sales", '`ขายโคขุน_ระยะเวลาที่เลี้ยง`', 'cf.age_range_sale')),

            DB::raw($this->groupRemark('โครุ่น', "cattle_sales", '`ขายโครุ่น_ราคาต่อตัว`', 'cf.remark')),
            DB::raw($this->groupRemark('โครุ่น', "cattle_sales", '`ขายโครุ่น_ระยะเวลาที่เลี้ยง`', 'cf.age_range_sale')),

            DB::raw($this->groupRemark('อื่นๆ', "cattle_sales", '`ขายอื่นๆ_ราคาต่อตัว`', 'cf.remark')),
            DB::raw($this->groupRemark('อื่นๆ', "cattle_sales", '`ขายอื่นๆ_ระยะเวลาที่เลี้ยง`', 'cf.age_range_sale')),


            DB::raw($this->raw("sale_satisfaction", '`ระดับความพอใจต่อราคาที่ขาย`')),

            //part7
            DB::raw($this->groupRaw("support_sources", '`หน่วยงานที่ให้บริการส่งเสริมการเลี้ยงโคเนื้อ`')),
            DB::raw($this->groupRaw("support_visit", '`ท่านเคยได้รับการเยี่ยมเยือนฟาร์มจากหน่วยงานในข้อ 7.1 หรือไม่`')),

            DB::raw($this->groupRemark('เคย', "support_visit", '`ท่านเคยได้รับการเยี่ยมเยือนฟาร์มจากหน่วยงานในข้อ 7.1 หรือไม่ (โครงการ)`', 'cf.remark')),

            DB::raw($this->groupRaw("production_support", '`ท่านเคยได้รับการสนับสนุนปัจจัยการผลิตหรือไม่`')),
            DB::raw($this->groupRemark('เคย', "production_support", '`ท่านเคยได้รับการสนับสนุนปัจจัยการผลิตหรือไม่ (โครงการ)`', 'cf.remark')),

            DB::raw($this->groupRaw("cattle_heath_support", '`การใช้บริการด้านสุขภาพโคจากหน่วยงานของกรมปศุสัตว์`')),
            DB::raw($this->groupRemark('เคย', "cattle_heath_support", '`การใช้บริการด้านสุขภาพโคจากหน่วยงานของกรมปศุสัตว์ (โครงการ)`', 'cf.remark')),

            DB::raw($this->groupRaw("training_support", '`ท่านเคยเข้ารับการฝึกอบรมเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่`')),
            DB::raw($this->groupRemark('เคย', "training_support", '`ท่านเคยเข้ารับการฝึกอบรมเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่ (โครงการ)`', 'cf.remark')),


            DB::raw($this->groupRaw("observe_support", '`ท่านเคยไปดูงานเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่`')),
            DB::raw($this->groupRemark('เคย', "observe_support", '`ท่านเคยไปดูงานเกี่ยวกับการเลี้ยงโคเนื้อหรือไม่ (โครงการ)`', 'cf.remark')),

            DB::raw($this->groupRaw("female_breeder_support", '`ท่านเคยได้รับการสนับสนุนให้แม่พันธุ์โคเนื้อมาเลี้ยงเพื่อผลิตลูกหรือไม่`')),
            DB::raw($this->groupRemark('เคย', "female_breeder_support", '`ท่านเคยได้รับการสนับสนุนให้แม่พันธุ์โคเนื้อมาเลี้ยงเพื่อผลิตลูกหรือไม่ (โครงการ)`', 'cf.remark')),

            //part 8
            DB::raw($this->normal('problem', 'ปัญหา')),
            DB::raw($this->normal('suggestion', 'ข้อเสนอแนะ'))

        ]);

        $query->join('choice_farm_owner as cf', 'cf.farm_owner_id', '=', 'farm_owners.id');
        $query->join('choices as c', 'c.id', '=', 'cf.choice_id');
        $query->orderBy('farm_owners.id', 'cf.choice_id');
        $query->groupBy("farm_owners.id");

        //$query = $query->limit(1);
        $data = $query->get();


        $data = collect($data)->map(function ($x) {
            return (array)$x;
        })->toArray();

        Excel::create('Filename', function ($excel) use ($data) {

            $excel->sheet('Sheetname', function ($sheet) use ($data) {

                $sheet->fromModel($data);

            });

        })->download('xlsx');

    }

}
