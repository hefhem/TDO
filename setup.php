
				
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
											<li class=""><a href="#settings1" data-toggle="tab">Profile</a>
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
											<div class="tab-pane fade" id="settings1">
												<p>Your eyes can deceive you. Don't trust them. I don't know what you're talking about. I am a member of the Imperial Senate on a diplomatic mission to Alderaan-- I care. So, what do you think of her, Han? Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you're going.
													</p><p>
											</p></div>
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
						

				   </div>
					<!-- /inner content wrapper -->

                </div>
				<script src="appjs/cargotype.js?85"></script>
				<script src="appjs/region.js"></script>
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