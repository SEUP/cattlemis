<!DOCTYPE html>
<html>
<head>
    <meta id="token" name="token" content="{{ csrf_token() }}">
    <title>Cattle MIS</title>

    <link rel="stylesheet" href="/css/vendor.sass.css">
    <link rel="stylesheet" href="/css/vendor.less.css">
    <link rel="stylesheet" href="/css/vendor.style.css">

    <link rel="stylesheet" href="/css/app.css">

    <meta id="admin_level" value="guest">
    <meta id="province" value="0">
    <meta id="amphur" value="0">
    <meta id="district" value="0">

    <link href='/css/vendor.print.style.css' rel='stylesheet' media='print'/>


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
        <ul class="nav navbar-top-links navbar-nav navbar-right">
            <!-- /.dropdown -->
            <li class="">
                <a href="/login">เข้าสู่ระบบ</a>
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
                        ยินดีต้อนรับ ผู้เยี่ยมชม
                    </li>
                    <li>
                        <a href="/"><i class="fa fa-dashboard fa-fw"></i> หน้าหลัก</a>
                    </li>
                    <li>
                        <a href="/questionaire/search"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูลเกษตรกร</a>
                    </li>
                    <li>
                        <a href="/charts/menuchart"><i class="fa fa-bar-chart-o fa-fw"></i> แผนภูมิรายงาน</a>

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

    Vue.filter('ln2br', function (str) {
        var breakTag = '<br/>';
        return (str + '').replace(/\n/g,"<br>");
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

            })
                ;
            })

</script>
</body>
</html>