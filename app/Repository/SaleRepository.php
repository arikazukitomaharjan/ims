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

    class SaleRepository extends Repository
    {

        public function model()
        {

            // TODO: Implement model() method.
            return 'App\Sale';
        }





        public function show($month)
        {

            /*  return $this->makeModel()
                  ->join('tbl_sales as sales', 'sales.id', '=', 'tbl_order.sales_id')
                  ->select('sales.date', 'sales.delivery_date', DB::raw("sum(sales.total_amount) as total_amount"), DB::raw("count(tbl_order.id) as orderCount"), DB::raw("monthname(date) as month,month(date) as monthOrder,year(date) as year"))
                  ->where('sales.client_id', '=', $id)
                  ->groupBy('year','month')
                  ->orderBy('year', 'DESC')
                  ->orderBy('monthOrder', 'DESC')
                  ->get();
    
              */
            return $this->makeModel()
                ->join('product' , 'product.id' , '=' , 'sales.product_id')
                ->join('categories' , 'categories.id' , '=' , 'product.category_id')
                ->select('sales.id','product.name' , 'categories.name as category_name' , 'product.category_id' , 'product.information' , 'sales.cost_price' , 'sales.sale_price' , 'sales.sale_datetime' , 'sales.quantity')
                ->whereRaw("month(sale_date) = $month")
                ->get();
        }

        /**
         * @return mixed
         */
        /* public function sold_quantity()
         {
             return $this->makeModel()
                 ->select('product_id',DB::raw("sum(quantity) as quantity"))
                 ->groupBy('product_id')
                 ->get();
    
         }*/

        public function showCalculation($month)
        {

            return $this->makeModel()
                ->select(DB::raw("sum(sale_price) as sale_price") , DB::raw("sum(cost_price) as cost_price"))
                ->whereRaw("month(sale_date) = $month")
                ->get();
        }





        public function showFilterByMonth($from , $to)
        {

            return $this->makeModel()
                ->join('product' , 'product.id' , '=' , 'sales.product_id')
                ->select('product.name' , 'sales.sale_date' , 'product.information' , 'sales.cost_price' , 'sales.sale_price' , 'sales.sale_datetime' , 'sales.quantity')
                ->whereBetween('sales.sale_date' , [$from , $to])
                ->get();

        }





        public function showFilterByMonthFrom($from)
        {

            return $this->makeModel()
                ->join('product' , 'product.id' , '=' , 'sales.product_id')
                ->select('product.name' , 'sales.sale_date' , 'product.information' , 'sales.cost_price' , 'sales.sale_price' , 'sales.sale_datetime' , 'sales.quantity')
                ->where('sales.sale_date' , '>=' , $from)
                ->get();
        }





        public function showFilterByMonthTo($to)
        {

            return $this->makeModel()
                ->join('product' , 'product.id' , '=' , 'sales.product_id')
                ->select('product.name' , 'sales.sale_date' , 'product.information' , 'sales.cost_price' , 'sales.sale_price' , 'sales.sale_datetime' , 'sales.quantity')
                ->where('sales.sale_date' , '<=' , $to)
                ->get();
        }





        public function getSaleDateOfCurrentMonth($month)
        {

            return $this->makeModel()
                ->select('sale_date')
                //                ->whereRaw("month(sale_date) = $month")
                ->get();
        }





        public function getTotalSale()
        {

            return $this->makeModel()
                ->select('sale_date as date' , DB::raw("sum(sale_price) as sale_price") , DB::raw("sum(quantity) as quantity"))
                ->groupBY('sale_date')
                ->get();
        }





        public function getTotalSaleOfCurrentMonth($month)
        {

            return $this->makeModel()
                ->select('sale_price' , 'sale_date as date')
                //                ->whereRaw("month(sale_date) = $month")

                ->get();
        }





        public function getTotalSumSaleDateOfCurrentMonth($month)
        {

            return $this->makeModel()
                ->select(DB::raw("sum(sale_price) as sale_price"))
                ->whereRaw("month(sale_date) = $month")
                ->get();
        }





        public function showCalculationHavingAll($from , $to)
        {
            return $this->makeModel()
                ->select(DB::raw("sum(sale_price) as sale_price"),DB::raw("sum(cost_price) as cost_price"))
                ->whereBetween('sale_date',[$from,$to])
                ->get();
        }





        public function showCalculationHavingFrom($from)
        {
            return $this->makeModel()
                ->select(DB::raw("sum(sale_price) as sale_price"),DB::raw("sum(cost_price) as cost_price"))
                ->where('sale_date','>=',$from)
                ->get();
        }





        public function showCalculationHavingTo($to)
        {
            return $this->makeModel()
                ->select(DB::raw("sum(sale_price) as sale_price"),DB::raw("sum(cost_price) as cost_price"))
                ->where('sale_date' , '<=' , $to)
                ->get();

        }





        public function totalSaleCount()
        {

            return $this->makeModel()
                ->count();
        }


        public function remove($id){
            return $this->makeModel()
                ->find($id)->delete();
        }

    }