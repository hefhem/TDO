$(document).ready(function(){
	$('#btnDelMultiState').fadeOut();
	getState();
});

function setState(){

//alert('called');

stateID = $('#stateID').val();
stateName = $.trim($('#stateName').val());
stateCode = $.trim($('#stateCode').val());

if (stateName == '') {
	alertMsg('State name is required', 'warning');
	$('#stateName').focus();
	return;
}
if (stateCode == '') {
	alertMsg('State code is required', 'warning');
	$('#stateCode').focus();
	return;
}

//alert( stateID + ',' + stateName + ',' + stateCode);

$.ajax({
type: "POST",
url: 'includes/functioncall.php',
dataType: 'json',
data: {functionname: 'setState', stateID: stateID, stateName: stateName, stateCode: stateCode},
success: function(obj,textstatus){
				//alert('I got here');
				//console.log(obj);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddStateRecord').text() == 'Save'){
						clearStateValues();
					}
					getState();
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

function getState() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getState'},
	success: function(obj,textstatus){
				
				//console.log(obj);
				
		var tbl = '<table class="table table-bordered datatable" id="tblState"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllStateType" onchange="checkAll(this,\'selClsState\'); countStateCheckedBox();" /></th> ' +
		' <th><strong>State Name</strong></th><th><strong>State Code</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyState"> ';
        $('#divStateTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addState(this.stateID, this.stateName, this.stateCode, true);
        });
		tbl += '</tbody></table>'; 
		$("#divStateTBL").html(tbl); 
		$('#tblState').dataTable();
	}
});
	//alert('2');
	return false;
}

function editState(id) {
    
    stateID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getStateByID', stateID: stateID},
	success: function(obj,textstatus){
				console.log(obj);
		$.each(obj, function () {
			$('#stateID').val(this.stateID);
			$('#stateName').val(this.stateName);
			$('#stateCode').val(this.stateCode);
		});
		
		$('#btnAddStateRecord').text('Update');
		
		$('#btnAddState').click();
	}
});
    
    
}

function _addState(id, stateName, stateCode, isReturn) {
    var tr = '<tr id="trState_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsState" onclick="countStateCheckedBox();" /></td><td>' + stateName +
                '</td><td>' + stateCode +
                '</td><td> <a  title="Click to edit" href=\'javascript:editState(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblState > tbody:first").append(tr);
}

function countStateCheckedBox() {
    if ($('#tbodyState input:checkbox:checked').length > 0) $('#btnDelMultiState').fadeIn();
    else { $('#chkAllState').checked = false; 
	$('#btnDelMultiState').fadeOut(); }
}

function deleteSelectedState() {
    if ($('#tbodyState input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyState input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsState').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
					
		$.ajax({
		type: "POST",
		url: 'includes/functioncall.php',
		dataType: 'json',
		data: {functionname: 'delState', stateID: sel_IDs},
		success: function(obj,textstatus){
						
						if (obj.isSuccess == 1) {
							alertMsg(obj.msg,'success');
							//alertMsgGritter('Success',obj.msg,'success')
							$('#btnDelMultiState').fadeOut();
							getState();
						}
						else {
							alertMsg(obj.msg,'danger');
							//alertMsgGritter('Error',obj.msg,'danger')
						}
					}
		});
	
	
	return false;
}
 
 function clearStateValues() {

    $('#stateID').val('0');
	$('#stateName').val('');
	$('#stateCode').val('');
	$('#btnAddStateRecord').text('Save');
		

}