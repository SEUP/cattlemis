@extends('admin.layout')

@section('page-wrapper')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Choice Management</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('share.error')
        </div>
    </div>
    <div class="row" id="user-management-app">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        var app = new AdminApp({
            el: "body",
            methods: {},
            ready: function () {
                console.log('choice app');
            },
        })
    </script>

@endsection

