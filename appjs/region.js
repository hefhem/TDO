$(document).ready(function(){
	$('#btnDelMultiRegion').fadeOut();
	getRegion();
});

function setRegion(){

//alert('called');

regionID = $('#regionID').val();
regionName = $.trim($('#regionName').val());

if (regionName == '') {
	alertMsg('Region name is required', 'warning');
	$('#regionName').focus();
	return;
}

$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setRegion', regionID: regionID, regionName: regionName},
success: function(obj,textstatus){
				//alert('I got here');
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddRegionRecord').text() == 'Save'){
						clearRegionValues();
					}
					getRegion();
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

function getRegion() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getRegion'},
	success: function(obj,textstatus){
				
				//console.log(obj);
				
		var tbl = '<table class="table table-bordered datatable" id="tblRegion"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllRegionType" onchange="checkAll(this,\'selClsRegion\'); countRegionCheckedBox();" /></th> ' +
		' <th><strong>Region Name</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyRegion"> ';
        $('#divRegionTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addRegion(this.regionID, this.regionName,true);
        });
		tbl += '</tbody></table>'; 
		$("#divRegionTBL").html(tbl); 
		$('#tblRegion').dataTable();
	}
});
	//alert('2');
	return false;
}

function editRegion(id) {
    
    regionID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getRegionByID', regionID: regionID},
	success: function(obj,textstatus){
				console.log(obj);
		$.each(obj, function () {
			$('#regionID').val(this.regionID);
			$('#regionName').val(this.regionName);
		});
		
		$('#btnAddRegionRecord').text('Update');
		
		$('#btnAddRegion').click();
	}
});
    
    
}

function _addRegion(id, regionName, isReturn) {
    var tr = '<tr id="trRegion_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsRegion" onclick="countRegionCheckedBox();" /></td><td>' + regionName +
                '</td><td> <a  title="Click to edit" href=\'javascript:editRegion(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblRegion > tbody:first").append(tr);
}

function countRegionCheckedBox() {
    if ($('#tbodyRegion input:checkbox:checked').length > 0) $('#btnDelMultiRegion').fadeIn();
    else { $('#chkAllRegion').checked = false; 
	$('#btnDelMultiRegion').fadeOut(); }
}

function deleteSelectedRegion() {
    if ($('#tbodyRegion input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyRegion input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsRegion').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
					
		$.ajax({
		type: "POST",
		url: 'includes/db_connect_functioncall.php',
		dataType: 'json',
		data: {functionname: 'delRegion', regionID: sel_IDs},
		success: function(obj,textstatus){
						
						if (obj.isSuccess == 1) {
							alertMsg(obj.msg,'success');
							//alertMsgGritter('Success',obj.msg,'success')
							$('#btnDelMultiRegion').fadeOut();
							getRegion();
						}
						else {
							alertMsg(obj.msg,'error');
							//alertMsgGritter('Error',obj.msg,'error')
						}
					}
		});
	
	
	return false;
}
 
 function clearRegionValues() {

    $('#regionID').val('0');
	$('#regionName').val('');
	$('#btnAddRegionRecord').text('Save');
		

}