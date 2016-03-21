angular.module('order', [])
  .controller('orderController', ['$scope','$http','$location',function($scope,$http,$location) {
    var path = $location.absUrl()
        path = path.split('?')[1]
        var id = path.split('&')
        console.log(id)
    getProduct()
    $scope.test= 'ffff'
    
    function getProduct(){
    	$http.get('../detail_product_select.php?'+id[1]+'&'+id[2]).success(function(data){
    		$scope.product=data
    		getParameterFromUrl()
    	})
    }
    $scope.getColor = function (change){
    	if(change){
    		$scope.params = undefined
    		$scope.colorSelect = ""
    		$scope.sizeSelect = ""
			$scope.unitSelect = ""
    	}
    	$http.get('../detail_product_color.php?'+id[1]+'&'+id[2]+'&productName='+$scope.product[$scope.productSelect][0]).success(function(data){
    		$scope.color=data
    		console.log($scope.color)
    		getColorEdit()
    	})
    }
    $scope.getSize = function (change){
    	if(change){
    		$scope.params = undefined
    		$scope.sizeSelect = ""
			$scope.unitSelect = ""
    	}
    	$http.get('../detail_product_size.php?'+id[1]+'&'+id[2]+'&productName='+$scope.product[$scope.productSelect][0]+"&colorId="+$scope.color[$scope.colorSelect][0]).success(function(data){
    		$scope.size=data
    		console.log($scope.size)
    		getSizeEdit()
    	})
    }
    $scope.getUnit = function (change){
    	if(change){
    		$scope.params = undefined
    		$scope.unitSelect = ""
    	}
    	console.log($scope.size[$scope.sizeSelect][0])
    	$http.get('../detail_product_unit.php?'+id[1]+'&'+id[2]+'&productName='+$scope.product[$scope.productSelect][0]+"&colorId="+$scope.color[$scope.colorSelect][0]+"&sizeId="+$scope.size[$scope.sizeSelect][0]).success(function(data){
    		$scope.unit=data
    		console.log($scope.unit)
    		getUnitEdit()
    	})
    }
    $scope.getId = function (){
    	console.log($scope.unit[$scope.unitSelect][0])
    	$http.get('../product_select_id.php?productName='+$scope.product[$scope.productSelect][0]+"&colorId="+$scope.color[$scope.colorSelect][0]+"&sizeId="+$scope.size[$scope.sizeSelect][0]+"&unitId="+$scope.unit[$scope.unitSelect][0]).success(function(data){
    		$scope.id=data[0][0]
    		console.log('id',$scope.id)
    	})
    }
    function getParameterFromUrl() {
    	var url = decodeURIComponent(window.location.search.substring(1))
    	if(url){
    		var params=url.split('&')
	    	$scope.params= {}
	    	angular.forEach(params,function(value){
	    		var temp = value.split('=')
	    		$scope.params[temp[0]] = temp[1] 
	    	})
	    	console.log($scope.params)
	    	getProductEdit()
    	}
    	
    }
   function getProductEdit(){
   		for(var n =0 ;n < $scope.product.length;n++){
     		if($scope.product[n][1] == $scope.params.productName){
     			$scope.productSelect = n.toString()
     			$scope.getColor()
     			break
     		}else{
     			console.log($scope.product[n][1], $scope.params.productName)
     		}
     	}
    }
    function getColorEdit(){
    	if($scope.params){
    		for(var n =0 ;n < $scope.color.length;n++){
     		if($scope.color[n][1] == $scope.params.productcolor){
     			$scope.colorSelect = n.toString()
     			$scope.getSize()
     			break
     		}else{
     			console.log($scope.color[n][1], $scope.params.productName)
     		}
     	}
    	}
    }
    function getSizeEdit(){
    	if($scope.params){
    		for(var n =0 ;n < $scope.size.length;n++){
    			console.log('fdf')
     		if($scope.size[n][1] == $scope.params.productsize){
     			$scope.sizeSelect = n.toString()
     			$scope.getUnit()
     			break
     		}else{
     			console.log($scope.size[n][1], $scope.params.productName)
     		}
     	}
    	}
    }
    function getUnitEdit(){
    	if($scope.params){
    		for(var n =0 ;n < $scope.unit.length;n++){
     		if($scope.unit[n][1] == $scope.params.productunit){
     			$scope.unitSelect = n.toString()
     			$scope.getId()
     			break
     		}else{
     			console.log($scope.unit[n][1], $scope.params.productName)
     		}
     	}
    	}
    }
  }])

