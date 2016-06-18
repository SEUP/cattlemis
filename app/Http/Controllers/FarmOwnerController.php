<?php

namespace App\Http\Controllers;

use App\Models\FarmOwner;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FarmOwnerController extends Controller
{
    public function index()
    {
        $farmOwners = FarmOwner::with([])->get();
        return $farmOwners;
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $form = $request->all();


        $farmOwner = new FarmOwner();
        $farmOwner->fill($request->all());
        $farmOwner->save();
        $farmOwner->sexes()->sync([$form['sex']['id']]);

        return $farmOwner;
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
