@extends('admin.layout')

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Calendar</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row" id="calendar-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Select Calendar
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <select class="form-control form" v-model="calendar" v-on:change="changeCalendar">
                                <option v-bind:value="null">Select Calendar</option>
                                <option v-for="calendar in listCalendars"
                                        v-bind:value="calendar">@{{calendar.name}}</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <a href="/admin/calendar/add" class="btn btn-default">Create New Calendar</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row" id="calendar-app" v-show="calendar != null">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @{{ calendar.name }}

                    <a href="/admin/calendar/@{{calendar.id}}/event/add" class="btn btn-default">Create Event</a>
                </div>
                <div class="panel-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <modal id="eventModal" :show.sync="showModal" :callback="test">
        <div slot="modal-header" class="modal-header">
            <h4 class="modal-title">Update Event</h4>
        </div>
        <div slot="modal-body" class="modal-body">
            <form method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Start</label>
                    <input v-model="event.start" id="start-date" type="datetime"
                           name="event[start]" class="form-control">
                </div>
                <div class="form-group">
                    <label>End</label>
                    <input v-model="event.end" type="datetime"
                           name="event[end]" class="form-control">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label><input v-model="event.allDay " type="checkbox"
                                      name="event[allday]">All Day</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>title</label>
                    <input v-model="event.title" type="text"
                           name="event[title]"
                           class="form-control" placeholder="name">
                </div>
                <div class="form-group">
                    <label>Description</label>
                            <textarea name="event[description]" class="form-control"
                                      placeholder="Description" v-model="event.description"></textarea>

                </div>
            </form>
        </div>
    </modal>
@endsection

@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: "body",
            ready: function () {
                this.getCalendars();

            },
            components: {
                modal: VueStrap.modal
            },
            data: {
                calendar: null,
                fullCalendar: null,
                listCalendars: [],
                showModal: false,
                event: null
            },
            methods: {
                test: function () {
                    this.showModal = false
                    this.$http({
                        url: "/api/user/" + this.user_id + "/calendar/" + this.calendar.id + "/event/" + this.event.id,
                        method: 'put',
                        data: this.event
                    }).success(function (r) {
                        //console.log(r);
                        this.fullCalendar.fullCalendar('rerenderEvents');
                    })
                },
                changeCalendar: function () {
                    //console.log(this.calendar);
                    setTimeout(this.initialFullCalendar, 0);
                },
                getCalendars: function () {
                    return this.$http.get('/api/user/' + this.user_id + '/calendar').success(function (r) {
                        this.listCalendars = r;
                    })
                },
                initialFullCalendar: function () {
                    this.fullCalendar = $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        editable: false,
                        eventLimit: false, // allow "more" link when too many events
                        events: '/api/user/' + this.user_id + '/calendar/' + this.calendar.id + '/event',

                        eventClick: function (calEvent, jsEvent, view) {

                            app.event = calEvent
                            app.showModal = true
                            //console.log(app.event)


                        }
                    });
                }
            }
        })
    </script>
@endsection