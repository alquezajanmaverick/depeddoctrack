var app = angular.module('positionApp', ['angular.filter']);
app.controller('positionCtrl', function($scope,$http) {
     $http.get("../../pages/school.json")
    .then(function(response) {
        $scope.school = response.data;
		$scope.xForm = {schoolID : $scope.school[0].SchoolID};
		console.log($scope.xForm.schoolID);
    });

    $scope.xForm = {};
	
	$scope.getme = function(x){
		console.log(x);
		$scope.xForm.schoolID = x;
	}
	
	
	
	$scope.b = function(e){
		console.log(e);
	}
    $scope.processForm = function(){
        $http.post('addprocess.php', $scope.xForm) .success(function(data){
            $('#modal-container-505047').modal('show')
        });
    }
    
    $scope.goToHome = function(){
        window.location.assign('../SGOD/');
    }
});

var reader = angular.module('readerApp',['angular.filter']);
reader.controller('readerCtrl',function($scope,$http){
   $http.get("fetchdata.php")
   .then(function(response){
       $scope.result = response.data;
   });
   
   $scope.editPos = function(x){
       $http.get("edit-position.php")
       .then(function(response){
           $scope.result = response.data;
       })
   };
   
   $scope.deleteme = function(x,pos){
        $scope.pos = pos;
       $scope.item = x;
   }
   $scope.deleteNow = function(x){
       $http.post('delete-position.php', {item:x}) .success(function(data){
          
           $http.get("fetchdata.php")
            .then(function(response){
                $scope.result = response.data;
                 $('#myModal').modal('hide');
            });
            
        });
   }
   
   $scope.showUpdate = function(x){
       $scope.id = x;
       $http.get("../../pages/school.json")
        .then(function(response) {
            $scope.school = response.data;
        });
       $http.post('fetchsingle.php', {item:$scope.id}) .success(function(data){
            $scope.result = data.data;
        });
   }

   $scope.showUpdateItem = function(x){
       
       window.location.assign('editprocess?item='+x);
       
   }
   $scope.showDate = function(){
       $('#datepicker').datepicker();
   }
});

