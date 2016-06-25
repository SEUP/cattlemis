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
                @foreach($farmOwners as $owner)
                    <tr>
                        <td>{{$owner->person_id}}</td>
                        <td>{{$owner->first_name}} {{$owner->last_name}} </td>
                        <td>
                            <a href="/admin/questionair/{{$owner->id}}/edit" class="btn btn-info">แก้ไข</a>
                            <button v-on:click="deleteFarmOwner({{$owner->id}})"
                                    class="btn btn-danger">ลบ
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: 'body',
            data: {},
            methods: {
                deleteFarmOwner: function (id) {
                    if (confirm("คุณต้องการลบข้อมูลเกษตกรรายนี้หรือไม่?")) {
                        this.$http.delete('/api/farm-owner/' + id).then(function (response) {
                            window.location.href = window.location.href;
                        })
                    }
                }
            },
            ready: function () {

            }
        })
    </script>
@endsection
