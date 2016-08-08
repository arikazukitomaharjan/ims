<?php /**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/8/16
 * Time: 2:40 PM
 */ ?>
        <!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Management System</title>
    <LINK href="{{url('style/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="screen">

    <link rel="stylesheet" href="{{url('css/style.css')}}" type="text/css" media="screen" title="default"/>
    <link href="{{url('css/jquery.fancybox.css')}}" type="text/css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="{{asset('style/select2.min.css')}}" type="text/css"/>


</head>
<body data-ng-app="app">
<!-- Start: page-top-outer -->
<div id="wrapper">
    @include('../include/navigation')
    <div class="container">
        <div id="panel_box" class="super-admin">
            <div id="my-dash">
                <div id="chart">
                </div>
                <div id="control">
                </div>
            </div>
            <?= Lava::render('Dashboard', 'Donuts', 'my-dash'); ?>
            <a href="{{url('app/v1/product')}}"><span>
                    <img src="{{url('images/admin/inventory.png')}}"></span>
                <p>Inventory  <span style="font-size: 12px; color: darkred;">{{ $totalProduct }}</span></p>
            </a>
            <a href="{{url('app/v1/sale')}}"><span>
                <img src="{{url('images/admin/report.png')}}"></span>
                <p>Report <span style="font-size: 12px; color: darkred;">{{ $totalSale }}</span></p>
            </a><a href="{{url('app/v1/sale')}}"><span>
                <img src="{{url('images/admin/config.png')}}"></span>
                <p>Change Password</p>
            </a>

            <a href="{{url('app/v1/category')}}"><span>
                <img src="images/super-admin7.png"></span>
                <p>Category <span style="font-size: 12px; color: darkred;">{{ $totalCategory }}</span></p>
            </a>
            <div id="sales_div" style="min-height:500px; max-height:2000px;"></div>
            <?= Lava::render('CalendarChart', 'Sales', 'sales_div') ?>

            <div id="temps_div"></div>

            {{--@linechart('Temps', 'temps_div')--}}
        </div>
    </div>


    <!-- start footer -->
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


    <script src="{{url('script/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
    <script src="{{url('script/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('script/angular.min.js')}}" type="text/javascript"></script>
    <script src="{{url('script/angular-route.min.js')}}" type="text/javascript"></script>

    <script src="{{url('script/smart-table.min.js')}}" type="text/javascript"></script>
    <script src="{{url('angular/app.js')}}" type="text/javascript"></script>
    <script src="{{url('angular/product.js')}}" type="text/javascript"></script>
    <script src="{{url('angular/sale.js')}}" type="text/javascript"></script>
    <script src="{{url('angular/category.js')}}" type="text/javascript"></script>
    <script src="https://use.fontawesome.com/a1419c4bc3.js"></script>
    <script type="text/javascript" src="{{url('js/tcal.js')}}"></script>


</body>
</html>