<?php

use Illuminate\Http\Request;
use App\Models\FarmOwner;
use App\Models\Choice;

use Illuminate\Support\Facades\DB;

Route::get('test2/{choices}', function ($choices) {
});

Route::get('gmap/{province?}', function ($province = null) {
//select farm_owners.first_name ,farm_owners.last_name, farm_owners.farm_lat,farm_owners.farm_long
//from farm_owners
//where farm_owners.farm_lat is not null and farm_owners.farm_long is not null

    $query = DB::table('farm_owners');
    $query->select(["farm_owners.first_name", "farm_owners.last_name", "farm_owners.farm_lat", "farm_owners.farm_long"]);

    $query->whereNotNull('farm_owners.farm_lat');
    $query->whereNotNull('farm_owners.farm_long');

    if ($province) {
        $query->where('farm_owners.house_province', '=', DB::raw($province));
    }

    $result = $query->get();

    $output = [];
    foreach ($result as $r) {
        $marker = new stdClass();
        $marker->title = "$r->first_name $r->last_name";
        $marker->position = [
            "lat" => $r->farm_lat,
            "lng" => $r->farm_long
        ];

        $output[] = $marker;
    }

    return $output;

});

Route::get('map-data/{id?}', function ($provinceId = null) {

    if ($provinceId) {

        $query = DB::table('thailand_amphures');

        $query->leftJoin('farm_owners', 'farm_owners.house_amphur', '=', 'thailand_amphures.amphur_id');

        $query->select(["thailand_amphures.amphur_id", "thailand_amphures.amphur_name"]);
        $query->addSelect(DB::raw('count(farm_owners.id) as value'));
        $query->addSelect(DB::raw('count(farm_owners.id) as y'));

        $query->where('thailand_amphures.province_id', '=', $provinceId);

        $query->groupBy('thailand_amphures.amphur_id');

        return $query->get();


    } else {
        $query = DB::table('thailand_provinces');
        $query->leftJoin('farm_owners', 'farm_owners.house_province', '=', 'thailand_provinces.province_id');

        $query->select(["thailand_provinces.province_id", "thailand_provinces.province_name"]);
        $query->addSelect(DB::raw('count(farm_owners.id) as value'));
        $query->addSelect(DB::raw('count(farm_owners.id) as y'));


        $query->where('thailand_provinces.geo_id', '=', '1');

        $query->groupBy('thailand_provinces.province_id');

        return $query->get();

    }


});


Route::get('multi/choices/{type}/{province?}', function ($type, $provinceId = null) {

    //fix data tables
    $translate = [
        "abortion" => "โรคแท้งติดต่อ",
        "tuberculosis" => "โรควัณโรค",
        "foot_mouth_disease" => "โรคปากและเท้าเปื่อย",

    ];

    $choices = explode(",", $type);

    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');

    $query->leftJoin('farm_owners', function ($join) use ($provinceId) {
        $join->on('choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');
        if ($provinceId) {
            $join->on('farm_owners.house_province', '=', DB::raw($provinceId));
        }
    });
    foreach ($choices as $choice) {
        $query->orWhere('choices.type', '=', $choice);
    }


    $query->groupBy('choices.id');
    $query->orderBy('choices.id');
    $query->select(DB::raw('count(farm_owners.id) as user_count, choices.choice'));
    $query->addSelect('choices.type');

    $results = $query->get();
    $results = (new \Illuminate\Support\Collection($results))->groupBy('choice');

    $xAxis = [];
    foreach ($choices as $choice) {

        if (array_has($translate, $choice)) {
            $xAxis[] = $translate[$choice];
        } else {
            $xAxis[] = $choice;
        }
    }

    $chart = [];
    $chart['tooltip'] = [];
    $chart['tooltip']['valueSuffix'] = " คน";

    $chart['xAxis'] = [];
    $chart['xAxis']['categories'] = $xAxis;

    foreach ($results as $key => $value) {

        $name = $key;

        $data = [];
        foreach ($value as $v) {
            $data[] = $v->user_count;
        }

        $chart['series'][] =
            [
                'name' => $name,
                'data' => $data,
                // 'colorByPoint' => true,
            ];
    }

    return $chart;


});

