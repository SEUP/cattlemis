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
            @include('share.error')
        </div>
    </div>
    <div class="row" id="user-profile-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create User
                </div>
                <div class="panel-body">

                    <form method="post" action="{{action("Admin\\UserController@doAdd")}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Firstname</label>
                            <input value="{{old("user.firstname")}}" type="text"
                                   name="user[firstname]"
                                   class="form-control" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input value="{{old("user.lastname")}}" type="text" name="user[lastname]"
                                   class="form-control"
                                   placeholder="Lastname">
                        </div>

                        <div class="form-group">
                            <label>E-Mail</label>
                            <input value="{{old('user.email')}}" type="email" name="user[email]"
                                   class="form-control"
                                   placeholder="E-Mail">
                        </div>

                        <div class="form-group">
                            <label>Roles</label>
                            <input type="hidden" name="user[roles][][id]" value="0">
                            @foreach($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="user[roles][][id]"
                                               value="{{$role->id}}"> {{$role->role}}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="user[password]" class="form-control"
                                   placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label>Verify Password</label>
                            <input type="password" name="user[vpassword]" class="form-control"
                                   placeholder="Verify Password">
                        </div>


                        <button type="submit" class="btn btn-default">Submit</button>
                        <a class="btn btn-default" href="{{action("Admin\\UserController@index")}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection