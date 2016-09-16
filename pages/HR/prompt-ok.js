var app = angular.module('congApp',[]);

app.controller('congCtrl',function($scope,$http){
    $scope.promptMe = function(itm){
        var x = confirm("Mark selected record as COMPLETE?"+itm);
        if(x==true){
            $http.post('complete.php', {itemno:itm}) .success(function(){
               window.location.reload();
                });
        }else{

        }
    }
});