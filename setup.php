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
							<h3 class="text-uppercase no-m"><b>Setup</b></h3>
							<br/>
					   </div>
					   
						<div class="row mb25">
								<div class="col-md-12">
									<div class="box-tab">

										<ul class="nav nav-tabs">
											<li class="active"><a href="#CargoType" data-toggle="tab">Cargo Type</a>
											</li>
                                            <li class=""><a href="#TruckType" data-toggle="tab">Truck Type</a>
											</li>
                                            <li class=""><a href="#Driver" data-toggle="tab">Driver</a>
											</li>
											<li class=""><a href="#Region" data-toggle="tab">Region</a>
											</li>
											<li class=""><a href="#State" data-toggle="tab">State</a>
											</li>
											<li class=""><a href="#City" data-toggle="tab" >City</a>
											</li>
											<li class=""><a href="#Location" data-toggle="tab">Location</a>
											</li>
											<li class=""><a href="#Port" data-toggle="tab">Port</a>
											</li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane fade active in" id="CargoType">
												<button class="btn btn-primary btn-sm" id="btnAddCargoType" data-toggle="modal" data-target="#cargoTypeModal">New</button>
												<button class="btn btn-sm" id="refreshCargoType" onclick="getCargoType();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiCargoType" onclick="deleteSelectedCargoType();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divCargoTBL">
													
												</div>
											</div>
                                            <div class="tab-pane fade in" id="TruckType">
												<button class="btn btn-primary btn-sm" id="btnAddTruckType" data-toggle="modal" data-target="#truckTypeModal">New</button>
												<button class="btn btn-sm" id="refreshTruckType" onclick="getTruckType();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiTruckType" onclick="deleteSelectedTruckType();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divTruckTBL">
													
												</div>
											</div>
                                            <div class="tab-pane fade in" id="Driver">
												<button class="btn btn-primary btn-sm" id="btnAddDriver" data-toggle="modal" data-target="#driverModal">New</button>
												<button class="btn btn-sm" id="refreshDriver" onclick="getDriver();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiDriver" onclick="deleteSelectedDriver();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divDriverTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="Region">
												<button class="btn btn-primary btn-sm" id="btnAddRegion" data-toggle="modal" data-target="#regionModal">New</button>
												<button class="btn btn-sm" id="refreshRegion" onclick="getRegion();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiRegion" onclick="deleteSelectedRegion();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divRegionTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="State">
												<button class="btn btn-primary btn-sm" id="btnAddState" data-toggle="modal" data-target="#stateModal">New</button>
												<button class="btn btn-sm" id="refreshState" onclick="getState();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiState" onclick="deleteSelectedState();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divStateTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="City">
												<button class="btn btn-primary btn-sm" id="btnAddCity" data-toggle="modal" data-target="#cityModal">New</button>
												<button class="btn btn-sm" id="refreshCity" onclick="getCity();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiCity" onclick="deleteSelectedCity();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divCityTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="Location">
												<button class="btn btn-primary btn-sm" id="btnAddLocation" data-toggle="modal" data-target="#locationModal">New</button>
												<button class="btn btn-sm" id="refreshLocation" onclick="getLocation();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiLocation" onclick="deleteSelectedLocation();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divLocationTBL">
													
												</div>
											</div>
											<div class="tab-pane fade in" id="Port">
												<button class="btn btn-primary btn-sm" id="btnAddPort" data-toggle="modal" data-target="#portModal">New</button>
												<button class="btn btn-sm" id="refreshPort" onclick="getPort();">Refresh</button>
												<button class="btn btn-danger btn-sm" id="btnDelMultiPort" onclick="deleteSelectedPort();">Delete</button>
												<br/>
												<br/>
												<div class="table-responsive no-border" id="divPortTBL">
													
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>
                       
				       <!-- Cargo Type Modal -->
					   <div class="modal fade bs-modal-sm" id="cargoTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearCargoValues();">×</button>
										<h4 class="modal-title">Add/Edit Cargo Type</h4>
									</div>
									<div class="modal-body">
										<!--<form role="form" action="includes/functioncall.php" method="post" name="cargo_type">-->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Cargo Type Name</label>
														<div>
															<input type="hidden" class="form-control" name="cargoTypeID" id="cargoTypeID" value="0">
															<input type="text" class="form-control" name="cargoTypeName" id="cargoTypeName" placeholder="Description">
															<!--<input type="text" class="form-control" name="functionname" id="functionname" placeholder="Description">-->
														</div>
													</div>
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearCargoValues();">Cancel</button>
										<!--<button type="submit" class="btn btn-primary btn-lg" oonclick="setCargoTyp();">Submit</button>-->
										<button type="button" class="btn btn-primary btn-lg" id="btnAddCargoRecord" onclick="setCargoType();">Save</button>
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
                       
                       <!-- Truck Type Modal -->
					   <div class="modal fade bs-modal-sm" id="truckTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearTruckValues();">×</button>
										<h4 class="modal-title">Add/Edit Truck Type</h4>
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
                       
                       <!-- Driver Modal -->
					   <div class="modal fade bs-modal-sm" id="driverModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearDriverValues();">×</button>
										<h4 class="modal-title">Add/Edit Driver</h4>
									</div>
									<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>First Name</label>
														<div>
															<input type="hidden" class="form-control" name="driverID" id="driverID" value="0">
															<input type="text" class="form-control" name="diverFirstName" id="diverFirstName" placeholder="First Name">
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label>Middle Name</label>
														<div>
															<input type="text" class="form-control" name="diverMiddleName" id="diverMiddleName" placeholder="Middle Name">
														</div>
													</div>
                                                    
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearDriverValues();">Cancel</button>
										<button type="button" class="btn btn-primary btn-lg" id="btnAddDriverRecord" onclick="setDriver();">Save</button>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Region Modal -->
					   <div class="modal fade bs-modal-sm" id="regionModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearRegionValues();">×</button>
										<h4 class="modal-title">Add/Edit Region</h4>
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
                       
						<!-- State Modal -->
					   <div class="modal fade bs-modal-sm" id="stateModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearStateValues();">×</button>
										<h4 class="modal-title">Add/Edit State</h4>
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
                       
						 <!-- City Modal -->
					    <div class="modal fade bs-modal-sm" id="cityModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearCityValues();">×</button>
										<h4 class="modal-title">Add/Edit City</h4>
									</div>
									<div class="modal-body">
										<!--<form role="form" action="includes/functioncall.php" method="post" name="cargo_type">-->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>City Name</label>
														<div>
															<input type="hidden" class="form-control" name="cityID" id="cityID" value="0">
															<input type="text" class="form-control" name="cityName" id="cityName" placeholder="City Name">
															<input type="hidden" class="form-control" name="functionname" id="functionname" value="setCity">
														</div>
														<label>City Code</label>
														<div>
															<input type="text" class="form-control" name="cityCode" id="cityCode" placeholder="city Code">
														</div>
														<label>State</label>
														<div>
														<?php 
															$result = getStateDropDown(); 
															echo '<select class="lstState form-control" id="cityStateID" name="cityStateID">';
															echo '<option value="0">Select State</option>';
																while ($staterow = mysqli_fetch_assoc($result)) {
																   echo '<option value="'.$staterow['stateID'].'">'.$staterow['stateName'].'</option>';
																}
																
																$mysqli->close();
																
															echo '</select>';
														?>
														</div>
													</div>
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearCityValues();">Cancel</button>
										<button type="submit" class="btn btn-primary btn-lg" id="btnAddCityRecord" onclick="setCity();">Save</button>
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
						
						  <!-- Location Modal -->
					    <div class="modal fade bs-modal-sm" id="locationModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearLocationValues();">×</button>
										<h4 class="modal-title">Add/Edit Location</h4>
									</div>
									<div class="modal-body">
										<!--<form role="form" action="includes/functioncall.php" method="post" name="cargo_type">-->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Location Name</label>
														<div>
															<input type="hidden" class="form-control" name="locationID" id="locationID" value="0">
															<input type="text" class="form-control" name="locationName" id="locationName" placeholder="location Name">
															<input type="hidden" class="form-control" name="functionname" id="functionname" value="setLocation">
														</div>
														<label>Region</label>
														<div>
														<?php 
															$result->free_result();
															$result = getRegionDropDown(); 
															echo '<select class="lstRegion form-control" id="locationRegionID" name="locationRegionID">';
															echo '<option value="0">Select Region</option>';
																while ($regionrow = mysqli_fetch_assoc($result)) {
																   echo '<option value="'.$regionrow['regionID'].'">'.$regionrow['regionName'].'</option>';
																}
																$mysqli->close();
															echo '</select>';
														?>
														</div>
													</div>
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearLocationValues();">Cancel</button>
										<button type="submit" class="btn btn-primary btn-lg" id="btnAddLocationRecord" onclick="setLocation();">Save</button>
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
						   <!-- Port Modal -->
					    <div class="modal fade bs-modal-sm" id="portModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="clearPortValues();">×</button>
										<h4 class="modal-title">Add/Edit Port</h4>
									</div>
									<div class="modal-body">
										<!--<form role="form" action="includes/functioncall.php" method="post" name="cargo_type">-->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Port Name</label>
														<div>
															<input type="hidden" class="form-control" name="portID" id="portID" value="0">
															<input type="text" class="form-control" name="portName" id="portName" placeholder="Port Name">
															<input type="hidden" class="form-control" name="functionname" id="functionname" value="setPort">
														</div>
														<label>Location</label>
														<div>
														<?php
															$result->close();
															$result = getLocationDropDown();
														
															echo '<select class="form-control" id="portLocationID" name="portLocationID">';
															echo '<option value="0">Select Location</option>';
																while ($locationrow = mysqli_fetch_assoc($result)) {
																   echo '<option value="'.$locationrow['locationID'].'">'.$locationrow['locationName'].'</option>';
																}
																$mysqli->close();
															echo '</select>'; 
														?>
														</div>
													</div>
												</div>												
											</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="clearPortValues();">Cancel</button>
										<button type="submit" class="btn btn-primary btn-lg" id="btnAddPortRecord" onclick="setPort();">Save</button>
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
						

				   </div>
					<!-- /inner content wrapper -->

                </div>
				<script src="appjs/cargotype.js?86"></script>
                <script src="appjs/trucktype.js"></script>
                <script src="appjs/driver.js"></script>  
				<script src="appjs/region.js"></script>
				<script src="appjs/state.js"></script>
				<script src="appjs/city.js"></script>
				<script src="appjs/location.js"></script>
				<script src="appjs/port.js"></script>
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