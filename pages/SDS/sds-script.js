var app = angular.module('sdsApp',['ngRoute','ui.bootstrap']);
app.factory("Globalvar",function(){
        return {};
});

app.config(["$httpProvider", function ($httpProvider) {
    $httpProvider.defaults.transformResponse.push(function(responseData){
        convertDateStringsToDates(responseData);
        return responseData;
    });
}]);

var regexIso8601 = /^(\d{4}|\+\d{6})(?:-(\d{2})(?:-(\d{2})(?:T(\d{2}):(\d{2}):(\d{2})\.(\d{1,})(Z|([\-+])(\d{2}):(\d{2}))?)?)?)?$/;

function convertDateStringsToDates(input) {
    // Ignore things that aren't objects.
    if (typeof input !== "object") return input;

    for (var key in input) {
        if (!input.hasOwnProperty(key)) continue;

        var value = input[key];
        var match;
        // Check for string properties which look like dates.
        // TODO: Improve this regex to better match ISO 8601 date strings.
        if (typeof value === "string" && (match = value.match(regexIso8601))) {
            // Assume that Date.parse can parse ISO 8601 strings, or has been shimmed in older browsers to do so.
            var milliseconds = Date.parse(match[0]);
            if (!isNaN(milliseconds)) {
                input[key] = new Date(milliseconds);
            }
        } else if (typeof value === "object") {
            // Recurse into object
            convertDateStringsToDates(value);
        }
    }
}

app.controller('sdsCtrl',function($scope,$http,Globalvar,$uibModal){
        $scope.m = Globalvar;
        $scope.showAlert = false;
         $http.get("get-data.php")
            .then(function(response) {
                $scope.data = response.data;
               
                if($scope.data.ok === "YES"){
                       
                }
        });


        var ctrl = this;

        $scope.openModal = function (item,xname) {
                $scope.m.itemno = item;
				$scope.m.name = xname;
                var modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: 'modal.html',
                controller: 'ModalInstanceCtrl',
                controllerAs: '$ctrl',
                resolve: {
                        items: function () {
                        return ctrl.items;
                        }
                }
                });
        };

		$scope.format = 'yyyy-MM-dd';
		$scope.altInputFormats = ['yyyy-MM-dd'];

		$scope.m.opened = false;
			
	
});


app.controller('ModalInstanceCtrl', function($scope,$uibModalInstance,Globalvar,$http) {
        $scope.m = Globalvar;
        $scope.title = $scope.m.name+" -- "+$scope.m.itemno;
        $scope.today = function() {
                $scope.dt = new Date();
                };
        $scope.today();

         $scope.popup = {
         opened: false
        };
        $scope.close = function(){
                $uibModalInstance.dismiss('cancel');
        };
        $scope.open = function() {
                $scope.popup.opened = true;
        };

        $scope.go =function(){
                $http.post('released-sds.php', {itemno:$scope.m.itemno,xdate:$scope.dt}) .success(function(){
                        $uibModalInstance.dismiss('cancel');
                        window.location.reload();
                });
        };
});

// congratulatory
app.controller('congCtrl',function($scope,$http){
	$scope.Date = function(arg){
	   return new Date(arg);
	};
	
	$http.get("congratulatoryBE/get-congdata.php")
            .then(function(response) {
                $scope.data = response.data;
				
        });
		
	$scope.parseme = function(x){
		return new Date(x);
	}

	$scope.updateitem = function(x,y,z){
		if(z==false){
			$http.post('congratulatoryBE/post-date.php', {itemno:x,SDSreleaseddate:y}) .success(function(data){
			window.location.reload();
        });
		}
	}

});


// appointment
app.controller('appointCtrl',function($scope,$http){
	$http.get("congratulatoryBE/get-congdata.php")
            .then(function(response) {
                $scope.data = response.data;
                
        });
});