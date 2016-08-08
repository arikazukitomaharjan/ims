<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Management System</title>
    <LINK href="{{url('style/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" media="screen" title="default"/>
    <link href="{{url('css/jquery.fancybox.css')}}" type="text/css" rel="stylesheet" media="screen">



</head>
<body class="log-warp">
<div id="wrapper" style="background-image: {{url('images/grad-back.jpg')}}">
    <div class="container">
        <div id="login">
            <div class="box">
                <div class="logo">
                    <img src="{{url('images/logo.png')}}" alt="loginimage" width="100%">
                </div>


                <form method="POST" action="{{ url('/login') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="input-group form-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                              aria-hidden="true"></span></span>
                        <input type="email" name="email" type="text" value="{{ old('email') }}" class="form-control">
                    </div>
                    <div class="input-group form-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"
                                                              aria-hidden="true"></span></span>
                        <input name="password" id="password" type="password" class="form-control"/>

                    </div>


                    <input name="submit" type="submit" class="btn btn-warning" value="Login"/>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
{{--
<body class="log-warp">

<div id="wrapper" style="background-image: {{url('images/grad-back.jpg')}};">
    <div class="container">
        <div id="login">
            <div class="box">
                <div class="logo">
                    <img src="" alt="loginimage" width="100%">
                </div>
                <form role="form" method="POST" action="{{ url('/login') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"
                                                          aria-hidden="true"></span></span>
                    <input type="email" name="email" type="text" value="{{ old('email') }}" class="form-control">


                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"
                                                          aria-hidden="true"></span></span>
                    <input name="password" id="password" type="password" class="form-control"/>

                    <input name="btnLogin" type="submit" class="submit-login" value="Login"/>
                </form>
            </div>
        </div>
    </div>
</div>
</body>--}}
</html>

































