var app = angular.module('assignApp',['ui.bootstrap','angular.filter']);
app.controller('assignCtrl',function($scope){
	
	$scope.open2 = function() {
			$scope.popup2.opened = true;
		};
	
	$scope.today = function() {
		$scope.dateinformed = new Date();
		};
		$scope.today();

		$scope.clear = function() {
			$scope.dateinformed = null;
		};




		$scope.open4 = function() {
			$scope.popup4.opened = true;
		};

		$scope.formats = ['yyyy-MM-dd'];
		$scope.format = $scope.formats[0];
		$scope.altInputFormats = ['yyy-MM-dd'];

		$scope.popup2 = {
			opened: false
		};
		
		
	$scope.open = function() {
		$scope.popup.opened = true;
		};
	
	$scope.today = function() {
		$scope.effectivity = new Date();
		};
		$scope.today();

		$scope.clear = function() {
			$scope.effectivity = null;
		};




		$scope.formats = ['yyyy-MM-dd'];
		$scope.format = $scope.formats[0];
		$scope.altInputFormats = ['yyy-MM-dd'];

		$scope.popup = {
			opened: false
		};

		$scope.popup4 = {
			opened: false
		};
});


app.controller('appointCtrl',function($scope,$http){
	$http.get("get-appointee.php")
        .then(function(response) {
            $scope.appoint = response.data;
			console.log($scope.poss.length);
			
        });
});