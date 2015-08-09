$(document).ready(function(){
	$('#btnDelMultiMenuItem').fadeOut();
	getMenuItem();
});

function setMenuItem(){

//alert('called');

menuItemID = $('#menuItemID').val();
menuMenuID = $.trim($('#menuMenuID').val());
menuItemName = $.trim($('#menuItemName').val());
menuItemDescription = $.trim($('#menuItemDescription').val());
menuItemCode = $.trim($('#menuItemCode').val());
menuItemRanking = $.trim($('#menuItemRanking').val());
    
if (menuMenuID == '0' || menuMenuID == '') {
	alertMsg('Please select a menu name', 'error');
	$('#menuID').focus();
	return;
}
    
if (menuItemName == '') {
	alertMsg('Menu Item name is required', 'error');
	$('#menuItemName').focus();
	return;
}
    
if (menuItemDescription == '') {
	alertMsg('Menu Item description is required', 'error');
	$('#menuItemDescription').focus();
	return;
}
    
if (menuItemCode == '') {
	alertMsg('Menu Item code is required', 'error');
	$('#menuItemCode').focus();
	return;
}
    
if (menuItemRanking == '') {
	alertMsg('Menu Item ranking is required', 'error');
	$('#menuItemRanking').focus();
	return;
}
    
if (menuItemRanking <= 0) {
	alertMsg('Menu Item ranking cannot be less than or equal zero', 'error');
	$('#menuItemRanking').focus();
	return;
}
     
$.ajax({
type: "POST",
url: 'includes/functioncall.php',
dataType: 'json',
data: {functionname: 'setMenuItem', menuItemID: menuItemID, menuMenuID: menuMenuID, menuItemName: menuItemName, menuItemDescription: menuItemDescription, menuItemCode: menuItemCode, menuItemRanking: menuItemRanking},
success: function(obj,textstatus){
    //alert( menuItemID + ',' + menuMenuID + ',' + menuItemName + ',' + menuItemDescription + ',' + menuItemCode + ',' + menuItemRanking);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddMenuItemRecord').text() == 'Save'){
						clearMenuItemValues();
					}
					getMenuItem();
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

function getMenuItem() {
    //alert('am here');
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getMenuItem'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		var cls = 'selClsMenuItem';
		var tbl = '<table class="table table-bordered datatable" id="tblMenuItem"> <thead> ' +
		'<tr> <th style="width: 5%;"><input type="checkbox" value="" id="chkAllMenuItemType" onchange="checkAll(this,\'selClsMenuItem\'); countMenuItemCheckedBox();" /></th> ' +
		' <th><strong>Menu Name</strong> <th><strong>Menu Item Name</strong> <th><strong>Menu Item Description</strong> <th><strong>Menu Item Code</strong></th> <th><strong>MenuItem Ranking</strong></th><th style="width: 7%; text-align: center;"><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyMenuItem"> ';
        $('#divMenuItemTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addMenuItem(this.menuItemID, this.menuName, this.menuItemName, this.menuItemDescription, this.menuItemCode, this.menuItemRanking, true);
        });
		tbl += '</tbody></table>'; 
		$("#divMenuItemTBL").html(tbl); 
		$('#tblMenuItem').dataTable();
	}
});
	return false;
}

function editMenuItem(id) {
    //alert('aaaaaa');
    menuItemID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'getMenuItemByID', menuItemID: menuItemID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#menuItemID').val(this.menuItemID);
            $('#menuMenuID').val(this.menuID);
			$('#menuItemName').val(this.menuItemName);
            $('#menuItemDescription').val(this.menuItemDescription);
            $('#menuItemCode').val(this.menuItemCode);
            $('#menuItemRanking').val(this.menuItemRanking);
		});
		
		$('#btnAddMenuItemRecord').text('Update');
		
		$('#btnAddMenuItem').click();
	}
});
    
    
}

function _addMenuItem(id, menuName, menuItemName, menuItemDescription, menuItemCode, menuItemRanking, isReturn) {
    var tr = '<tr id="trMenuItem_' + id + '"><td  style="width: 5%;"><input type="checkbox" value="' + id + '" class="selClsMenuItem" onclick="countMenuItemCheckedBox();" /></td><td>' + menuName + '</td> <td>' + menuItemName + '</td> <td>' + menuItemDescription + '</td> <td>' + menuItemCode + '</td> <td>' + menuItemRanking + '</td><td style="width: 7%; text-align: center;"> <a  title="Click to edit" href=\'javascript:editMenuItem(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblMenuItem > tbody:first").append(tr);
}

function countMenuItemCheckedBox() {
    if ($('#tbodyMenuItem input:checkbox:checked').length > 0) $('#btnDelMultiMenuItem').fadeIn();
    else { $('#chkAllMenuItem').checked = false; 
	$('#btnDelMultiMenuItem').fadeOut(); }
}

function deleteSelectedMenuItem() {
    if ($('#tbodyMenuItem input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyMenuItem input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsMenuItem').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
	
	$.ajax({
	type: "POST",
	url: 'includes/functioncall.php',
	dataType: 'json',
	data: {functionname: 'delMenuItem', menuItemID: sel_IDs},
	success: function(obj,textstatus){
					
					if (obj.isSuccess == 1) {
						alertMsg(obj.msg,'success');
						//alertMsgGritter('Success',obj.msg,'success')
						$('#btnDelMultiMenuItem').fadeOut();
						getMenuItem();
					}
					else {
						alertMsg(obj.msg,'danger');
						//alertMsgGritter('Error',obj.msg,'danger')
					}
				}
	});
	
	return false;
}

 function clearMenuItemValues() {

    $('#menuItemID').val('0');
    $('#menuID').val('0');
	$('#menuItemName').val('');
    $('#menuItemDescription').val('');
    $('#menuItemCode').val('');
    $('#menuItemRanking').val('');
	$('#btnAddMenuItemRecord').text('Save');

}