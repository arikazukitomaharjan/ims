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
        <li><a href="{{('product')}}">Product</a></li>
    </ol>

    <div class="row" data-ng-controller="productCtrl" data-ng-init="init()" st-table="displayedCollection"
         st-safe-src="products">
        <div class="col-md-12">
            <div class="main-block">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h3 class="panel-title">Product<span style="float:right;"><a href="#"
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

                        <div class="col-md-3">


                            <select st-search="category.name" st-input-event="change" st-delay=0 name="category_id"
                                    ng-model="input.category_id" class="select form-control"
                                    ng-options="category.id as category.name for category in categories"
                                    ng-change="change(input)" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-4">

                            <st-date-range predicate="date_added" before="query.from"
                                           after="query.to"></st-date-range>
                            <form>
                                <input name="from" data-ng-model="input.from" type="text" class="datepicker"
                                       ng-click="openBefore($event)"
                                       placeholder="from"
                                       style="width: 120px !important;"/>
                                <input name="to" data-ng-model="input.to" type="text" class="datepicker"
                                       placeholder="to" ng-click="openAfter($event)"
                                       style="width: 120px !important;"/>

                        </div>

                        <div class="col-md-3">
                            <input st-search placeholder="search" class="input-sm form-control"
                                   type="search"/>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 25px">
                        <div class="table-responsive">
                            <table class="table table-hover" id="bootstrap-table">
                                <thead>
                                <tr>

                                    <th class="table-header-check">S.N</th>
                                    <th class="table-header-repeat line-left minwidth-1">Name</th>
                                    <th class="table-header-repeat line-left">Information</th>
                                    <th class="table-header-repeat line-left">Total Qty</th>
                                    <th class="table-header-repeat line-left">Rem. Qty</th>
                                    <th class="table-header-repeat line-left minwidth-1 align-right">Cost Price</th>
                                    {{--<th class="table-header-repeat line-left align-right">MRP</th>--}}
                                    <th class="table-header-repeat line-left minwidth-1 align-right">SOLD QTY</th>
                                    <th class="table-header-repeat line-left minwidth-1">Date Added</th>
                                    <th class="table-header-options line-left">Options</th>


                                </tr>
                                </thead>
                                <tbody>

                                <tr data-ng-repeat="row in displayedCollection">
                                    <td><% $index+1 %></td>
                                    <td><%row.name%></td>
                                    <td><%row.information%></td>
                                    <td><%row.stock + row.sold_quantity%></td>
                                    <td><%row.stock%></td>
                                    <td><%row.cost_price%></td>

                                    <td>
                                        <%row.sold_quantity%>
                                    </td>

                                    {{--<td><%row.category_id%></td>--}}
                                    <td><%row.date_added%></td>

                                    <td>
                                        {{--<button type="button" data-ng-click="edit(row.id)" title="edit">edit</button>--}}
                                        <a href="#"
                                           data-ng-click="popup(row.id,row.name,row.information,row.stock,row.cost_price,row.MRP,row.date_added)"
                                           class="btn btn-primary btn-xs"
                                           data-target="#editProduct">Edit
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="#" data-ng-click="popupDelete(row.id)" class="btn btn-danger btn-xs"
                                           data-target="#deleteProduct">Delete <span
                                                    class="glyphicon glyphicon-trash"></span></a>
                                        <a href="#"
                                           data-ng-click="popupSales(row.id,row.name,row.MRP,row.stock,row.cost_price)"
                                           class="btn btn-primary btn-xs"
                                           data-target="#saleProduct">Sale</a>

                                    </td>


                                </tr>
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


                    {{--modal code--}}


                    {{--add product modal--}}
                    <div class="modal fade" id="addProduct" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Product</h4>
                                </div>
                                <div class="modal-body">
                                    <form name="forms" class="form-validation  userForm">

                                        <div class="form-group">
                                            <label><b>Name</b></label>
                                            <input type="text" name="name" data-ng-model="input.name"
                                                   required="required" placeholder="Name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><b>Information</b></label>
                                            <input type="text" name="information" data-ng-model="input.information"
                                                   placeholder="Information" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><b>Stock</b></label>
                                            <input type="text" name="stock" data-ng-model="input.stock"
                                                   required="required" placeholder="Quantity" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><b>Cost Price</b></label>
                                            <input type="text" name="cost_price" data-ng-model="input.cost_price"
                                                   placeholder="Cost Price" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><b>MarkPrice</b></label>
                                            <input type="text" name="MRP" data-ng-model="input.MRP"
                                                   required="required" placeholder="Mark Price" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><b>Category</b></label>
                                            <select name="category_id" ng-model="input.category_id"
                                                    class="select form-control"
                                                    ng-options="category.id as category.name for category in categories">
                                            </select>
                                        </div>
                                        {{--<select name="category_id" id="category_id" ng-model="input.category_id">
                                            <option ng-repeat="category in categories"
                                                    value="<%category.id%>"><%category.name%>
                                            </option>

                                        </select>--}}


                                        {{--category: <%input.category_id%>--}}
                                        {{-- {!! Form::text(
                                             'date_added',
                                             date('Y-m-d'),
                                             array('class'=>'form-control')
                                         ) !!}--}}
                                        <div class="form-group">
                                            <label><b>Date</b></label>
                                            <input type="date" name="date_added"
                                                   class="form-control" data-ng-model="date_added"
                                            >
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" ng-disabled="forms.$invalid"
                                            data-ng-click="addProduct(input)">
                                        Add
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--edit model--}}

                    <div class="modal fade" id="editProduct" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Category</h4>
                                </div>
                                <div class="modal-body">
                                    <form name="forms" class="form-validation">
                                        <div class="form-group">
                                            <div class="form-group">

                                                <input type="hidden" name="id" data-ng-modal="id"
                                                       placeholder="id" id="showId" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Name</b></label>
                                                <input
                                                        type="text" name="name" data-ng-modal="name"
                                                        required="required" placeholder="Name" id="showName"
                                                        class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label><b>Information</b></label>
                                                <input type="text" name="information" data-na-modal="information"
                                                       placeholder="Information" id="showInformation"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Stock</b></label>
                                                <input type="number" name="stock" data-ng-model="stock"
                                                       placeholder="Quantity" class="form-control"
                                                       id="showStock">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Cost Price</b></label>
                                                <input type="number" name="cost_price" data-ng-model="cost_price"
                                                       placeholder="Cost Price" class="form-control"
                                                       id="showCost_price">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Mark Price</b></label>
                                                <input type="number" name="MRP" data-ng-model="MRP"
                                                       placeholder="Mark Price" class="form-control"
                                                       id="showMRP">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Date</b></label>
                                                <input type="date" name="date_added" id="showDate_added"
                                                       class="form-control" data-ng-model="date_added"
                                                >
                                            </div>

                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" ng-disabled="forms.$invalid"
                                            data-ng-click="editProduct()">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                                    <button class="btn btn-info" data-ng-click="deleteProduct()">
                                        Delete
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>


                    {{--sale modal--}}
                    <div class="modal fade" id="saleProduct" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Sale Product</h4>
                                </div>
                                <div class="modal-body">
                                    <center>
                                        <input type="hidden" ng-model="productID">
                                        <label> Name : </label><%productName %> <br>
                                        {{--            <label> MRP : </label><span data-ng-show="hideMRP"><% productMRP %></span><span
                                                            data-ng-hide="hideMRP"><% total_sales_price %></span><br>--}}
                                        <label> MRP : </label><% productMRP %>
                                        <span ng-hide="hideAlways"><% total_cost_price %></span> <br>
                                        <label> Stock : </label><%productStock %> <br>
                                        <label> Total Sale Price :</label> <span ng-if="!quantity"> 0 </span> <%
                                        sale_price %> <br>


                                    </center>
                                    <form name="forms" class="form-validation">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label><b>Name</b></label>
                                                <input type="number" name="quantity" data-ng-model="quantity"

                                                       placeholder="Quantity" class="form-control" data-placeholder="0">

                                            </div>
                                            <div class="form-group">
                                                <label><b>Sale Price</b></label>
                                                <input type="number" name="price" data-ng-model="price"
                                                       data-ng-keyup="totalSale(price)"
                                                       placeholder="Price" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Sale Price</b></label><input type="text"
                                                                                       name="sale_price"
                                                                                       data-ng-model="sale_price"
                                                                                       placeholder="Sale Price"
                                                                                       class="form-control">
                                            </div>
                                            {{--<div id="userid">{!! Auth::user()->id !!}</div>--}}
                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" data-ng-click="saleProduct()">
                                        Sale
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                    {{--end modal--}}


                </div>
            </div>
        </div>
    </div>




@endsection