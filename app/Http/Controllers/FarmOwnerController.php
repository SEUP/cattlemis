<?php

namespace App\Http\Controllers;

use App\Models\FarmInfo;
use App\Models\FarmOwner;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\FarmOwnerRequest;

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
                $choices[] = $form[$field]['id'];
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
                    $choices[] = $item['id'];
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
            $choices = $this->generateChoice($request, $form, $choices, "$field");
        }


        foreach ($multiFieldArray as $field) {
            $choices = $this->generateManyChoices($request, $form, $choices, "$field");
        }

        return $choices;
    }

    public function index(Request $request)
    {
        $query = FarmOwner::query();


        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query->where('person_id', 'like', "%$keyword%");
            $query->orWhere('first_name', 'like', "%$keyword%");
            $query->orWhere('last_name', 'like', "%$keyword%");
        }
        $query->select(['id','first_name', 'last_name','person_id']);
        $farmOwners = $query->paginate(20);

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

        $farmOwner->choices()->sync($this->getChoices($request, $this->fieldArray[0], $this->multiFieldArray[0]));
        // $farmOwner->choices2()->sync($this->getChoices($request, $this->fieldArray[1], $this->multiFieldArray[1]));

        // $farm_info = new FarmInfo();
        // $farm_info->fill($request->get('farm_info'));
        //$farmOwner->farm_info()->save($farm_info);


        return $farmOwner;
    }

    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function edit($id)
    {
        /* @var User $user */
        $farmOwner = FarmOwner::with([])->find($id);

        return $farmOwner;
    }

    public function update(FarmOwnerRequest $request, $id)
    {
        $form = $request->all();
        $farmOwner = FarmOwner::find($id);
        $farmOwner->fill($form);

        $farmOwner->total_master_breeding_types = $farmOwner->total_male_breeding_types +
            $farmOwner->total_female_breeding_types + $farmOwner->total_male_over_six_breeding_types
            + $farmOwner->total_female_over_six_breeding_types
            + $farmOwner->total_male_under_six_breeding_types
            + $farmOwner->total_female_under_six_breeding_types;

        // $farmOwner->save();

        $farmOwner->total_expense_amount = $farmOwner->drug_price +
            $farmOwner->food_price + $farmOwner->expense_price;

        $farmOwner->save();

        $farmOwner->choices()->sync($this->getChoices($request, $this->fieldArray[0], $this->multiFieldArray[0]));
        // $farmOwner->choices2()->sync($this->getChoices($request, $this->fieldArray[1], $this->multiFieldArray[1]));

        //$farm_info = $farmOwner->farm_info()->first();
        //$farm_info->fill($request->get('farm_info'));
        // $farmOwner->farm_info()->save($farm_info);


        return $farmOwner;
    }

    public function destroy($id)
    {
        /* @var FarmOwner $farmOwner */
        $farmOwner = FarmOwner::find($id);

        $farmOwner->choices()->detach();
        // $farmOwner->choices2()->detach();

        $farmOwner->delete();
        return [true];
    }

}
