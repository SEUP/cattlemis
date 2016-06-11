<?php

namespace App\Http\Controllers\Admin;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/30/2016
 * Time: 8:33 AM
 */

use App\Http\Requests\ProfileRequest;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use \App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;


class ProfileController extends Controller
{

    private $namespace = __NAMESPACE__;

    public function index()
    {
        $user = Auth::user();
        return view('share.user.profile')
            ->with('user', $user);
    }


    function doEdit(ProfileRequest $request)
    {
        $profile = $request->get('profile');

        $user = Auth::user();
        $user->fill($profile);

        if ($profile['password']) {
            $user->password = \Hash::make($profile['password']);
        }
        $user->save();


        return redirect()->action("\\$this->namespace\\ProfileController@index")->with("SUCCESS_MESSAGE", ["msg" => "Profile updated."]);
    }

}
