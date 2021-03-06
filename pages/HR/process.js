'use strict';
var app = angular.module('processApp',['ui.bootstrap']);

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

app.controller('processCtrl',function($scope,$http){
	$http.get("get-process.php")
	.then(function(response){
		$scope.Xdata = response.data;
	});
	
	$scope.check = true;
	$scope.validateDoor = function(x){
		console.log(x)
		if(x == false){
			$scope.check = false
		}else{
			$scope.check=true;
		}
	}
	
	$scope.updateMe = function(x,y){
		$http.post('updateprocess.php', {itemno:x,xdate:y}) 
			.success(function(data){
			window.location.reload();
		});
	}
});