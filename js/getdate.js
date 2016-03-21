angular.module('getdate', [])
  .controller('getdateController', ['$scope','$http',function($scope,$http) {
  	$scope.date = moment().format("DD MMMM YYYY")
  }])