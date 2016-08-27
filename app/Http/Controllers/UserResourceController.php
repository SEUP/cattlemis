<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['roles']);

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query->where('firstname', 'like', "%$keyword%");
            $query->orWhere('lastname', 'like', "%$keyword%");
            $query->orWhere('email', 'like', "%$keyword%");
        }

        return $query->paginate(12);
    }

    public function create()
    {
        return new User();
    }

    public function store(Requests\UserCreateRequest $request)
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

    public function update(Requests\UserUpdateRequest $request, $id)
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
