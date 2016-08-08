<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/8/16
 * Time: 5:03 PM
 */
?>
<!-- start nav-right -->

<div id="head">
    <div class="container">
        <div class="logo">
            <a href="{{url('app/v1/dashboard')}}">
                <img src="{{url('images/logo.png')}}" width="100%">
            </a>
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
            <input type="texts" class="form-control" placeholder="Search here...">
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="navigation">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                </button>
            </div><!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{url('app/v1/dashboard')}}"><span class="glyphicon glyphicon-home"
                                                                                   aria-hidden="true"></span></a>
                    </li>
                    <li><a href="{{url('app/v1/category')}}">Category</a></li>
                    <li><a href="{{url('app/v1/product')}}">Product</a></li>
                    <li><a href="{{url('app/v1/sale')}}">Report</a></li>
                    <li><a href="{{url('app/v1/expense')}}">Expense</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"></a></li>

                    <li><a href="#"></a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><span class="glyphicon glyphicon-user"></span>My Account</a>

                        <ul class="dropdown-menu">
                            <li><a href="#">Change Password</a></li>
                            <li><a href="{{url('logout')}}">Log Out</a></li>


                        </ul>
                    </li>
                </ul>
                {{-- <li>
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <span class="caret"></span></a>

                     <ul class="dropdown-menu">
                         <li><a href="user-listing.php">List User</a></li>

                         <li><a href="form-user.php">Add New user</a></li>


                     </ul>
                 </li>
--}}

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>