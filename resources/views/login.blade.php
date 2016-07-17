<!DOCTYPE html>
<html>
<head>
    <title>Chaow Porkaew</title>

    <link rel="stylesheet" href="/css/vendor.sass.css">
    <link rel="stylesheet" href="/css/vendor.less.css">
    <link rel="stylesheet" href="/css/vendor.style.css">

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
                    <form role="form" method="post" action="/login" v-on:submit="login()">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" v-model="loginForm.email" name="login[email]" type="email"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" v-model="loginForm.password" name="login[password]"
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

<script src="/js/vendor.js"></script>
<script type="text/javascript">
    var app = new Vue({

        el : 'body',
        data : {
            loginForm : {}
        },
        methods : {
            login : function(){

            }
        },
        ready : function(){

        }


    })
</script>
</body>
</html>