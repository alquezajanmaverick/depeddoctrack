var app = angular.module('updtApp',['ui.bootstrap','angular.filter']);
app.controller('updtCtrl',function($scope){
	$scope.Date = function(arg){
	   return new Date(arg);
	};
	
	$scope.parseme = function(x){
		$scope.x = new Date(x);
		$scope.dateinformed = $scope.x;	
	}
	
	$scope.parseme2 = function(x){
		$scope.x = new Date(x);
		$scope.effectivity = $scope.x;	
	}
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



		// Disable weekend selection
		function disabled(data) {
			var date = data.date,
			mode = data.mode;
			return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
		}


		$scope.open2 = function() {
			$scope.popup2.opened = true;
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
});


app.controller('appointCtrl',function($scope,$http){
	$http.get("get-appointee.php")
        .then(function(response) {
            $scope.appoint = response.data;
			console.log($scope.poss.length);
			
        });
});