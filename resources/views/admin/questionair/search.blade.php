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
            <table class="table ">
                <thead>
                <tr>
                    <th class="col-md-3">รหัสประจำตัวประชาชน</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th class="col-md-3">การจัดการ</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="owner in farmOwners">
                    <td>@{{ owner.person_id }}</td>
                    <td>@{{ owner.first_name }} @{{ owner.last_name }}</td>
                    <td>
                        <a href="/admin/questionair/@{{owner.id}}/edit" class="btn btn-info">แก้ไข</a>
                        <button v-on:click="deleteFarmOwner(owner.id)"
                                class="btn btn-danger">ลบ
                        </button>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">
                        <ul class="pagination">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                    </td>
                </tr>

                </tfoot>
            </table>
        </div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {
                farmOwners: [],
                farmOwnerPage : {}
            },
            methods: {
                deleteFarmOwner: function (id) {
                    console.log(id)
                    if (confirm("คุณต้องการลบข้อมูลเกษตกรรายนี้หรือไม่?")) {
                        this.$http.delete('/api/farm-owner/' + id).then(function (response) {
                            window.location.href = window.location.href;
                        })
                    }
                }
            },
            ready: function () {
                this.$http.get('/api/farm-owner').then(
                        function (response) {

                            this.farmOwnerPage = response.data;
                            this.farmOwners = this.farmOwnerPage.data;
                        },
                        function (error) {

                        }
                );
            }
        })
    </script>
@endsection
