<!DOCTYPE html>
<html>
<head>
    <meta id="token" name="token" content="{{ csrf_token() }}">
    @if(Auth::user())
        <meta id="user_id" name="user[id]" value="{{Auth::user()->id}}">
        <meta id="user_is_admin" name="user[isAdmin]" value="{{Auth::user()->isAdmin()}}">
        @if(Auth::user()->isAdmin())
            <meta id="admin_level" value="admin">
            <meta id="province" value="0">
            <meta id="amphur" value="0">
            <meta id="district" value="0">
        @elseif(Auth::user()->hasRole('user_province'))
            <meta id="admin_level" value="user_province">
            <meta id="province" value="{{Auth::user()->user_province}}">
            <meta id="amphur" value="0">
            <meta id="district" value="0">
        @elseif(Auth::user()->hasRole('user_amphur'))
            <meta id="admin_level" value="user_amphur">
            <meta id="province" value="{{Auth::user()->user_province}}">
            <meta id="amphur" value="{{Auth::user()->user_amphur}}">
            <meta id="district" value="0">
        @elseif(Auth::user()->hasRole('user_district'))
            <meta id="admin_level" value="user_district">
            <meta id="province" value="{{Auth::user()->user_province}}">
            <meta id="amphur" value="{{Auth::user()->user_amphur}}">
            <meta id="district" value="{{Auth::user()->user_district}}">
        @endif
    @endif
    <title>Cattle MIS</title>
    <link rel="stylesheet" href="{{asset("css/vendor.sass.css")}}">
    <link rel="stylesheet" href="{{asset("css/vendor.sass.css")}}">
    <link rel="stylesheet" href="{{asset("css/vendor.style.css")}}">

    <link rel="stylesheet" href="{{asset("css/app.css")}}">


    <link href='{{asset("/css/vendor.print.style.css")}}' rel='stylesheet' media='print'/>


    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body v-cloak>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-cattle navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url("/")}}/admin">Cattle Management Information System</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{url("/")}}/admin/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{url("/")}}/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li class="sidebar-search">


                        <!-- /input-group -->
                    </li>
                    <li class="sidebar-search">
                        ยินดีต้อนรับ, {{Auth::user()->firstname}} {{Auth::user()->lastname}}
                    </li>
                    <li>
                        <a href="{{url("/")}}/admin#"><i class="fa fa-dashboard fa-fw"></i> หน้าหลัก</a>
                    </li>

                    <li>
                        <a href="{{url("/")}}/admin/questionaire/add"><i class="fa fa-plus fa-fw"></i>
                            บันทึกข้อมูลเกษตรกรใหม่</a>
                    </li>

                    <li>
                        <a href="{{url("/")}}/admin/questionaire/search"><i class="fa fa-search fa-fw"></i>
                            ค้นหาข้อมูลเกษตรกร</a>
                    </li>
                    <li>
                        <a href="{{url("/")}}/admin/charts/menuchart"><i class="fa fa-bar-chart-o fa-fw"></i>
                            แผนภูมิรายงาน</a>

                    </li>

                    <li>
                        <a href="{{asset("file/questionaire.pdf")}}"><i class="fa fa-file-text-o fa-fw"></i> ดาวน์โหลดแบบสอบถาม</a>
                    </li>


                    @if(Auth::user() && Auth::user()->isAdmin())
                        <li>
                            <a href="{{url("/")}}/admin/user"><i class="fa fa-user fa-fw"></i> จัดการข้อมูลผู้ใช้</a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class=col-lg-12">
                <template v-for="error in formError">
                    <alert type="danger" dismissable>
                        @{{error}}
                    </alert>
                </template>
            </div>
            @section('spinner')
                <div class="col-lg-12">
                    @yield('page-wrapper')
                    <spinner id="spinner-box" :size="lg" :fixed="spinnerFixed" text="Loading..."></spinner>
                </div>
            @show
        </div>


    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="{{asset("/js/vendor.js")}}"></script>

<script type="text/javascript">

    window.root_url = Vue.http.options.root = '{{url("/")}}';
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

    Vue.filter('ln2br', function (str) {
        var breakTag = '<br/>';
        return (str + '').replace(/\n/g, "<br>");
    })

    var AdminApp = Vue.extend({
        el: "body",
        data: function () {
            return {
                currentUser: {},
                ajaxCount: 0,
                spinnerFixed: true,
                formError: {},
            }

        },
        components: {
            tabs: VueStrap.tabset,
            tab: VueStrap.tab,
            accordion: VueStrap.accordion,
            panel: VueStrap.panel,
            'my-select': VueStrap.select,
            'my-option': VueStrap.option,
            affix: VueStrap.affix,
            spinner: VueStrap.spinner,
            alert: VueStrap.alert,
        },
        methods: {},
        ready: function () {
            this.show = true;

        },
    });

</script>


@section('javascript')
    <script type="text/javascript">

        var app = new AdminApp({
            el: 'body'
        })
    </script>
@show

<script>


    Vue.http.interceptors.push(
        function (request, next) {

            if (app.ajaxCount == 0) {
                app.$broadcast("show::spinner")
            }
            app.ajaxCount++;

            next((response) => {

                app.ajaxCount--;
                if (app.ajaxCount == 0) {
                    app.$broadcast("hide::spinner")
                }

            });
        })

</script>
</body>
</html>