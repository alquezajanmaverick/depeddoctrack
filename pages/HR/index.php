<?php 
	require_once("../../connection/PHPpdo.php");
	$db = new DatabaseConnect();
	$db->query("CALL fetchpositions");
	$x = $db->resultset();
	$r = $db->rowCount();
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../libs/css/bootstrap-paper.css">
<script src="../../libs/js/jquery-3.1.0.min.js"></script>
<script src="../../libs/js/angular.min.js"></script>
<script src="../../libs/js/ui-bootstrap.min.js"></script>
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
            <a class="navbar-brand" href="#">HRMO</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="assignment.php">Appointees <span class="sr-only">(current)</span></a>
                </li>
                <li><a href="congratulatory.php">Congratulatory</a>
                </li>
                <li><a href="process.php">Processing</a>
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

<div class="container-fluid">
	<div class="jumbotron">
    <p>List of Vacant Position:</p>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><center>Item No</center></th>
                <th><center>Position</center></th>
                <th><center>Category</center></th>
                <th><center>Level</center></th>
                <th><center>District</center></th>
                <th><center>School Name</center></th>
                <th><center>School ID</center></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($x as $position){ ?>
            <tr>
                <td><center><?php echo $position['itemno']; ?></center></td>
                <td><center><?php echo $position['position']; ?></center></td>
                <td><center><?php echo $position['positioncategory']; ?></center></td>
                <td><center><?php echo $position['schoollevel']; ?></center></td>
                <td><center><?php echo $position['district']; ?></center></td>
                <td><center><?php echo $position['schoolname']; ?></center></td>
                <td><center><?php echo $position['schoolid']; ?></center></td>
                <td><center><button type="button" onclick="window.location.assign('add-appointee.php?itemno=<?php echo $position['itemno']; ?>')" class="btn btn-xs btn-success glyphicon glyphicon-plus-sign"> Assign</button></center></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
    <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>-->
    </p>
</div>
</div>


</body>
</html>