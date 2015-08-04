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
	
	/*State*/
	if ($functionname == 'setState'){
		$stateID = $_POST["stateID"];
		$stateName = $_POST["stateName"];
		$stateCode = $_POST["stateCode"];
		
		setState($stateID, $stateName, $stateCode, $mysqli);
	}
	if ($functionname == 'getState'){	
		getState($mysqli);
	}
	if ($functionname == 'getStateByID'){
		$stateID = $_POST["stateID"];		
		getStateByID($stateID, $mysqli);
	}
	if ($functionname == 'delState'){
		$stateID = $_POST["stateID"];		
		delState($stateID, $mysqli);
	}
	
	/*City*/
	if ($functionname == 'setCity'){
		$cityID = $_POST["cityID"];
		$cityName = $_POST["cityName"];
		$cityCode = $_POST["cityCode"];
		$cityStateID = $_POST["cityStateID"];
		
		setCity($cityID, $cityName, $cityCode, $cityStateID, $mysqli);
	}
	if ($functionname == 'getCity'){	
		getCity($mysqli);
	}
	if ($functionname == 'getCityByID'){
		$cityID = $_POST["cityID"];		
		getCityByID($cityID, $mysqli);
	}
	if ($functionname == 'delCity'){
		$cityID = $_POST["cityID"];		
		delCity($cityID, $mysqli);
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
	
	$ids = explode(',',$cargoTypeID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM cargotype WHERE cargoTypeID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
	
	$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
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

/* State */

function setState($stateID, $stateName, $stateCode, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($stateID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO State (stateName, stateCode, createdByID, modifiedBy) VALUES(?, ?, ?, ?)")) {
        $stmt->bind_param('ssii',$stateName, $stateCode, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE State SET stateName = ?, stateCode = ?, modifiedBy = ? WHERE stateID = ?")) {
        $stmt->bind_param('ssii',$stateName, $stateCode, $user_id, $stateID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getState($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT stateID, stateName, stateCode FROM state");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getStateByID($stateID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT stateID, stateName, stateCode FROM state WHERE stateID = $stateID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delState($stateID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$stateID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM state WHERE stateID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* City */

function setCity($cityID, $cityName, $cityCode, $cityStateID, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($cityID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO City (cityName, cityCode, stateID, createdByID, modifiedBy) VALUES(?, ?, ?, ?, ?)")) {
        $stmt->bind_param('ssii',$cityName, $cityCode, $cityStateID, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE City SET cityName = ?, cityCode = ?, stateID = ?, modifiedBy = ? WHERE cityID = ?")) {
        $stmt->bind_param('ssii',$cityName, $cityCode, $cityStateID, $user_id, $cityID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getCity($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.cityID, T0.cityName, T0.cityCode, T0.stateID, T1.stateName FROM city T0 INNER JOIN state T1 ON T0.stateID = T1.stateID");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getCityByID($cityID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.cityID, T0.cityName, T0.cityCode, T0.stateID, T1.stateName FROM city T0 
									INNER JOIN state T1 ON T0.stateID = T1.stateID WHERE cityID = $cityID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delCity($cityID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$cityID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM city WHERE cityID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}


?>
