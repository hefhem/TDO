$(document).ready(function(){
	$('#btnDelMultiUserGroup').fadeOut();
	getUserGroup();
});

function setUserGroup(){

//alert('called');

userGroupID = $('#userGroupID').val();
userGroupName = $.trim($('#userGroupName').val());
userGroupDescription = $.trim($('#userGroupDescription').val());
userGroupCode = $.trim($('#userGroupCode').val());

if (userGroupName == '') {
	alertMsg('User group name is required', 'warning');
	$('#userGroupName').focus();
	return;
}
    
if (userGroupDescription == '') {
	alertMsg('User group description is required', 'warning');
	$('#userGroupDescription').focus();
	return;
}
    
if (userGroupCode == '') {
	alertMsg('User group code is required', 'warning');
	$('#userGroupCode').focus();
	return;
}

$.ajax({
type: "POST",
url: 'includes/functioncall.php',
dataType: 'json',
data: {functionname: 'setUserGroup', userGroupID: userGroupID, userGroupName: userGroupName, userGroupDescription: userGroupDescription, userGroupCode: userGroupCode},
success: function(obj,textstatus){
    
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddUserGroupRecord').text() == 'Save'){
						clearUserGroupValues();
					}
					getUserGroup();
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

function getUserGroup() {
    //alert('am here');
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getUserGroup'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		var cls = 'selClsUserGroup';
		var tbl = '<table class="table table-bordered datatable" id="tblUserGroup"> <thead> ' +
		'<tr> <th style="width: 5%;"><input type="checkbox" value="" id="chkAllUserGroupType" onchange="checkAll(this,\'selClsUserGroup\'); countUserGroupCheckedBox();" /></th> ' +
		' <th><strong>User Group Name</strong> <th><strong>User Group Description</strong> <th><strong>User Group Code</strong></th><th style="width: 7%; text-align: center;"><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyUserGroup"> ';
        $('#divUserGroupTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addUserGroup(this.userGroupID, this.userGroupName, this.userGroupDescription, this.userGroupCode, true);
        });
		tbl += '</tbody></table>'; 
		$("#divUserGroupTBL").html(tbl); 
		$('#tblUserGroup').dataTable();
	}
});
	return false;
}

function editUserGroup(id) {
    //alert('aaaaaa');
    userGroupID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getUserGroupByID', userGroupID: userGroupID},
	success: function(obj,textstatus){
				console.log(obj);
		$.each(obj, function () {
			$('#userGroupID').val(this.userGroupID);
			$('#userGroupName').val(this.userGroupName);
            $('#userGroupDescription').val(this.userGroupDescription);
            $('#userGroupCode').val(this.userGroupCode);
		});
		
		$('#btnAddUserGroupRecord').text('Update');
		
		$('#btnAddUserGroup').click();
	}
});
    
    
}

function _addUserGroup(id, userGroupName, userGroupDescription, userGroupCode, isReturn) {
    var tr = '<tr id="trUserGroup_' + id + '"><td  style="width: 5%;"><input type="checkbox" value="' + id + '" class="selClsUserGroup" onclick="countUserGroupCheckedBox();" /></td><td>' + userGroupName + '</td> <td>' + userGroupDescription + '</td> <td>' + userGroupCode + '</td><td style="width: 7%; text-align: center;"> <a  title="Click to edit" href=\'javascript:editUserGroup(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblUserGroup > tbody:first").append(tr);
}

function countUserGroupCheckedBox() {
    if ($('#tbodyUserGroup input:checkbox:checked').length > 0) $('#btnDelMultiUserGroup').fadeIn();
    else { $('#chkAllUserGroup').checked = false; 
	$('#btnDelMultiUserGroup').fadeOut(); }
}

function deleteSelectedUserGroup() {
    if ($('#tbodyUserGroup input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyUserGroup input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsUserGroup').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'delUserGroup', userGroupID: sel_IDs},
	success: function(obj,textstatus){
					
					if (obj.isSuccess == 1) {
						alertMsg(obj.msg,'success');
						//alertMsgGritter('Success',obj.msg,'success')
						$('#btnDelMultiUserGroup').fadeOut();
						getUserGroup();
					}
					else {
						alertMsg(obj.msg,'danger');
						//alertMsgGritter('Error',obj.msg,'danger')
					}
				}
	});
	
	return false;
}

 function clearUserGroupValues() {

    $('#userGroupID').val('0');
	$('#userGroupName').val('');
    $('#userGroupDescription').val('');
    $('#userGroupCode').val('');
	$('#btnAddUserGroupRecord').text('Save');

}