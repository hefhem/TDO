$(document).ready(function(){
	$('#btnDelMultiTruck').fadeOut();
	getTruck();
	//getListState();
});

function setTruck(){

//alert('called');

truckID = $('#truckID').val();
truckName = $.trim($('#truckName').val());
regNumb = $.trim($('#regNumb').val());
truckTruckTypeID = $.trim($('#truckTruckTypeID').val());

if (truckName == '') {
	alertMsg('Truck name is required', 'error');
	$('#truckName').focus();
	return;
}

if (regNumb == '') {
	alertMsg('Registration number is required', 'error');
	$('#truckName').focus();
	return;
}

if (truckTruckTypeID == '0' || truckTruckTypeID == '') {
	alertMsg('Please select a truckType', 'error');
	$('#truckTruckTypeID').focus();
	return;
}

//alert( truckID + ',' + truckName + ',' + truckCode);

$.ajax({
type: "POST",
url: 'includes/functioncall.php',
dataType: 'json',
data: {functionname: 'setTruck', truckID: truckID, truckName: truckName, regNumb: regNumb, truckTruckTypeID: truckTruckTypeID},
success: function(obj,textstatus){
				//alert('I got here');
				//console.log(obj);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddTruckRecord').text() == 'Save'){
						clearTruckValues();
					}
					getTruck();
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

function getTruck() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getTruck'},
	success: function(obj,textstatus){
				
				//console.log(obj);
				
		var tbl = '<table class="table table-bordered datatable" id="tblTruck"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllTruckType" onchange="checkAll(this,\'selClsTruck\'); countTruckCheckedBox();" /></th> ' +
		' <th><strong>Truck Name</strong></th><th><strong>Truck Type</strong></th><th><strong>Reg. No.</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyTruck"> ';
		$('#divTruckTBL').html('');
        $('#divTruckTBL').html(IMG_LOAD);
		
        $.each(obj, function () {
            tbl += _addTruck(this.truckID, this.truckName, this.regNumb, this.truckTypeName, true);
			
        });
		tbl += '</tbody></table>'; 
		$("#divTruckTBL").html(tbl); 
		$('#tblTruck').dataTable();
	}
});
	//alert('2');
	return false;
}

function editTruck(id) {
    
    truckID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getTruckByID', truckID: truckID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#truckID').val(this.truckID);
			$('#truckName').val(this.truckName);
			$('#regNumb').val(this.regNumb);
			$('#truckTruckTypeID').val(this.truckTypeID);
		});
		
		$('#btnAddTruckRecord').text('Update');
		
		$('#btnAddTruck').click();
	}
});
    
    
}

function _addTruck(id, truckName, regNumb, truckTypeName, isReturn) {
    var tr = '<tr id="trTruck_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsTruck" onclick="countTruckCheckedBox();" /></td><td>' + truckName +
                '</td><td>' + truckTypeName +
                '</td><td>' + regNumb +
                '</td><td> <a  title="Click to edit" href=\'javascript:editTruck(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblTruck > tbody:first").append(tr);
}

function countTruckCheckedBox() {
    if ($('#tbodyTruck input:checkbox:checked').length > 0) $('#btnDelMultiTruck').fadeIn();
    else { $('#chkAllTruck').checked = false; 
	$('#btnDelMultiTruck').fadeOut(); }
}

function deleteSelectedTruck() {
    if ($('#tbodyTruck input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyTruck input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsTruck').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
					
		$.ajax({
		type: "POST",
		url: 'includes/functioncall.php',
		dataType: 'json',
		data: {functionname: 'delTruck', truckID: sel_IDs},
		success: function(obj,textstatus){
						
						if (obj.isSuccess == 1) {
							alertMsg(obj.msg,'success');
							//alertMsgGritter('Success',obj.msg,'success')
							$('#btnDelMultiTruck').fadeOut();
							getTruck();
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

    $('#truckID').val('0');
	$('#truckName').val('');
	$('#regNumb').val('');
	$('#truckTruckTypeID').val('0');
	$('#btnAddTruckRecord').text('Save');
		
}