<?php

namespace App\Http\Controllers;

use App\Models\FarmOwner;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FarmOwnerController extends Controller
{

    private function getChoices(Request $request)
    {
        $form = $request->all();

        $choices = [];

        if ($request->has("sex")) {
            $choices[] = $form['sex']['id'];
        }

        if ($request->has("education")) {
            $choices[] = $form['education']['id'];
        }

        if ($request->has("social_status")) {
            if (isset($form['social_status']['pivot'])) {
                $choices[$form['social_status']['id']] = ['remark' => $form['social_status']['pivot']['remark']];
            } else {
                $choices[] = $form['social_status']['id'];
            }

        }

        if (isset($form['family_status']['pivot'])) {
            $choices[$form['family_status']['id']] = ['remark' => $form['family_status']['pivot']['remark']];
        } else {
            $choices[] = $form['family_status']['id'];
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
    }

    public function store(Request $request)
    {
        $form = $request->all();

        $farmOwner = new FarmOwner();
        $farmOwner->fill($request->all());
        $farmOwner->save();
        $farmOwner->choices()->sync($this->getChoices($request));

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

        return $farmOwner;
    }

    public function destroy($id)
    {
        /* @var FarmOwner $farmOwner */
        $farmOwner = FarmOwner::find($id);
        $farmOwner->delete();
        return [true];
    }

}
