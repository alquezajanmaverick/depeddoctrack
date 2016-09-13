<?php 
require_once("../../connection/PHPpdo.php");
if(isset($_GET['itemno'])){
	$db = new DatabaseConnect();
	$db->query("CALL forcongratulatory");
	$x =$db->single();
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../libs/css/bootstrap-paper.css">
<script src="../../libs/js/angular.min.js"></script>
<script src="../../libs/js/angular-filter.min.js"></script>
<script src="../../libs/js/jquery-3.1.0.min.js"></script>
<script src="../../libs/js/ui-bootstrap.min.js"></script>
<script src="updtcong-script.js"></script>
</head>

<body ng-app="congupdateApp" ng-controller="congupdateCtrl">
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
                <li class="active"><a 
                 href="#">Congratulatory</a>
                </li>
                <li><a href="process.php">Processing</a>
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

<br><br>
    
    <div class="container-fluid">
    	<div class="row">
        	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Congratulatory Update</h3>
            </div>
            <div class="panel-body">
                
                <form method="POST" action="update-congprocess.php" class="form-horizontal">
                    <div class="form-group">
                        <label for="itemno" class="col-sm-2 control-label">Item Number:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="itemno" name="itemno" placeholder="Item Number" value="<?php echo $x['itemno']; ?>" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-sm-2 control-label">Position</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="<?php echo $x['position']; ?>" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="schoolname" class="col-sm-2 control-label">School Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="schoolname" name="schoolname" placeholder="School Name" value="<?php echo $x['schoolName']; ?>" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dateinformed" class="col-sm-2 control-label">Date Informed</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="text" name="effectivity" ng-model="dateinformed" class="form-control" id="effectivity" placeholder="Effectivity of Appointment"  uib-datepicker-popup="yyyy-MM-dd" datepicker-options="datepicker" is-open="popup.opened" ng-init="parseme('<?php echo $x['dateinformed']; ?>')">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" ng-click="open()"><i class="glyphicon glyphicon-calendar"></i></button>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duedate" class="col-sm-2 control-label">Due Date of Submission</label>
                        <div class="col-sm-10">
                            <input type="text" name="duedate" ng-model="effectivity" class="form-control" id="duedate" placeholder="Due Date of Submission"  uib-datepicker-popup="yyyy-MM-dd" datepicker-options="datepicker" is-open="popup1.opened" ng-init="parseme2('<?php echo $x['duedate']; ?>')">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="datereleased" class="col-sm-2 control-label">Due Date of Submission</label>
                        <div class="col-sm-10">
                            <input type="text" name="datereleased" ng-model="effectivity" class="form-control" id="datereleased" placeholder="Date Released to SDS"  uib-datepicker-popup="yyyy-MM-dd" datepicker-options="datepicker" is-open="popup2.opened" ng-init="parseme3('<?php echo $x['hrmodate']; ?>')">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" ng-click="open2()"><i class="glyphicon glyphicon-calendar"></i></button>
                                </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input name="isSDS" type="checkbox" ng-model="isSDS" ng-init="isSDS=<?php if($x['isSDS']=='YES'){echo "true";}else{echo "false";}; ?>">Released to SDS
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
	</div>
    </div>
</div>
</body>
</html>