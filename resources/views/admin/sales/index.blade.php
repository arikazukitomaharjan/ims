<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 6/9/16
     * Time: 9:54 AM
     */
?>
@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{('dashboard')}}">Dashboard</a></li>
        <li><a href="{{('sale')}}">Report</a></li>
    </ol>

    <div class="row" data-ng-controller="saleCtrl" data-ng-init="init()" st-table="displayedCollection"
         st-safe-src="sales" st-group="groupKey">
        <div class="col-md-12">
            <div class="main-block">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h3 class="panel-title">Report<span style="float:right;"><a href="#"
                                                                                    title="Add New"
                                                                                    data-ng-click="popupAddProduct()"
                                                                                    data-target="#addProduct"><span
                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></h3>
                    </div>
                    <div class="row" style="margin:20px;">
                        <div class="col-md-1">
                            <input class="input-sm form-control" name="items" id="items" type="number"
                                   data-ng-model="itemsByPage">
                        </div>

                        <div class="col-md-6">
                            <form class="form-horizontal" role="form"
                            >
                                {{--{{ csrf_field() }}--}}
                                <input name="from" data-ng-model="from" type="text" class="datepicker"
                                       placeholder="from"
                                        {{--style="width: 120px !important;"--}}/>
                                <input name="to" data-ng-model="to" type="text" class="datepicker"
                                       placeholder="to"
                                        {{--style="width: 120px !important;"--}}/>
                                <input name="search" type="submit" value="Search" ng-click="dateRange(from,to)"/>
                            </form>
                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-3">
                            <input st-search placeholder="search" class="input-sm form-control"
                                   type="search"/>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 25px" data-ng-hide="saleDateRanges">
                        <div class="table-responsive">
                            <table class="table table-hover" id="bootstrap-table">
                                <thead>
                                <tr class="no-hover">
                                    <th class="table-header-check">S.N</th>
                                    <th class="table-header-repeat line-left minwidth-1">Name</th>
                                    <th class="table-header-repeat line-left">Information</th>
                                    <th class="table-header-repeat line-left align-right">Quantity</th>
                                    <th class="table-header-repeat line-left minwidth-1 align-right">Cost/Qty</th>
                                    <th class="table-header-repeat line-left align-right">Sale/Qty</th>
                                    <th class="table-header-repeat line-left align-right">Sale price</th>

                                    <th class="table-header-repeat line-left minwidth-1">Sales Date</th>
                                    <th class="table-header-repeat line-left minwidth-1">Option</th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr data-ng-repeat="row in displayedCollection">
                                    <td><% $index+1 %></td>
                                    <td><%row.name%></td>
                                    <td><%row.information%></td>
                                    <td><%row.quantity%></td>

                                    <td><% cost_per_quantity=(row.cost_price/row.quantity)%></td>
                                    <td><% sale_per_quantity=(row.sale_price/row.quantity)%></td>
                                    <td><%row.sale_price%></td>
                                    {{--<td><%row.category_id%></td>--}}
                                    <td><%row.sale_datetime%></td>
                                    <td><a href="#" data-ng-click="popupDelete(row.id)" class="btn btn-danger btn-xs"
                                           data-target="#deleteProduct">Delete <span
                                                    class="glyphicon glyphicon-trash"></span></a></td>

                                </tr>
                                <td>


                                </td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    Total Sale Price: <% totalsale_price %>
                                </td>
                                <td>
                                    Total Expense: <% totalexpenses %>
                                </td>
                                <td>
                                    Total Cost Price: <% totalcost_price %>
                                </td>
                                <td>
                                    {{--   <% if(totalsale_price > totalcost_price)%>
                                        <% profit%>
                                        <% if(totalsale_price < totalcost_price)%>
                                        <% loss%>--}}

                                    <% totalsale_price > totalcost_price ? profit + profitAmount:
                                    loss + lossAmount%>
                                </td>


                                <tr>
                                    <center>

                                        <div st-pagination="" st-items-by-page="itemsByPage"
                                             st-displayed-pages="7"></div>

                                    </center>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 25px" data-ng-show="saleDateRanges">
                        <div class="table-responsive">
                            <table class="table table-hover" id="bootstrap-table">
                                <thead>
                                <tr class="no-hover">
                                    <th class="table-header-check">S.N</th>
                                    <th class="table-header-repeat line-left minwidth-1">Name</th>
                                    <th class="table-header-repeat line-left">Information</th>
                                    <th class="table-header-repeat line-left align-right">Quantity</th>
                                    <th class="table-header-repeat line-left minwidth-1 align-right">Cost/Qty</th>
                                    <th class="table-header-repeat line-left align-right">Sale/Qty</th>
                                    <th class="table-header-repeat line-left align-right">Sale price</th>

                                    <th class="table-header-repeat line-left minwidth-1">Sales Date</th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr data-ng-repeat="row in displayedCollection">
                                    <td><% $index+1 %></td>
                                    <td><%row.name%></td>
                                    <td><%row.information%></td>
                                    <td><%row.quantity%></td>

                                    <td><% cost_per_quantity=(row.cost_price/row.quantity)%></td>
                                    <td><% sale_per_quantity=(row.sale_price/row.quantity)%></td>
                                    <td><%row.sale_price%></td>
                                    {{--<td><%row.category_id%></td>--}}
                                    <td><%row.sale_datetime%></td>
                                    <td><a href="#" data-ng-click="popupDelete(row.id)" class="btn btn-danger btn-xs"
                                           data-target="#deleteProduct">Delete <span
                                                    class="glyphicon glyphicon-trash"></span></a></td>

                                </tr>
                                <td>


                                </td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    Total Sale Price: <% totalsale_price %>
                                </td>
                                <td>
                                    Total Expense: <% totalexpenses %>
                                </td>
                                <td>
                                    Total Cost Price: <% totalcost_price %>
                                </td>
                                <td>
                                    {{--   <% if(totalsale_price > totalcost_price)%>
                                        <% profit%>
                                        <% if(totalsale_price < totalcost_price)%>
                                        <% loss%>--}}

                                    <% totalsale_price > totalcost_price ? profit + profitAmount:
                                    loss + lossAmount%>
                                </td>


                                <tr>
                                    <center>

                                        <div st-pagination="" st-items-by-page="itemsByPage"
                                             st-displayed-pages="7"></div>

                                    </center>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        {{--delete modal--}}
        <div class="modal fade" id="deleteProduct" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Product</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                        <input type="hidden" id="deleteId" name="id">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" data-ng-click="deleteSale()">
                            Delete
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>




@endsection