Route::get('range/farm-owner/{type}/{min}/{max}/{numberGroup}/{province?}', function ($type, $min, $max, $numberGroup, $province = null) {

//    SELECT SUM(CASE WHEN age_c < 18 THEN 1 ELSE 0 END) AS [Under 18],
//        SUM(CASE WHEN age_c BETWEEN 18 AND 24 THEN 1 ELSE 0 END) AS [18-24],
//        SUM(CASE WHEN age_c BETWEEN 25 AND 34 THEN 1 ELSE 0 END) AS [25-34]
//     FROM contacts

    $step = intval(($max - $min) / $numberGroup);
    $arr = range($min, $max, $step);


    $query = DB::table('farm_owners');

    if ($province) {
        $query->where('farm_owners.house_province', '=', $province);
    }

    if ($type == 'age' or $type =='avg_cattle_income') {
        $query->where($type, '>', 0);
    }

    if ($min == 0) {
        $query->addSelect(DB::raw("SUM(IF($type = 0,1,0)) as '0'"));
    } elseif ($min == 1) {
        $query->addSelect(DB::raw("SUM(IF($type = 0,1,0)) as '0'"));
        $query->addSelect(DB::raw("SUM(IF($type = $min,1,0)) as '$min'"));
    } else {
        $query->addSelect(DB::raw("SUM(IF($type <= $min,1,0)) as '0 ถึง $min'"));
    }


    for ($i = 0; $i < sizeof($arr) - 1; $i++) {
        $low = $arr[$i];
        $high = $arr[$i + 1];
        $labelLow = $low + 1;
        if ($high - $labelLow == 0) {
            $query->addSelect(DB::raw("SUM(IF( $type = $high,1,0)) as '$high'"));
        } else {
            $query->addSelect(DB::raw("SUM(IF($type > $low and $type <= $high,1,0)) as '$labelLow ถึง $high'"));
        }

    }

    $max = $arr[sizeof($arr) - 1];
    $maxLabel = $max + 1;

    $query->addSelect(DB::raw("SUM(IF($type > $max,1,0)) as '$maxLabel ขึ้นไป'"));


    $results = $query->get()[0];

    $xAxis = [];
    foreach ($results as $key => $value) {
        $data[] = intval($value);
        $xAxis[] = $key;
    }

    $chart = [];
    $chart['tooltip'] = [];
    $chart['tooltip']['valueSuffix'] = " คน";


    $chart['xAxis'] = [];
    $chart['xAxis']['categories'] = $xAxis;

    $chart['series'] = [];

    $chart['series'][] =
        [
            'name' => 'จำนวน',
            'data' => $data,
            'colorByPoint' => true,

        ];

    return $chart;

});

Route::get('normal/{type}/{province?}', function ($type, $province = null) {

    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');

    $query->where('choices.type', '=', $type);

    if ($province) {
        $query->where('farm_owners.house_province', '=', $province);
    }

    $query->groupBy('choices.choice');
    $query->orderBy('choices.id', 'asc');
    $query->select(DB::raw('count(farm_owners.id) as user_count, choices.choice'));

    $results = $query->get();

    $data = [];
    $xAxis = [];
    foreach ($results as $result) {
        $data[] = $result->user_count;
        $xAxis[] = $result->choice;
    }


    $chart = [];
    $chart['tooltip'] = [];
    $chart['tooltip']['valueSuffix'] = " คน";
    $chart['xAxis'] = [];
    $chart['xAxis']['categories'] = $xAxis;

    $chart['series'] = [];

    $chart['series'][] =
        [
            'name' => 'จำนวน',
            'data' => $data,
            'colorByPoint' => true,
        ];

    return $chart;
});

