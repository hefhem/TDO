$(document).ready(function(){
	$('#btnDelMultiCity').fadeOut();
	getCity();
	//getListState();
});

function setCity(){

//alert('called');

cityID = $('#cityID').val();
cityName = $.trim($('#cityName').val());
cityCode = $.trim($('#cityCode').val());
cityStateID = $.trim($('#cityStateID').val());

if (cityName == '') {
	alertMsg('City name is required', 'warning');
	$('#cityName').focus();
	return;
}
if (cityCode == '') {
	alertMsg('City code is required', 'warning');
	$('#cityCode').focus();
	return;
}
if (cityStateID == '0' || cityStateID == '') {
	alertMsg('Please select a state', 'warning');
	$('#cityStateID').focus();
	return;
}

//alert( cityID + ',' + cityName + ',' + cityCode);

$.ajax({
type: "POST",
url: 'includes/db_connect_functioncall.php',
dataType: 'json',
data: {functionname: 'setCity', cityID: cityID, cityName: cityName, cityCode: cityCode, cityStateID: cityStateID},
success: function(obj,textstatus){
				//alert('I got here');
				//console.log(obj);
				if (obj.isSuccess == 1) {
					alertMsg(obj.msg,'success');
					//alertMsgGritter('Success',obj.msg,'success')
					if ($('#btnAddCityRecord').text() == 'Save'){
						clearCityValues();
					}
					getCity();
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

function getCity() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getCity'},
	success: function(obj,textstatus){
				
				//console.log(obj);
				
		var tbl = '<table class="table table-bordered datatable" id="tblCity"> <thead> ' +
		'<tr> <th style="width: 25px;"><input type="checkbox" value="" id="chkAllCityType" onchange="checkAll(this,\'selClsCity\'); countCityCheckedBox();" /></th> ' +
		' <th><strong>City Name</strong></th><th><strong>City Code</strong></th><th><strong>State</strong></th><th><strong>Edit</strong></th> </tr>  </thead>  <tbody id="tbodyCity"> ';
		$('#divCityTBL').html('');
        $('#divCityTBL').html(IMG_LOAD);

        $.each(obj, function () {
            tbl += _addCity(this.cityID, this.cityName, this.cityCode, this.stateName, true);
        });
		tbl += '</tbody></table>'; 
		$("#divCityTBL").html(tbl); 
		$('#tblCity').dataTable();
	}
});
	//alert('2');
	return false;
}

function editCity(id) {
    
    cityID = id;
	
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getCityByID', cityID: cityID},
	success: function(obj,textstatus){
				//console.log(obj);
		$.each(obj, function () {
			$('#cityID').val(this.cityID);
			$('#cityName').val(this.cityName);
			$('#cityCode').val(this.cityCode);
			$('#cityStateID').val(this.stateID);
		});
		
		$('#btnAddCityRecord').text('Update');
		
		$('#btnAddCity').click();
	}
});
    
    
}

function _addCity(id, cityName, cityCode, stateName, isReturn) {
    var tr = '<tr id="trCity_' + id + '"><td><input type="checkbox" value="' + id + '" class="selClsCity" onclick="countCityCheckedBox();" /></td><td>' + cityName +
                '</td><td>' + cityCode +
                '</td><td>' + stateName +
                '</td><td> <a  title="Click to edit" href=\'javascript:editCity(' + id + ');\' class="btn btn-default btn-xs"><i class="fa fa-pencil fa-1g"></i> </a> &nbsp; ' +
                '</td>  </tr>';
    if (isReturn) return tr; else $("#tblCity > tbody:first").append(tr);
}

function countCityCheckedBox() {
    if ($('#tbodyCity input:checkbox:checked').length > 0) $('#btnDelMultiCity').fadeIn();
    else { $('#chkAllCity').checked = false; 
	$('#btnDelMultiCity').fadeOut(); }
}

function deleteSelectedCity() {
    if ($('#tbodyCity input:checkbox:checked').length < 1) { alertWarning('Validate', 'please check the item to delete...'); return; }
    if (!confirm('Do you want to delete ' + $('#tbodyCity input:checkbox:checked').length + ' record(s)')) return;

    var sel_IDs = "";
	$('.selClsCity').each(function () { 
		if (this.checked) { 
			sel_IDs += $(this).val() + ","; 
		} 
	});
					
		$.ajax({
		type: "POST",
		url: 'includes/db_connect_functioncall.php',
		dataType: 'json',
		data: {functionname: 'delCity', cityID: sel_IDs},
		success: function(obj,textstatus){
						
						if (obj.isSuccess == 1) {
							alertMsg(obj.msg,'success');
							//alertMsgGritter('Success',obj.msg,'success')
							$('#btnDelMultiCity').fadeOut();
							getCity();
						}
						else {
							alertMsg(obj.msg,'error');
							//alertMsgGritter('Error',obj.msg,'error')
						}
					}
		});
	
	
	return false;
}
 
 function clearCityValues() {

    $('#cityID').val('0');
	$('#cityName').val('');
	$('#cityCode').val('');
	$('#cityStateID').val('0');
	$('#btnAddCityRecord').text('Save');
		
}

function getListState() {
	//alert('1');
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getState'},
	success: function(obj,textstatus){
				
				//console.log(obj);
		$('.lstState').html('');
        $('.lstState').append('<option value="' + 0 + '">' + 'Select a state: ' + '</option>');
        $.each(obj, function () {
            $('.lstState').append('<option value="' + this.stateID + '">' + this.stateName + '</option>');
        });
	}
});
	//alert('2');
	return false;
}