angular.module("unit_select",[]).controller("unit_selectcontroller",["$scope","$http","$location",function($scope,$http,$location){
	$scope.fun = fun
	console.log($scope.non)
	recive()
	function fun(){
		console.log($scope.non)
		$http.get('../insert/unit_price_select.php?pg_id='+$scope.non).then(function(res){
			$scope.result = res.data[0]
		}, function(res){
			console.log (res)
		})
	}
	function recive(){
      var path = $location.absUrl()
      path = path.split('?')[1]
      if(path){
      	var id = path.split('=')[1]
      	get_recive_id(id)
      }
    }

    function get_recive_id(id){
    	$http.get('../insert/get_detail_recive.php?detail_recive_id='+id).then(function(res){
			console.log(res.data)
			$scope.datas = res.data
			$scope.non = $scope.datas.first[0][0]
			console.log($scope.non)	
			fun()
		}, function(res){
			console.log (res)
		})
    }
}])
