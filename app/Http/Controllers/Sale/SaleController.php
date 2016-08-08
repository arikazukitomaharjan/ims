<?php

    namespace App\Http\Controllers\Sale;

    use App\Http\Requests\CreateSaleRequest;
    use Carbon\Carbon;
    use Faker\Provider\DateTime;
    use Illuminate\Http\Request;
    use App\Repository\SaleRepository as Sale;
    use App\Repository\ProductRepository as Product;
    use App\Repository\ExpenseRepository as Expense;
    use App\Http\Requests;
    use App\Http\Controllers\Controller;

    class SaleController extends Controller
    {

        public function index(Sale $sale , CreateSaleRequest $request , Expense $expense)
        {

            $month = Carbon::now();
            $month = $month->format('m');
            $from = $request->from;
            $to = $request->to;
            //
            /* $dt = new DateTime();
             return $dt->format('Y-m-d H:i:s');
             die();*/
            $expense = $expense->showSum($month);
            $sales = $sale->show($month);
            $salesCalculation = $sale->showCalculation($month);

            /*  $sales = ['sales' => $sale,
                  'sold_quantity' => $sold_quantity];
              dd($sales);*/

            return response()->json(['success' => TRUE , 'data' => $sales , 'calculation' => $salesCalculation , 'expenses' => $expense]);
        }





        public function saleRange(CreateSaleRequest $request , Sale $sale , Expense $expense)
        {

            $from = $request->from;
            $to = $request->to;
            if ($request->has('from') && $request->has('to')) {
                $from = $request->from;
                $to = $request->to;
                $sales = $sale->showFilterByMonth($from , $to);
                $expense = $expense->getExpenseOfHavingAll($from , $to);
                $salesCalculation = $sale->showCalculationHavingAll($from , $to);

                //

                return response()->json(['success' => TRUE , 'data' => $sales , 'calculation' => $salesCalculation , 'expenses' => $expense]);
            }
            //            if($request->has('from') && $request->has('to'))
            if ($request->has('from') && !$request->has('to')) {

                $sales = $sale->showFilterByMonthFrom($from);
                $expense = $expense->getExpenseOfGivenDateHavingFrom($from);
                $salesCalculation = $sale->showCalculationHavingFrom($from);

                return response()->json(['success' => TRUE , 'data' => $sales , 'calculation' => $salesCalculation , 'expenses' => $expense]);
            }
            if ($request->has('to') && !$request->has('from')) {
                $sales = $sale->showFilterByMonthTo($to);
                $expense = $expense->getExpenseOfGivenDateHavingTo($to);
                $salesCalculation = $sale->showCalculationHavingTo($to);

                return response()->json(['success' => TRUE , 'data' => $sales , 'calculation' => $salesCalculation , 'expenses' => $expense]);
            }

        }





        public function delete($id , Sale $sale , Product $product)
        {

            //$product=$product->sale()->id;
            //            $product = $sale->product()->id;
            //            dd($product);
            /*
                        $product = $product->find($id);
                        dd($product);*/
            $sales = $sale->remove($id);

            return response()->json(['data' => $sales , 'msg' => 'successfully deleted' , 'id' => $id]);
        }
    }
