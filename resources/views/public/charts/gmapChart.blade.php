@extends('public.layout')

@section('page-wrapper')
    <input type="hidden" id="chartTitle" value="{{$title}}"/>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$title}}</h1>
                </div>
            </div>
            <div class="row" style="padding-bottom: 1em;">
                <div class="col-xs-12" style="">
                    <select class="form-control" v-on:change="provinceChange" v-model="selProvince">
                        <option value="0">กรุณาเลือกจังหวัด</option>
                        <option v-for="option in provinces"
                                v-bind:value="option.PROVINCE_ID">@{{ option.PROVINCE_NAME }}</option>
                    </select>
                </div>
            </div>
            <div class="row" style="height: 600px;">
                <div class="col-lg-12" style="height: 600px;">

                    <google-map style="width: 100%; height: 100%; position: absolute; left:0; top:0"
                                :center="{lat: 19.1378449, lng: 99.9138361}"
                                :zoom="8"
                    >

                        <marker v-for="m in chartData" :position.sync="m.position"
                                :title="m.title"
                                :clickable="true"
                                :draggable="true" @g-click="center=m.position">

                        <info-window :content="m.title" :opened="false"></info-window>

                        </marker>


                    </google-map>


                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-4" style="margin-top: 2em;">
            @include('share.chart_menu',["PREFIX"=>""])
        </div>
    </div>

@endsection


@section('javascript')
    <script src="/js/lodash.min.js"></script>

    <script type="text/javascript" src="/js/vue-google-maps/dist/vue-google-maps.js"></script>

    <script type="text/javascript">

        VueGoogleMap.load({
            'key': 'AIzaSyAA4xy46J4VXUz-MK2XLMtK6Eglw99H5Us',
        })

        var app = new AdminApp({
            el: 'body',
            components: {
                'google-map': VueGoogleMap.Map,
                'marker': VueGoogleMap.Marker,
                'info-window': VueGoogleMap.InfoWindow
            },
            data: {
                chartData: {},
                chartType: "",
                chartTitle: "",
                provinces: [],
                selProvince: 0,
            },
            methods: {
                provinceChange: function () {

                    this.$http.get('/chart/gmap/' + this.selProvince).then(function (r) {
                        data = r.data;
                        this.chartData = data;
                    });
                },

                loadData: function () {
                    this.$http.get("/api/thailand/province").then(function (response) {
                        this.provinces = response.data;
                    });

                    this.$http.get('/chart/gmap').then(function (r) {
                        data = r.data;
                        this.chartData = data;
                    });

                }
            },
            ready: function () {
                this.chartType = $("#chartType").val();
                this.chartTitle = $("#chartTitle").val();
                this.loadData();
            }
        })


    </script>
@endsection