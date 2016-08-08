/**
 * Created by sabin on 5/24/16.
 */

'use strict';

var base_path = 'http://localhost/inventorymanagementsystem/public/app/v1/';


var app=angular.module('app',['smart-table'],function($interpolateProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

