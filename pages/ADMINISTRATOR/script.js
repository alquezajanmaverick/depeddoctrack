var app = angular.module('adminApp',['ngRoute','ui.bootstrap','angular-toast']);
app.controller('adminCtrl',function($scope,$http,$routeParams){
    $http.get("get-data.php")
        .then(function(response) {
            $scope.data = response.data;
    });

    $scope.viewMe = function(x){
        
        $routeParams.itemno = {itemno:x};
        window.location.href = 'view-details.html#/?itemno='+x;
    }
});

app.controller('viewCtrl',function($scope,$http,$routeParams,$location){
    $scope.itemno = $location.search();
    $http.post('get-single.php', {itemno:$scope.itemno.itemno})
        .success(function(data){
        $scope.details = data;
    });
    $scope.type="danger";
    $http.post('get-progress.php', {itemno:$scope.itemno.itemno})
        .success(function(data){
        $scope.progress = data;
        $scope.range = [5,20,40,60,80,100];
        if($scope.progress >= $scope.range[0]){
            $scope.type = "danger";
        }
        if($scope.progress >= $scope.range[1]){
            scope.type = "warning";
        }
        if($scope.progress >= $scope.range[2]){
            $scope.type = "info";
        }
        if($scope.progress >= $scope.range[3]){
            $scope.type = "primary";
        }
        if($scope.progress >= $scope.range[4]){
            $scope.type = "success";
        }
    });

    $scope.home = function(){
        window.location.href = 'index.html';
    }
});

app.controller('userCtrl',function($scope,$http,$routeParams){
     $http.get("get-user.php")
        .then(function(response) {
            $scope.data = response.data;
    });

    $scope.editme = function(e){
        $routeParams.userID = {userID:e};
        window.location.href = 'update-user.html#/?userID='+e;
    }
});

app.controller('updateCtrl',function($scope,$http,$routeParams,$location){
    $scope.userID = $location.search();
    $scope.showAlert = false;
    $scope.xForm = {};
    $http.post('get-single-user.php', {userID:$scope.userID.userID})
        .success(function(data){
        $scope.details = data;
        $scope.xForm.userID = $scope.details[0].userID;
    });

    $scope.submitMe = function(){
        if(($scope.xForm.username=="" || $scope.xForm.username == null)||($scope.xForm.password==""||$scope.xForm.password==null)){
            $scope.showAlert = true;
        }
        else{
            $scope.showAlert = false;
            $http.post('update-user.php', $scope.xForm)
                .success(function(data){
                $scope.details = data;
                window.location.href="user-control.html";
            });
        }
    }

    $scope.notify = function(e){
        return toast.show(e || 'Alert')
    }
});