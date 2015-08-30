$(document).ready(function(){
	$('#btnDelMultiMenu').fadeOut();
	getMenu();
});

function setMenu(){

//alert('called');

menuID = $('#menuID').val();
menuName = $.trim($('#menuName').val());
menuDescription = $.trim($('#menuDescription').val());
menuCode = $.trim($('#menuCode').val());
menuRanking = $.trim($('#menuRanking').val());

if (menuName == '') {
	alertMsg('Menu name is required', 'warning');
	$('#menuName').focus();
	return;
}
    
if (menuDescription == '') {
	alertMsg('Menu description is required', 'warning');
	$('#menuDescription').focus();
	return;
}
    
if (menuCode == '') {
	alertMsg('Menu code is required', 'warning');
	$('#menuCode').focus();
	return;
}
    
if (menuRanking == '') {
	alertMsg('Menu ranking is required', 'warning');
	$('#menuRanking').focus();
	return;
}
    
if (menuRanking <= 0) {
	alertMsg('Menu ranking cannot be less than or equal zero', 'warning');
	$('#menuRanking').focus();
	return;
}

$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setMenu', menuID: menuID, menuName: menuName, menuDescription: menuDescription, menuCode: menuCode, menuRanking: menuRanking},
success: function(obj,textstatus){
    
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddMenuRecord').text() == 'Save'){
						clearMenuValues();
					}
					getMenu();
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

function getMenu() {
    //alert('am here');
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getMenu'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		var cls = 'selClsMenu';
		var tbl = '<table class="table table-bordered datatable" id="tblMenu"> <thead> ' +
		'<tr> <th style="width: 5%;"><input type="checkbox" value="" id="chkAllMenuType" onchange="checkAll(this,\'selClsMenu\'); countMenuCheckedBox();" /></th> ' +
		' <th><strong>Menu Name</strong> <th><strong>Menu Description</strong> <th><strong>Menu Code</strong></th> <th><strong>Menu Ranking</strong></th><th style="width: 7%; text-align: center;"><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyMenu"> ';
        $('#divMenuTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addMenu(this.menuID, this.menuName, this.menuDesc, this.menuCode, this.menuRanking, true);
        });
		tbl += '</tbody></table>'; 
		$("#divMenuTBL").html(tbl); 
		$('#tblMenu').dataTable();
	}
});
	return false;
}

function editMenu(id) {
    //alert('aaaaaa');
    menuID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getMenuByID', menuID: menuID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#menuID').val(this.menuID);
			$('#menuName').val(this.menuName);
            $('#menuDescription').val(this.menuDesc);
            $('#menuCode').val(this.menuCode);
            $('#menuRanking').val(this.menuRanking);
		});
		
		$('#btnAddMenuRecord').text('Update');
		
		$('#btnAddMenu').click();
	}
});
    
    
}

function _addMenu(id, menuName, menuDescription, menuCode, menuRanking, isReturn) {
    var tr = '<tr id="trMenu_' + id + '"><td  style="width: 5%;"><input type="checkbox" value="' + id + '" class="selClsMenu" onclick="countMenuCheckedBox();" /></td><td>' + menuName + '</td> <td>' + menuDescription + '</td> <td>' + menuCode + '</td> <td>' + menuRanking + '</td><td style="width: 7%; text-align: center;"> <a  title="Click to edit" href=\'javascript:editMenu(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblMenu > tbody:first").append(tr);
}

function countMenuCheckedBox() {
    if ($('#tbodyMenu input:checkbox:checked').length > 0) $('#btnDelMultiMenu').fadeIn();
    else { $('#chkAllMenu').checked = false; 
	$('#btnDelMultiMenu').fadeOut(); }
}

function deleteSelectedMenu() {
    if ($('#tbodyMenu input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyMenu input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsMenu').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'delMenu', menuID: sel_IDs},
	success: function(obj,textstatus){
					
					if (obj.isSuccess == 1) {
						alertMsg(obj.msg,'success');
						//alertMsgGritter('Success',obj.msg,'success')
						$('#btnDelMultiMenu').fadeOut();
						getMenu();
					}
					else {
						alertMsg(obj.msg,'error');
						//alertMsgGritter('Error',obj.msg,'error')
					}
				}
	});
	
	return false;
}

 function clearMenuValues() {

    $('#menuID').val('0');
	$('#menuName').val('');
    $('#menuDescription').val('');
    $('#menuCode').val('');
    $('#menuRanking').val('');
	$('#btnAddMenuRecord').text('Save');

}