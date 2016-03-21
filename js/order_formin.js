angular.module('order', [])
  .controller('orderController', ['$scope','$http',function($scope,$http) {
    console.log('xxxx')
  	getCustommer()
  	$scope.changOrderDate = function () {
  		$scope.sendDate =moment($scope.orderDate).format("YYYY-MM-DD")
  		console.log($scope.sendDate)
  	};
  	$scope.chnageCustomer = function(param){
  		$scope.showDropdown = $scope.data[param]
  		console.log($scope.showDropdown)
  		if(param==='company'){
  			$scope.isCompany = true
  		}else{
  			$scope.isCompany = false
  		}
  	}

  	function getCustommer(){
  		$http.get('../insert/order_select.php').success(function(data){
  			$scope.data=data
  			$scope.showDropdown = $scope.data.company
  			$scope.isCompany = true
  		})
  	}
  }]).controller('getdateController', ['$scope','$http',function($scope,$http) {
    $scope.date = moment().format("DD MMMM YYYY")
  }])

  