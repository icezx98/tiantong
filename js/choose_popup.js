angular.module("choose_select_popup",['ngAnimate','ui.bootstrap'])
.controller("choose_select_popup_controller",["$scope","$http","$location","$uibModalInstance","items",function($scope,$http,$locationm,$uibModalInstance,items){
$scope.result = items;
$scope.disable = true;
console.log(items[0][0].price_unit)
$scope.ok = function(){
	console.log('ggg',$scope.result)
    $uibModalInstance.close($scope.result);
    // alert('123')
    // $scope.cb = true
  };
  $scope.cancle = function(){
	console.log('ccc',$scope.result)
    $uibModalInstance.dismiss('cancle');
    // alert('123')
    // $scope.cb = true
  };
$scope.checkValid = function(index){
	if(index !== undefined){
		$scope.result[0][index].total = $scope.result[0][index].price_unit * $scope.result[0][index].qty
	}
	$scope.disable = false;
	$scope.result[0].forEach(function(value){
		// console.log(value.qty)
		if(value.qty === undefined || value.qty === null){
			$scope.disable = true;
		}

	})
};
$scope.checkValid(undefined)
}])
