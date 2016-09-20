
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../libs/css/bootstrap-paper.css">
<script src="../../libs/js/angular.min.js"></script>
<script src="../../libs/js/angular-filter.min.js"></script>
<script src="../../libs/js/dirPaginate.js"></script>
<script src="../../libs/js/jquery-3.1.0.min.js"></script>
<script src="../../libs/js/ui-bootstrap.min.js"></script>
<script src="appoint.js"></script>
</head>

<body ng-app="appointApp" ng-controller="appointCtrl">
<nav class="navbar navbar-inverse navbar-static-top navbar-fixed-top">
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
                <li class="active"><a href="#">Appointees <span class="sr-only">(current)</span></a>
                </li>
                <li><a 
                 href="congratulatory.php">Congratulatory</a>
                </li>
                <li><a href="process.php">Processing of Appointment</a>
                </li>
                <li><a href="transmission/">Transmission</a>
                </li>
                
              </li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="log-out.php">Sign-Out</a>
                </li>
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<br><br><br><br>
<div class="container-fluid">
  <div class="jumbotron">
	  <p>List of Appointee.</p>
      <input type="text" ng-model="q" placeholder="Search here ...">
      &nbsp;&nbsp;
      <small>Items per page : </small><input style="width:50px;" type="number" ng-model="ctr" ng-init="ctr=5">
      
	  <div class="table-responsive">
        <table class="table table-condensed">
            <thead class="bg-primary">
                <tr>
                    <th><center>Item No</center></th>
                    <th><center>Position</center></th>
                    <th><center>Category</center></th>
                    <th><center>Name</center></th>
                    <th><center>Assigned School</center></th>
                    <th><center>Date Informed</center></th>
                    <th><center>Effectivity of Appointment</center></th>
                    <th><center>Due Date of Submission</center></th>
                    <th><center>Remarks</center></th>
                    <th colspan="2"><center></center></th>
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="x in appoint | filter:q | itemsPerPage: ctr">
                	<td><center>{{x.itemno}}</center></td>
                    <td><center>{{x.position}}</center></td>
                    <td><center>{{x.category}}</center></td>
                    <td><center>{{x.name}}</center></td>
                    <td><center>{{x.schoolName}}</center></td>
                    <td><center>{{x.dateinformed}}</center></td>
                    <td><center>{{x.effectivity}}</center></td>
                    <td><center>{{x.duedate}}</center></td>
                    <td><center>{{x.remarks}}</center></td>
                    <td><center><button ng-click="updateappointee(x.itemno)" class="btn btn-xs btn-warning glyphicon glyphicon-edit"> UPDATE</button></center></td>
                    <td><center><button ng-click="delappointee(x.itemno)" class="btn btn-xs btn-danger glyphicon glyphicon-trash"> DELETE</button></center></td>
                </tr>
            </tbody>
        </table>
        <dir-pagination-controls template-url="../../libs/js/dirPaginate.html"></dir-pagination-controls>
        
    </div>
  </div>
</div>


</body>
</html>