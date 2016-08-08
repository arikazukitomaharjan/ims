<?php

    namespace App\Http\Controllers\Product;

    use App\Http\Requests\CreateProductRequest;
    use App\Http\Requests\CreateSaleRequest;
    use Carbon\Carbon;
    use \DB;
    use Illuminate\Http\Request;
    use App\Repository\ProductRepository as Product;
    use App\Repository\SaleRepository as Sale;
    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class ProductController extends Controller
    {

        /**
         * @param Product $product
         * @param Sale    $sale
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function index(Product $product , Sale $sale)
        {

            $id = $product->lists('id');

            $product = $product->all();

            //$product = $product->all();
            //        $array=[$productSum,$product];

            return response()->json(['data' => $product]);
        }





        /**
         * @param Product              $product
         * @param CreateProductRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function store(Product $product , CreateProductRequest $request)
        {

            $data = $request->all();

            $products = $product->add($request->all());

            return response()->json(['data' => $products]);
        }





        /**
         * @param                      $id
         * @param Product              $product
         * @param CreateProductRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function update($id , Product $product , CreateProductRequest $request)
        {

            //$data=$request->all();
            //        $categories = $category->find($id)->($request->all());
            $products = $product->edit($id , $request->all());

            return response()->json(['data' => $products]);
        }





        /**
         * @param                      $id
         * @param Product              $product
         * @param CreateProductRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function delete($id , Product $product , CreateProductRequest $request)
        {

            $products = $product->remove($id);

            return response()->json(['data' => $products , 'msg' => 'successfully deleted' , 'id' => $id]);

        }





        /**
         * @param                      $id
         * @param Sale                 $sale
         * @param CreateSaleRequest    $request
         * @param Product              $product
         * @param CreateProductRequest $productRequest
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function saleProduct($id , Sale $sale , CreateSaleRequest $request , Product $product , CreateProductRequest $productRequest)
        {

            $user = Auth::user()->id;
            $date = Carbon::now();

            $sale_datetime = Carbon::now();
            $sale_datetime = $sale_datetime->format('Y-m-d h-m-s');
            $data = [
                'product_id'    => $request->id ,
                'quantity'      => $request->quantity ,
                'sale_price'    => $request->sale_price ,
                'cost_price'    => $request->cost_price ,
                'sold_by'       => $user ,
                'sale_date'     => $date ,
                'sale_datetime' => $sale_datetime
            ];
            //        dd($data);

            //        dd("SOLD=" . $sold_Quantity . "QUANTITY=" . $quantity . "total=" . $total_Quantity);

            //$total_Quantity = $product->find($id)->stock;

            $quantity = $request->quantity;
            $total_Quantity = $product->find($id)->stock;
            if ($quantity > $total_Quantity) {
                echo "quantity cannot be greater than the stock";
            } else {
                //total stock after sale
                $stock = $total_Quantity - $quantity;
                $sold_Quantity = $product->find($id)->sold_quantity;

                //total no. of item sold
                $sold_Quantity = $sold_Quantity + $quantity;

                //insert into database
                $sale->create($data);

                //update into database
                $product->find($id)->update(['stock' => $stock , 'sold_quantity' => $sold_Quantity]);

                return response()->json(['msg' => 'success' , 'data' => $product]);

            }

        }





        /**
         * @param                      $id
         * @param Product              $product
         * @param CreateProductRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function productByCategory($id , Product $product , CreateProductRequest $request)
        {

            $products = $product->listByCategory($id);

            return response()->json(['data' => $products]);
        }
    }

