@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$course->code}} - {{$course->name}}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.error')
        </div>
    </div>
    <div class="row" id="user-profile-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Homework
                </div>
                <div class="panel-body">
                    <form method="post"
                          action="{{action("Admin\\CourseHomeworkController@doEdit",['id'=>$course->id,'hid'=>$homework->id])}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Title</label>
                            <input value="{{$homework->title}}" type="year"
                                   name="homework[title]"
                                   class="form-control" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control"
                                      name="homework[description]">{{$homework->description}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                        <a class="btn btn-default"
                           href="{{action("Admin\\CourseController@view",['id'=>$course->id])}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
@endsection