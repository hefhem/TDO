
				
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
											<li class=""><a href="#Region" data-toggle="tab">Region</a>
											</li>
											<li class=""><a href="#State" data-toggle="tab">State</a>
											</li>
											<li class=""><a href="#City" data-toggle="tab" onclick="javascript: getListState();">City</a>
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
															<select class="lstState form-control" id="cityStateID">
																<option value="0">Select State:</option>
															</select>
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
						

				   </div>
					<!-- /inner content wrapper -->

                </div>
				<script src="appjs/cargotype.js?86"></script>
				<script src="appjs/region.js"></script>
				<script src="appjs/state.js"></script>
				<script src="appjs/city.js"></script>
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