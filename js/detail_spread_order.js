angular.module("spreas",['ngCookies'])
.controller('spreascontroller',["$scope","$http","$location","$cookies",function($scope,$http,$location,$cookies){
	var values=$cookies.get('values')
	console.log(values)
	values = JSON.parse(values)
	var ids = []
	$scope.qty = []
	$scope.gardenNetworkId = []
	$scope.dropdown = []
	$scope.checkQty = checkQty
	$scope.submit = submit
	values.forEach(function(value){
		ids.push(value[0])
	})
	var dataLength = 0
	getDetail()
	function submit(){
		for(var n=0;n<$scope.data.length;n++){
			$scope.data[n].qty=$scope.qty[n]
			$scope.data[n].gardenNetworkId=$scope.gardenNetworkId[n]
		}
		$http.post('./insert/detail_spread_order_formin.php', $scope.data).then(function(res){
		location='./spread_order.php'
		});
	}
 	function checkQty(orderQty,index) {
 		console.log($scope.qty[index],parseInt(orderQty))
 		if($scope.data[index+1] !== undefined){
	 			if($scope.qty[index]<parseInt(orderQty) && $scope.data[index].detail_orders_id !== $scope.data[index+1].detail_orders_id){
	 			$scope.data.splice(index, 0, $scope.data[index]);
	 		}else if($scope.qty[index]>=parseInt(orderQty) && $scope.data[index].detail_orders_id === $scope.data[index+1].detail_orders_id || $scope.qty[index] === null){
	 			$scope.data.splice(index, 1);
	 		}
 		}else{
 			if($scope.qty[index]<parseInt(orderQty)){
	 			$scope.data.splice(index, 0, $scope.data[index]);
	 		}else if($scope.qty[index]>=parseInt(orderQty) || $scope.qty[index] === null){
	 			$scope.data.splice(index, 1);
	 		}
 		}
 	}
 	function getDetail() {
 		$http.get('./checkorder.php?values='+ids).then(function(res){
 			res.data.forEach(function(resValue){
 				values.forEach(function(idValue){
 					if(resValue.orders_id === idValue[0]){
 					resValue.spreadId = idValue[5]
 					}
 				})
 			})
 			$scope.data= res.data
 			getGarden()
 			console.log(res.data)
 		})
 	}
 	function getGarden() {
 		$http.get('./js/getgarden.php?value='+$scope.data[dataLength].product_id+','+$scope.data[dataLength].color_id+','+$scope.data[dataLength].size_id+','+$scope.data[dataLength].unit_measure_id)
 		.then(function(res){
 			if(dataLength+1 === $scope.data.length){
 				$scope.data[dataLength].dropdown = res.data
 			}
 			else{
 				$scope.data[dataLength].dropdown = res.data
 				dataLength++
 				getGarden()
 			}
 			
 		})
 	}
}])