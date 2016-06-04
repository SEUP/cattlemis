@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Course Management</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.error')
        </div>
    </div>
    <div class="row" id="user-edit-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User's Edit
                </div>
                <div class="panel-body">

                    <form method="post" action="/admin/course/{{$course->id}}/edit">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Year</label>
                            <input value="{{$course->year}}" type="year"
                                   name="course[year]"
                                   class="form-control" placeholder="Year">
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input value="{{$course->semester}}" type="number"
                                   name="course[semester]"
                                   class="form-control" placeholder="Semester">
                        </div>

                        <div class="form-group">
                            <label>Code</label>
                            <input value="{{$course->code}}" type="text"
                                   name="course[code]"
                                   class="form-control" placeholder="Code">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{$course->name}}" type="text"
                                   name="course[name]"
                                   class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control"
                                      name="course[description]">{{$course->description}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                        <a class="btn btn-default" href="/admin/course">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection