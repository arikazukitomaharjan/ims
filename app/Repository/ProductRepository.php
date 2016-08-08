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
    use DB;

    class ProductRepository extends Repository
    {

        public $sale;





        public function model()
        {

            // TODO: Implement model() method.
            return 'App\Product';
        }





        public function totalQuantity()
        {

         
            return $this->makeModel()
                ->join('sales as sales' , 'sales.product_id' , '=' , 'product.id')
                ->select(DB::raw("sum('sales.quantity') as quantity"))
                ->groupBy('sales.product_id')
                ->get();

            /*   SELECT *
               FROM  `purchases`
       WHERE purchases.amount = (
           SELECT SUM( payments.amount )
       FROM payments
       WHERE payments.purchase_id = purchases.id )*/

        }





        public function saleID()
        {

            return $this->makeModel()
                ->sale()
                ->lists('id');

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





        public function listByCategory($id)
        {

            return $this->makeModel()->where('category_id' , '=' , $id)->get();
        }





        public function getProductOfCurrentMonth($month)
        {
            return $this->makeModel()
                ->select('date')
                ->whereRaw("month(date) = $month")
                ->get();
        }



        public function totalProductCount(){
            return $this->makeModel()
                ->count();

        }
    }