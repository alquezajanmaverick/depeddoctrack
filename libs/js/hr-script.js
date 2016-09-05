var app = angular.module('mainApp',['ngRoute','ngAnimate','angular.filter','ui.bootstrap','ngScrollbar']);
app.factory("Globalvar",function(){
        return {};
});
app.directive('auto-refresh',function($location,$route){
	return function(scope,element,attribute){
		element.bind('click',function(){
			if(element[0] && element[0].href && element[0].href === $location.absUrl()){
				$route.reload();
				console.log('reloaded');
			}
		})
	}
})
app.config(function($routeProvider) {
		$routeProvider

			// route for the home page
			.when('/', {
				templateUrl : 'redirect/home.html',
				controller  : 'mainCtrl'
			})

			// route for the appointee page
			.when('/appointee', {
				templateUrl : 'redirect/appointee.html',
				controller  : 'appointeeCtrl'
			})

			// route for the congratulatory page
			.when('/congratulatory', {
				templateUrl : 'redirect/congratulatory.html',
				controller  : 'congratulatoryCtrl'
			})

            // route for the remarks page
			.when('/remarks', {
				templateUrl : 'redirect/remarks.html',
				controller  : 'remarksCtrl'
			})

            // route for the process page
			.when('/process', {
				templateUrl : 'redirect/process.html',
				controller  : 'processCtrl'
			})

			.when('/add-appointee', {
				templateUrl : 'redirect/add-appointee.html',
				controller  : 'addCtrl'
			})
	});

	// create the controller and inject Angular's $scope
	app.controller('mainCtrl', function($scope,Globalvar,$http) {
		$scope.m = Globalvar;
		$scope.message = $scope.m.message;
		// create a message to display in our view
		$scope.class = 'page-animate';
		 $http.get("get-appointee.php")
        .then(function(response) {
            $scope.appointee = response.data;
        });
	});

	app.controller('appointeeCtrl', function($scope,Globalvar) {
		$scope.m = Globalvar;
		$scope.message = $scope.m.message; 
		$scope.class = 'page-animate';
	});

	app.controller('congratulatoryCtrl', function($scope,Globalvar) {
		$scope.m = Globalvar;
		$scope.message = $scope.m.message; 
		$scope.class = 'page-animate';
	});

	app.controller('remarksCtrl', function($scope,Globalvar) {
		$scope.class = 'page-animate';
	});

	app.controller('processCtrl', function($scope,Globalvar) {
		$scope.class = 'page-animate';
	});
	//add appointee
	app.controller('addCtrl', function($scope,Globalvar,$http,$route) {
		
		//reload
		var ctrl = this;
		ctrl.reloadData = function(){
			$route.reload();
		}
		//--reload
		$scope.xForm = {};
		$scope.class = 'page-animate';
		 $http.get("get-position.php")
		.then(function(response) {
			$scope.pos = response.data;
		
		});
		$scope.ProcessForm = function(){
			console.log($scope.xForm.position)
			$http.post('add-appointee.php', $scope.xForm) .success(function(data){
				//$('#modal-container-505047').modal('show')
				console.log();
			});
		}
		$scope.today = function() {
		$scope.xForm.dateinformed = new Date();
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

	});