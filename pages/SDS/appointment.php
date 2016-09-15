<?php include("begin.php"); ?>
<div class="blurMe">
</div>
<div class="content">
<div>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="#">SDS</a>
            <ul class="nav navbar-nav">
                <li>
                    <a href="congratulatory.php">Congratulatory</a>
                </li>
                <li>
                    <a href="appointment.php">Appointment</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="../../log-out.php">Sign-out</a>
            </li>
            </ul>
        </div>
    </nav>

    
    <div class="container" ng-controller="appointCtrl" >
    	<br><br><br><br><br>
        <center>
            <div class="table-responsive">
                <table class="table table-condensed table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th><center>Item No</center></th>
                            <th><center>Position</center></th>
                            <th><center>School ID</center></th>
                            <th><center>School Name</center></th>
                            <th><center>Name</center></th>
                            <th><center>Date Released</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in data">
                            <td><center>{{x.itemno}}</center></td>
                            <td><center>{{x.position}}</center></td>
                            <td><center>{{x.schoolID}}</center></td>
                            <td><center>{{x.schoolName}}</center></td>
                            <td><center>{{x.name}}</center></td>
                            <td><center>{{x.hrmodate | date:'dd-MM-yyyy'}}</center></td>
                        </tr>
                    </tbody>
                </table>
</div>   
        </center>
    </div>
</div>



</div>
<?php include("end.php"); ?>