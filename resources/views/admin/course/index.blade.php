@extends('admin.layout')

@section('page-wrapper')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Courses Management</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.error')
        </div>
    </div>
    <div class="row" id="course-management-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/admin/course/add" class="btn btn-default">Create Course</a>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course</th>
                            <th>Semester</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{$course->id}}</td>
                                <td>
                                    <a href="{{action("Admin\\CourseController@view",['id'=>$course->id])}}">{{ $course->code}}
                                        - {{ $course->name}}</a></td>
                                <td>{{ $course->semester }}</td>
                                <td>{{ $course->year }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a href="/admin/course/{{$course->id}}/edit" class="btn btn-default">Edit</a>
                                        <button v-on:click="deleteUser({{$course->id}})" type="button"
                                                class="btn btn-default">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        {!! $courses->links() !!}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        var CoursesIndexApp = new AdminApp({
            el: "body",
            methods: {
                deleteUser: function (id) {
                    if (confirm("Do you want to delete this course")) {
                        window.location.href = "/admin/course/" + id + "/delete";
                    }
                }
            },
            ready: function () {

            },
        })
    </script>

@endsection

