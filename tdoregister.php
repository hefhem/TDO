<?php
include_once 'includes/db_connect.php';
include_once 'includes/db_connect_functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == false) {
    header('Location: signin.php');
}
?>
<style type="text/css">
.form-control {
	margin-bottom:3%;
}
</style>
<div class="content-wrap">

    <!-- inner content wrapper -->
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading"><h3>REGISTER</h3></header>
                    <div class="panel-body">
                     <!--<form class="form-horizontal" role="form">-->
                     	<div class="col-lg-12">
                        	<div class="form-group">
                                <div class="" align="center">
                                    <button class="btn btn-primary" id="btnAddPort" data-toggle="modal" data-target="#findModal">Find</button>
                                    <button type="submit" class="btn btn-default" id="btnRefresh">Refresh</button>
									<button type="submit" class="btn btn-primary" id="btnAddRegister">New</button>
                                    <button type="submit" class="btn btn-success" id="btnAddRegister">Save</button>
                                    
                                </div>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <header class="panel-heading"></header>
                        <br/>
                        <br/>
                    	<div class="col-lg-6">
                            <div class="form-group">
                                <label for="jobNumber" class="col-sm-4 control-label">Job Number</label>
                                <div class="col-sm-7">
                                    <input type="text" readonly="readonly" class="form-control" id="jobNumber" value="<?php echo getJobNumber($mysqli); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateReceived" class="col-sm-4 control-label">Date Received</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="dateReceived" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fileRef" class="col-sm-4 control-label">File Ref.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="fileRef" placeholder="File Reference">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="containerNo" class="col-sm-4 control-label">Container No.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="containerNo" placeholder="Container No.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="terminalID" class="col-sm-4 control-label">Terminal</label>
                                <div class="col-sm-7">
                                    <?php 
										$result = getTerminalDropDown(); 
										echo '<select class="form-control" id="terminalID" name="terminalID">';
										echo '<option value="0">Select Terminal</option>';
											while ($terminalrow = mysqli_fetch_assoc($result)) {
											   echo '<option value="'.$terminalrow['terminalID'].'">'.$terminalrow['terminalName'].'</option>';
											}
											
											$mysqli->close();
											
										echo '</select>';
									?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="truckID" class="col-sm-4 control-label">Truck</label>
                                <div class="col-sm-7">
                                    <?php 
										$result = getTruckDropDown(); 
										echo '<select class="form-control" id="truckID" name="truckID">';
										echo '<option value="0">Select Truck</option>';
											while ($truckrow = mysqli_fetch_assoc($result)) {
											   echo '<option value="'.$truckrowrow['truckID'].'">'.$truckrow['truckName'].' - '.$truckrow['regNumb'].'</option>';
											}
											
											$mysqli->close();
											
										echo '</select>';
									?>
                                </div>
                            </div>
							<div class="form-group">
                                <label for="loadingDate" class="col-sm-4 control-label">Loading Date</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="loadingDate" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="loadingTime" class="col-sm-4 control-label">Loading Time</label>
                                <div class="col-sm-7">
                                    <input type="time" class="form-control" id="loadingTime" placeholder="hh:mm:ss">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="dispatchDate" class="col-sm-4 control-label">Dispatch Date</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="dispatchDate" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dispatchTime" class="col-sm-4 control-label">Dispatch Time</label>
                                <div class="col-sm-7">
                                    <input type="time" class="form-control" id="dispatchTime" placeholder="hh:mm:ss">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        	<div class="form-group">
                                <label for="status" class="col-sm-4 control-label">Status</label>
                                <div class="col-sm-7">
                                	<select class="form-control" id="status">
                                    	<option value="O">Open</option>
                                        <option value="L">Closed</option>
                                        <option value="C">Canceled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="expiryDate" class="col-sm-4 control-label">Expiry Date</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="expiryDate" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tdoReceiptDate" class="col-sm-4 control-label">TDO Receipt</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="tdoReceiptDate" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cargoTypeID" class="col-sm-4 control-label">Cargo Type</label>
                                <div class="col-sm-7">
                                    <?php 
										$result = getCargoTypeDropDown(); 
										echo '<select class="form-control" id="cargoTypeID" name="cargoTypeID">';
										echo '<option value="0">Select Cargo Type</option>';
											while ($cargotyperow = mysqli_fetch_assoc($result)) {
											   echo '<option value="'.$cargotyperow['cargoTypeID'].'">'.$cargotyperow['cargoTypeName'].'</option>';
											}
											
											$mysqli->close();
											
										echo '</select>';
									?>
                                </div>
                            </div>
							<div class="form-group">
                                <label for="stateID" class="col-sm-4 control-label"> Destination State</label>
                                <div class="col-sm-7">
                                    <?php 
										$result = getStateDropDown(); 
										echo '<select class="form-control" id="stateID" name="stateID">';
										echo '<option value="0">Select State</option>';
											while ($staterow = mysqli_fetch_assoc($result)) {
											   echo '<option value="'.$staterow['stateID'].'">'.$staterow['stateName'].'</option>';
											}
											
											$mysqli->close();
											
										echo '</select>';
									?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="destinationID" class="col-sm-4 control-label">Destination</label>
                                <div class="col-sm-7">
                                    <select class="form-control" id="destinationID">
										<option value="0">Select State First</option>
									</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="returnTerminal" class="col-sm-4 control-label">Return Terminal</label>
                                <div class="col-sm-7">
                                    <?php 
										$result = getTerminalDropDown(); 
										echo '<select class="form-control" id="returnTerminal" name="returnTerminal">';
										echo '<option value="0">Select Return Terminal</option>';
											while ($retterminalrow = mysqli_fetch_assoc($result)) {
											   echo '<option value="'.$retterminalrow['terminalID'].'">'.$retterminalrow['terminalName'].'</option>';
											}
											
											$mysqli->close();
											
										echo '</select>';
									?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="schDelDate" class="col-sm-4 control-label">Sch. Delivery Date</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" id="schDelDate" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="remarks" class="col-sm-4 control-label">Remarks</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" id="remarks" placeholder="Remarks"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--</form>-->
                    </div>
                </section>
            </div>
        </div>
                       
<!-- Find Modal -->
<div class="modal fade bs-modal-sm" id="findModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Find Register</h4>
            </div>
            <div class="modal-body">
                <!--<form role="form" action="includes/functioncall.php" method="post" name="cargo_type">-->
                    <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive no-border" id="divRegisterTBL">
						   </div>
                        </div>												
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                
                <!--</form>-->
            </div>
        </div>
    </div>
</div>
    </div>
    <!-- /inner content wrapper -->

</div>