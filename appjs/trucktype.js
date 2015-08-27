$(document).ready(function(){
	$('#btnDelMultiTruckType').fadeOut();
	getTruckType();
});

function setTruckType(){

//alert('called');

truckTypeID = $('#truckTypeID').val();
truckTypeName = $.trim($('#truckTypeName').val());

if (truckTypeName == '') {
	alertMsg('Truck type name is required', 'warning');
	$('#truckTypeName').focus();
	return;
}

$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setTruckType', truckTypeID: truckTypeID, truckTypeName: truckTypeName},
success: function(obj,textstatus){
				
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddTruckRecord').text() == 'Save'){
						clearTruckValues();
					}
					getTruckType();
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

function getTruckType() {
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getTruckType'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		var cls = 'selClsTruckType';
		var tbl = '<table class="table table-bordered datatable" id="tblTruckType"> <thead> ' +
		'<tr> <th style="width: 5%;"><input type="checkbox" value="" id="chkAllTruckTypeType" onchange="checkAll(this,\'selClsTruckType\'); countTruckTypeCheckedBox();" /></th> ' +
		' <th><strong>Truck Name</strong></th><th style="width: 7%; text-align: center;"><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyTruckType"> ';
        $('#divTruckTypeTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addTruckType(this.truckTypeID, this.truckTypeName,true);
        });
		tbl += '</tbody></table>'; 
		$("#divTruckTypeTBL").html(tbl); 
		$('#tblTruckType').dataTable();
	}
});
	return false;
}

function editTruckType(id) {
    
    truckTypeID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getTruckTypeByID', truckTypeID: truckTypeID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#truckTypeID').val(this.truckTypeID);
			$('#truckTypeName').val(this.truckTypeName);
		});
		
		$('#btnAddTruckRecord').text('Update');
		
		$('#btnAddTruckType').click();
	}
});
    
    
}

function _addTruckType(id, truckTypeName, isReturn) {
    var tr = '<tr id="trTruckType_' + id + '"><td  style="width: 5%;"><input type="checkbox" value="' + id + '" class="selClsTruckType" onclick="countTruckTypeCheckedBox();" /></td><td>' + truckTypeName +
                '</td><td style="width: 7%; text-align: center;"> <a  title="Click to edit" href=\'javascript:editTruckType(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblTruckType > tbody:first").append(tr);
}

function countTruckTypeCheckedBox() {
    if ($('#tbodyTruckType input:checkbox:checked').length > 0) $('#btnDelMultiTruckType').fadeIn();
    else { $('#chkAllTruckType').checked = false; 
	$('#btnDelMultiTruckType').fadeOut(); }
}

function deleteSelectedTruckType() {
    if ($('#tbodyTruckType input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyTruckType input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsTruckType').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'delTruckType', truckTypeID: sel_IDs},
	success: function(obj,textstatus){
					
					if (obj.isSuccess == 1) {
						alertMsg(obj.msg,'success');
						//alertMsgGritter('Success',obj.msg,'success')
						$('#btnDelMultiTruckType').fadeOut();
						getTruckType();
					}
					else {
						alertMsg(obj.msg,'danger');
						//alertMsgGritter('Error',obj.msg,'danger')
					}
				}
	});
	
	return false;
}

 function clearTruckValues() {

    $('#truckTypeID').val('0');
	$('#truckTypeName').val('');
	$('#btnAddTruckRecord').text('Save');

}