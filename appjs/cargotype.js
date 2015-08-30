$(document).ready(function(){
	$('#btnDelMultiCargoType').fadeOut();
	getCargoType();
});

function setCargoType(){

//alert('called');

cargoTypeID = $('#cargoTypeID').val();
cargoTypeName = $.trim($('#cargoTypeName').val());

if (cargoTypeName == '') {
	alertMsg('Cargo type name is required', 'warning');
	$('#cargoTypeName').focus();
	return;
}

$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setCargoType', cargoTypeID: cargoTypeID, cargoTypeName: cargoTypeName},
success: function(obj,textstatus){
		//alert('called2');
		//console.log(obj);
		if (obj.isSuccess == 1) {
			alertMsg(obj.msg,'success');
			//alertMsgGritter('Success',obj.msg,'success')
			if ($('#btnAddCargoRecord').text() == 'Save'){
				clearCargoValues();
			}
			getCargoType();
		}
		else {
			alertMsg(obj.msg,'error');
			//alertMsgGritter('Error',obj.msg,'danger')
		}
	}
});
	
 //alert('called finally');
	return false;
}

function getCargoType() {
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getCargoType'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		var cls = 'selClsCargoType';
		var tbl = '<table class="table table-bordered datatable" id="tblCargoType"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllCargoTypeType" onchange="checkAll(this,\'selClsCargoType\'); countCargoTypeCheckedBox();" /></th> ' +
		' <th><strong>Cargo Name</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyCargoType"> ';
        $('#divCargoTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addCargoType(this.cargoTypeID, this.cargoTypeName,true);
        });
		tbl += '</tbody></table>'; 
		$("#divCargoTBL").html(tbl); 
		$('#tblCargoType').dataTable();
	}
});
	return false;
}

function editCargoType(id) {
    
    cargoTypeID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getCargoTypeByID', cargoTypeID: cargoTypeID},
	success: function(obj,textstatus){
				console.log(obj);
		$.each(obj, function () {
			$('#cargoTypeID').val(this.cargoTypeID);
			$('#cargoTypeName').val(this.cargoTypeName);
		});
		
		$('#btnAddCargoRecord').text('Update');
		
		$('#btnAddCargoType').click();
	}
});
    
    
}

function _addCargoType(id, cargoTypeName, isReturn) {
    var tr = '<tr id="trCargoType_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsCargoType" onclick="countCargoTypeCheckedBox();" /></td><td>' + cargoTypeName +
                '</td><td> <a  title="Click to edit" href=\'javascript:editCargoType(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblCargoType > tbody:first").append(tr);
}

function countCargoTypeCheckedBox() {
    if ($('#tbodyCargoType input:checkbox:checked').length > 0) $('#btnDelMultiCargoType').fadeIn();
    else { $('#chkAllCargoType').checked = false; 
	$('#btnDelMultiCargoType').fadeOut(); }
}

function deleteSelectedCargoType() {
    if ($('#tbodyCargoType input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyCargoType input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsCargoType').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'delCargoType', cargoTypeID: sel_IDs},
	success: function(obj,textstatus){
					
					if (obj.isSuccess == 1) {
						alertMsg(obj.msg,'success');
						//alertMsgGritter('Success',obj.msg,'success')
						$('#btnDelMultiCargoType').fadeOut();
						getCargoType();
					}
					else {
						alertMsg(obj.msg,'danger');
						//alertMsgGritter('Error',obj.msg,'danger')
					}
				}
	});
	
	return false;
}

 function clearCargoValues() {

    $('#cargoTypeID').val('0');
	$('#cargoTypeName').val('');
	$('#btnAddCargoRecord').text('Save');
		
}