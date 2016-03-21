<!DOCTYPE html>
<html ng-app>
  <head>
    <meta charset="utf-8" />  
    <script type="text/javascript" src="angular.min.js"></script>
    <title>My Learn AngularJs 1</title> 
  </head>
  <body>
    <div>
      <label>Name:</label>
      <input type="text" ng-model="yourName" placeholder="Enter a name here">
      <hr>
      <h1>Hello {{yourName}}!</h1>
    </div>
    
  </body>
</html>