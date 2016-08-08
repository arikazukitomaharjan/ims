<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/9/16
 * Time: 7:06 AM
 */
?>
@extends('layouts.app')

@section('content')
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>

            <td colspan="2">home</td>
        </tr>
    </table>
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table" class="product-table">
        <tr class="no-hover">
            <th class="table-header-check">S.N</th>
            <th class="table-header-repeat line-left minwidth-1">Name</th>
            <th class="table-header-repeat line-left minwidth-1">Date Added</th>
            <th class="table-header-repeat line-left">Information</th>
            <th class="table-header-repeat line-left">Quantity</th>
            <th class="table-header-repeat line-left minwidth-1 align-right">Cost Price</th>
            <th class="table-header-repeat line-left align-right">MRP</th>
            <th class="table-header-repeat line-left minwidth-1 align-right">SOLD QTY</th>
            <th class="table-header-options line-left">Options</th>
        </tr>
        <tr>
        </tr>
    </table>

@endsection