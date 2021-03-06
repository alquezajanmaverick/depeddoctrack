
var app = angular.module('mainApp',['ngRoute','ngAnimate','angular.filter','ui.bootstrap']);
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

			.when('/monitor', {
				templateUrl : 'redirect/monitoring.html',
				controller  : 'monitorCtrl'
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

			// route for the congratulatory page
			.when('/add-congratulatory', {
				templateUrl : 'redirect/add-congratulatory.html',
				controller  : 'addcongratulatoryCtrl'
			})

			// route for the congratulatory page
			.when('/edit-congratulatory', {
				templateUrl : 'redirect/edit-congratulatory.html',
				controller  : 'editcongratulatoryCtrl'
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

			 .otherwise({
				templateUrl: 'redirect/404.html'
			});
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
		
		$scope.appointNow = function(x,y)
		{
			$scope.m.itemno = x;
			$scope.m.pos = y;
			window.location.href = "#add-appointee";
			console.log(x);
		}
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
		
		 $scope.openEdit = function(x,y){
			 $scope.m.itemno = x;
			 $scope.m.pos = y;
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
		$scope.m = Globalvar;
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
			$scope.m.itemno = $scope.xForm.itemno;
			$http.post('add-appointee.php', $scope.xForm) .success(function(data){
				//$('#modal-container-505047').modal('show')
				location.href = '#/add-congratulatory';
				//console.log();
			});
		};
		
		$scope.updateItemNo =function(x){
			$http.post('assign-itemno.php', {item : x}) .success(function(data){
				$scope.xForm.itemno = data.itemno;
				console.log($scope.xForm.itemno);
			});
		};
		
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

		 $http.get("get-position.php")
		.then(function(response) {
			$scope.pos = response.data;
			console.log($scope.pos.position);
		});
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
			$scope.xForm.olditemno = $scope.m.itemno;
			$http.post('edit-appointee.php', $scope.xForm) .success(function(data){
				//$('#modal-container-505047').modal('show')
				//$scope.open();
				window.location.href = '#/edit-congratulatory';

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

	app.controller('monitorCtrl',function($scope,$http,$route){
		$scope.dynamic = 0;
		var type
		$http.get("monitor.php")
		.then(function(response) {
			$scope.monitoring = response.data;
		});
		
	})

	app.controller('addcongratulatoryCtrl',function($scope,$http,$route,Globalvar,uibDateParser,$filter,$uibModal){
		$scope.m = Globalvar;

		$scope.xForm = {};
		$scope.xForm.itemno = $scope.m.itemno;
		$scope.xForm.isReleased = false;
		$scope.xForm.effectivity = "";
		$scope.today = function() {
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

		$scope.popup2 = {
			opened: false
		};

		$scope.formats = ['yyyy-MM-dd'];
		$scope.format = $scope.formats[0];
		$scope.altInputFormats = ['yyy-MM-dd'];

		$scope.open1 = function() {
			$scope.popup.opened = true;
			};

			$scope.popup = {
				opened: false
			};

		$scope.radioModel = "Not Submitted";
		
		$scope.validateRelease = function(x){
			if(x == true){
				$scope.xForm.isReleased = "YES";
			}
			else
			{
				$scope.xForm.isReleased = "NO";
			}
		}

		$scope.appendCongratulatory = function(){
				$scope.xForm.remarks = $scope.radioModel;

				$scope.validateRelease($scope.xForm.isReleased);

				if(angular.isUndefined($scope.xForm.datetoSDS))
				{
					$scope.xForm.datetoSDS = null;
				}
				if(angular.isUndefined($scope.xForm.datesubmission))
				{
					$scope.xForm.datesubmission = null;
				}
				$http.post('add-congratulatory.php', $scope.xForm) .success(function(data){
						$scope.open()
				});
		}
			
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
			

	})

	