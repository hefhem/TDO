$(document).ready(function(){
	$('#btnDelMultiForm').fadeOut();
	getForm();
});

function setForm(){

//alert('called');

formID = $('#formID').val();
menuItemMenuID = $.trim($('#menuItemMenuID').val());
formName = $.trim($('#formName').val());
formDescription = $.trim($('#formDescription').val());
formCode = $.trim($('#formCode').val());
    
if (menuItemMenuID == '0' || menuItemMenuID == '') {
	alertMsg('Please select a menu name', 'error');
	$('#menuItemMenuID').focus();
	return;
}
    
if (formName == '') {
	alertMsg('Menu Item name is required', 'error');
	$('#formName').focus();
	return;
}
    
if (formDescription == '') {
	alertMsg('Menu Item description is required', 'error');
	$('#formDescription').focus();
	return;
}
    
if (formCode == '') {
	alertMsg('Menu Item code is required', 'error');
	$('#formCode').focus();
	return;
}
     
$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setForm', formID: formID, menuItemMenuID: menuItemMenuID, formName: formName, formDescription: formDescription, formCode: formCode},
success: function(obj,textstatus){
    //alert( formID + ',' + menuItemMenuID + ',' + formName + ',' + formDescription + ',' + formCode);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddFormRecord').text() == 'Save'){
						clearFormValues();
					}
					getForm();
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

function getForm() {
    //alert('am here');
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getForm'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		var cls = 'selClsForm';
		var tbl = '<table class="table table-bordered datatable" id="tblForm"> <thead> ' +
		'<tr> <th style="width: 5%;"><input type="checkbox" value="" id="chkAllFormType" onchange="checkAll(this,\'selClsForm\'); countFormCheckedBox();" /></th> ' +
		' <th><strong>Menu Item Name</strong> <th><strong>Form Name</strong> <th><strong>Form Description</strong> <th><strong>Form Code</strong></th><th style="width: 7%; text-align: center;"><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyForm"> ';
        $('#divFormTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addForm(this.formID, this.menuItemName, this.formName, this.formDescription, this.formCode, true);
        });
		tbl += '</tbody></table>'; 
		$("#divFormTBL").html(tbl); 
		$('#tblForm').dataTable();
	}
});
	return false;
}

function editForm(id) {
    //alert('aaaaaa');
    formID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getFormByID', formID: formID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#formID').val(this.formID);
            $('#menuItemMenuID').val(this.menuItemID);
			$('#formName').val(this.formName);
            $('#formDescription').val(this.formDescription);
            $('#formCode').val(this.formCode);
		});
		
		$('#btnAddFormRecord').text('Update');
		
		$('#btnAddForm').click();
	}
});
    
    
}

function _addForm(id, menuItemName, formName, formDescription, formCode, isReturn) {
    var tr = '<tr id="trForm_' + id + '"><td  style="width: 5%;"><input type="checkbox" value="' + id + '" class="selClsForm" onclick="countFormCheckedBox();" /></td><td>' + menuItemName + '</td> <td>' + formName + '</td> <td>' + formDescription + '</td> <td>' + formCode + '</td><td style="width: 7%; text-align: center;"> <a  title="Click to edit" href=\'javascript:editForm(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblForm > tbody:first").append(tr);
}

function countFormCheckedBox() {
    if ($('#tbodyForm input:checkbox:checked').length > 0) $('#btnDelMultiForm').fadeIn();
    else { $('#chkAllForm').checked = false; 
	$('#btnDelMultiForm').fadeOut(); }
}

function deleteSelectedForm() {
    if ($('#tbodyForm input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyForm input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsForm').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'delForm', formID: sel_IDs},
	success: function(obj,textstatus){
					
					if (obj.isSuccess == 1) {
						alertMsg(obj.msg,'success');
						//alertMsgGritter('Success',obj.msg,'success')
						$('#btnDelMultiForm').fadeOut();
						getForm();
					}
					else {
						alertMsg(obj.msg,'error');
						//alertMsgGritter('Error',obj.msg,'error')
					}
				}
	});
	
	return false;
}

 function clearFormValues() {

    $('#formID').val('0');
    $('#menuItemMenuID').val('0');
	$('#formName').val('');
    $('#formDescription').val('');
    $('#formCode').val('');
	$('#btnAddFormRecord').text('Save');

}