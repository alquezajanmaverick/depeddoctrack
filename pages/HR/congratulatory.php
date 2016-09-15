<?php 
require_once("../../connection/PHPpdo.php");
$db = new DatabaseConnect();
$db->query("CALL forcongratulatory");
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
                <li><a href="../../log-out.php">Sign-Out</a>
                </li>
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<br><br>
    <div class="container-fluid">
    	<div class="jumbotron">
            <p>Test.</p>
            <div class="table-responsive">
            <table class="table table-condensed">
                <thead class="bg-primary">
                    <tr>
                    	<th><center>Item No</center></th>
                        <th><center>Name</center></th>
                        <th><center>Position</center></th>
                        <th><center>Assigned to</center></th>
                        <th><center>Date Informed</center></th>
                        <th><center>Due Date of Submission</center></th>
                        <th><center>Date Released to SDS</center></th>
                        <th><center>Complete</center></th>
                        <th><center></center></th>
                    </tr>
                </thead>
                <tbody>
                <?php if($r>0){
					foreach($x as $c){
				?>
                	{{if('<?php echo $c['ok']; ?>'=='YES'){color='bg-success'}}}
                    <tr ng-class="color">
                        <td><center><?php echo $c['itemno']; ?></center></td>
                        <td><center><?php echo $c['name']; ?></center></td>
                        <td><center><?php echo $c['position']; ?></center></td>
                        <td><center><?php echo $c['schoolName']; ?></center></td>
                        <td><center><?php echo $c['dateinformed']; ?></center></td>
                        <td><center><?php echo $c['duedate']; ?></center></td>
                        <td><center><?php echo $c['hrmodate']; ?></center></td>
                        <td><center><?php echo $c['ok']; ?></center></td>
                        <td><center><button class="btn btn-xs btn-warning glyphicon glyphicon-edit" onclick="window.location.assign('update-congratulatory.php?itemno=<?php echo $c['itemno']; ?>')"> UPDATE</button></center></td>	
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</body>
</html>