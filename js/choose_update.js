angular.module("choose_update",['ngCookies'])
.controller("choose_updatecontroller",["$scope","$http","$cookies",function($scope,$http,$cookies){
	$scope.choose = choose
	var de_cho_id = $cookies.get('de_cho_id')
	de_cho_id = JSON.parse(de_cho_id)
	console.log(de_cho_id)
	$scope.good = parseInt(de_cho_id[5])
	$scope.total = parseInt(de_cho_id[7])
	// $scope.checked = checked
	// $scope.datachecked = {}
	// var data2Insert = {}
	function choose(){
		 console.log(111)	
		if (de_cho_id[4] < $scope.good) {
			console.log($scope.good)	
			$scope.good = parseInt(de_cho_id[4])

		};
		$scope.total = parseInt(de_cho_id[3]) * $scope.good
	}
	
	
}])