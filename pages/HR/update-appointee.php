<?php
require_once("../../connection/PHPpdo.php");

if(isset($_GET['itemno'])){
	$db = new DatabaseConnect();
	$db->query("CALL fetchsingleappointee(?)");
	$db->bind(1,$_GET['itemno']);
	$x = $db->single();
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
<script src="updscript.js"></script>
</head>

<body ng-app="updtApp" ng-controller="updtCtrl">
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
<br><br><br><br>
<div class="container-fluid">
	<div class="row">
    	<div class="col-md-8 col-md-offset-2">
        
        	<div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Appointing to vacant position ...</h3>
                </div>
                <div class="panel-body">
                    
                    
                   <form method="post" action="update-process.php" class="form-horizontal">
            	
                        <div class="form-group">
                            <label for="itemno" class="col-sm-2 control-label">Item number :</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $x['itemno']; ?>" name="itemno" class="form-control" id="itemno" placeholder="Item number" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pos" class="col-sm-2 control-label">Position:</label>
                            <div class="col-sm-10">
                               <input type="text" value="<?php echo $x['position']; ?>" name="pos" class="form-control" id="pos" placeholder="Position" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-sm-2 control-label">Category :</label>
                            <div class="col-sm-10">
                               <input type="text" value="<?php echo $x['category']; ?>" name="category" class="form-control" id="category" placeholder="Position" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="schoolID" class="col-sm-2 control-label">School ID :</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $x['schoolID']; ?>" name="schoolID" class="form-control" id="schoolID" placeholder="School ID" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="schoolname" class="col-sm-2 control-label">School Name :</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $x['schoolName']; ?>" name="schoolname" class="form-control" id="schoolname" placeholder="Position" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name :</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $x['name']; ?>" name="name" class="form-control" id="name" placeholder="Name" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10 col-lg-offset-0 col-lg-12">
                                <div class="col-md-6">
                                    <label for="name" class="col-sm-3 control-label">Date Informed :</label>
                                    <div class="col-sm-8 col-lg-8 col-lg-offset-1">
                                        <input type="text" name="dateinformed" ng-model="dateinformed" uib-datepicker-popup="yyyy-MM-dd" datepicker-options="datepicker" class="form-control" id="dateinformed" placeholder="Date informed" is-open="popup2.opened" ng-init="parseme('<?php echo $x['dateinformed']; ?>')" required>
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" ng-click="open2()"><i class="glyphicon glyphicon-calendar"></i></button>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="reply" class="col-sm-2 control-label">Reply :</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $x['reply']; ?>"  name="reply" class="form-control" id="reply" placeholder="Reply" required >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Effectivity of Appointment :</label>
                            <div class="col-sm-10">
                                <input type="text" name="effectivity" ng-model="effectivity" class="form-control" id="effectivity" placeholder="Effectivity of Appointment"  uib-datepicker-popup="yyyy-MM-dd" datepicker-options="datepicker" is-open="popup.opened" ng-init="parseme2('<?php echo $x['effectivity']; ?>')" required>
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" ng-click="open()"><i class="glyphicon glyphicon-calendar"></i></button>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-sm-2 control-label">Remarks :</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="remarks" ng-model="remarks" ng-init="remarks = '<?php echo $x['remarks']; ?>'" name="remarks" placeholder="Remarks" required>		
                                	<option value="">--</option>
                                    <option value="NOT SUBMITTED">NOT SUBMITTED</option>
                                    <option value="RETURNED FOR COMPLIANCE">RETURNED FOR COMPLIANCE</option>
                                    <option value="COMPLETE AND RECEIVED">COMPLETE AND RECEIVED</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default glyphicon glyphicon-send"> Submit</button>
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