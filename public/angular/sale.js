/**
 * Created by sabin on 6/9/16.
 */
app.controller('saleCtrl', function ($scope, $http, $window) {
    $scope.base_path = $window.base_path;
    $scope.saleDateRanges = false;

    $scope.init = function () {
        $scope.profit = "profit :";
        $scope.loss = "loss :";

        $scope.url = $scope.base_path + 'sales';
        $http.get($scope.url).success(function (response) {
            $scope.sales = response.data;
            $scope.categories = response.data;


            $scope.totalsale_price = response.calculation[0].sale_price;
            $scope.totalcost_price = response.calculation[0].cost_price;
            $scope.totalexpenses = response.expenses[0].sumCost;
            $scope.profitAmount = $scope.totalsale_price - $scope.totalcost_price - $scope.totalexpenses;
            $scope.lossAmount = $scope.totalcost_price + $scope.totalexpenses - $scope.totalsale_price;

            console.log(categories);
            // console.log($scope.sales);
        });


        $scope.dateRange = function (from, to) {

            $scope.url = $scope.base_path + 'saleRange';
            var data = {
                from: from,
                to: to
            };
            $http.post($scope.url, data).success(function (response) {
                $scope.saleDateRanges = true;
                $scope.sales = response.data;
                $scope.categories = response.data;


                $scope.totalsale_price = response.calculation[0].sale_price;
                $scope.totalcost_price = response.calculation[0].cost_price;
                $scope.totalexpenses = response.expenses[0].sumCost;
                $scope.profitAmount = $scope.totalsale_price - $scope.totalcost_price - $scope.totalexpenses;
                $scope.lossAmount = $scope.totalcost_price + $scope.totalexpenses - $scope.totalsale_price;

            });
        };


        $scope.displayedCollection = [].concat($scope.sales);
        $scope.itemsByPage = 10;
    }
    $scope.popupDelete = function (id) {
        console.log(id);
        angular.element('#deleteId').val(id);
        angular.element('#deleteProduct').modal('show');
    };
    $scope.deleteSale=function () {

        $scope.id = angular.element('#deleteId').val();
        console.log("id is  " + $scope.id);
        var data = {
            id: $scope.id
        };
        console.log(data);
        $scope.url = $scope.base_path + 'sales/' + $scope.id;
        console.log($scope.url);
        $http.delete($scope.url, data).success(function (response) {

            $scope.init();
            $window.location.reload();

            console.log('your id is' + response);

        });
    }

});