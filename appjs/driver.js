$(document).ready(function(){
	$('#btnDelMultiDriver').fadeOut();
	getDriver();
});

function setDriver(){

//alert('called');

driverID = $('#driverID').val();
driverCode = $.trim($('#driverCode').val());
driverFirstName = $.trim($('#driverFirstName').val());
driverMiddleName = $.trim($('#driverMiddleName').val());
driverLastName = $.trim($('#driverLastName').val());

if (driverCode == '') {
	alertMsg('Driver Code is required', 'warning');
	$('#driverCode').focus();
	return;
}
    
if (driverFirstName == '') {
	alertMsg('Driver first name is required', 'warning');
	$('#driverFirstName').focus();
	return;
}
    
if (driverLastName == '') {
	alertMsg('Driver last name is required', 'warning');
	$('#driverLastName').focus();
	return;
}


$.ajax({
type: "POST",
url: 'includes/functioncall.php',
dataType: 'json',
data: {functionname: 'setDriver', driverID: driverID, driverCode: driverCode, driverFirstName: driverFirstName, driverMiddleName: driverMiddleName, driverLastName: driverLastName},
success: function(obj,textstatus){
				
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddDriverRecord').text() == 'Save'){
						clearDriverValues();
					}
					getDriver();
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

function getDriver() {
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getDriver'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		var cls = 'selClsDriver';
		var tbl = '<table class="table table-bordered datatable" id="tblDriver"> <thead> ' +
		'<tr> <th style="width: 5%;"><input type="checkbox" value="" id="chkAllDriver" onchange="checkAll(this,\'selClsDriver\'); countDriverCheckedBox();" /></th> ' +
		' <th><strong>Driver Code</strong></th> <th><strong>First Name</strong></th> <th><strong>Middle Name</strong></th> <th><strong>Last Name</strong></th><th style="width: 7%; text-align: center;"><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyDriver"> ';
        $('#divDriverTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addDriver(this.driverID, this.driverCode, this.firstName, this.middleName, this.lastName,true);
        });
		tbl += '</tbody></table>'; 
		$("#divDriverTBL").html(tbl); 
		$('#tblDriver').dataTable();
	}
});
	return false;
}

function _addDriver(id, driverCode, driverFirstName, driverMiddleName, driverLastName, isReturn) {
    var tr = '<tr id="trDriver_' + id + '"><td  style="width: 5%;"><input type="checkbox" value="' + id + '" class="selClsDriver" onclick="countDriverCheckedBox();" /></td><td>' + driverCode + '</td> <td>' + driverFirstName + '</td> <td>' + driverMiddleName + '</td> <td>' + driverLastName + '</td> <td style="width: 7%; text-align: center;"> <a  title="Click to edit" href=\'javascript:editDriver(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblDriver > tbody:first").append(tr);
}

function editDriver(id) {
    
    driverID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getDriverByID', driverID: driverID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
            
            $('#driverID').val(this.driverID);
            $('#driverCode').val(this.driverCode); 
            $('#driverFirstName').val(this.firstName);
            $('#driverMiddleName').val(this.middleName);
            $('#driverLastName').val(this.lastName);
            
		});
		
		$('#btnAddDriverRecord').text('Update');
		
		$('#btnAddDriver').click();
	}
});
    
    
}

function countDriverCheckedBox() {
    if ($('#tbodyDriver input:checkbox:checked').length > 0) $('#btnDelMultiDriver').fadeIn();
    else { $('#chkAllDriver').checked = false; 
	$('#btnDelMultiDriver').fadeOut(); }
}

function deleteSelectedDriver() {
    if ($('#tbodyDriver input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyDriver input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsDriver').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'delDriver', driverID: sel_IDs},
	success: function(obj,textstatus){
					
					if (obj.isSuccess == 1) {
						alertMsg(obj.msg,'success');
						//alertMsgGritter('Success',obj.msg,'success')
						$('#btnDelMultiDriver').fadeOut();
						getDriver();
					}
					else {
						alertMsg(obj.msg,'danger');
						//alertMsgGritter('Error',obj.msg,'danger')
					}
				}
	});
	
	return false;
}

 function clearDriverValues() {

    $('#driverID').val('0');
    $('#driverCode').val(''); 
    $('#driverFirstName').val('');
    $('#driverMiddleName').val('');
    $('#driverLastName').val('');
     
	$('#btnAddDriverRecord').text('Save');

}