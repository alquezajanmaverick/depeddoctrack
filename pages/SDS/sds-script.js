var app = angular.module('sdsApp',['ui.bootstrap']);
app.factory("Globalvar",function(){
        return {};
});
app.controller('sdsCtrl',function($scope,$http,Globalvar){
         $http.get("get-data.php")
            .then(function(response) {
                $scope.data = response.data;
                console.log($scope.data);
        });
})