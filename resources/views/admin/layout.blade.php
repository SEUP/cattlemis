<!DOCTYPE html>
<html>
<head>
    <meta id="token" name="token" content="{{ csrf_token() }}">

    <title>Cattle MIS</title>

    <link rel="stylesheet" href="/css/vendor.sass.css">
    <link rel="stylesheet" href="/css/vendor.less.css">
    <link rel="stylesheet" href="/css/vendor.style.css">
    <link href='/css/vendor.print.style.css' rel='stylesheet' media='print'/>

    <meta id="user_id" value="{{Auth::user()->id}}"/>

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
            <a class="navbar-brand" href="/admin">Cattle Management Information System</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="/admin/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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

                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li class="sidebar-search">
                        ยินดีต้อนรับ, {{Auth::user()->firstname}} {{Auth::user()->lastname}}
                    </li>
                    <li>
                        <a href="/admin#"><i class="fa fa-dashboard fa-fw"></i> หน้าหลัก</a>
                    </li>

                    <li>
                        <a href="/admin/questionair/add"><i class="fa fa-plus fa-fw"></i> บันทึกข้อมูลเกษตรกรใหม่</a>
                    </li>

                    <li>
                        <a href="/admin/questionair/search"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูลเกษตรกร</a>
                    </li>
                    <li>
                        <a href="/admin/#chart"><i class="fa fa-bar-chart-o fa-fw"></i> แผนภูมิรายงาน<span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="flot.html">จำนวนเกษตรกรแยกตามจังหวัด</a>
                            </li>
                            <li>
                                <a href="morris.html">จำนวนเกษตรกรแบ่งตามรายได้</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="/admin/user"><i class="fa fa-user fa-fw"></i> จัดการข้อมูลผู้ใช้</a>
                    </li>
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
<script src="/js/vendor.js"></script>

<script type="text/javascript">

    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

    var AdminApp = Vue.extend({
        el: "body",
        data: function () {
            return {
                currentUser: {},
                user_id: {},
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
        methods: {
            loadCurrentUser: function () {
                return this.$http({url: "/api/current_user", method: "get"}).then(function (r) {
                    this.currentUser = r;
                    //console.log(this.currentUser);
                })
            },
            getCurrentUser: function () {
                return this.currentUser;
            }
        },
        ready: function () {
            this.loadCurrentUser();
            this.user_id = $("#user_id").attr('value');
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

    Vue.http.interceptors.push(function (request, next) {

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

            }
    )

</script>
</body>
</html>