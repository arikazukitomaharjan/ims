<?php

namespace App\Http\Controllers\Expense;

use App\Http\Requests\CreateExpenseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repository\ExpenseRepository as Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    //
    public function index(Expense $expense){
        $month = Carbon::now();
        $month = $month->format('m');
        $expenses=$expense->show($month);
        $sum=$expense->showSum($month);
        return response()->json(['data'=>$expenses,'sum'=>$sum]);
    }
    public function store(Expense $expense, CreateExpenseRequest $request){
        $user=Auth::User()->id;
        $data=array(
            'name'=>$request->name,
            'description'=>$request->description,
            'cost'=>$request->cost,
            'date'=>$request->date,
            'user_id'=>$user

            );
        $expenses=$expense->add($data);

        return response()->json(['data' => $expenses,'msg'=>'added suffussfull']);
    }
}
