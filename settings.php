<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == false) {
    header('Location: signin.php');
}
?>

				
				<div class="content-wrap">

                    <!-- inner content wrapper -->
				   <div class="wrapper">
				   
					   <div class="panel-heading">
							<h3 class="text-uppercase no-m"><b>Settings</b></h3>
							<br/>
					   </div>
					   
						<div class="row mb25">
								<div class="col-md-12">
									<div class="box-tab">

										<ul class="nav nav-tabs">
											<li class="active"><a href="#UserGroup" data-toggle="tab">User Group</a>
											</li>
                                            <li class=""><a href="#Users" data-toggle="tab">Users</a>
											</li>
                                            <li class=""><a href="#Menu" data-toggle="tab">Menus</a>
											</li>
											<li class=""><a href="#MenuItem" data-toggle="tab">MenuItem</a>
											</li>
											<li class=""><a href="#Forms" data-toggle="tab">Forms</a>
											</li>
											<li class=""><a href="#AccessLevels" data-toggle="tab" >Access Levels</a>
											</li>
											
										</ul>
										<div class="tab-content">
											<div class="tab-pane fade active in" id="UserGroup">
												<button class="btn btn-primary btn-sm" id="btnAddUserGroup" data-toggle="modal" data-target="#userGroupModal">New</button>
												<button class="btn btn-sm" id="refreshUserGroup" onclick="getUserGroup();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiUserGroup" onclick="deleteSelectedUserGroup();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divUserGroupTBL">
													
												</div>
											</div>
                                            <div class="tab-pane fade in" id="Users">
												<button class="btn btn-primary btn-sm" id="btnAddUsers" data-toggle="modal" data-target="#usersModal">New</button>
												<button class="btn btn-sm" id="refreshUsers" onclick="getUsers();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiUsers" onclick="deleteSelectedUsers();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divUsersTBL">
													
												</div>
											</div>
                                            <div class="tab-pane fade in" id="Menu">
												<button class="btn btn-primary btn-sm" id="btnAddMenu" data-toggle="modal" data-target="#menuModal">New</button>
												<button class="btn btn-sm" id="refreshMenu" onclick="getMenu();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiMenu" onclick="deleteSelectedMenu();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divMenuTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="MenuItem">
												<button class="btn btn-primary btn-sm" id="btnAddMenuItem" data-toggle="modal" data-target="#menuItemModal">New</button>
												<button class="btn btn-sm" id="refreshMenuItem" onclick="getMenuItem();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiMenuItem" onclick="deleteSelectedMenuItem();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divMenuItemTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="Forms">
												<button class="btn btn-primary btn-sm" id="btnAddForms" data-toggle="modal" data-target="#formsModal">New</button>
												<button class="btn btn-sm" id="refreshForms" onclick="getForms();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiForms" onclick="deleteSelectedForms();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divFormsTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="AccessLevels">
												<button class="btn btn-primary btn-sm" id="btnAddAccessLevels" data-toggle="modal" data-target="#accessLevelsModal">New</button>
												<button class="btn btn-sm" id="refreshAccessLevels" onclick="getAccessLevels();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiAccessLevels" onclick="deleteSelectedAccessLevels();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divAccessLevelsTBL">
													
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>
                       
				       <!-- User Group Modal -->
					   <div class="modal fade bs-modal-sm" id="userGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearUserGroupValues();">×</button>
										<h4 class="modal-title">Add/Edit User Group</h4>
									</div>
									<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
                                                    
													<div class="form-group">
														<label>User Group Name</label>
														<div>
															<input type="hidden" class="form-control" name="userGroupID" id="userGroupID" value="0">
															<input type="text" class="form-control" name="userGroupName" id="userGroupName" placeholder="Name">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>User Group Description</label>
														<div>
															<input type="text" class="form-control" name="userGroupDescription" id="userGroupDescription" placeholder="Description">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>User Group Code</label>
														<div>
															<input type="text" class="form-control" name="userGroupCode" id="userGroupCode" placeholder="Code">
														</div>
													</div>
                                                    
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearUserGroupValues();">Cancel</button>
										<button type="button" class="btn btn-primary btn-lg" id="btnAddUserGroupRecord" onclick="setUserGroup();">Save</button>
									</div>
								</div>
							</div>
						</div>
                       
                       <!-- Users Modal -->
					   <div class="modal fade bs-modal-sm" id="usersModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearTruckValues();">×</button>
										<h4 class="modal-title">Add/Edit Users</h4>
									</div>
									<div class="modal-body">
										<!--<form role="form" action="includes/functioncall.php" method="post" name="truck_type">-->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Truck Type Name</label>
														<div>
															<input type="hidden" class="form-control" name="truckTypeID" id="truckTypeID" value="0">
															<input type="text" class="form-control" name="truckTypeName" id="truckTypeName" placeholder="Description">
															<!--<input type="text" class="form-control" name="functionname" id="functionname" placeholder="Description">-->
														</div>
													</div>
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearTruckValues();">Cancel</button>
										<!--<button type="submit" class="btn btn-primary btn-lg" oonclick="setTruckTyp();">Submit</button>-->
										<button type="button" class="btn btn-primary btn-lg" id="btnAddTruckRecord" onclick="setTruckType();">Save</button>
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
                       
                       <!-- Menus Modal -->
					   <div class="modal fade bs-modal-sm" id="menuModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearMenuValues();">×</button>
										<h4 class="modal-title">Add/Edit Menus</h4>
									</div>
									<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Menu Name</label>
														<div>
															<input type="hidden" class="form-control" name="driverID" id="menuID" value="0">
															<input type="text" class="form-control" name="menuName" id="menuName" placeholder="Name">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Menu Description</label>
														<div>
															<input type="text" class="form-control" name="menuDescription" id="menuDescription" placeholder="Description">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Menu Code</label>
														<div>
															<input type="text" class="form-control" name="menuCode" id="menuCode" placeholder="Code">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Menu Ranking</label>
														<div>
															<input type="number" class="form-control" name="menuRanking" id="menuRanking" placeholder="Ranking">
														</div>
													</div>
                                                    
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearMenuValues();">Cancel</button>
										<button type="button" class="btn btn-primary btn-lg" id="btnAddMenuRecord" onclick="setMenu();">Save</button>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Menu Items Modal -->
					   <div class="modal fade bs-modal-sm" id="menuItemModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearRegionValues();">×</button>
										<h4 class="modal-title">Add/Edit Menu Item</h4>
									</div>
									<div class="modal-body">
										<!--<form role="form" action="includes/functioncall.php" method="post" name="cargo_type">-->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Region Name</label>
														<div>
															<input type="hidden" class="form-control" name="regionID" id="regionID" value="0">
															<input type="text" class="form-control" name="regionName" id="regionName" placeholder="Description">
															<input type="hidden" class="form-control" name="functionname" id="functionname" value="setRegion">
														</div>
													</div>
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearRegionValues();">Cancel</button>
										<button type="submit" class="btn btn-primary btn-lg" id="btnAddRegionRecord" onclick="setRegion();">Save</button>
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
                       
						<!-- Forms Modal -->
					   <div class="modal fade bs-modal-sm" id="formsModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearStateValues();">×</button>
										<h4 class="modal-title">Add/Edit Form</h4>
									</div>
									<div class="modal-body">
										<!--<form role="form" action="includes/functioncall.php" method="post" name="cargo_type">-->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>State Name</label>
														<div>
															<input type="hidden" class="form-control" name="stateID" id="stateID" value="0">
															<input type="text" class="form-control" name="stateName" id="stateName" placeholder="State Name">
															<input type="hidden" class="form-control" name="functionname" id="functionname" value="setState">
														</div>
														<label>State Code</label>
														<div>
															<input type="text" class="form-control" name="stateCode" id="stateCode" placeholder="State Code">
														</div>
													</div>
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearStateValues();">Cancel</button>
										<button type="submit" class="btn btn-primary btn-lg" id="btnAddStateRecord" onclick="setState();">Save</button>
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
				   </div>
					<!-- /inner content wrapper -->

                </div>
				<script src="appjs/usergroup.js?86"></script>
                <script src="appjs/menu.js"></script>
				<script>
				
				function checkAll(ele,cls) {
				 //var checkboxes = document.getElementsByTagName('input');
				 //alert(cls);
				 var checkboxes = document.getElementsByClassName(cls);
				 if (ele.checked) {
					 for (var i = 0; i < checkboxes.length; i++) {
						 if (checkboxes[i].type == 'checkbox') {
							 checkboxes[i].checked = true;
						 }
					 }
				 } else {
					 for (var i = 0; i < checkboxes.length; i++) {
						 console.log(i)
						 if (checkboxes[i].type == 'checkbox') {
							 checkboxes[i].checked = false;
						 }
					 }
				  }
			    }
				
				/*function checkAll(ele,cls) {
					
					//if ($('#chkAllCargoTypeType').prop("checked")) {
							$('.selClsCargoType').prop('checked', true);
					} else {
							$('.selClsCargoTyp').prop('checked', false);
					}
					
					return false;

				}*/
				
				</script>