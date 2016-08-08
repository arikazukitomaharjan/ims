/**
 * Created by sabin on 6/9/16.
 */
app.controller('productCtrl', function ($scope, $http, $location, $window) {
    $scope.hideAlways = true;
    $scope.hideMRP = true;
    $scope.base_path = $window.base_path;
    // $scope.showData=false;
    $scope.init = function () {
        // $scope.showData=true;
        $scope.url = $scope.base_path + 'products';
        $http.get($scope.url).success(function (response) {
            $scope.products = response.data;
            // $scope.sold_quantity=response.data[0];

            console.log(response);
            console.log($scope.sold_quantity);

            // $scope.query=response.query;

        });
        $scope.url = $scope.base_path + 'categories';
        $http.get($scope.url).success(function (response) {
            $scope.categories = response.data;
            $scope.category_id=response.data.id;
            console.log($scope.categories);
        });

        $scope.displayedCollection = [].concat($scope.products);
        // $scope.displayedCollections = [].concat($scope.sold_quantity);
        $scope.itemsByPage = 10;


        $scope.displayCategoryProduct = function () {
            console.log('djhfaks fs');
        }
    };


    $scope.popupAddProduct = function (input) {
        console.log(' i am here hahha');
        $scope.url = $scope.base_path + 'categories';
        $http.get($scope.url).success(function (response) {
            $scope.categories = response.data;
        });
        $scope.date_added = new Date();

        angular.element('#addProduct').modal('show');
    };
    $scope.addProduct = function (input) {
        var data = {
            name: input.name,
            information: input.information,
            stock: input.stock,
            cost_price: input.cost_price,
            MRP: input.MRP,
            category_id: input.category_id,
            date_added: $scope.date_added
        };
        $scope.url = $scope.base_path + 'products/store';
        $http.post($scope.url, data).success(function (response) {
            $scope.input.name = '';
            $scope.input.information = '';
            $scope.input.stock = '';
            $scope.input.cost_price = '';
            $scope.input.MRP = '';
            $scope.init();
        });
    };


    $scope.popup = function (id, name, information, stock, cost_price, MRP, date_added) {
        console.log(name);
        angular.element('#showId').val(id);
        angular.element('#showName').val(name);
        angular.element('#showInformation').val(information);
        angular.element('#showStock').val(stock);
        angular.element('#showCost_price').val(cost_price);
        angular.element('#showMRP').val(MRP);
        // angular.element('#showshowCategory').val(category_id);
        angular.element('#showDate_added').val(date_added);
        angular.element('#editProduct').modal('show');


    };
    

    $scope.editProduct = function () {
        $scope.id = angular.element('#showId').val();
        $scope.name = angular.element('#showName').val();
        $scope.information = angular.element('#showInformation').val();
        $scope.stock = angular.element('#showStock').val();
        $scope.cost_price = angular.element('#showCost_price').val();
        $scope.MRP = angular.element('#showMRP').val();
        $scope.date_added = angular.element('#showDate_added').val();
        console.log('i am an id' + $scope.id);
        var data = {
            id: $scope.id,
            name: $scope.name,
            information: $scope.information,
            stock: $scope.stock,
            cost_price: $scope.cost_price,
            MRP: $scope.MRP,
            date_added: $scope.date_added
        };
        $scope.url = $scope.base_path + 'products/' + $scope.id;
        console.log($scope.url);
        $http.patch($scope.url, data).success(function (response) {
            $scope.init();
            $('#editProduct').modal('hide');
        });
    };

    $scope.popupDelete = function (id) {
        console.log(id);
        angular.element('#deleteId').val(id);
        angular.element('#deleteProduct').modal('show');
    };

    $scope.deleteProduct = function () {
        $scope.id = angular.element('#deleteId').val();
        console.log("id is  " + $scope.id);
        var data = {
            id: $scope.id
        };
        console.log(data);
        $scope.url = $scope.base_path + 'products/' + $scope.id;
        console.log($scope.url);
        $http.delete($scope.url, data).success(function (response) {

            $scope.init();
            $window.location.reload();
            alert('successfully deleted');
            console.log('your id is' + response);

        });
    };
    $scope.popupSales = function (id, name, MRP, stock, cost_price) {


        console.log(id);
        $scope.productId = id;
        $scope.productName = name;
        $scope.productMRP = MRP;
        $scope.productStock = stock;
        $scope.productCost_price = cost_price;


        $scope.totalSale = function (price) {
            $scope.hideMRP = false;
            if ($scope.quantity == "") {
                $scope.sale_price = "0";
            }
            $scope.total_cost_price = price * $scope.quantity;
            $scope.sale_price = price * $scope.quantity;
        };

        $('#saleProduct').modal('show');
    };


    $scope.saleProduct = function () {
        $scope.id = $scope.productId;

        /*   $scope.quantity =  $scope.quantity;
         $scope.sale_price = $scope.total_sales_price;
         $scope.cost_price = $scope.total_cost_price;*/

        var data = {
            id: $scope.id,
            quantity: $scope.quantity,
            sale_price: $scope.sale_price,
            cost_price: $scope.total_cost_price

        };
        $scope.url = $scope.base_path + 'productSale/' + $scope.id;
        console.log(data);
        $http.post($scope.url, data).success(function (response) {
            $scope.quantity = '';
            $scope.sale_price = '';
            $scope.init();
        });
    };

    $scope.change = function (input) {
        var obj = {category_id: input.category_id}
        // console.log("a"+obj.category_id);


        $scope.url = $scope.base_path + 'productByCategory/' + obj.category_id;
        $http.post($scope.url).success(function (response) {

                $scope.products = response.data;

            console.log("new"+  $scope.products );
        });
    };

    $scope.search = function () {
        console.log($scope.from);
        console.log('i am here');
        var obj = {
            from: input.from,
            to: $scope.to
        };
        console.log(obj);
    }
   
});