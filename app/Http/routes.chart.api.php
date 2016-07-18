<?php

use Illuminate\Http\Request;
use App\Models\FarmOwner;
use App\Models\Choice;

use Illuminate\Support\Facades\DB;

Route::get('test', function () {
    $type = 'sex';
    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');

    $query->where('choices.type', '=', $type);
    $query->groupBy('choices.choice');

    $query->select(DB::raw('count(farm_owners.id) as user_count, choices.choice'));

    $results = $query->get();
    dd($results);
    return $results;
});


Route::get('normal/{type}', function ($type) {

    $query = DB::table('farm_owners');
    $query->join('choice_farm_owner', 'farm_owners.id', '=', 'choice_farm_owner.farm_owner_id');
    $query->join('choices', 'choice_farm_owner.choice_id', '=', 'choices.id');
    //$results = $query->get(['farm_owners.id', 'choices.id as choices_id', 'choices.type', 'choices.choice']);
    $query->groupBy('choices.choice');
    $query->select(DB::raw('count(*) as user_count, choices.choice'));
    $results = $query->get();

    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');

    $query->where('choices.type', '=', $type);
    $query->groupBy('choices.choice');

    $query->select(DB::raw('count(farm_owners.id) as user_count, choices.choice'));

    $results = $query->get();

    $data = [];
    $xAxis = [];
    foreach ($results as $result) {
        $data[] = $result->user_count;
        $xAxis[] = $result->choice;
    }


    $chart = [];
    $chart['xAxis'] = [];
    $chart['xAxis']['categories'] = $xAxis;

    $chart['series'] = [];

    $chart['series'][] =
        [
            'name' => 'All Data',
            'data' => $data
        ];

    return $chart;
});


