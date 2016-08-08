<?php

    namespace App\Repository;

    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 6/8/16
     * Time: 12:40 PM
     */

    use Bosnadev\Repositories\Contracts\RepositoryInterface;
    use Bosnadev\Repositories\Eloquent\Repository;
    use Illuminate\Support\Facades\DB;

    class ExpenseRepository extends Repository
    {

        public function model()
        {

            // TODO: Implement model() method.
            return 'App\Expense';
        }





        public function show($month)
        {

            return $this->makeModel()->select('id' , 'name' , 'description' , 'date' , 'cost')->whereRaw("month(date) = $month")->get();
        }





        public function showSum($month)
        {

            return $this->makeModel()->select(DB::raw("sum(cost) as sumCost"))->whereRaw("month(date) = $month")->get();
        }





        public function add($data)
        {

            return $this->makeModel()->create($data);
        }





        public function edit($id , $data)
        {

            return $this->makeModel()->find($id)->update($data);
        }





        public function remove($id)
        {

            return $this->makeModel()->find($id)->delete();
        }





        public function getTotalExpenseOfCurrentMonth($month)
        {

            return $this->makeModel()
                ->select('cost' , 'date')
                ->whereRaw("month(date) = $month")
                ->get();
        }





        public function getTotalSumexpenseDateOfCurrentMonth($month)
        {

            return $this->makeModel()
                ->select(DB::raw("sum(cost) as cost"))
                ->whereRaw("month(date) = $month")
                ->get();
        }





        public function getExpenseOfHavingAll($from , $to)
        {

            return $this->makeModel()
                ->select(DB::raw("sum(cost) as sumCost"))
                ->whereBetween('date' , [$from , $to])
                ->get();
        }





        public function getExpenseOfGivenDateHavingFrom($from)
        {

            return $this->makeModel()
                ->select(DB::raw("sum(cost) as sumCost"))
                ->where('date' , '>=' , $from)
                ->get();
        }





        public function getExpenseOfGivenDateHavingTo($to)
        {

            return $this->makeModel()
                ->select(DB::raw("sum(cost) as sumCost"))
                ->where('date' , '<=' , $to)
                ->get();
        }
    }