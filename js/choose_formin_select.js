angular.module("choose_select",['ngAnimate','ui.bootstrap','choose_select_popup'])
.controller("choose_selectcontroller",["$scope","$http","$location","$uibModal",function($scope,$http,$locationm,$uibModal){
	$scope.choose = choose
	$scope.cl2 = cl2
	$scope.bbb = bbb
	$scope.check2 = check2
	$scope.insert = insert
	$scope.insert2 = insert2
	$scope.box = []
	// $scope.checked = checked
	// $scope.datachecked = {}
	var data2Insert = {}
	function choose(){
		$http.get('../insert/choose_formin_select.php?garden_id='+$scope.cho).then(function(res){
			$scope.result = res.data
			bbb(getIdDetail(res.data))
			// console.log($scope.result)
		}, function(res){
			console.log (res)
		})
	}
	
	function cl2(param,param2,index){
		// console.log(param)
		// console.log(param2)
		$scope.re_id = param2
		 var modalInstance = $uibModal.open({
	      templateUrl: 'choose_popup.html',
	      controller: 'choose_select_popup_controller',
	      size:'lg',
	      resolve: {
	        items: function () {
	          return $scope.result2[param];
	        }
	      }
	    });
	    modalInstance.result.then(function () {
	    	$scope.check2[index] = true
	    	check2(param)
	    }, function () {
	    	// $scope.box = true
	      console.log('Modal dismissed at: ' + new Date());
	    });
	}
	
	function bbb(detailId){
		$http.get('../insert/choose_click_select.php?garden_id='+$scope.cho+"&de_spread_id="+detailId).then(function(res){
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
			detailId.push(param[n][0])
		}
		return detailId
	}

	function check2(key){
		if(data2Insert[key]){
			data2Insert[key] = undefined
		}else if(!data2Insert[key]){
			data2Insert[key] = $scope.result2[key]
		}	
	}

	function insert(){
		// console.log($scope.re_id)
		insert2($scope.re_id)
	}

	function insert2(re_id){
		if(re_id === undefined) {
			insert($scope.re_id)
		};
		$scope.choose_id = document.getElementById("choose_id").value;
		$scope.employee_id = document.getElementById("employee").value;
		// console.log(re_id)
		var a = {
			'choose_id' : $scope.choose_id,
			'cho' : $scope.cho,
			'orderDate' : $scope.orderDate,
			'employee_id' : $scope.employee_id,
			'recive_id' : re_id
		}
		data = [a,data2Insert]
		console.log(data)
		$http.post('./choose_click_insert.php',data).then(function(res){
			console.log(res.data)
			location.reload();
		}, function(res){
		})
	}
}])