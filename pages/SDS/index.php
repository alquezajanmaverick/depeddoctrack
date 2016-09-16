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
                    <a href="congratulatory.php">Congratulatory</a>
                </li>
                <li>
                    <a href="process/">Process of Appointment</a>
                </li>
                <li>
                    <a href="attested/">Attested of Appointment</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="../../log-out.php">Sign-out</a>
            </li>
            </ul>
        </div>
    </nav>

    
    <div class="container" >
        <center>
               
                <table class="table table-hover" style="margin-top:100px;" >
                <thead class="bg-primary">
                    <tr>
                        <th><center>Item No.</center></th>
                        <th><center>Name</center></th>
                        <th><center>Due Date of Submission</center></th>
                        <th><center>Action</center></th>
                         
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in data">
                        <td><center>{{x.itemno}}</center></td>
                        <td><center>{{x.name}}</center></td>
                        <td><center>{{x.duedate | date:'dd-MM-yyyy'}}</center></td>
                        <td><center>
                            <div ng-show="x.ok">
                                <button type="button" class="btn btn-xs btn-success glyphicon glyphicon-ok-circle" ng-click="openModal(x.itemno,x.name)"> Approve</button>
                            </div>
                        </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>
</div>



<script type="text/ng-template" id="myModalOK.html">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Good Job!</h3>
        </div>
        <div class="modal-body" id="modal-body">
            <center><p class="input-group form-control">
                        <input type="text" class="form-control" uib-datepicker-popup="yyyy-MM-dd" datepicker-options="datepicker" ng-model="xForm.datesubmission"  is-open="popup.opened" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="openDate()"><i class="glyphicon glyphicon-calendar"></i></button>
                        </span>
                    </p><center>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
        </div>
</script>
</div>
<?php include("end.php"); ?>