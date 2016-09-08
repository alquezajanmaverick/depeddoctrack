<?php include('gate.php'); ?>
<!DOCTYPE html>
<html lang="en" ng-app="sdsApp" ng-controller="sdsCtrl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="60"/>
    
    <title><?php echo title; ?></title>
    <?php // echo css; ?>
    <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
 
          
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" />
     <!-- Latest compiled and minified CSS -->
    <!--<link rel="stylesheet" href="../../libs/css/bootstrap.css">-->
    
    <link rel="stylesheet" href="../../libs/css/bootstrap-paper.css">
    
    <?php echo customcss; ?>
    <?php echo angular; ?>
    <script src="../../libs/js/dirPaginate.js"></script>
    <?php echo angularfilter; ?>    
    <?php echo angularroute; ?>
    <?php echo angularanimate; ?>
    <script src="sds-script.js"></script>
    <script src="../../libs/js/ui-bootstrap.min.js"></script>
    <style>
        .blurMe{
                background-image:url('https://unsplash.it/1366/768/?random'); 
                width:1366px;
                height:768px;
                -webkit-filter: blur(2px);
                z-index:0;
                position:absolute;
            }
            .content{
                z-index:10;
                position:relative;
            }
    </style>
</head>
<body>