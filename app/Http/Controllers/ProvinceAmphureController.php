<?php

namespace App\Http\Controllers;

use App\Models\Amphur;
use App\Models\FarmOwner;
use App\Models\Province;
use App\Models\ThailandProvince;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProvinceAmphureController extends Controller
{

    public function index($provinceId)
    {
        /* @var Province $province */
        $province = Province::find($provinceId);
        $amphurs = $province->amphurs()->get();
        return $amphurs;
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
