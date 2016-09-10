<?php

namespace App\Http\Controllers;

use App\Models\FarmInfo;
use App\Models\FarmOwner;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\FarmOwnerRequest;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class FarmOwnerController extends Controller
{

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

    public function index(Request $request)
    {
        $query = DB::table('farm_owners');

        $query->leftJoin('thailand_provinces', 'farm_owners.house_province', '=', 'thailand_provinces.province_id');
        $query->leftJoin('thailand_amphures', 'farm_owners.house_amphur', '=', 'thailand_amphures.amphur_id');
        $query->leftJoin('thailand_districts', 'farm_owners.house_district', '=', 'thailand_districts.district_id');

        $query->select([
            'farm_owners.id', 'farm_owners.first_name', 'farm_owners.last_name'
            , 'updated_at'
            , 'thailand_provinces.province_name'
            , 'thailand_amphures.amphur_name'
            , 'thailand_districts.district_name'
            , 'farm_owners.house_province'
            , 'farm_owners.house_amphur'
            , 'farm_owners.house_district'

        ]);

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query->where('farm_owners.person_id', 'like', "%$keyword%");
            $query->orWhere('farm_owners.first_name', 'like', "%$keyword%");
            $query->orWhere('farm_owners.last_name', 'like', "%$keyword%");
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
        /* @var User $user */
        $farmOwner = FarmOwner::with([])->find($id);

        return $farmOwner;
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

        $farmOwner->total_master_breeding_types = $farmOwner->total_male_breeding_types +
            $farmOwner->total_female_breeding_types + $farmOwner->total_male_over_six_breeding_types
            + $farmOwner->total_female_over_six_breeding_types
            + $farmOwner->total_male_under_six_breeding_types
            + $farmOwner->total_female_under_six_breeding_types;

        // $farmOwner->save();

        $farmOwner->total_expense_amount = $farmOwner->drug_price +
            $farmOwner->food_price + $farmOwner->expense_price;

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

}
