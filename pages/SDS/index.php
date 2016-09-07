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
                    <a href="#">Home</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="#">Sign-out</a>
            </li>
            </ul>
        </div>
    </nav>

    
    <div class="container">
        <center>
                <table class="table table-hover" style="margin-top:150px;">
                <thead class="bg-primary">
                    <tr>
                        <th><center>Item No.</center></th>
                        <th><center>Name</center></th>
                        <th><center>Status</center></th>
                        <th><center>Progress</center></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in data">
                        <td><center>{{x.itemno}}</center></td>
                        <td><center>{{x.name}}</center></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>
</div>




</div>
<?php include("end.php"); ?>