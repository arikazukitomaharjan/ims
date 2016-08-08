<?php

    namespace App\Http\Controllers;

    use App\Repository\ExpenseRepository as Expense;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use App\Repository\ProductRepository as Product;
    use App\Repository\CategoryRepository as Category;
    use App\Repository\SaleRepository as Sale;
    use App\Http\Requests;
    use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;

    class DashboardController extends Controller
    {

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index(Sale $sale , Expense $expense , Product $product , Category $category)
        {

            $salesExpense = Lava::DataTable();
            $month = Carbon::now();
            $month = $month->format('m');

            //get total sum of sales of current month
            $totalSaleOfCurrentMonth = $sale->getTotalSaleOfCurrentMonth($month);

            //get total sum of expenses of current month
            $totalExpenseOfCurrentMonth = $expense->getTotalExpenseOfCurrentMonth($month);
            //                        dd($totalExpenseOfCurrentMonth);

            $array = array_merge($totalSaleOfCurrentMonth->toArray() , $totalExpenseOfCurrentMonth->toArray());

            /*   $salesExpense->addDateColumn('Date')
                   ->addNumberColumn('Sales')
                   ->addNumberColumn('Expense');
               //                ->addNumberColumn('Net Worth');

               foreach ($array as $g => $value) {

                   $rowData = [

                       $value['date'] , isset($value['sale_price']) ? $value['sale_price']: "" , isset($value['cost']) ? $value['cost']: ""
                       //                    $value['date'] , isset($value['sale_price']) ? $value['sale_price']: "" , isset($value['cost']) ? $value['cost']: ""
                   ];

                   $salesExpense->addRow($rowData);
               }

               Lava::ComboChart('Temps')
                   ->setOptions([
                       'datatable'      => $salesExpense ,
                       'title'          => 'Company Performance' ,
                       'titleTextStyle' => Lava::TextStyle([
                           'color'    => 'rgb(123, 65, 89)' ,
                           'fontSize' => 16
                       ]) ,
                       'legend'         => Lava::Legend([
                           'position' => 'in'
                       ]) ,
                       'seriesType'     => 'bars' ,
                       'series'         => [
                           2 => Lava::Series([
                               'type' => 'line'
                           ])
                       ]
                   ]);*/

            /*            Lava::LineChart('Temps')
                            ->setOptions([
                                'title'          => 'Sales expense' ,
                                'datatable'      => $salesExpense ,
                                'titleTextStyle' => Lava::TextStyle([
                                    'fontName' => 'Arial' ,

                                ]) ,
                                'legend'         => Lava::Legend([
                                    'position' => 'top'
                                ])
                            ]);*/

            $sales = Lava::DataTable();
            $month = Carbon::now();
            //            $month = $month->format('m');

            //get total sum of sales of current month
            $totalSale = $sale->getTotalSale();
            //            dd($totalSale);
            $sales->addDateColumn('Date')
                ->addNumberColumn('Sold');

            foreach ($totalSale as $g => $value) {

                $rowData = [

                    $value['date'] , $value['sale_price']
                ];

                $a = $sales->addRow($rowData);
            }

            Lava::CalendarChart('Sales' , $sales , [
                'title'                   => 'Product Sold' ,
                'unusedMonthOutlineColor' => [
                    'stroke'        => '#ECECEC' ,
                    'strokeOpacity' => 0.75 ,
                    'strokeWidth'   => 1
                ] ,
                'dayOfWeekLabel'          => [
                    'color'    => '#4f5b0d' ,
                    'fontSize' => 16 ,
                    'italic'   => TRUE
                ] ,
                'noDataPattern'           => [
                    'color'           => '#DDD' ,
                    'backgroundColor' => '#11FFFF'
                ] ,
                'colorAxis'               => [
                    'values' => [0 , 100] ,
                    'colors' => ['black' , 'green']
                ]
            ]);

            $totalProduct = $product->totalProductCount();
            $totalSale = $sale->totalSaleCount();
            $totalCategory = $category->totalCategoryCount();

            $datatable = Lava::DataTable();
            $datatable
                ->addNumberColumn('Sales')
                ->addDateColumn('Date')

                ->
                addRows([
                    [1000,'2016-07-02' ] ,
                    [ 200,'2016-08-02' ],
                    [ 1500,'2016-08-01' ]

                ]);
            //            dd($d);
            $pieChart = Lava::ColumnChart('Donuts' , $datatable , [
                'width'        => 1090 ,


            ]);

            $filter = Lava::DateRangeFilter(1 , [

                'ui' => [
                    'labelStacking' => 'vertical' ,

                ]

            ]);

            $control = Lava::ControlWrapper($filter , 'control');
            $chart = Lava::ChartWrapper($pieChart , 'chart');
            $a = Lava::Dashboard('Donuts')->bind($control , $chart);

            return view('admin.dashboard' , compact('totalProduct' , 'totalSale' , 'totalCategory'));
        }


    }
