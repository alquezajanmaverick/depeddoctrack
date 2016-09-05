<?php include("begin.php"); ?>
<?php include("header.php"); ?>
<div class="container-fluid" ng-app="positionApp" ng-controller="positionCtrl">

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
				    <div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">
								Add a Vacant Position
							</h3>
						</div>
						<div class="panel-body">
							
							
							<div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-10">
                                    <form ng-submit="processForm()" class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label for="itemno" class="col-sm-2 control-label">
                                                Item Number:
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" ng-model="xForm.itemno" name="itemno" class="form-control" id="itemno" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pos" class="col-sm-2 control-label">
                                                Position
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" ng-model="xForm.position" name="pos" class="form-control" id="itemno" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cat" class="col-sm-2 control-label">
                                                Position Category
                                            </label>
                                            <div class="col-md-10">
                                            <select class="form-control" name="cat" ng-model="xForm.category">
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
                                                <select class="form-control" ng-model="xForm.level">
                                                    <option ng-repeat="x in school | unique:'Level'">{{x.Level}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dist" class="col-sm-2 control-label">
                                                District
                                            </label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="dist" ng-model="xForm.district">
                                                    <option ng-repeat="x in school | filterBy:['Level']:xForm:level | unique:'District'">{{x.District}}</option>
                                                </select>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label for="school" class="col-sm-2 control-label">
                                                School Name
                                            </label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="sch" ng-model="xForm.school">
                                                    <option ng-repeat="x in school | filterBy:['Level']:xForm.level | filterBy:['District']:xForm.district | unique:'School'">{{x.School}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="school" class="col-sm-2 control-label">
                                                School ID
                                            </label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="schID" ng-model="xForm.schoolID">
                                                    <option ng-repeat="x in school | filterBy:['Level']:xForm.level | filterBy:['District']:xForm.district | filterBy:['School']:xForm.school | unique:'SchoolID'">{{x.SchoolID}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">

                                                <button type="submit" class="btn btn-primary">
                                                    Submit
                                                </button>
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
                            <p>New Vacant Position has been added!</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" ng-click="goToHome()" class="btn btn-default" data-dismiss="modal">Close</button>
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
<?php include('end.php'); ?>