var app = angular.module('congupdateApp',['ui.bootstrap']);
app.controller('congupdateCtrl',function($scope){
	$scope.parseme = function(x){
		$scope.x = new Date(x);
		$scope.dateinformed = $scope.x;	
	};
	$scope.open = function() {
		$scope.popup.opened = true;
		};
		
	$scope.popup = {
		opened: false
	};
	
	
	
	
	/** --------------------**/
	
	$scope.parseme2 = function(x){
		$scope.x = new Date(x);
		$scope.duedate = $scope.x;	
	};
	$scope.open1 = function() {
			$scope.popup1.opened = true;
		};
		
	$scope.popup1 = {
		opened: false
	};
	
	
	/** ---------------------**/
	
	$scope.parseme3 = function(x){
		$scope.x = new Date(x);
		$scope.datereleased = $scope.x;	
	};
	
		
	$scope.open2 = function() {
		$scope.popup2.opened = true;
	};

	$scope.popup2 = {
		opened: false
	};
	
	/** ---------------------**/
	
	$scope.parseme4 = function(x){
		$scope.x = new Date(x);
		$scope.effectivity = $scope.x;	
	};
	
		
	$scope.open3 = function() {
		$scope.popup3.opened = true;
	};

	$scope.popup3 = {
		opened: false
	};
	

	

	
});