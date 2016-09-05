<?php include('begin.php'); ?>
<?php include('header.php'); ?>
<div class="container" ng-app="readerApp" ng-controller="readerCtrl">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <input ng-model="hunt" type="text" placeholder="Search here ...">
            <table class="table table-striped table-hover ">
              <thead>
                <tr class="bg-primary">
                  <th>ITEM NO</th>
                  <th>POSITION</th>
                  <th>CATEGORY</th>
                  <th>SCHOOL LEVEL</th>
                  <th>DISTRICT</th>
                  <th>SCHOOL NAME</th>
                  <th>SCHOOL ID</th>
                  <th colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="x in result | filterBy:['position','schoolname','positioncategory','position','schoolid','district','schoollevel','itemno']:hunt ">
                  <td ng-model="it">{{x.itemno}}</td>
                  <td>{{x.position}}</td>
                  <td>{{x.positioncategory}}</td>
                  <td>{{x.schoollevel}}</td>
                  <td>{{x.district}}</td>
                  <td>{{x.schoolname}}</td>
                  <td>{{x.schoolid}}</td>
                  <td><button ng-click="showUpdateItem(x.itemno)" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="modal" data-target="#myModalUpdate"></span> EDIT</button></td>
                  <td><button ng-click="deleteme(x.itemno,x.position)" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> REMOVE</button></td>
                </tr>                
              </tbody>
            </table> 
        </div>
        <div class="col-md-2"></div>
    </div>
    
    
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Delete {{pos}} </h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                  <h4>Are you sure you want to delete "{{pos}}" Position?</h4>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-click="deleteNow(item)" >Yes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
    
    
    
    
</div>


<?php include('end.php'); ?>