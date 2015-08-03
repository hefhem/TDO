<?php

//header('Content-Type: application/json');
include_once 'db_connect.php';   // As functions.php is not included
include_once 'functions.php';
	sec_session_start();
	
	if (login_check($mysqli) == false) {
		exit();
	}
	//$user_id = 	$_SESSION['user_id'];
	
	$functionname = $_POST["functionname"];
	
	/*Cargotype*/
	if ($functionname == 'setCargoType'){
		$cargoTypeID = $_POST["cargoTypeID"];
		$cargoTypeName = $_POST["cargoTypeName"];
		
		setCargoType($cargoTypeID, $cargoTypeName, $mysqli);
	}
	if ($functionname == 'getCargoType'){	
		getCargoType($mysqli);
	}
	if ($functionname == 'getCargoTypeByID'){
		$cargoTypeID = $_POST["cargoTypeID"];		
		getCargoTypeByID($cargoTypeID, $mysqli);
	}
	if ($functionname == 'delCargoType'){
		$cargoTypeID = $_POST["cargoTypeID"];		
		delCargoType($cargoTypeID, $mysqli);
	}
	
	/*Region*/
	if ($functionname == 'setRegion'){
		$regionID = $_POST["regionID"];
		$regionName = $_POST["regionName"];
		
		setRegion($regionID, $regionName, $mysqli);
	}
	if ($functionname == 'getRegion'){	
		getRegion($mysqli);
	}
	if ($functionname == 'getRegionByID'){
		$regionID = $_POST["regionID"];		
		getRegionByID($regionID, $mysqli);
	}
	if ($functionname == 'delRegion'){
		$regionID = $_POST["regionID"];		
		delRegion($regionID, $mysqli);
	}

function setCargoType($cargoTypeID, $cargoTypeName, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$response = 1;
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}

	if ($cargoTypeID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO CargoType (cargoTypeName, createdByID, modifiedBy) VALUES(?, ?, ?)")) {
        $stmt->bind_param('sss',$cargoTypeName, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE CargoType SET cargoTypeName = ?, modifiedBy = ? WHERE cargoTypeID = ?")) {
        $stmt->bind_param('sii',$cargoTypeName, $user_id, $cargoTypeID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getCargoType($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("CALL getCargoType");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	/*if ($stmt = $mysqli->prepare("SELECT cargoTypeID, cargoTypeName, dateCreated, createdByID, dateModified, modifiedBy FROM cargotype")) {
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
		//$result = $stmt->fetch_all();
	
	}*/
    //echo($response);
	echo json_encode($rows);
}

function getCargoTypeByID($cargoTypeID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT cargoTypeID, cargoTypeName FROM cargotype WHERE cargoTypeID = $cargoTypeID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	/*if ($stmt = $mysqli->prepare("SELECT cargoTypeID, cargoTypeName, dateCreated, createdByID, dateModified, modifiedBy FROM cargotype")) {
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
		//$result = $stmt->fetch_all();
	
	}*/
    //echo($response);
	echo json_encode($rows);
}

function delCargoType($cargoTypeID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("DELETE FROM cargotype WHERE cargoTypeID = $cargoTypeID ");
		
		if ($result){
			$response = array('isSuccess'=>'1', 'msg'=>'Record(s) deleted successfully.');
		} else {
			$response = array('isSuccess'=>'0', 'msg'=>'Failed to delete record(s).');
		}
		
	echo json_encode($response);
}

/* region */

function setRegion($regionID, $regionName, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}

	if ($regionID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO Region (regionName, createdByID, modifiedBy) VALUES(?, ?, ?)")) {
        $stmt->bind_param('sii',$regionName, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE Region SET regionName = ?, modifiedBy = ? WHERE regionID = ?")) {
        $stmt->bind_param('sii',$regionName, $user_id, $regionID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getRegion($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("CALL getRegion");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getRegionByID($regionID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT regionID, regionName FROM region WHERE regionID = $regionID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delRegion($regionID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$regionID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM region WHERE regionID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}


?>
