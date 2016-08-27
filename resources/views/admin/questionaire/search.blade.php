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
            <div class="form-group" style="padding-bottom: 1em;">
                <label for="search">ค้นหา</label>

                <div class="input-group">
                    <input type="text" v-on:keyup.13="search()" class="form-control"
                           placeholder="ค้นหา : ชื่อ นามสกุล รหัสประจำตัวประชาชน หรือ จังหวัด"
                           v-model="form.keyword">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" v-on:click="search()">ค้นหา</button>
                </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th class="col-md-3">รหัสประจำตัวประชาชน</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>จังหวัด</th>
                        <th class="hidden-md">เวลา</th>
                        <th class="col-md-4 col-lg-3 text-center">การจัดการ</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="owner in farmOwners">
                        <td>@{{ owner.person_id }}</td>
                        <td>@{{ owner.first_name }} @{{ owner.last_name }}</td>
                        <td>@{{ owner.province_name}}</td>
                        <td class="hidden-md">@{{ owner.updated_at }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="/admin/questionaire/@{{owner.id}}/export" target="_blank"
                                   class="btn btn-success">ส่งออก</a>
                                <a href="/admin/questionaire/@{{owner.id}}/edit" class="btn btn-info">แก้ไข</a>
                                <button v-on:click="deleteFarmOwner(owner.id)"
                                        class="btn btn-danger">ลบ
                                </button>
                            </div>

                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5">
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
                farmOwners: [],
                farmOwnerPage: {},
                form: {
                    keyword: "",
                    page: "",
                }
            },
            methods: {
                deleteFarmOwner: function (id) {
                    console.log(id)
                    if (confirm("คุณต้องการลบข้อมูลเกษตกรรายนี้หรือไม่?")) {
                        this.$http.delete('/api/farm-owner/' + id).then(function (response) {
                            this.search();
                        })
                    }
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
            created: function () {
                this.search();
            }
        })
    </script>
@endsection
