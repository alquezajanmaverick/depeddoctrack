var app = angular.module('warningApp',[]);

app.controller('warningCtrl',function($scope,$http){
    $http.get("notif.php")
    .then(function(response) {
        $scope.data = response.data;
        console.log($scope.data);
    });

    $scope.go = function(e){
        window.location.href = "../update-congratulatory.php?itemno="+e;
    }
})