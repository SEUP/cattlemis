@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">บันทึกข้อมูลเกษตรกรใหม่</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">

            <form>
                <div class="form-group" v-bind:class="{ 'has-error': error.firstname }">
                    <label>ชื่อ</label>
                    <input type="text" class="form-control" v-model="questionair.firstname">
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error.lastname }">
                    <label>นามสกุล</label>
                    <input type="text" class="form-control" v-model="questionair.lastname">
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error.person_id }">
                    <label>เลขบัตรประจำตัวประชาชน</label>
                    <input type="text" class="form-control" v-model="questionair.person_id">
                </div>
            </form>
            <form class="form form-inline">
                <fieldset>
                    <legend>พ่อพันธ์โคเนื้อที่เลี้ยง</legend>
                    <div class="form-group">
                        <label>พันธุ์</label>
                        <input type="text" class="form-control" v-model="twopointfive.type">
                    </div>
                    <div class="form-group">
                        <label>แหล่งที่มา</label>
                        <input type="text" class="form-control" v-model="twopointfive.source">
                    </div>
                    <div class="form-group">
                        <label>จำนวน</label>
                        <input type="text" class="form-control" v-model="twopointfive.amount">
                    </div>
                    <div class="form-group">
                        <label>ราคา</label>
                        <input type="text" class="form-control" v-model="twopointfive.price">
                    </div>
                    <button type="button" v-on:click="twopointfive_add()">Add</button>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>พันธ์</th>
                            <th>แหล่งที่มา</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in questionair.twopointfive">
                            <td>@{{ item.type }}</td>
                            <td>@{{ item.source }}</td>
                            <td>@{{ item.amount }}</td>
                            <td>@{{ item.price }}</td>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>


                <button type="button" v-on:click="save()" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">

        var app = new AdminApp({
            el: 'body',
            data: {
                questionair: {
                    twopointfive : [],
                },
                error: {},
                currentUser: {},
                twopointfive: {}
            },
            methods: {
                save: function () {
                    console.log('do posting to /api/questionair')
                    this.error = {}
                    this.$http({
                        url: "/api/questionair",
                        method: "post",
                        data: this.questionair
                    }).success(function (response) {
                        console.log(response)
                    }).error(function (error) {
                        this.error = error
                    })
                },
                twopointfive_add : function(){
                    if (!this.questionair.twopointfive){
                        this.questionair.twopointfive = [];
                    }
                    this.questionair.twopointfive.push(this.twopointfive);
                    this.twopointfive = {}
                }
            },
            ready: function () {
                console.log('questionair app ready')
                this.loadCurrentUser().success(function (r) {
                    this.currentUser = r;
                })
            }
        })

    </script>
@endsection