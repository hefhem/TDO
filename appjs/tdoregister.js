$(document).ready(function(){

});


function getCityByStateID() {
	//alert('1');
	$('#destinationID').html('');
    $('#destinationID').append('<option value="' + 0 + '">' + 'Select a destination: ' + '</option>');
	
	stateID = $('#stateID').val();
	$.ajax({
	type: "POST",
	url: 'includes/db_connect_functioncall.php',
	dataType: 'json',
	data: {functionname: 'getCityByStateID', stateID: stateID},
	success: function(obj,textstatus){
				
				//console.log(obj);
		$('#destinationID').html('');
        $('#destinationID').append('<option value="' + 0 + '">' + 'Select a destination: ' + '</option>');
        $.each(obj, function () {
            $('#destinationID').append('<option value="' + this.cityID + '">' + this.cityName + '</option>');
        });
	}
});
	//alert('2');
	return false;
}