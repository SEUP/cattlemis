<?php

namespace App\Http\Controllers;

use App\Models\FarmOwner;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FarmOwnerController extends Controller
{

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

    private function getChoices(Request $request)
    {
        $form = $request->all();

        $choices = [];

        $fieldArray = [
            'sex', 'family_status', 'education', 'social_status', 'personal_status', 'cattle_job', 'income_range'
        ];

        foreach ($fieldArray as $field) {
            $choices = $this->generateChoice($request, $form, $choices, "$field");
        }

        $multiFieldArray = [
            'jobtypes',
        ];

        foreach ($multiFieldArray as $field) {
            $choices = $this->generateManyChoices($request, $form, $choices, "$field");
        }

        return $choices;
    }

    private function getChoices2(Request $request)
    {
        $form = $request->all();

        $choices = [];

        $fieldArray = [
            'farm_record','farm_exp','farm_future',
            'farm_register_status','farm_register','farm_disease_check','abortion',
            'tuberculosis','foot_mouth_disease'

        ];

        foreach ($fieldArray as $field) {
            $choices = $this->generateChoice($request, $form, $choices, "$field");
        }

        $multiFieldArray = [
            'farm_purposes', 'male_breeding_types',
            'male_int_breeding_types', 'male_mixed_breeding_types', 'female_breeding_types',
            'female_int_breeding_types', 'female_mixed_breeding_types', 'male_over_six_breeding_types',
            'male_over_six_int_breeding_types', 'male_over_six_mixed_breeding_types',
            'female_over_six_breeding_types', 'female_over_six_int_breeding_types',
            'female_over_six_mixed_breeding_types', 'male_under_six_breeding_types',
            'male_under_six_int_breeding_types', 'male_under_six_mixed_breeding_types',
            'female_under_six_breeding_types', 'female_under_six_int_breeding_types',
            'female_under_six_mixed_breeding_types'
        ];

        foreach ($multiFieldArray as $field) {
            $choices = $this->generateManyChoices($request, $form, $choices, "$field");
        }

        return $choices;
    }

    public function index()
    {
        $farmOwners = FarmOwner::with([])->get();
        return $farmOwners;
    }

    public function create()
    {
        return new FarmOwner();
    }

    public function store(Request $request)
    {
        $form = $request->all();

        $farmOwner = new FarmOwner();
        $farmOwner->fill($request->all());
        $farmOwner->save();
        $farmOwner->choices()->sync($this->getChoices($request));
        $farmOwner->choices2()->sync($this->getChoices2($request));

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

    public function update(Request $request, $id)
    {
        $form = $request->all();
        $farmOwner = FarmOwner::find($id);
        $farmOwner->fill($form);
        $farmOwner->save();

        $farmOwner->choices()->sync($this->getChoices($request));
        $farmOwner->choices2()->sync($this->getChoices2($request));

        return $farmOwner;
    }

    public function destroy($id)
    {
        /* @var FarmOwner $farmOwner */
        $farmOwner = FarmOwner::find($id);

        $farmOwner->choices()->detach();

        $farmOwner->delete();
        return [true];
    }

}
