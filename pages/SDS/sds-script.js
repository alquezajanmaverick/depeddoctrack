var app = angular.module('sdsApp',['ngRoute','ui.bootstrap']);
app.factory("Globalvar",function(){
        return {};
});
app.controller('sdsCtrl',function($scope,$http,Globalvar,$uibModal,$route){
        $scope.m = Globalvar;
        $scope.showAlert = false
         $http.get("get-data.php")
            .then(function(response) {
                $scope.data = response.data;
                console.log(response.data);
                if($scope.data.ok === "YES"){
                        print('true');
                }
        });


        var ctrl = this;

        $scope.openModal = function (item) {
                $scope.m.itemno = item;
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
                })
        }

		$scope.format = 'yyyy-MM-dd';
		$scope.altInputFormats = ['yyyy-MM-dd'];

		$scope.m.opened = false
			
	
})


app.controller('ModalInstanceCtrl', function($scope,$uibModalInstance,Globalvar,$http,$route) {
        $scope.m = Globalvar;
        $scope.title = $scope.m.itemno;
        $scope.today = function() {
                $scope.dt = new Date();
                };
        $scope.today();

         $scope.popup = {
         opened: false
        };
        $scope.close = function(){
                $uibModalInstance.dismiss('cancel');
        }
        $scope.open = function() {
                $scope.popup.opened = true;
        };

        $scope.go =function(){
                $http.post('released-sds.php', {itemno:$scope.m.itemno,xdate:$scope.dt}) .success(function(data){
                        $uibModalInstance.dismiss('cancel');
                        window.location.reload();
                });
        }
});