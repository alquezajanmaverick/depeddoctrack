var app = angular.module('listApp',['angularUtils.directives.dirPagination']);

app.controller('listCtrl',function($scope,$http){
    $http.get("get-data.php")
        .then(function(response) {
            $scope.data = response.data;
        });

    $scope.delMe = function(e){
        var x = window.confirm("Are you sure you want to remove this record?!");
        if(x==true){
             $http.post('remove.php', {itemno:e})
                .success(function(data){
                    window.location.reload();
                });
        }
    }
})