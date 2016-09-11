@extends('public.layout')

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

                        <div class="form-group col-lg-6" style="padding-bottom: 1em;">

                            <label for="search">ค้นหา</label>

                            <input type="text" v-on:keyup.13="search()" class="form-control"
                                   placeholder="ค้นหา : ชื่อ นามสกุล รหัสประจำตัวประชาชน"
                                   v-model="form.keyword">
                        </div>

                        <div class="form-group col-lg-6" style="padding-bottom: 1em;">

                            <label for="search">ประเภทโคที่เลี้ยง</label>

                            <select id="breeding" class="form-control" v-on:change="" v-model="form.breeding"
                                    name="user[breeding]">
                                <option value="0">กรุณาเลือก</option>
                                <template v-for="option in breedings">
                                    <option
                                            v-bind:value="option.id">@{{ option.choice  }}</option>
                                    <template v-for="opt2 in option.children">
                                        <option
                                                v-bind:value="opt2.id">
                                            @{{ option.choice  }} - @{{ opt2.choice  }}
                                        </option>

                                        <option v-for="opt3 in opt2.children"
                                                v-bind:value="opt3.id">
                                            @{{option.choice}} - @{{opt2.choice}} - @{{ opt3.choice  }}
                                        </option>
                                    </template>

                                </template>
                            </select>
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
                        <th class="col-md-2" v-show="form.breedChoice">จำนวน<br/>@{{ form.breedChoice }}</th>
                        <th>จังหวัด</th>
                        <th>อำเภอ</th>
                        <th>ตำบล</th>
                        <th class="hidden-md">เวลา</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="owner in farmOwners">

                        <td>@{{ owner.first_name }} @{{ owner.last_name }}</td>
                        <td v-show="form.breedChoice">@{{ owner.amount }}</td>
                        <td>@{{ owner.province_name}}</td>
                        <td>@{{ owner.amphur_name}}</td>
                        <td>@{{ owner.district_name}}</td>
                        <td class="hidden-md">@{{ owner.updated_at }}</td>

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
                breedings: {},
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
                    breeding: 0,
                    breedChoice: "",
                    page: "",
                }
            },
            methods: {

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
                    if (!this.cannotEdit(owner)) {
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
                        breeding: 0,
                        breedChoice: "",
                        page: "",
                    }
                    this.search();

                },
                getBreedingText: function () {
                    var breedingSel = $("#breeding")[0];
                    if (breedingSel.selectedIndex != 0) {
                        var opt = breedingSel.selectedOptions[0]
                        var text = $(opt).html();
                        return text.trim();
                    }
                    return null;
                },
                search: function () {
                    this.$http.get('/api/farm-owner', {params: this.form}).then(
                            function (response) {
                                this.farmOwnerPage = response.data;
                                this.farmOwners = this.farmOwnerPage.data;

                                this.form.breedChoice = this.getBreedingText();

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


                this.admin_level = $("#admin_level").attr('value')


                self.$http.get("/api/choice/master_breeding_types").then(function (response) {
                    self.breedings = response.data;
                })

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
