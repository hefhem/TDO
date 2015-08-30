$(document).ready(function(){
	$('#btnDelMultiTerminal').fadeOut();
	getTerminal();
	//getListState();
});

function setTerminal(){

//alert('called');

terminalID = $('#terminalID').val();
terminalName = $.trim($('#terminalName').val());
terminalPortID = $.trim($('#terminalPortID').val());

if (terminalName == '') {
	alertMsg('Terminal name is required', 'warning');
	$('#terminalName').focus();
	return;
}

if (terminalPortID == '0' || terminalPortID == '') {
	alertMsg('Please select a port', 'warning');
	$('#terminalPortID').focus();
	return;
}

//alert( terminalID + ',' + terminalName + ',' + terminalCode);

$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setTerminal', terminalID: terminalID, terminalName: terminalName, terminalPortID: terminalPortID},
success: function(obj,textstatus){
				//alert('I got here');
				//console.log(obj);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddTerminalRecord').text() == 'Save'){
						clearTerminalValues();
					}
					getTerminal();
				}
				else {
					alertMsg(obj.msg,'error');
					//alertMsgGritter('Error',obj.msg,'error')
				}
			}
});
	
 //alert('called finally');
	return false;
}

function getTerminal() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getTerminal'},
	success: function(obj,textstatus){
				
				//console.log(obj);
				
		var tbl = '<table class="table table-bordered datatable" id="tblTerminal"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllTerminalType" onchange="checkAll(this,\'selClsTerminal\'); countTerminalCheckedBox();" /></th> ' +
		' <th><strong>Terminal Name</strong></th><th><strong>Port</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyTerminal"> ';
		$('#divTerminalTBL').html('');
        $('#divTerminalTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addTerminal(this.terminalID, this.terminalName, this.portName, true);
        });
		tbl += '</tbody></table>'; 
		$("#divTerminalTBL").html(tbl); 
		$('#tblTerminal').dataTable();
	}
});
	//alert('2');
	return false;
}

function editTerminal(id) {
    
    terminalID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getTerminalByID', terminalID: terminalID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#terminalID').val(this.terminalID);
			$('#terminalName').val(this.terminalName);
			$('#terminalPortID').val(this.portID);
		});
		
		$('#btnAddTerminalRecord').text('Update');
		
		$('#btnAddTerminal').click();
	}
});
    
    
}

function _addTerminal(id, terminalName, portName, isReturn) {
    var tr = '<tr id="trTerminal_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsTerminal" onclick="countTerminalCheckedBox();" /></td><td>' + terminalName +
                '</td><td>' + portName +
                '</td><td> <a  title="Click to edit" href=\'javascript:editTerminal(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblTerminal > tbody:first").append(tr);
}

function countTerminalCheckedBox() {
    if ($('#tbodyTerminal input:checkbox:checked').length > 0) $('#btnDelMultiTerminal').fadeIn();
    else { $('#chkAllTerminal').checked = false; 
	$('#btnDelMultiTerminal').fadeOut(); }
}

function deleteSelectedTerminal() {
    if ($('#tbodyTerminal input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyTerminal input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsTerminal').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
					
		$.ajax({
		type: "POST",
		url: 'includes/db_connect_functioncall.php',
		dataType: 'json',
		data: {functionname: 'delTerminal', terminalID: sel_IDs},
		success: function(obj,textstatus){
						
						if (obj.isSuccess == 1) {
							alertMsg(obj.msg,'success');
							//alertMsgGritter('Success',obj.msg,'success')
							$('#btnDelMultiTerminal').fadeOut();
							getTerminal();
						}
						else {
							alertMsg(obj.msg,'error');
							//alertMsgGritter('Error',obj.msg,'error')
						}
					}
		});
	
	
	return false;
}
 
 function clearTerminalValues() {

    $('#terminalID').val('0');
	$('#terminalName').val('');
	$('#terminalPortID').val('0');
	$('#btnAddTerminalRecord').text('Save');
		
}