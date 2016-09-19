var app = angular.module('notifApp',['angular-toast']);

app.controller('notifCtrl',function($scope,$http,toast){
    /**
    $http.get("notification/notif.php")
    .then(function(response) {
        $scope.listNotif = response.data;
       
        if($scope.listNotif.row == undefined){
            angular.forEach($scope.listNotif,function(value,key){
                $scope.notify(value['name']+" -- "+value['position']+" will expire at the end of the day. <a href='notif.php#/?itemn="+value['itemno']+"'>Click here</a>",10000);
                
            });
        }else{

        }
    });
    **/
    $http.get("notification/notifrow.php")
    .then(function(response) {
        $scope.listNotif = response.data;
        
        if($scope.listNotif > 0){
            $scope.notify("<strong>"+$scope.listNotif+"</strong> appointee/s will exceed the due date of submission tomorrow. <strong><a href='notification/show-warning.html'>View Details</a></strong>",9000);
        }
    });

    
     $scope.notify = function(e){
            return toast.show(e || 'Alert')
        }
})