<?php include("begin.php"); ?>
<div class="blurMe">
</div>
<div class="content">
<div>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="#">SDS</a>
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">Congratulatory</a>
                </li>
                <li>
                    <a href="process/">Appointment</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="../../log-out.php">Sign-out</a>
            </li>
            </ul>
        </div>
    </nav>

    
    <div class="container" ng-controller="congCtrl" >
    	<br><br><br><br><br>
        <center>
            <div class="table-responsive">
            	<p><input type="" ng-model="query" placeholder="Search here ..."></p>
                <table class="table table-condensed table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th><center>Item No</center></th>
                            <th><center>Position</center></th>
                            <th><center>School ID</center></th>
                            <th><center>School Name</center></th>
                            <th><center>Name</center></th>
                            <th><center>Date Received</center></th>
                            <th><center>Date Released</center></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="x in data | filter: query">
                            <td><center>{{x.itemno}}</center></td>
                            <td><center>{{x.position}}</center></td>
                            <td><center>{{x.schoolID}}</center></td>
                            <td><center>{{x.schoolName}}</center></td>
                            <td><center>{{x.name}}</center></td>
                            <td><center>{{x.hrmodate | date : 'dd-MM-yyyy'}}</center></td>
                            <td><center><input type="date" ng-model="x.SDSreleaseddate" ng-disabled="singleModel"></center></td>
                            <td><center><button type="button" class="btn btn-xs btn-primary glyphicon glyphicon-calendar" ng-model="singleModel" ng-init="singleModel=true" uib-btn-checkbox btn-checkbox-true="true" btn-checkbox-false="false"></button><button type="button" class="btn btn-xs btn-success glyphicon glyphicon-check" ng-click="updateitem(x.itemno,x.SDSreleaseddate,singleModel);singleModel=true"></button></center></td>
                        </tr>
                    </tbody>
                </table>
</div>   
        </center>
    </div>
</div>



</div>
<?php include("end.php"); ?>