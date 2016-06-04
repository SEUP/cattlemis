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
        return view('admin.user.profile')
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

    function doUnlink($social)
    {
        if ($social == "facebook") {
            /* @var \App\Models\User $user */
            $user = Auth::user();
            $user->facebook()->delete();

            return redirect()->action("\\$this->namespace\\ProfileController@index")
                ->with("SUCCESS_MESSAGE", ["msg" => "Your facebook profile has been unlinked."]);
        }
    }

    function socialCallback(LaravelFacebookSdk $fb, Request $request, $social)
    {

        if ($social == "facebook") {
            try {
                $url = action("\\$this->namespace\\ProfileController@socialCallback", ['social' => $social]);
                $token = $fb->getAccessTokenFromRedirect($url);
            } catch
            (FacebookSDKException $e) {
                dd($e->getMessage());
            }
            // Access token will be null if the user denied the request
            // or if someone just hit this URL outside of the OAuth flow.

            if (!$token) {
                // Get the redirect helper
                $helper = $fb->getRedirectLoginHelper();

                if (!$helper->getError()) {
                    abort(403, 'Unauthorized action.');
                }

                // User denied the request
                dd(
                    $helper->getError(),
                    $helper->getErrorCode(),
                    $helper->getErrorReason(),
                    $helper->getErrorDescription()
                );
            }

            if (!$token->isLongLived()) {
                // OAuth 2.0 client handler
                $oauth_client = $fb->getOAuth2Client();

                // Extend the access token.
                try {
                    $token = $oauth_client->getLongLivedAccessToken($token);
                } catch (FacebookSDKException $e) {
                    dd($e->getMessage());
                }
            }

            $fb->setDefaultAccessToken($token);

            // Save for later
            Session::put('fb_user_access_token', (string)$token);

            // Get basic info on the user from Facebook.
            try {
                $response = $fb->get('/me?fields=id,name,email,picture');
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }

            $facebook_user = $response->getGraphUser();

            $facebook_profile = new \App\Models\FacebookProfile();
            $facebook_profile->facebook_id = $facebook_user->getId();
            $facebook_profile->email = $facebook_user->getEmail();
            $facebook_profile->name = $facebook_user->getName();
            $facebook_profile->token = $token;

            /* @var \App\Models\User $user */
            $user = Auth::user();
            $user->facebook()->save($facebook_profile);

            return redirect()->action("\\$this->namespace\\ProfileController@index")
                ->with("SUCCESS_MESSAGE", ["msg" => "Facebook has successfully linked."]);


        }
    }
}
