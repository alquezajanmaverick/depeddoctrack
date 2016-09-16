<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../libs/css/bootstrap-paper.css">
<script src="../../libs/js/jquery-3.1.0.min.js"></script>
<script src="../../libs/js/angular.min.js"></script>
<script src="../../libs/js/ui-bootstrap.min.js"></script>
<script src="../../libs/js/dirPaginate.js"></script>
<script src="process.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">HRMO</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="assignment.php">Appointees <span class="sr-only">(current)</span></a>
                </li>
                <li><a href="congratulatory.php">Congratulatory</a>
                </li>
                <li class="active"><a href="#">Processing</a>
                </li>
                
              </li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../../log-out.php">Sign-Out</a>
                </li>
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<div class="container-fluid" ng-app="processApp" ng-controller="processCtrl">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<div class="jumbotron">
                <h3>Appointees under process ...</h3>
                <p></p>
                <div class="table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th><center>Item No.</center></th>
                                <th><center>Position</center></th>
                                <th><center>School ID</center></th>
                                <th><center>School Name</center></th>
                                <th><center>Name</center></th>
                                <th><center>Date Received</center></th>
                                <th><center>Date Released</center></th>
                                <th><center></center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in Xdata">
                                <td><center>{{x.itemno}}</center></td>
                                <td><center>{{x.position}}</center></td>
                                <td><center>{{x.schoolID}}</center></td>
                                <td><center>{{x.schoolName}}</center></td>
                                <td><center>{{x.name}}</center></td>
                                <td><center><input style="height:20px;width:130px" type="date" ng-model="x.hrmodatereceived" readonly></center></td>
                                <td><center><input style="height:20px;width:130px" type="date" ng-model="x.hrmodatereleased" ng-disabled="toggle"><button type="button" class="btn btn-primary btn-xs glyphicon glyphicon-calendar" ng-model="toggle" ng-init="toggle='false'" uib-btn-checkbox btn-checkbox-true="false" btn-checkbox-false="true" ng-click="validateDoor(toggle)"></button></center></td>
                                <td><button type="button" class="btn btn-success btn-xs glyphicon glyphicon-check" ng-disabled="check" ng-click="updateMe(x.itemno,x.hrmodatereleased)"></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>	
</div>

</body>
</html>