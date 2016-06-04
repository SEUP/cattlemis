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

                    <form method="post" action="/admin/calendar/{{$calendar->id}}/event/add">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Start</label>
                            <input value="{{old("event.start.date")}}" id="start-date" type="datetime"
                                   name="event[start]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>End</label>
                            <input value="{{old("event.end")}}" type="datetime"
                                   name="event[end]" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox"
                                              name="event[allday]">All Day</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>title</label>
                            <input value="{{old("event.title")}}" type="text"
                                   name="event[title]"
                                   class="form-control" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="event[description]" class="form-control"
                                      placeholder="Description">{{old('event.description')}}</textarea>

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
    <script>
        Date.parseDate = function (input, format) {
            return moment(input, format).toDate();
        };
        Date.prototype.dateFormat = function (format) {
            if (format == "H:i")
                return moment(this).format("HH:mm");
            return moment(this).format(format);
        };

        $("input[type=datetime]").datetimepicker({
            format: "YYYY-MM-DD HH:mm:00",
            defaultTime: '00:00',
        });
    </script>

@endsection