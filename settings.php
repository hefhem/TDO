<?php
include_once 'includes/db_connect.php';
include_once 'includes/db_connect_functions.php';
 
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
											<li class=""><a href="#MenuItem" data-toggle="tab">Menu Items</a>
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
												<button class="btn btn-primary btn-sm" id="btnAddForm" data-toggle="modal" data-target="#formModal">New</button>
												<button class="btn btn-sm" id="refreshForm" onclick="getForm();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiForm" onclick="deleteSelectedForm();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divFormTBL">
													
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
						
						<!-- MenuItem Item Modal -->
					   <div class="modal fade bs-modal-sm" id="menuItemModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearMenuItemValues();">×</button>
										<h4 class="modal-title">Add/Edit MenuItems</h4>
									</div>
									<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
                                                    
                                                    <div class="form-group">
														<label>Menu Name</label>
														<div>
															<?php 
                                                                
                                                                $result = getMenuDropDown(); 
                                                                echo '<select class="form-control" id="menuMenuID" name="menuMenuID">';
                                                                echo '<option value="0">Select Menu</option>';
                                                                    while ($menurow = mysqli_fetch_assoc($result)) {
                                                                       echo '<option                                                                                                                                    value="'.$menurow['menuID'].'">'.$menurow['menuName'].'</option>';
                                                                    }

                                                                    $mysqli->close();

                                                                echo '</select>';
                                                            ?>
														</div>
													</div>
                                                    
													<div class="form-group">
														<label>Menu Item Name</label>
														<div>
															<input type="hidden" class="form-control" name="menuItemID" id="menuItemID" value="0">
															<input type="text" class="form-control" name="menuItemName" id="menuItemName" placeholder="Name">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Menu Item Description</label>
														<div>
															<input type="text" class="form-control" name="menuItemDescription" id="menuItemDescription" placeholder="Description">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Menu Item Code</label>
														<div>
															<input type="text" class="form-control" name="menuItemCode" id="menuItemCode" placeholder="Code">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Menu Item Ranking</label>
														<div>
															<input type="number" class="form-control" name="menuItemRanking" id="menuItemRanking" placeholder="Ranking">
														</div>
													</div>
                                                    
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearMenuItemValues();">Cancel</button>
										<button type="button" class="btn btn-primary btn-lg" id="btnAddMenuItemRecord" onclick="setMenuItem();">Save</button>
									</div>
								</div>
							</div>
						</div>
                       
						<!-- Forms Modal -->
					   <div class="modal fade bs-modal-sm" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearFormValues();">×</button>
										<h4 class="modal-title">Add/Edit Forms</h4>
									</div>
									<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
                                                    
                                                    <div class="form-group">
														<label>Menu Name</label>
														<div>
															<?php 
                                                                
                                                                $result = getMenuItemDropDown(); 
                                                                echo '<select class="form-control" id="menuItemMenuID" name="menuItemMenuID">';
                                                                echo '<option value="0">Select Menu Item</option>';
                                                                    while ($menuitemrow = mysqli_fetch_assoc($result)) {
                                                                       echo '<option                                                                                                                                    value="'.$menuitemrow['menuItemID'].'">'.$menuitemrow['menuItemName'].'</option>';
                                                                    }

                                                                    $mysqli->close();

                                                                echo '</select>';
                                                            ?>
														</div>
													</div>
                                                    
													<div class="form-group">
														<label>Form Name</label>
														<div>
															<input type="hidden" class="form-control" name="formID" id="formID" value="0">
															<input type="text" class="form-control" name="formName" id="formName" placeholder="Name">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Form Description</label>
														<div>
															<input type="text" class="form-control" name="formDescription" id="formDescription" placeholder="Description">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Form Code</label>
														<div>
															<input type="text" class="form-control" name="formCode" id="formCode" placeholder="Code">
														</div>
													</div>
                                                    
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearFormValues();">Cancel</button>
										<button type="button" class="btn btn-primary btn-lg" id="btnAddFormRecord" onclick="setForm();">Save</button>
									</div>
								</div>
							</div>
						</div>
                       
                       
				   </div>

                </div>
				<script src="appjs/usergroup.js?86"></script>
                <script src="appjs/menu.js"></script>
                <script src="appjs/menuItem.js"></script>
                <script src="appjs/form.js"></script>
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