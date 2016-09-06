var app = angular.module('mainApp',['ngRoute','ngAnimate','angular.filter','ui.bootstrap','angularUtils.directives.dirPagination']);
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

			.when('/edit-appointee', {
				templateUrl : 'redirect/edit-appointee.html',
				controller  : 'editCtrl'
			})
	});

	// create the controller and inject Angular's $scope
	app.controller('mainCtrl', function($scope,Globalvar,$http,$route) {
		//reload
		var ctrl = this;
		ctrl.reloadData = function(){
			$route.reload();
		}
		//--reload
		$scope.m = Globalvar;
		$scope.m.hasVacant = false;
		$scope.message = $scope.m.message;
		// create a message to display in our view
		$scope.class = 'page-animate';
		 $http.get("get-position.php")
        .then(function(response) {
            $scope.poss = response.data;
			console.log($scope.poss.length)
			if($scope.poss.length > 0)
			{
				$scope.m.hasVacant = true;
			}
        });
	});

	app.controller('appointeeCtrl', function($scope,Globalvar,$route,$http,$uibModal) {
		$scope.m = Globalvar;
		//reload
		$scope.hasVacant = false;
		var ctrl = this;
		ctrl.reloadData = function(){
			$route.reload();
		}
		//--reload
		$http.get("get-appointee.php")
		.then(function(response) {
			$scope.appoint = response.data;
			
		});
		 
		$scope.open = function (x,y) {
			 $scope.m.varpass = x;
			 $scope.m.itemno = y
			 $uibModal.open({
				animation: true,
				ariaLabelledBy: 'modal-title',
				ariaDescribedBy: 'modal-body',
				templateUrl: 'myModalContent.html',
				controller : 'ModalInstanceCtrl',
				controllerAs: '$ctrl',
				size: 'sm',
				resolve: {
					passedVariable: function () {
					return x;
					}
				}
				});
		 }
		
		 $scope.openEdit = function(x){
			 $scope.m.itemno = x;
			 location.href = '#edit-appointee';
		 }

		$scope.class = 'page-animate';

		
	})
	app.controller('ModalInstanceCtrl',function($scope,$uibModalInstance,Globalvar,$http,$route){
		$scope.m = Globalvar;
		console.log($scope.m.itemno);
		$scope.ok = function () {
			
			$http.post('delete-appointee.php', {itemno:$scope.m.itemno}) .success(function(data){
				$uibModalInstance.close();
				$route.reload();
			});
		};

		$scope.cancel = function () {
			$uibModalInstance.dismiss('cancel');
		};
	})

	app.controller('congratulatoryCtrl', function($scope,Globalvar,$route) {
		//reload
		var ctrl = this;
		ctrl.reloadData = function(){
			$route.reload();
		}
		//--reload
		$scope.m = Globalvar;
		$scope.message = $scope.m.message; 
		$scope.class = 'page-animate';
	});

	app.controller('remarksCtrl', function($scope,Globalvar,$route) {
		//reload
		var ctrl = this;
		ctrl.reloadData = function(){
			$route.reload();
		}
		//--reload
		$scope.class = 'page-animate';
	});

	app.controller('processCtrl', function($scope,Globalvar,$route) {
		//reload
		var ctrl = this;
		ctrl.reloadData = function(){
			$route.reload();
		}
		//--reload
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
			$scope.xForm.dateinformed = null;
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

	app.controller('editCtrl',function($scope,$http,$route,Globalvar,$uibModal){
		$scope.xForm = {};
		$scope.date = new Date();
		//reload
		var ctrl = this;
		ctrl.reloadData = function(){
			$route.reload();
		}
		//--reload
		$scope.m = Globalvar;
		$scope.message = $scope.m.message; 
		$http.post('get-single-appointee.php', {itemno:$scope.m.itemno}) .success(function(data){
			$scope.appointee = data;
			$scope.date = new Date(data.dateinformed);
			data.dateinformed = $scope.date;
			$scope.position = data.position;
			$scope.reply - data.reply;
			$scope.xForm = data;
			console.log($scope.xForm.position);
		});

		$scope.ProcessForm = function(){
			console.log($scope.xForm.position)
			$http.post('edit-appointee.php', $scope.xForm) .success(function(data){
				//$('#modal-container-505047').modal('show')
				$scope.open();

			});
		}
		$scope.today = function() {
		//$scope.xForm.dateinformed = new Date();
		};

		$scope.today();

		$scope.clear = function() {
			
			$scope.xForm.dateinformed = null;
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


		$scope.format = 'yyyy-MM-dd';
		$scope.altInputFormats = ['yyyy-MM-dd'];

		$scope.popup2 = {
			opened: false
			
		};
		//modal
		$scope.open = function () {
			 $uibModal.open({
				animation: true,
				ariaLabelledBy: 'modal-title',
				ariaDescribedBy: 'modal-body',
				templateUrl: 'myModalOK.html',
				controller : 'ModalOKCtrl',
				controllerAs: '$ctrl',
				size: 'sm',
				resolve: {
				}
				});
		 }
		
	});

	app.controller('ModalOKCtrl',function($scope,$uibModalInstance,Globalvar,$http,$route){
		$scope.m = Globalvar;
		console.log($scope.m.itemno);
		$scope.ok = function () {
				$uibModalInstance.close();
				$route.reload();
				window.location.href="#/appointee";
		};

	});