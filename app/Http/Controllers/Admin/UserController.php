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


class UserController extends Controller
{

    private $namespace = __NAMESPACE__;

    public function index()
    {
        $users = \App\Models\User::with(['roles'])->paginate(15);
        return view('admin.user.index')->with('users', $users);
    }

    public function add()
    {
        $roles = Role::all();
        $user = new User();
        return view('admin.user.add')->with('roles', $roles)
            ->with('user', $user);
    }

    function doAdd(UserCreateRequest $request)
    {
        $userform = $request->get('user');

        $user = User::create($userform);
        $user->password = Hash::make($userform['password']);
        $user->save();

        foreach ($userform['roles'] as $role) {
            $roleM = Role::find($role['id']);
            $user->roles()->save($roleM);
        }

        return redirect()->action("\\$this->namespace\\UserController@index");
    }

    function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit')
            ->with('user', $user);
    }

    function doEdit(UserUpdateRequest $request, $id)
    {
        $userform = $request->get('user');

        $user = User::find($id);
        $user->fill($userform);

        if ($userform['password']) {
            $user->password = Hash::make($userform['password']);
        }
        $user->save();

        return redirect()->action("\\$this->namespace\\UserController@edit", ['id' => $id])->with("SUCCESS_MESSAGE", ["msg" => "User Profile updated."]);
    }

    function doDelete($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->action("\\$this->namespace\\UserController@index")->withErrors(new MessageBag(["USER" => "Cannot delete current user"]));
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->action("\\$this->namespace\\UserController@index")->with("SUCCESS_MESSAGE", ["msg" => "User deleted"]);
    }

}