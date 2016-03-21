angular.module('test',[]).controller('testcontroller',['$scope','$http',function($scope,$http){
	$http.get('./testphp.php').then(function success(res){
		console.log(res.data)
	 $scope.non = res.data
	}, function error(res){
		console.log('error')
	})
	$scope.a = function(){
		$scope.non.push($scope.non[0])
	}
	
}])

