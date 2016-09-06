<?php include "begin.php"; ?>

<div ng-app="mainApp" ng-controller="mainCtrl">
    <nav class="navbar navbar-default">
        <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">HRMO</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#/" auto-refresh><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#/monitor" auto-refresh><i class="fa fa-eye"></i> Monitoring</a></li>
            <li><a href="#appointee" auto-refresh><i class="fa fa-suitcase" aria-hidden="true"></i> Appointee</a></li>
            <li><a href="#congratulatory" auto-refresh><i class="fa fa-comment"></i> Congratulatory & Remarks</a></li>
            <li><a href="#process" auto-refresh><i class="fa fa-book"></i> Appointment</a></li>
            <li class="divider"></li>
            <li><a href="../../log-out.php" auto-refresh><i class="fa fa-sign-out" aria-hidden="true"></i> Sign-Out</a></li>
            
        </ul>
        </div>
    </nav>

<div id="main" class="container scrollme" ng-scrollbar>
    <div class"row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page {{class}}" ng-view></div>
        </div>
    </div>
</div>
</div>
<?php include "end.php"; ?>