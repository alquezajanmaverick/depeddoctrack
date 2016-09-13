'use strict';
var app = angular.module('appointApp',['ui.bootstrap','angular.filter','angularUtils.directives.dirPagination']);

app.controller('appointCtrl',function($scope,$http){
	$http.get("get-appointee.php")
        .then(function(response) {
            $scope.appoint = response.data;
			console.log($scope.appoint);
        });
		
	$scope.delappointee = function(x){
		
		var r = confirm("Are you sure you want to delete this record!?");
		if (r === true) {
			window.location.href="del-appointee?itemno="+x;
		} else {
			
		}
	};
	$scope.updateappointee = function(x){
		window.location.href="update-appointee?itemno="+x;
	};
});