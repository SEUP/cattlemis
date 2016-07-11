<?php

namespace App\Http\Controllers\Admin;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/30/2016
 * Time: 8:33 AM
 */

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use \App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;


class ChoiceController extends Controller
{

    private $namespace = __NAMESPACE__;

    public function index()
    {
        return view('admin.choice.index');

    }

    public function add()
    {
    }

    function doAdd(UserCreateRequest $request)
    {

    }

    function edit($id)
    {

    }

    function doEdit(UserUpdateRequest $request, $id)
    {

    }

    function doDelete($id)
    {

    }

}