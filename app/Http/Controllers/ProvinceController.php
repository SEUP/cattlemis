<?php

namespace App\Http\Controllers;

use App\Models\Amphur;
use App\Models\FarmOwner;
use App\Models\Province;
use App\Models\ThailandProvince;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProvinceController extends Controller
{

    public function index()
    {
        $provinces = Province::with([])->orderBy('province_name', 'asc')
            ->whereIn("province_id",[42,43,44,45])
            ->where("geo_id",'=','1')->get();
        return $provinces;
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {


    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

}
