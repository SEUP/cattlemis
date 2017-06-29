<!DOCTYPE html>
<html>
<head>
    <title>ระบบฐานข้อมูลเกษตรกรผู้เลี้ยงโคเนื้อ 4 จังหวัด</title>

    <link rel="stylesheet" href="{{asset("css/vendor.sass.css")}}">
    <link rel="stylesheet" href="{{asset("css/vendor.sass.css")}}">
    <link rel="stylesheet" href="{{asset("css/vendor.style.css")}}">

    <link rel="stylesheet" href="{{asset("css/app.css")}}">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <div class="login-panel panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" method="post" action="{{url('/')}}/login">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="login[email]" type="email"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="login[password]"
                                       type="password"
                                       value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            <hr/>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset("/js/vendor.js")}}"></script>
</body>
</html>