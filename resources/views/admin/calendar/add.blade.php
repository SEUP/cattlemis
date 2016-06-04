@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create New Calendar</h1>
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
                    New Calendar
                </div>
                <div class="panel-body">

                    <form method="post" action="/admin/calendar/add">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Name</label>
                            <input value="{{old("calendar.name")}}" type="text"
                                   name="calendar[name]"
                                   class="form-control" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="calendar[description]" class="form-control"
                                      placeholder="Description">{{old('calendar.description')}}</textarea>

                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>
                        <a class="btn btn-default" href="/admin/calendar">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
@endsection