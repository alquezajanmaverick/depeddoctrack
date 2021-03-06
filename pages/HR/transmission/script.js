var app = angular.module('transApp',['ui.bootstrap']);
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

app.controller('transCtrl',function($scope,$http){
	$http.get("get-data.php")
		.then(function(response) {
			$scope.data = response.data;
	});
	
	
	$scope.postNow = function(x,y){
		$http.post('post-datereceived.php', {itemno:x,xdate:y}) 
			.success(function(data){
		window.location.reload();
		});
	}
	$scope.postNow1 = function(x,y){
		$http.post('post-datetransmitted.php', {itemno:x,xdate:y}) 
			.success(function(data){
		window.location.reload();
		});
	}
	$scope.postNow2 = function(x,y){
		console.log(y);
		$http.post('post-datereceivedCSC.php', {itemno:x,xdate:y}) 
			.success(function(data){
		window.location.reload();
		});
	}
	$scope.postNow3 = function(x,y){
		$http.post('post-released.php', {itemno:x,xdate:y}) 
			.success(function(data){
		window.location.reload();
		});
	}
	
	
	
	//-----------------------------------
	$scope.check=true;
	$scope.checkDoor = function(x){
		console.log(x);
		if(x==true){
			$scope.check = true;
		}else{
			$scope.check = false;
		}
	}
	
	//-----------------------------------
	$scope.check1=true;
	$scope.checkDoor1 = function(x){
		console.log(x);
		if(x==true){
			$scope.check1 = true;
		}else{
			$scope.check1 = false;
		}
	}
	
	//-----------------------------------
	$scope.check2=true;
	$scope.checkDoor2 = function(x){
		console.log(x);
		if(x==true){
			$scope.check2 = true;
		}else{
			$scope.check2 = false;
		}
	}
	
	//-----------------------------------
	$scope.check3=true;
	$scope.checkDoor3 = function(x){
		console.log(x);
		if(x==true){
			$scope.check3 = true;
		}else{
			$scope.check3 = false;
		}
	}
	
});