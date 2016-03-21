<html ng-app="test">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	 <script type="text/javascript" src="angular.min.js"></script>
	 <script type="text/javascript" src="js/testjs.js"></script>
</head>
<body ng-controller="testcontroller">
 
<table border="1"  ng-click="a()">
	<tr ng-repeat="ice in non track by $index">
  		<td ng-repeat="nic in ice track by $index">{{nic}}</td> 
	</tr>
</table>

</body>
</html>