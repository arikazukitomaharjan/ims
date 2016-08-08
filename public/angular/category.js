/**
 * Created by sabin on 6/9/16.
 */

app.controller('CategoryCtrl', function ($http, $scope, $window, $location, $interval, $timeout) {
    $scope.base_path = $window.base_path;
    // console.log('hello');
    $scope.init = function () {

        $scope.url = $scope.base_path + 'categories';
        $http.get($scope.url).success(function (response) {

            $scope.categories = response.data;
        });
        $scope.displayedCollection = [].concat($scope.categories);
        console.log($scope.displayedCollection);
        $scope.itemsByPage = 10;
    };

    $scope.addCategory = function (input) {
        $scope.url = $scope.base_path + 'categories/store';
        var data = {
            'name': input.name,
            'description': input.description
        };
        console.log(data);
        var tm = 0;
        $scope.showAlert = false;
        $http.post($scope.url, data).success(function (response) {
            $scope.input.name = '';
            $scope.input.description = '';
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
    $scope.popup = function (id, name, description) {
        console.log(name);
        angular.element('#showId').val(id);
        angular.element('#showName').val(name);
        angular.element('#showDescription').val(description);
        angular.element('#editCategory').modal('show');

    };

    $scope.editCategory = function () {


        $scope.id = angular.element('#showId').val();
        $scope.name = angular.element('#showName').val();
        $scope.description = angular.element('#showDescription').val();
        console.log('i am an id' + $scope.id);
        var data = {
            id: $scope.id,
            name: $scope.name,
            description: $scope.description
        };
        $scope.url = $scope.base_path + 'categories/' + $scope.id;
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

    $scope.deleteCategory = function () {
        $scope.id = angular.element('#deleteId').val();
        console.log("id is  " + $scope.id);
        var data = {
            id: $scope.id
        };
        console.log(data);
        $scope.url = $scope.base_path + 'categories/' + $scope.id;
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