$(document).ready(function(){
	$('#btnDelMultiPort').fadeOut();
	getPort();
	//getListState();
});

function setPort(){

//alert('called');

portID = $('#portID').val();
portName = $.trim($('#portName').val());
portLocationID = $.trim($('#portLocationID').val());

if (portName == '') {
	alertMsg('Port name is required', 'warning');
	$('#portName').focus();
	return;
}

if (portLocationID == '0' || portLocationID == '') {
	alertMsg('Please select a location', 'warning');
	$('#portLocationID').focus();
	return;
}

//alert( portID + ',' + portName + ',' + portCode);

$.ajax({
type: "POST",
url: 'includes/functioncall.php',
dataType: 'json',
data: {functionname: 'setPort', portID: portID, portName: portName, portLocationID: portLocationID},
success: function(obj,textstatus){
				//alert('I got here');
				//console.log(obj);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddPortRecord').text() == 'Save'){
						clearPortValues();
					}
					getPort();
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

function getPort() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getPort'},
	success: function(obj,textstatus){
				
				//console.log(obj);
				
		var tbl = '<table class="table table-bordered datatable" id="tblPort"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllPortType" onchange="checkAll(this,\'selClsPort\'); countPortCheckedBox();" /></th> ' +
		' <th><strong>Port Name</strong></th><th><strong>Location</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyPort"> ';
		$('#divPortTBL').html('');
        $('#divPortTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addPort(this.portID, this.portName, this.locationName, true);
        });
		tbl += '</tbody></table>'; 
		$("#divPortTBL").html(tbl); 
		$('#tblPort').dataTable();
	}
});
	//alert('2');
	return false;
}

function editPort(id) {
    
    portID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getPortByID', portID: portID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#portID').val(this.portID);
			$('#portName').val(this.portName);
			$('#portLocationID').val(this.locationID);
		});
		
		$('#btnAddPortRecord').text('Update');
		
		$('#btnAddPort').click();
	}
});
    
    
}

function _addPort(id, portName, locationName, isReturn) {
    var tr = '<tr id="trPort_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsPort" onclick="countPortCheckedBox();" /></td><td>' + portName +
                '</td><td>' + locationName +
                '</td><td> <a  title="Click to edit" href=\'javascript:editPort(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblPort > tbody:first").append(tr);
}

function countPortCheckedBox() {
    if ($('#tbodyPort input:checkbox:checked').length > 0) $('#btnDelMultiPort').fadeIn();
    else { $('#chkAllPort').checked = false; 
	$('#btnDelMultiPort').fadeOut(); }
}

function deleteSelectedPort() {
    if ($('#tbodyPort input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyPort input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsPort').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
					
		$.ajax({
		type: "POST",
		url: 'includes/functioncall.php',
		dataType: 'json',
		data: {functionname: 'delPort', portID: sel_IDs},
		success: function(obj,textstatus){
						
						if (obj.isSuccess == 1) {
							alertMsg(obj.msg,'success');
							//alertMsgGritter('Success',obj.msg,'success')
							$('#btnDelMultiPort').fadeOut();
							getPort();
						}
						else {
							alertMsg(obj.msg,'danger');
							//alertMsgGritter('Error',obj.msg,'danger')
						}
					}
		});
	
	
	return false;
}
 
 function clearPortValues() {

    $('#portID').val('0');
	$('#portName').val('');
	$('#portLocationID').val('0');
	$('#btnAddPortRecord').text('Save');
		
}