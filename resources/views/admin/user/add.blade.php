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

                        <input type="hidden" id="selProvince" value="{{old("user.user_province",0) }}"/>
                        <input type="hidden" id="selAmphur" value="{{old("user.user_amphur",0)}}"/>
                        <input type="hidden" id="selDistrict" value="{{old("user.user_district",0)}}"/>

                        <div class="form-group">
                            <label class="control-label">จังหวัด</label>
                            <select class="form-control" v-on:change="provinceChange" v-model="selProvince"
                                    name="user[user_province]">
                                <option value="0">กรุณาเลือก</option>
                                <option v-for="option in provinces"
                                        v-bind:value="option.PROVINCE_ID">@{{ option.PROVINCE_NAME }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">อำเภอ</label>
                            <select class="form-control" v-on:change="amphurChange" v-model="selAmphur"
                                    name="user[user_amphur]">
                                <option value="0">กรุณาเลือก</option>
                                <option v-for="option in amphurs"
                                        v-bind:value="option.AMPHUR_ID">@{{ option.AMPHUR_NAME }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">ตำบล</label>
                            <select class="form-control" name="user[user_district]" v-model="selDistrict">
                                <option value="0">กรุณาเลือก</option>
                                <option v-for="option in districts"
                                        v-bind:value="option.DISTRICT_ID">@{{ option.DISTRICT_NAME }}</option>
                            </select>
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


@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: "body",
            data: {
                user_id: 0,
                user_is_admin: 0,

                provinces: {},
                amphurs: {},
                districts: {},

                selProvince: $("#selProvince").val(),
                selAmphur: $("#selAmphur").val(),
                selDistrict: $("#selDistrict").val(),

            },
            methods: {
                provinceChange: function () {
                    this.selAmphur = 0
                    this.selDistrict = 0;
                    if (this.selProvince != 0) {
                        this.$http.get('api/thailand/province/' + this.selProvince + "/amphure").then(function (r) {
                            this.amphurs = r.data;
                        })
                    }

                },

                amphurChange: function () {
                    this.selDistrict = 0;
                    if (this.selAmphur != 0) {
                        this.$http.get('api/thailand/province/' + this.selProvince + "/amphure/" + this.selAmphur + "/district").then(
                                function (r) {
                                    this.districts = r.data;
                                })
                    }

                }

            },
            ready: function () {
                console.log('user add');

                this.user_id = $("#user_id").attr('value')
                this.user_is_admin = $("#user_is_admin").attr('value')

                var self = this;


                self.$http.get("api/thailand/province").then(function (response) {
                    self.provinces = response.data;

                    if (self.selProvince != 0) {
                        this.$http.get('api/thailand/province/' + this.selProvince + "/amphure").then(function (r) {
                            this.amphurs = r.data;

                            if (self.selAmphur != 0) {
                                this.$http.get('api/thailand/province/' + this.selProvince + "/amphure/" + this.selAmphur + "/district"
                                ).then(function (r) {
                                    this.districts = r.data;
                                })
                            }

                        })
                    }

                });
            },
        })
    </script>

@endsection

