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
        <li><a href="{{('expense')}}">Expense</a></li>
    </ol>

    <div class="row" data-ng-controller="expenseCtrl" data-ng-init="init()" st-table="displayedCollection"
         st-safe-src="expenses">

        <div class="col-md-12">
            <div class="main-block">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h3 class="panel-title">Expense<span style="float:right;"><a href="#"
                                                                                     title="Add New"
                                                                                     data-toggle="modal"

                                                                                     data-target="#addExpense"><span
                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></h3>
                    </div>
                    <div class="row" style="margin:20px;">
                        <div class="col-md-1">
                            <input class="input-sm form-control" name="items" id="items" type="number"
                                   data-ng-model="itemsByPage">
                        </div>
                        <div class="col-md-3"></div>

                        <div class="col-md-3"></div>
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
                                    <th st-sort="name" class="table-header-repeat line-left minwidth-1">Name</th>
                                    <th st-sort="description" class="table-header-repeat line-left minwidth-1">
                                        Description
                                    </th>
                                    <th st-sort="cost" class="table-header-repeat line-left minwidth-1">Cost</th>
                                    <th st-sort="date" class="table-header-repeat line-left minwidth-1">Date</th>

                                    <th class="table-header-options line-left">Options</th>
                                </tr>


                                </thead>
                                <tbody>

                                <tr data-ng-repeat="row in displayedCollection">

                                    <td><% $index+1 %></td>
                                    <td><%row.name%></td>
                                    <td><%row.description%></td>
                                    <td><%row.cost%></td>
                                    <td><%row.date%></td>
                                    <td>
                                        {{--<button type="button" data-ng-click="edit(row.id)" title="edit">edit</button>--}}
                                        <a href="#"
                                           data-ng-click="popup(row.id,row.name,row.description,row.description,row.description,row.description)"
                                           class="btn btn-primary btn-xs"
                                           data-target="#editExpense">Edit<span
                                                    class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="#" data-ng-click="popupDelete(row.id)" class="btn btn-danger btn-xs"
                                           data-target="#deleteCategory">Delete<span
                                                    class="glyphicon glyphicon-trash"></span></a>

                                    </td>


                                </tr>
                                <td colspan="4">

                                    Total Expenses: <% sum %>


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


                    {{--modal code--}}

                    {{--modal add code--}}
                    <div class="modal fade" id="addExpense" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Expense</h4>
                                </div>
                                <div class="modal-body">

                                    <div ng-show="showAlert">
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <% msg %>
                                        </div>
                                    </div>


                                    <form name="forms" class="form-validation">
                                        <form name="forms" class="form-validation  userForm">
                                            <div class="form-group">
                                                <label><b>Name</b></label>
                                                <input type="text" name="name" data-ng-model="input.name"
                                                       required="required" placeholder="Name" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Description</b></label>
                                                <input type="text" name="description" data-ng-model="input.description"
                                                       placeholder="Description" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Cost</b></label>

                                                <input type="text" name="cost" data-ng-model="input.cost"
                                                       placeholder="Cost" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Date</b></label>
                                                <input type="date" name="date" data-ng-model="input.date"
                                                       placeholder="date" class="form-control">

                                            </div>
                                        </form>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" ng-disabled="forms.$invalid"
                                            data-ng-click="addExpense(input)">
                                        Add
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>


                    {{-- edit model--}}

                    <div class="modal fade" id="editCategory" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Expense</h4>
                                </div>
                                <div class="modal-body">
                                    <div ng-show="showAlert">
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <% msg %>
                                        </div>
                                    </div>
                                    <form name="forms" class="form-validation">
                                        <div class="form-group">

                                            <input type="hidden" name="id" data-ng-modal="id"
                                                   placeholder="id" id="showId" class="form-control">
                                            <div class="form-group">
                                                <label><b>Name</b></label>
                                                <input
                                                        type="text" name="name" data-ng-modal="name"
                                                        required="required" placeholder="Name" id="showName"
                                                        class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label><b>Description</b></label>
                                                <input type="text" name="description" data-na-modal="description"
                                                       placeholder="Description" id="showDescription"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Cost</b></label>
                                                <input
                                                        type="text" name="cost" data-ng-modal="cost"
                                                        placeholder="cost" id="cost" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><b>Date</b></label>

                                                <input type="date" name="date" data-na-modal="date"
                                                       placeholder="date" id="date" class="form-control">

                                            </div>
                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" ng-disabled="forms.$invalid"
                                            data-ng-click="editExpense()">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>


                    {{--  delete modal--}}
                    <div class="modal fade" id="deleteCategory" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete Category</h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this item?
                                    <input type="hidden" id="deleteId" name="id">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" data-ng-click="deleteCategory()">
                                        Delete
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
