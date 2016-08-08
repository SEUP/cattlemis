var elixir = require('laravel-elixir');
elixir.config.css.sass.pluginOptions.precision = 10;
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


elixir(function (mix) {

    elixir.config.css.sass.pluginOptions.precision = 10;

    mix
    //js
        .copy('resources/assets/vendor/jquery/dist/jquery.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/datetimepicker/jquery.datetimepicker.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/fullcalendar/dist/fullcalendar.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/metisMenu/dist/metisMenu.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/startbootstrap-sb-admin-2-sass/dist/js/sb-admin-2.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/moment/moment.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/bootstrap-sass/assets/fonts', 'public/fonts')
        .copy('resources/assets/vendor/vue/dist/vue.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/vue-resource/dist/vue-resource.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/vue-strap/dist/vue-strap.min.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/highcharts/highcharts.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/highcharts/modules/map.src.js', 'resources/assets/js/vendor')
        .copy('resources/assets/vendor/highcharts/modules/drilldown.js', 'resources/assets/js/vendor')

        //font
        .copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts')

        //css
        .copy('resources/assets/vendor/metisMenu/dist/metisMenu.min.css', 'resources/assets/css/vendor')
        .copy('resources/assets/vendor/fullcalendar/dist/fullcalendar.min.css', 'resources/assets/css/vendor')
        .copy('resources/assets/vendor/fullcalendar/dist/fullcalendar.print.css', 'resources/assets/css/vendor')
        .copy('resources/assets/vendor/datetimepicker/jquery.datetimepicker.css', 'resources/assets/css/vendor')


    mix.sass('app.scss', 'public/css/vendor.sass.css');
    mix.less('app.less', 'public/css/vendor.less.css');
    mix.styles([
        'vendor/metisMenu.min.css',
        'vendor/fullcalendar.min.css',
        'vendor/jquery.datetimepicker.css'
    ], 'public/css/vendor.style.css')

    mix.styles([
        'vendor/fullcalendar.print.css'
    ], 'public/css/vendor.print.style.css')

    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/moment.js',
        'vendor/jquery.datetimepicker.min.js',
        'vendor/fullcalendar.min.js',
        'vendor/metisMenu.min.js',
        'vendor/bootstrap.min.js',
        'vendor/sb-admin-2.js',
        'vendor/vue.min.js',
        'vendor/vue-resource.min.js',
        'vendor/vue-strap.min.js',
        'vendor/highcharts.js',
        'vendor/map.src.js',
        'vendor/drilldown.js',

    ], 'public/js/vendor.js')
});

