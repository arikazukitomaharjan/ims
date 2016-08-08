/**
 * Created by sabin on 6/9/16.
 */

app.controller('expenseCtrl', function ($http, $scope, $window, $location, $interval, $timeout) {
    $scope.base_path = $window.base_path;
    console.log('hello');
    $scope.init = function () {

        $scope.url = $scope.base_path + 'expenses';
        $http.get($scope.url).success(function (response) {
            console.log('hi0');
            $scope.expenses = response.data;
            $scope.sum = response.sum[0].sumCost;
            console.log("response"+$scope.sum);
        });
        $scope.displayedCollection = [].concat($scope.expenses);
        // $scope.sum = [].concat($scope.sum);

        console.log("h"+$scope.displayedCollection);
        console.log("sum"+$scope.sum);
        $scope.itemsByPage = 10;
    };

    $scope.addExpense = function (input) {
        $scope.url = $scope.base_path + 'expenses/store';
        var data = {
            'name': input.name,
            'description': input.description,
            'cost': input.cost,
            'date': input.date
        };
        console.log(data);
        var tm = 0;
        $scope.showAlert = false;
        $http.post($scope.url, data).success(function (response) {
            $scope.input.name = '';
            $scope.input.description = '';
            $scope.input.cost = '';
            $scope.input.date = '';
            $interval(function () {
                if (tm == 1) {
                    $scope.msg = response.msg;
                    $scope.showAlert = true;
                }
                if (tm == 400) {
                    $scope.msg = '';
                    $scope.showAlert = false;
                }

                tm = tm + 1;

            }, 1);

            /*$interval(function () {
             if (tm == 1) {
             $scope.msg = response.msg;
             $scope.showAlert=true;


             } else {
             $scope.showAlert=false;
             $scope.msg = '';
             }
             }, 10000);*/

            $scope.msg = response.msg;
            console.log(response);
            /*   $scope.flashShow=response.flashShow;
             console.log(msg+flashShow);*/
            $scope.init();


        });
    };
    $scope.popup = function (id, name, description,cost,date) {
        console.log(name);
        angular.element('#showId').val(id);
        angular.element('#showName').val(name);
        angular.element('#showDescription').val(description);
        $scope.cost=cost;
        $scope.date=date;
        console.log('heldksaj'+$scope.cost);
        angular.element('#editCategory').modal('show');

    };

    $scope.editExpense= function () {


/*        $scope.id = angular.element('#showId').val();
        $scope.name = angular.element('#showName').val();
        $scope.description = angular.element('#showDescription').val();
        $scope.cost= $scope.cost;
        $scope.date= $scope.date;*/
        console.log('i am an id' + $scope.id);
        var data = {
            id: $scope.id,
            name: $scope.name,
            description: $scope.description,
            cost:$scope.cost,
            date:$scope.date
        };
        $scope.url = $scope.base_path + 'expenses/' + $scope.id;
        console.log($scope.url);
        var tm = 0;

        $http.patch($scope.url, data).success(function (response) {
            $interval(function () {
                if(tm==1){
                    $scope.msg=response.msg;
                    $scope.showAlert = true;
                }if(tm==300){
                    $scope.msg='';$scope.showAlert = false;
                    $scope.init();
                    $window.location.reload();
                }
                tm=tm+1;

            },1);


        })
    };

    $scope.popupDelete = function (id) {
        console.log(id);
        angular.element('#deleteId').val(id);
        angular.element('#deleteCategory').modal('show');
    };

    $scope.deleteExpense = function () {
        $scope.id = angular.element('#deleteId').val();
        console.log("id is  " + $scope.id);
        var data = {
            id: $scope.id
        };
        console.log(data);
        $scope.url = $scope.base_path + 'expenses/' + $scope.id;
        console.log($scope.url);
        $http.delete($scope.url, data).success(function (response) {
            /* console.log('response');
             console.log('msg');*/
            $scope.init();
            $window.location.reload();
            alert('successfully deleted');
            console.log('your id is' + response);

        });

    }

});