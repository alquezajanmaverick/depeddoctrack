var app = angular.module('congupdateApp',['ui.bootstrap']);
app.controller('congupdateCtrl',function($scope){
	$scope.parseme = function(x){
		$scope.x = new Date(x);
		$scope.dateinformed = $scope.x;	
	}
	$scope.open = function() {
		$scope.popup.opened = true;
		};
		
	$scope.popup = {
		opened: false
	};
	
	
	
	
	/** --------------------**/
	
	$scope.parseme2 = function(x){
		$scope.x = new Date(x);
		$scope.effectivity = $scope.x;	
	}
	$scope.open1 = function() {
			$scope.popup1.opened = true;
		};
		
	$scope.popup1 = {
		opened: false
	};
	
	
	/** ---------------------**/
	
	$scope.parseme3 = function(x){
		$scope.x = new Date(x);
		$scope.effectivity = $scope.x;	
	}
	
		
	$scope.open2 = function() {
		$scope.popup2.opened = true;
	};

	$scope.popup2 = {
		opened: false
	};
	

	
		
		
	
	

	$scope.clear = function() {
		$scope.effectivity = null;
	};

	
});