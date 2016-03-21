angular.module('order', [])
  .controller('orderController', ['$scope','$http','$location',function($scope,$http,$location) {
    console.log('xxxx')
  	//getCustommer()
    getOrder()
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
    function getOrder(){
      var path = $location.absUrl()
      path = path.split('?')[1]
      var id = path.split('=')[1]
      $http.get('../update/get_orders.php?id='+id).success(function(data){
        console.log(data)
        $scope.orderDate = new Date(data.orders_date)
        $scope.changOrderDate()
      })
    }
  }]).controller('getdateController', ['$scope','$http',function($scope,$http) {
    $scope.date = moment().format("DD MMMM YYYY")
  }])

  