Route::get('pie/{type}/{province?}', function ($type, $province = null) {


    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');

    $query->where('choices.type', '=', $type);

    if ($province) {
        $query->where('farm_owners.house_province', '=', $province);
    }

    $query->groupBy('choices.choice');
    $query->orderBy('choices.id', 'asc');
    $query->select(DB::raw('count(farm_owners.id) as user_count, choices.choice'));

    $results = $query->get();


    $data = [];


    foreach ($results as $result) {
        $each = new stdClass();
        $each->name = $result->choice;
        $each->y = $result->user_count;

        $data[] = $each;
    }


    $chart = [];
    $chart['tooltip'] = [];
    $chart['tooltip']['pointFormat'] = "จำนวน: <b>{point.y} คน</b>";


    $chart['series'] = [];

    $chart['series'][] =
        [
            "name" => $type,
            "colorByPoint" => true,
            "data" => $data
        ];

    return $chart;
});

Route::get('cattle/{title}/{type}/{province?}', function ($title, $type, $province = null) {

    //$type="male_breeding_types";

    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');
    $query->where('choices.type', '=', $type);

    if ($province) {
        $query->where('farm_owners.house_province', '=', $province);
    }

    $query->groupBy('choices.choice');
    $query->orderBy('choices.id', 'asc');
    $query->select(DB::raw('sum(choice_farm_owner.amount) as cattle_count, choices.choice, choices.id'));

    $results = $query->get();


    $data = [];
    $xAxis = [];
    foreach ($results as $r) {
        $each = new stdClass();
        $each->name = $r->choice;
        $each->y = intval($r->cattle_count);
        $each->drilldown = $r->choice;
        $xAxis[] = $r->choice;
        $data[] = $each;
    }

    $data_drill = [];
    foreach ($results as $r) {

        $each_drill = new stdClass();
        $each_drill->name = $r->choice;
        $each_drill->id = $r->choice;

        $query = DB::table('choices');
        $query->Join('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
        $query->Join('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');

        $query->where('choices.parent_id', '=', $r->id);

        $query->whereIn('choice_farm_owner.farm_owner_id', function ($query) use ($r) {
            $query->select('choice_farm_owner.farm_owner_id')
                ->from('choice_farm_owner')
                ->where('choice_farm_owner.choice_id', $r->id);
        });
        $query->groupBy('choices.id');


        $query->select(DB::raw('sum(choice_farm_owner.amount) as cattle_count, choices.choice, choices.id'));

        $sub_results = $query->get();
        //return $sub_results;

        $each_drill->data = [];
        foreach ($sub_results as $sub_r) {
            if ($sub_r->choice != null) {
                //$each_drill->data[] = $sub_r->choice;
                //$each_drill->data[] = $sub_r->cattle_count;
                $each_drill->data[] = array($sub_r->choice, intval($sub_r->cattle_count));
                $data_drill[] = $each_drill;
            }
        }
    }

    $show_drill = new stdClass();
    $show_drill->series = $data_drill;


    $chart = [];
    $chart['tooltip'] = [];
    $chart['tooltip']['pointFormat'] = "จำนวน: <b>{point.y} ตัว</b>";
    $chart['xAxis'] = [];
    $chart['xAxis']['categories'] = $xAxis;

    $chart['series'] = [];

    $chart['series'][] =
        [
            "name" => $title,
            "colorByPoint" => true,
            "data" => $data
        ];


    $chart['drilldown'] = $show_drill;

    return $chart;
});


Route::get('double/{title}/{type}/{action?}/{element?}/{province?}', function ($title, $type, $action, $element, $province = null) {

    //get top

    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');
    $query->where('choices.type', '=', $type);

    if ($province) {
        $query->where('farm_owners.house_province', '=', $province);
    }

    $query->groupBy('choices.choice');
    $query->orderBy('choices.id', 'asc');
    $query->select(DB::raw('count(farm_owners.id) as regis_count, choices.choice, choices.id'));

    $results = $query->get();
    // return $results;

    $data = [];
    foreach ($results as $result) {
        $each = new stdClass();
        $each->name = $result->choice;
        $each->y = $result->regis_count;

        $data[] = $each;
    }


//get down
    $data_drill = [];
    $xAxis = [];
    foreach ($results as $r) {

        $query = DB::table('choices');
        $query->Join('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
        $query->Join('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');

        $query->where('choices.parent_id', '=', $r->id);
        if ($province) {
            $query->where('farm_owners.house_province', '=', $province);
        }

        $query->whereIn('choice_farm_owner.farm_owner_id', function ($query) use ($r) {
            $query->select('choice_farm_owner.farm_owner_id')
                ->from('choice_farm_owner')
                ->where('choice_farm_owner.choice_id', $r->id);
        });
        $query->groupBy('choices.id');


        $query->select(DB::raw("$action($element) as type_count, choices.choice, choices.id"));
        $sub_results = $query->get();
        //return $sub_results;

        foreach ($sub_results as $result) {
            $data_drill[] = intval($result->type_count);
            $xAxis[] = $result->choice;
        }
    }

    $chart = [];
    $chart['tooltip'] = [];
    $chart['tooltip']['pointFormat'] = "จำนวน: <b>{point.y}</b>";
    $chart['series'] = [];
    $chart['series'][] =
        [
            "name" => $title,
            "colorByPoint" => true,
            "data" => $data
        ];


    $chart['xAxis'] = [];

    $chart['xAxis']['categories'] = $xAxis;
    $chart['xAxis']['crosshair'] = true;

    $chart['drilldown'] = [];
    $chart['drilldown'][] =
        [
            'name' => 'จำนวน',
            'data' => $data_drill,
            'colorByPoint' => true,
        ];

    return $chart;
});

Route::get('budget/{province?}', function ($province = null) {

    //get top
    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');
    $query->where('choices.type', '=', "budget_source");

    if ($province) {
        $query->where('farm_owners.house_province', '=', $province);
    }

    $query->groupBy('choices.choice');
    $query->orderBy('choices.id', 'asc');
    $query->select(DB::raw('count(farm_owners.id) as user_count, choices.choice, choices.id'));

    $results = $query->get();


    foreach ($results as $result) {
        $each = new stdClass();
        $each->name = $result->choice;
        $each->y = $result->user_count;
        $data[] = $each;
    }


//get down
    $query = DB::table('choices');
    $query->leftJoin('choice_farm_owner', 'choices.id', '=', 'choice_farm_owner.choice_id');
    $query->leftJoin('farm_owners', 'choice_farm_owner.farm_owner_id', '=', 'farm_owners.id');
    $query->where('choices.type', '=', "loan_types");

    if ($province) {
        $query->where('farm_owners.house_province', '=', $province);
    }

    $query->groupBy('choices.choice');
    $query->orderBy('choices.id', 'asc');
    $query->select(DB::raw('sum(choice_farm_owner.amount) as loan_amount, choices.choice, choices.id'));

    $sub_results = $query->get();
    // return $results;

    $data_drill = [];
    $xAxis = [];
    foreach ($sub_results as $result) {
        $data_drill[] = intval($result->loan_amount);
        $xAxis[] = $result->choice;
    }

    $chart = [];
    $chart['tooltip'] = [];
    $chart['tooltip']['pointFormat'] = "จำนวน: <b>{point.y}</b>";
    $chart['series'] = [];
    $chart['series'][] =
        [
            "name" => "เงินทุนในการเลี้ยงโคเนื้อ",
            "colorByPoint" => true,
            "data" => $data
        ];


    $chart['xAxis'] = [];

    $chart['xAxis']['categories'] = $xAxis;
    $chart['xAxis']['crosshair'] = true;

    $chart['drilldown'] = [];
    $chart['drilldown'][] =
        [
            'name' => 'จำนวน',
            'data' => $data_drill,
            'colorByPoint' => true,
        ];

    return $chart;
});