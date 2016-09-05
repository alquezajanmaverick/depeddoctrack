<?php include "begin.php"; ?>

<div ng-app="mainApp" ng-controller="mainCtrl">
    <nav class="navbar navbar-default">
        <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">HRMO</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#/" auto-refresh><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#appointee" auto-refresh><i class="fa fa-shield"></i> Appointee</a></li>
            <li><a href="#congratulatory" auto-refresh><i class="fa fa-comment"></i> Congratulatory</a></li>
            <li><a href="#remarks" auto-refresh><i class="fa fa-comment"></i> Remarks</a></li>
            <li><a href="#process" auto-refresh><i class="fa fa-comment"></i> Process of Papers</a></li>
        </ul>
        </div>
    </nav>


<div id="main" class="container">
    <div class"row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page {{class}}" ng-view></div>
        </div>
    </div>
</div>
</div>
<?php include "end.php"; ?>