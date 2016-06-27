<?php

namespace App\Http\Controllers;

use App\Models\FarmOwner;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProvinceController extends Controller
{

    public function index()
    {
        $provinces = Province::with(['amphures'])->get();
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
