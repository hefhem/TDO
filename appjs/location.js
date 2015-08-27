$(document).ready(function(){
	$('#btnDelMultiLocation').fadeOut();
	getLocation();
	//getListState();
});

function setLocation(){

//alert('called');

locationID = $('#locationID').val();
locationName = $.trim($('#locationName').val());
locationRegionID = $.trim($('#locationRegionID').val());

if (locationName == '') {
	alertMsg('Location name is required', 'warning');
	$('#locationName').focus();
	return;
}

if (locationRegionID == '0' || locationRegionID == '') {
	alertMsg('Please select a region', 'warning');
	$('#locationRegionID').focus();
	return;
}

//alert( locationID + ',' + locationName + ',' + locationCode);

$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setLocation', locationID: locationID, locationName: locationName, locationRegionID: locationRegionID},
success: function(obj,textstatus){
				//alert('I got here');
				//console.log(obj);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddLocationRecord').text() == 'Save'){
						clearLocationValues();
					}
					getLocation();
				}
				else {
					alertMsg(obj.msg,'danger');
					//alertMsgGritter('Error',obj.msg,'danger')
				}
			}
});
	
 //alert('called finally');
	return false;
}

function getLocation() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getLocation'},
	success: function(obj,textstatus){
				
				//console.log(obj);
				
		var tbl = '<table class="table table-bordered datatable" id="tblLocation"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllLocationType" onchange="checkAll(this,\'selClsLocation\'); countLocationCheckedBox();" /></th> ' +
		' <th><strong>Location Name</strong></th><th><strong>Region</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyLocation"> ';
		$('#divLocationTBL').html('');
        $('#divLocationTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addLocation(this.locationID, this.locationName, this.regionName, true);
        });
		tbl += '</tbody></table>'; 
		$("#divLocationTBL").html(tbl); 
		$('#tblLocation').dataTable();
	}
});
	//alert('2');
	return false;
}

function editLocation(id) {
    
    locationID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getLocationByID', locationID: locationID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#locationID').val(this.locationID);
			$('#locationName').val(this.locationName);
			$('#locationRegionID').val(this.regionID);
		});
		
		$('#btnAddLocationRecord').text('Update');
		
		$('#btnAddLocation').click();
	}
});
    
    
}

function _addLocation(id, locationName, regionName, isReturn) {
    var tr = '<tr id="trLocation_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsLocation" onclick="countLocationCheckedBox();" /></td><td>' + locationName +
                '</td><td>' + regionName +
                '</td><td> <a  title="Click to edit" href=\'javascript:editLocation(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblLocation > tbody:first").append(tr);
}

function countLocationCheckedBox() {
    if ($('#tbodyLocation input:checkbox:checked').length > 0) $('#btnDelMultiLocation').fadeIn();
    else { $('#chkAllLocation').checked = false; 
	$('#btnDelMultiLocation').fadeOut(); }
}

function deleteSelectedLocation() {
    if ($('#tbodyLocation input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyLocation input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsLocation').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
					
		$.ajax({
		type: "POST",
		url: 'includes/db_connect_functioncall.php',
		dataType: 'json',
		data: {functionname: 'delLocation', locationID: sel_IDs},
		success: function(obj,textstatus){
						
						if (obj.isSuccess == 1) {
							alertMsg(obj.msg,'success');
							//alertMsgGritter('Success',obj.msg,'success')
							$('#btnDelMultiLocation').fadeOut();
							getLocation();
						}
						else {
							alertMsg(obj.msg,'danger');
							//alertMsgGritter('Error',obj.msg,'danger')
						}
					}
		});
	
	
	return false;
}
 
 function clearLocationValues() {

    $('#locationID').val('0');
	$('#locationName').val('');
	$('#locationRegionID').val('0');
	$('#btnAddLocationRecord').text('Save');
		
}