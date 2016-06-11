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
    <div class="row" id="user-management-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{action('Admin\\UserController@add')}}" class="btn btn-default">Create User</a>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach($user->roles as $role)
                                            <li>{{ $role->role }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a href="{{action("Admin\\UserController@edit",["id"=>$user->id])}}" class="btn btn-default">Edit</a>
                                        @if($user->id != Auth::user()->id)
                                            <button v-on:click="deleteUser({{$user->id}})" type="button"
                                                    class="btn btn-default">
                                                Delete
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        {!! $users->links() !!}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        var UserIndexApp = new AdminApp({
            el: "body",
            methods: {
                deleteUser: function (id) {
                    if (confirm("Do you want to delete this user")) {
                        window.location.href = "/admin/user/" + id + "/delete";
                    }
                }
            },
            ready: function () {
                console.log('user index app');
            },
        })
    </script>

@endsection

