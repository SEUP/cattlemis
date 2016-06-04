<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserResourceController extends Controller
{
    public function index()
    {
        $users = User::with(['roles'])->get();
        return $users;
    }

    public function create()
    {
        return new User();
    }

    public function store(Request $request)
    {
        $user = User::create($request->get('user'));
        $user->save();
        return $user;
    }

    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function edit($id)
    {
        /* @var User $user */
        $user = User::find($id);
        return $user;
    }

    public function update(Request $request, $id)
    {
        /* @var User $user */
        $user = User::find($id);
        $user->fill($request->get('user'));
        $user->save();
        return $user;
    }

    public function destroy($id)
    {
        /* @var User $user */
        $user = User::find($id);
        $user->delete();
        return [true];
    }

}
