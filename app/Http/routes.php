<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    if (Auth::user()) {
        return "index";
    } else {
        return redirect('/login');
    }

});

Route::get('login', function (\Illuminate\Support\Facades\Request $request) {
    return view('login');
});

Route::get('login/{social}/callback', function (
    \SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb,
    \Illuminate\Http\Request $request,
    $social
) {
    if ($social == "facebook") {
        try {
            $token = $fb->getAccessTokenFromRedirect("/login/$social/callback");
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
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
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

        // Save for later
        Session::put('fb_user_access_token', (string)$token);

        // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('/me?fields=id,name,email,picture');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        $facebook_user = $response->getGraphUser();

        $facebookProfile = \App\Models\FacebookProfile::where('facebook_id', '=', $facebook_user->getId())->first();
        if ($facebookProfile) {
            $user = $facebookProfile->user;
            Auth::login($user);

            return redirect('/admin');
        } else {
            return Redirect::back()->withInput()->withErrors(['facebook' => "Your facebook profile is not linked with any account"]);
        }
    }
});

Route::post('login', function (\Illuminate\Http\Request $request) {
    $login = $request->get('login');
    if (Auth::attempt($login)) {
        // Authentication passed...
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect('/admin');
        } else {
            return redirect('/student');
        }

    } else {
        return Redirect::back()->withInput()->withErrors(['password' => 'Email and/or password invalid.']);
    }
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::resource('/api/user', "UserResourceController");

Route::resource('/api/user.calendar', "UserCalendarResourceController");
Route::resource('/api/user.calendar.event', "UserCalendarEventResourceController");

Route::get('/api/current_user', function () {
    return Auth::user();
});

