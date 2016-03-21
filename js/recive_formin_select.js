angular.module("recive_select",['ngAnimate','ui.bootstrap','recive_select_popup'])
.controller("recive_selectcontroller",["$scope","$http","$location","$uibModal",function($scope,$http,$locationm,$uibModal){
	$scope.rec = rec
	$scope.cl = cl
	$scope.aaa = aaa
	$scope.check = check
	$scope.insert = insert
	$scope.box = []
	// $scope.checked = checked
	// $scope.datachecked = {}
	var data2Insert = {}
	function rec(){
		$http.get('../insert/recive_formin_select.php?garden_id='+$scope.recive).then(function(res){
			$scope.result = res.data
			aaa(getIdDetail(res.data))
		}, function(res){
			console.log (res)
		})
	}
	
	function cl(param,index){
		console.log(index)
		 var modalInstance = $uibModal.open({
	      templateUrl: 'recive_popup.html',
	      controller: 'recive_select_popup_controller',
	      size:'lg',
	      resolve: {
	        items: function () {
	          return $scope.result2[param];
	        }
	      }
	    });
	    modalInstance.result.then(function () {
	    	$scope.box[index] = true
	    	check(param)
	    }, function () {
	    	// $scope.box = true
	      console.log('Modal dismissed at: ' + new Date());
	    });
	}

	
	function aaa(detailId){
		$http.get('../insert/recive_click_select.php?garden_id='+$scope.recive+"&de_spread_id="+detailId).then(function(res){
			$scope.result2 = res.data
			// console.log($scope.result2[0][0])
			// alert($scope.result2)
			// aaa()

			}, function(res){
			console.log (res)
		})
	}

	function getIdDetail(param){
		var detailId = []
		for(var n=0;n<param.length;n++){
			detailId.push(param[n][1])
		}
		return detailId
	}
	function check(key){
		if(data2Insert[key]){
			data2Insert[key] = undefined
		}else if(!data2Insert[key]){
			data2Insert[key] = $scope.result2[key]
		}	
	}
	function insert(){
		$scope.recive_id = document.getElementById("recive_id").value;
		$scope.employee_id = document.getElementById("employee").value;
		// console.log($scope.recive_id)
		var a = {
			'recive_id' : $scope.recive_id,
			'recive' : $scope.recive,
			'orderDate' : $scope.orderDate,
			'employee_id' : $scope.employee_id
		}
		data = [a,data2Insert]
		console.log(data)
		$http.post('./recive_click_insert.php',data).then(function(res){
			console.log(res.data)
			location.reload();
		}, function(res){
		})
	}
}])