<?php
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
?>
<?php include 'begin.php'; ?>
<?php include 'header.php'; ?>
<?php
$db = new DatabaseConnect();
$db->query("SELECT * FROM `tblpositions` WHERE `itemno` = ?");
$db->bind(1,$_GET['item']);
$i = $db->single();
?>
<script>
    var updater = angular.module('updateApp',['angular.filter']);
    updater.controller('updateCtrl',function($scope,$http){
        $scope.message = "";
    $http.get("../../pages/school.json")
    .then(function(response) {
        $scope.school = response.data;
    });
    $scope.updatePos = function(){
        $scope.xForm.key = '<?php echo $_GET['item']; ?>';
         
        $http.post('edit-position.php', $scope.xForm) .success(function(data){
            $scope.message = "New Vacant Position has been updated!";
            $('#modal-container-505047').modal('show');
            
        });
    }
    $scope.goToHome = function(){
        window.location.assign('../SGOD/');
    }
    $scope.cancelTransaction = function(){
        $scope.message = "New Vacant Position has updating been canceled!";
        window.location.assign('../SGOD/');
    }

});
</script>


<div class="container-fluid" ng-app="updateApp" ng-controller="updateCtrl">
    
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
				    <div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">
								Update Vacant Position
							</h3>
						</div>
						<div class="panel-body">
							
							
							<div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-10">
                                    <form ng-submit="updatePos()" class="form-horizontal" role="form">
                                        <input type="hidden" ng-model="xForm.key" ng-init="xForm.key = '<?php echo $_GET['item']; ?>'" />
                                        <div class="form-group">
                                            <label for="itemno" class="col-sm-2 control-label">
                                                Item Number:
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" ng-model="xForm.itemno" ng-init="xForm.itemno='<?php echo $i['itemno']; ?>'" name="itemno" class="form-control" id="itemno" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pos" class="col-sm-2 control-label">
                                                Position
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" ng-model="xForm.position" ng-init="xForm.position = '<?php echo $i['position']; ?>'" name="pos" class="form-control" id="itemno" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cat" class="col-sm-2 control-label">
                                                Position Category
                                            </label>
                                            <div class="col-md-10">
                                            <select class="form-control" name="cat" ng-model="xForm.positioncategory" ng-init="xForm.positioncategory = '<?php echo $i['positioncategory']; ?>'">
                                                    <option value="New">New</option>
                                                    <option value="Promotion">Promotion</option>
                                                    <option value="Substitute">Substitute</option>
                                                    <option value="Reclassification">Reclassification</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pos" class="col-sm-2 control-label">
                                                School Level
                                            </label>
                                            <div class="col-md-10">
                                                <select class="form-control" ng-model="xForm.level" ng-init="xForm.level='<?php echo $i['schoollevel']; ?>'">
                                                    <option ng-repeat="x in school | unique:'Level'">{{x.Level}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dist" class="col-sm-2 control-label">
                                                District
                                            </label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="dist" ng-model="xForm.district" ng-init="xForm.district = '<?php echo $i['district']; ?>'">
                                                    <option ng-repeat="x in school | filterBy:['Level']:xForm:level | unique:'District'">{{x.District}}</option>
                                                </select>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="school" class="col-sm-2 control-label">
                                                School Name
                                            </label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="sch" ng-model="xForm.school" ng-init="xForm.school = '<?php echo $i['schoolname']; ?>'">
                                                    <option ng-repeat="x in school | filterBy:['Level']:xForm.level | filterBy:['District']:xForm.district | unique:'School'">{{x.School}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="school" class="col-sm-2 control-label">
                                                School ID
                                            </label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="schID" ng-model="xForm.schoolID" ng-init="xForm.schoolID = '<?php echo $i['schoolid']; ?>'">
                                                    <option ng-repeat="x in school | filterBy:['Level']:xForm.level | filterBy:['District']:xForm.district | filterBy:['School']:xForm.school | unique:'SchoolID'">{{x.SchoolID}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" ng-click="cancelTransaction()" class="btn btn-danger">Cancel</button>
                                            </div>
                                            <div class="col-md-">
                                                
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
							
							
						</div>
						<div class="panel-footer">
						<!--footer here-->
						</div>
					</div>
					
					
					<div class="modal" id="modal-container-505047">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Success!</h4>
                          </div>
                          <div class="modal-body">
                            <p>{{message}}</p>
                          </div>
                          <div class="modal-footer">
                            <button  ng-click="goToHome()" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>


					
					
				</div>
				<div class="col-md-2">
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'end.php'; ?>