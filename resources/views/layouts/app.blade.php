<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Management System</title>
    <LINK href="{{url('style/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="screen">
    <LINK href="{{url('style/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" media="screen">

    <link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" media="screen" title="default"/>
    <link href="{{url('css/jquery.fancybox.css')}}" type="text/css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="{{asset('style/select2.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('style/tcal.css')}}" type="text/css"/>


</head>
<body data-ng-app="app">
<!-- Start: page-top-outer -->
<div id="wrapper">
    @include('../include/navigation')
    <div id="form">
        <div class="container">


            @yield('content')

        </div>
    </div>

    <div id="footer">
        <div class="container">
            <div class="pull-left">
                <p>&copy; Copyright Digital Agency Catmandu.</p>
            </div>

            <div class="pull-right">

                <p><a href="http://digitalagencycatmandu.com/" target="_blank"><img src="{{url('images/logo_dac.png')}}"
                                                                                    alt=""></a>&nbsp;www.digitalagencycatmandu.com
                </p>
            </div>

            <div class="clear"></div>
        </div>
    </div>

    <!-- end footer -->
</div>

<script src="{{url('script/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
<script src="{{url('script/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('script/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{url('script/select2.min.js')}}" type="text/javascript"></script>
<script src="{{url('script/angular.min.js')}}" type="text/javascript"></script>
<script src="{{url('script/angular-route.min.js')}}" type="text/javascript"></script>
<script src="{{url('script/smart-table.min.js')}}" type="text/javascript"></script>
<script src="{{url('angular/app.js')}}" type="text/javascript"></script>
<script src="{{url('angular/product.js')}}" type="text/javascript"></script>
<script src="{{url('angular/sale.js')}}" type="text/javascript"></script>
<script src="{{url('angular/category.js')}}" type="text/javascript"></script>
<script src="{{url('angular/expense.js')}}" type="text/javascript"></script>
<script src="https://use.fontawesome.com/a1419c4bc3.js"></script>
<script type="text/javascript" src="{{url('script/tcal.js')}}"></script>
<script type="text/javascript">
    $(function () {


        $(".select").select2({
            placeholder: '',
            theme: "classic",
            tokenSeparators: [',', ' '],
            tags: true
        });


        $('.datepicker').datepicker({format: 'yyyy-mm-dd'})


    });

</script>


</body>
</html>
