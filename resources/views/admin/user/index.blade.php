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

                    <div class="form-group" style="padding-bottom: 1em;">
                        <label for="search">ค้นหา</label>

                        <div class="input-group">
                            <input type="text" v-on:keyup.13="search()" class="form-control"
                                   placeholder="ค้นหา : ชื่อ นามสกุล E-mail จังหวัด อำเภอ หรือตำบล"
                                   v-model="form.keyword">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" v-on:click="search()">ค้นหา</button>
                            </span>
                        </div>
                    </div>

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
                        <tr v-for="user in users">
                            <td>@{{user.id}}</td>
                            <td>@{{user.firstname }} @{{user.lastname }}</td>
                            <td>@{{user.email }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li v-for="role in user.roles">@{{ role.role }}</li>
                                </ul>
                            </td>
                            <td>
                                <div v-if="user_is_admin" class="btn-group" role="group" aria-label="...">
                                    <a href="/admin/user/@{{ user.id }}/edit"
                                       class="btn btn-default">Edit</a>
                                    <button v-if="user.id != user_id" v-on:click="deleteUser(user.id)" type="button"
                                            class="btn btn-danger">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <div>
                                    จำนวนทั้งหมด @{{ userPage.total }} รายการ
                                </div>
                                <ul class="pagination">
                                    <li v-bind:class="{ 'active' : (userPage.current_page == n+1) }"
                                        v-for="n in userPage.last_page ">
                                        <a v-on:click="gotoPage(n+1)">@{{ n+1 }}</a>
                                    </li>

                                </ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: "body",
            data: {
                user_id: 0,
                user_is_admin: 0,
                users: [],
                userPage: {},
                form: {
                    keyword: "",
                    page: "",
                }
            },
            methods: {

                deleteUser: function (id) {
                    if (confirm("Do you want to delete this user")) {
                        window.location.href = "/admin/user/" + id + "/delete";
                    }
                },
                search: function () {
                    this.$http.get('/api/user', {params: this.form}).then(
                            function (response) {

                                this.userPage = response.data;
                                this.users = this.userPage.data;
                            },
                            function (error) {

                            }
                    );
                },
                gotoPage: function (page) {
                    this.form.page = page;
                    this.search();
                }

            },
            ready: function () {
                console.log('user index app');
                this.search();

                this.user_id = $("#user_id").attr('value')
                this.user_is_admin = $("#user_is_admin").attr('value')
            },
        })
    </script>

@endsection

