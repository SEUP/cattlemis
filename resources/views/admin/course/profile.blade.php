@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User Management</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.error')
        </div>
    </div>
    <div class="row" id="user-profile-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User's profile
                </div>
                <div class="panel-body">

                    <form method="post" action="{{action("Admin\\ProfileController@index")}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Firstname</label>
                            <input value="{{$user->firstname}}" type="text" name="profile[firstname]"
                                   class="form-control" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input value="{{$user->lastname}}" type="text" name="profile[lastname]" class="form-control"
                                   placeholder="Lastname">
                        </div>

                        <div class="form-group">
                            <label>E-Mail</label>
                            <input value="{{$user->email}}" type="email" name="profile[email]" readonly="readonly"
                                   class="form-control"
                                   placeholder="E-Mail">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="profile[password]" class="form-control"
                                   placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label>Verify Password</label>
                            <input type="password" name="profile[vpassword]" class="form-control"
                                   placeholder="Verify Password">
                        </div>


                        <button type="submit" class="btn btn-default">Submit</button>
                        <a class="btn btn-default" href="/admin">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="user-social-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Facebook
                </div>
                <div class="panel-body">
                    @if(Auth::user()->facebook)
                        <dl class="dl-horizontal">
                            <dt>Facebook ID</dt>
                            <dd>{{ Auth::user()->facebook->facebook_id }}</dd>
                            <dt>Facebook E-Mail</dt>
                            <dd>{{ Auth::user()->facebook->email }}</dd>
                            <dt>Facebook Name</dt>
                            <dd>{{ Auth::user()->facebook->name }}</dd>
                        </dl>
                        <a href="{{action("Admin\\ProfileController@doUnlink",['social'=>'facebook'])}}"
                           class="btn btn-social btn-facebook">
                            <span class="fa fa-facebook"></span> Unlink with Facebook
                        </a>
                    @else
                        <?php
                        $fb = app(SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
                        $callbackUrl = action("Admin\\ProfileController@socialCallback", ['social' => 'facebook']);
                        $url = $fb->getLoginUrl(['email'], $callbackUrl);
                        ?>
                        <a href="{{$url}}" class="btn btn-social btn-facebook">
                            <span class="fa fa-facebook"></span> Link with Facebook
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
@endsection