<?php

namespace App\Http\Controllers;

use App\Models\Amphur;
use App\Models\FarmOwner;
use App\Models\Province;
use App\Models\ThailandProvince;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ProvinceFarmOwnerController extends Controller
{

    public function index(Request $request, $province)
    {
        $query = DB::table('farm_owners');

        $query->join('thailand_provinces', 'farm_owners.house_province', '=', 'thailand_provinces.province_id');
        $query->join('thailand_amphures', 'farm_owners.house_amphur', '=', 'thailand_amphures.amphur_id');
        $query->join('thailand_districts', 'farm_owners.house_district', '=', 'thailand_districts.district_id');

        $query->select([
            'farm_owners.id', 'farm_owners.first_name', 'farm_owners.last_name',
            'farm_owners.person_id', 'updated_at'
            , 'thailand_provinces.province_name'
            , 'thailand_amphures.amphur_name'
            , 'thailand_districts.district_name'

        ]);


        $query->where('farm_owners.house_province', '=', $province);


        $query->orderBy('updated_at', 'desc');
        $farmOwners = $query->paginate(12);

        return $farmOwners;
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $provinces = Province::with([])->orderBy('province_name', 'asc')
            ->where("province_id", '=', $id)->first();
        return $provinces;
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
