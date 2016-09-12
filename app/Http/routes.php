<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {

    $countFarmOwners = \App\Models\FarmOwner::with([])->count();

    return view('public.dashboard')
        ->with('countFarmOwners', $countFarmOwners);
});

Route::get('questionaire/search', function () {
    return view('public.questionaire.search');
});

Route::get('charts/menuchart', function () {
    return view("public.charts.menuChart");
});

Route::get('charts/menuchart/{province}/{amphur?}', function ($province, $amphur=null) {
    return view("public.charts.mapdashboard")
        ->with('province', $province)
        ->with('amphur', $amphur);
});

Route::get('charts/groupJoin/{title?}', function ($title = "การรวมกลุ่มวิสาหกิจชุมชนและสหกรณ์โคเนื้อ", $type = "group_joins") {

    return view("public.charts.groupJoinChart")
        ->with('title', $title)
        ->with('type', $type);
});


Route::get('charts/normal/{title}/{type}', function ($title, $type) {

    return view("public.charts.normalChart")
        ->with('title', $title)
        ->with('type', $type);
});

Route::get('charts/gmap/{title}', function ($title) {

    return view("public.charts.gmapChart")
        ->with('title', $title);
});

Route::get('charts/pie/{title}/{type}', function ($title, $type) {

    return view("public.charts.pieChart")
        ->with('title', $title)
        ->with('type', $type);
});

Route::get('charts/multi-choice/{title}/{type}', function ($title, $type) {

    return view("public.charts.multiChoiceChart")
        ->with('title', $title)
        ->with('type', $type);
});


Route::get('charts/range-farmowner/{title}/{type}/{min}/{max}/{step}',
    function (\Illuminate\Http\Request $request,$title, $type, $min, $max, $step) {

        $withNull = false;
        $nullText = "null";

        if($request->has('withNull')) $withNull = $request->get('withNull');
        if($request->has('nullText')) $nullText = $request->get('nullText');

        return view("public.charts.farmownerRangeChart")
            ->with('title', $title)
            ->with('type', $type)
            ->with('min', $min)
            ->with('max', $max)
            ->with('step', $step)
            ->with('withNull',$withNull)
            ->with('nullText',$nullText);
    });

Route::get('charts/cattle/', function () {

    return view("public.charts.cattleChart");
});

Route::get('charts/double/{title}/{type}', function ($title, $type) {
    return view("public.charts.doubleChart")
        ->with('title', $title)
        ->with('type', $type);
});

Route::get('charts/budget/', function () {
    return view("public.charts.budgetChart");
});




Route::get('login', function (\Illuminate\Support\Facades\Request $request) {
    return view('login');
});

Route::post('login', function (\Illuminate\Http\Request $request) {
    $login = $request->get('login');
    if (Auth::attempt($login)) {
        // Authentication passed...
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect('/admin');
        } else {
            return redirect('/admin');
        }

    } else {
        return Redirect::back()->withInput()->withErrors(['password' => 'Email and/or password invalid.']);
    }
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});


Route::resource('/api/farm-owner', "FarmOwnerController");

Route::resource('/api/thailand/province', "ProvinceController");
Route::resource('/api/thailand/province.farm_owners', "ProvinceFarmOwnerController");
Route::resource('/api/thailand/province.amphure', "ProvinceAmphureController");
Route::resource('/api/thailand/province.amphure.farm_owners', "ProvinceAmphureFarmOwnerController");
Route::resource('/api/thailand/province.amphure.district', "ProvinceAmphurDistrictController");

Route::get('/api/choice', function () {
    $choices = \App\Models\Choice::with([])->orderBy('order', 'asc')->orderBy('id', 'asc')->get()->groupBy('type');
    return $choices;
});

Route::get('/api/choice/{type}', function ($type) {
    $choices = \App\Models\Choice::where('type', '=', $type)->get();
    return $choices;
});


Route::resource('/api/user', "UserResourceController");