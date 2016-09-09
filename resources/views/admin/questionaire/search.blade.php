@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ค้นหาข้อมูลเกษตรกร</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">

        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ค้นหาเกษตรกร</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="form-group col-lg-12" style="padding-bottom: 1em;">

                            <label for="search">ค้นหา</label>

                            <input type="text" v-on:keyup.13="search()" class="form-control"
                                   placeholder="ค้นหา : ชื่อ นามสกุล รหัสประจำตัวประชาชน"
                                   v-model="form.keyword">
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="control-label">จังหวัด</label>
                            <select class="form-control" v-on:change="provinceChange" v-model="form.province"
                                    name="user[user_province]">
                                <option value="0">กรุณาเลือก</option>
                                <option v-for="option in provinces"
                                        v-bind:value="option.PROVINCE_ID">@{{ option.PROVINCE_NAME }}</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="control-label">อำเภอ</label>
                            <select class="form-control" v-on:change="amphurChange" v-model="form.amphur"
                                    name="user[user_amphur]">
                                <option value="0">กรุณาเลือก</option>
                                <option v-for="option in amphurs"
                                        v-bind:value="option.AMPHUR_ID">@{{ option.AMPHUR_NAME }}</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="control-label">ตำบล</label>
                            <select class="form-control" name="user[user_district]" v-model="form.district">
                                <option value="0">กรุณาเลือก</option>
                                <option v-for="option in districts"
                                        v-bind:value="option.DISTRICT_ID">@{{ option.DISTRICT_NAME }}</option>
                            </select>
                        </div>

                        <div class="col-lg-12">
                            <button class="btn btn-primary" type="button" v-on:click="search()">
                                ค้นหา
                            </button>

                            <button class="btn btn-default" type="button" v-on:click="resetSearch()">
                                ล้างข้อมูล
                            </button>
                        </div>

                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                    <tr>

                        <th>ชื่อ - นามสกุล</th>
                        <th>จังหวัด</th>
                        <th>อำเภอ</th>
                        <th>ตำบล</th>
                        <th class="hidden-md">เวลา</th>
                        <th class="col-md-4 col-lg-3 text-center">การจัดการ</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="owner in farmOwners">

                        <td>@{{ owner.first_name }} @{{ owner.last_name }}</td>
                        <td>@{{ owner.province_name}}</td>
                        <td>@{{ owner.amphur_name}}</td>
                        <td>@{{ owner.district_name}}</td>
                        <td class="hidden-md">@{{ owner.updated_at }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="/admin/questionaire/@{{owner.id}}/export" target="_blank"
                                   class="btn btn-success">ส่งออก</a>

                                <a v-bind:class="{'disabled' : cannotEdit(owner) }"
                                   href="/admin/questionaire/@{{owner.id}}/edit" class="btn btn-info">แก้ไข</a>

                                <a
                                        v-bind:class="{'disabled' : cannotEdit(owner) }"
                                        v-on:click="deleteFarmOwner(owner)"
                                        class="btn btn-danger">ลบ
                                </a>
                            </div>

                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">
                            <div>
                                จำนวนทั้งหมด @{{ farmOwnerPage.total }} รายการ
                            </div>
                            <ul class="pagination">
                                <li v-bind:class="{ 'active' : (farmOwnerPage.current_page == n+1) }"
                                    v-for="n in farmOwnerPage.last_page ">
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
@endsection


@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {
                provinces: {},
                amphurs: {},
                districts: {},

                user_id: 0,
                user_is_admin: 0,
                admin_level: 0,

                farmOwners: [],
                farmOwnerPage: {},
                form: {
                    keyword: "",
                    province: 0,
                    amphur: 0,
                    district: 0,
                    page: "",
                }
            },
            methods: {
                cannotEdit: function (owner) {

                    var p = $("#province").attr('value')
                    var a = $("#amphur").attr('value')
                    var d = $("#district").attr('value')


                    if (this.admin_level == 'admin') return false;
                    if (this.admin_level == 'user_province' && p == owner.house_province) return false;
                    if (this.admin_level == 'user_amphur' && a == owner.house_amphur) return false;
                    if (this.admin_level == 'user_district' && d == owner.house_district) return false;

                    return true;
                },
                provinceChange: function () {
                    this.form.amphur = 0
                    this.form.district = 0;
                    if (this.form.province != 0) {
                        this.$http.get('/api/thailand/province/' + this.form.province + "/amphure").then(function (r) {
                            this.amphurs = r.data;
                        })
                    }

                },

                amphurChange: function () {
                    this.form.district = 0;
                    if (this.form.amphur != 0) {
                        this.$http.get('/api/thailand/province/' + this.form.province + "/amphure/" + this.form.amphur + "/district").then(
                                function (r) {
                                    this.districts = r.data;
                                })
                    }

                },
                deleteFarmOwner: function (owner) {
                    if(!this.cannotEdit(owner)){
                        var id = owner.id
                        if (confirm("คุณต้องการลบข้อมูลเกษตกรรายนี้หรือไม่?")) {
                            this.$http.delete('/api/farm-owner/' + id).then(function (response) {
                                this.search();
                            })
                        }
                    }

                },
                resetSearch: function () {

                    this.form = {
                        keyword: "",
                        province: 0,
                        amphur: 0,
                        district: 0,
                        page: "",
                    }
                    this.search();

                },
                search: function () {
                    this.$http.get('/api/farm-owner', {params: this.form}).then(
                            function (response) {

                                this.farmOwnerPage = response.data;
                                this.farmOwners = this.farmOwnerPage.data;
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
                var self = this;

                this.user_id = $("#user_id").attr('value')
                this.user_is_admin = $("#user_is_admin").attr('value')

                this.form.province = $("#province").attr('value')
                this.form.amphur = $("#amphur").attr('value')
                this.form.district = $("#district").attr('value')

                this.admin_level = $("#admin_level").attr('value')


                self.$http.get("/api/thailand/province").then(function (response) {
                    self.provinces = response.data;

                    if (self.form.province != 0) {
                        this.$http.get('/api/thailand/province/' + self.form.province + "/amphure").then(function (r) {
                            this.amphurs = r.data;

                            if (self.form.amphur != 0) {
                                this.$http.get('/api/thailand/province/' + self.form.province + "/amphure/" + self.form.amphur + "/district"
                                ).then(function (r) {
                                    this.districts = r.data;
                                })
                            }

                        })
                    }

                });
                this.search();
            }
        })
    </script>
@endsection
