@extends('admin.layout')

@section('page-wrapper')

    <div class="row">
        <div class="col-lg-12">
            @include('admin.error')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$course->code}} - {{$course->name}}</h1>
        </div>
        <div class="col-lg-12">
            <h2>Course Description</h2>
            <pre>{{$course->description}}</pre>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Student List
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->students as $student)
                            <tr>
                                <td>{{$student->id}}</td>
                                <td>{{$student->firstname}} {{$student->lastname}}</td>
                                <td>
                                    Button
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="panel-footer">
                    xxx
                </div>
            </div>


        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Homework List
                </div>
                <div class="panel-body">
                    <a href="/admin/course/{{$course->id}}/homework/add" class="btn btn-default">Create Homework</a>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->homeworks as $homework)
                            <tr>
                                <td>{{$homework->id}}</td>
                                <td>{{$homework->title}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a href="/admin/course/{{$course->id}}/homework/{{$homework->id}}/edit"
                                           class="btn btn-default">Edit</a>
                                        <button v-on:click="deleteHomework({{$course->id}},{{$homework->id}})"
                                                type="button"
                                                class="btn btn-default">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>


@endsection

@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: "body",
            methods: {
                deleteHomework: function (courseid, id) {
                    if (confirm("Do you want to delete this homework")) {
                        window.location.href = "/admin/course/" + courseid + "/homework/" + id + "/delete";
                    }
                }
            },
            ready: function () {

            },
        })
    </script>

@endsection



