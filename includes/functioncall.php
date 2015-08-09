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

	/*Trucktype*/
	if ($functionname == 'setTruckType'){
		$truckTypeID = $_POST["truckTypeID"];
		$truckTypeName = $_POST["truckTypeName"];
		
		setTruckType($truckTypeID, $truckTypeName, $mysqli);
	}
	if ($functionname == 'getTruckType'){	
		getTruckType($mysqli);
	}
	if ($functionname == 'getTruckTypeByID'){
		$truckTypeID = $_POST["truckTypeID"];		
		getTruckTypeByID($truckTypeID, $mysqli);
	}
	if ($functionname == 'delTruckType'){
		$truckTypeID = $_POST["truckTypeID"];		
		delTruckType($truckTypeID, $mysqli);
	}

    /*Driver*/
	if ($functionname == 'setDriver'){
        
        $driverID = $_POST["driverID"];
        $driverCode = $_POST["driverCode"];
        $driverFirstName = $_POST["driverFirstName"];
        $driverMiddleName = $_POST["driverMiddleName"];
        $driverLastName = $_POST["driverLastName"];
        
        setDriver($driverID, $driverCode, $driverFirstName, $driverMiddleName, $driverLastName, $mysqli);
	}
	if ($functionname == 'getDriver'){	
		getDriver($mysqli);
	}
	if ($functionname == 'getDriverByID'){
		$driverID = $_POST["driverID"];		
		getDriverByID($driverID, $mysqli);
	}
	if ($functionname == 'delDriver'){
		$driverID = $_POST["driverID"];		
		delDriver($driverID, $mysqli);
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
	
	/*Location*/
	if ($functionname == 'setLocation'){
		$locationID = $_POST["locationID"];
		$locationName = $_POST["locationName"];
		$locationRegionID = $_POST["locationRegionID"];
		
		setLocation($locationID, $locationName, $locationRegionID, $mysqli);
	}
	if ($functionname == 'getLocation'){	
		getLocation($mysqli);
	}
	if ($functionname == 'getLocationByID'){
		$locationID = $_POST["locationID"];		
		getLocationByID($locationID, $mysqli);
	}
	if ($functionname == 'delLocation'){
		$locationID = $_POST["locationID"];		
		delLocation($locationID, $mysqli);
	}
	
	/*Port*/
	if ($functionname == 'setPort'){
		$portID = $_POST["portID"];
		$portName = $_POST["portName"];
		$portLocationID = $_POST["portLocationID"];
		
		setPort($portID, $portName, $portLocationID, $mysqli);
	}
	if ($functionname == 'getPort'){	
		getPort($mysqli);
	}
	if ($functionname == 'getPortByID'){
		$portID = $_POST["portID"];		
		getPortByID($portID, $mysqli);
	}
	if ($functionname == 'delPort'){
		$portID = $_POST["portID"];		
		delPort($portID, $mysqli);
	}
	
	/*Terminal*/
	if ($functionname == 'setTerminal'){
		$terminalID = $_POST["terminalID"];
		$terminalName = $_POST["terminalName"];
		$terminalPortID = $_POST["terminalPortID"];
		
		setTerminal($terminalID, $terminalName, $terminalPortID, $mysqli);
	}
	if ($functionname == 'getTerminal'){	
		getTerminal($mysqli);
	}
	if ($functionname == 'getTerminalByID'){
		$terminalID = $_POST["terminalID"];		
		getTerminalByID($terminalID, $mysqli);
	}
	if ($functionname == 'delTerminal'){
		$terminalID = $_POST["terminalID"];		
		delTerminal($terminalID, $mysqli);
	}
	
	/*Truck*/
	if ($functionname == 'setTruck'){
		$truckID = $_POST["truckID"];
		$truckName = $_POST["truckName"];
		$regNumb = $_POST["regNumb"];
		$truckTruckTypeID = $_POST["truckTruckTypeID"];
		
		setTruck($truckID, $truckName, $regNumb, $truckTruckTypeID, $mysqli);
	}
	if ($functionname == 'getTruck'){	
		getTruck($mysqli);
	}
	if ($functionname == 'getTruckByID'){
		$truckID = $_POST["truckID"];		
		getTruckByID($truckID, $mysqli);
	}
	if ($functionname == 'delTruck'){
		$truckID = $_POST["truckID"];		
		delTruck($truckID, $mysqli);
	}

    /*User Group*/
	if ($functionname == 'setUserGroup'){
		$userGroupID = $_POST["userGroupID"];
		$userGroupName = $_POST["userGroupName"];
		$userGroupDescription = $_POST["userGroupDescription"];
		$userGroupCode = $_POST["userGroupCode"];
		
		setUserGroup($userGroupID, $userGroupName, $userGroupDescription, $userGroupCode, $mysqli);
	}
	if ($functionname == 'getUserGroup'){	
		getUserGroup($mysqli);
	}
	if ($functionname == 'getUserGroupByID'){
		$userGroupID = $_POST["userGroupID"];		
		getUserGroupByID($userGroupID, $mysqli);
	}
	if ($functionname == 'delUserGroup'){
		$userGroupID = $_POST["userGroupID"];		
		delUserGroup($userGroupID, $mysqli);
	}

    /*Menu*/
	if ($functionname == 'setMenu'){
		$menuID = $_POST["menuID"];
		$menuName = $_POST["menuName"];
		$menuDescription = $_POST["menuDescription"];
		$menuCode = $_POST["menuCode"];
        $menuRanking = $_POST["menuRanking"];
		
		setMenu($menuID, $menuName, $menuDescription, $menuCode, $menuRanking, $mysqli);
	}
	if ($functionname == 'getMenu'){	
		getMenu($mysqli);
	}
	if ($functionname == 'getMenuByID'){
		$menuID = $_POST["menuID"];		
		getMenuByID($menuID, $mysqli);
	}
	if ($functionname == 'delMenu'){
		$menuID = $_POST["menuID"];		
		delMenu($menuID, $mysqli);
	}

/*MenuItem Item*/
	if ($functionname == 'setMenuItem'){
		$menuItemID = $_POST["menuItemID"];
        $menuMenuID = $_POST["menuMenuID"];
		$menuItemName = $_POST["menuItemName"];
		$menuItemDescription = $_POST["menuItemDescription"];
		$menuItemCode = $_POST["menuItemCode"];
        $menuItemRanking = $_POST["menuItemRanking"];
		
		setMenuItem($menuItemID, $menuMenuID, $menuItemName, $menuItemDescription, $menuItemCode, $menuItemRanking, $mysqli);
	}
	if ($functionname == 'getMenuItem'){	
		getMenuItem($mysqli);
	}
	if ($functionname == 'getMenuItemByID'){
		$menuItemID = $_POST["menuItemID"];		
		getMenuItemByID($menuItemID, $mysqli);
	}
	if ($functionname == 'delMenuItem'){
		$menuItemID = $_POST["menuItemID"];		
		delMenuItem($menuItemID, $mysqli);
	}


/* Cargo Type*/

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

/* Truck Type*/

function setTruckType($truckTypeID, $truckTypeName, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$response = 1;
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}

	if ($truckTypeID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO TruckType (truckTypeName, createdByID, modifiedBy) VALUES(?, ?, ?)")) {
        $stmt->bind_param('sss',$truckTypeName, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE TruckType SET truckTypeName = ?, modifiedBy = ? WHERE truckTypeID = ?")) {
        $stmt->bind_param('sii',$truckTypeName, $user_id, $truckTypeID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getTruckType($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT truckTypeID, truckTypeName, dateCreated, createdByID, dateModified, modifiedBy FROM trucktype");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
    
    //echo($response);
	echo json_encode($rows);
}

function getTruckTypeByID($truckTypeID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT truckTypeID, truckTypeName FROM trucktype WHERE truckTypeID = $truckTypeID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	/*if ($stmt = $mysqli->prepare("SELECT truckTypeID, truckTypeName, dateCreated, createdByID, dateModified, modifiedBy FROM trucktype")) {
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
		//$result = $stmt->fetch_all();
	
	}*/
    //echo($response);
	echo json_encode($rows);
}

function delTruckType($truckTypeID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$truckTypeID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM trucktype WHERE truckTypeID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
	
	$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* Driver*/

function setDriver($driverID, $driverCode, $driverFirstName, $driverMiddleName, $driverLastName, $mysqli) {
	
    $response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$response = 1;
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}

	if ($driverID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO driver (driverCode, firstName, middleName, lastName, createdByID, modifiedBy) VALUES(?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('ssssii',$driverCode, $driverFirstName, $driverMiddleName, $driverLastName, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE Driver SET driverCode = ?, firstName = ?, middleName = ?, lastName = ?, modifiedBy = ? WHERE driverID = ?")) {
        $stmt->bind_param('ssssii',$driverCode, $driverFirstName, $driverMiddleName, $driverLastName, $user_id, $driverID);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getDriver($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT driverID, driverCode, firstName, middleName, lastName, dateCreated, createdByID, dateModified, modifiedBy FROM driver");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
    
    //echo($response);
	echo json_encode($rows);
}

function getDriverByID($driverID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT driverID, driverCode, firstName, middleName, lastName FROM driver WHERE driverID = $driverID");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
    
    //echo($response);
	echo json_encode($rows);
}

function delDriver($driverID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$driverID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM driver WHERE driverID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
	
	$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* Region */

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
        $stmt->bind_param('ssiii',$cityName, $cityCode, $cityStateID, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE City SET cityName = ?, cityCode = ?, stateID = ?, modifiedBy = ? WHERE cityID = ?")) {
        $stmt->bind_param('ssiii',$cityName, $cityCode, $cityStateID, $user_id, $cityID);
 
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

/* Location */

function setLocation($locationID, $locationName, $locationRegionID, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($locationID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO Location (locationName, regionID, createdByID, modifiedBy) VALUES(?, ?, ?, ?)")) {
        $stmt->bind_param('siii',$locationName, $locationRegionID, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE Location SET locationName = ?, regionID = ?, modifiedBy = ? WHERE locationID = ?")) {
        $stmt->bind_param('siii',$locationName, $locationRegionID, $user_id, $locationID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getLocation($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.locationID, T0.locationName, T0.regionID, T1.regionName FROM location T0 INNER JOIN region T1 ON T0.regionID = T1.regionID");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getLocationByID($locationID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.locationID, T0.locationName, T0.regionID, T1.regionName 
									FROM location T0 INNER JOIN region T1 ON T0.regionID = T1.regionID 
									WHERE locationID = $locationID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delLocation($locationID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$locationID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM location WHERE locationID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* Port */

function setPort($portID, $portName, $portLocationID, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($portID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO Port (portName, locationID, createdByID, modifiedBy) VALUES(?, ?, ?, ?)")) {
        $stmt->bind_param('siii',$portName, $portLocationID, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE Port SET portName = ?, locationID = ?, modifiedBy = ? WHERE portID = ?")) {
        $stmt->bind_param('siii',$portName, $portLocationID, $user_id, $portID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getPort($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.portID, T0.portName, T0.locationID, T1.locationName FROM port T0 INNER JOIN location T1 ON T0.locationID = T1.locationID");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getPortByID($portID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.portID, T0.portName, T0.locationID, T1.locationName 
									FROM port T0 INNER JOIN location T1 ON T0.locationID = T1.locationID 
									WHERE portID = $portID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delPort($portID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$portID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM port WHERE portID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* Terminal */

function setTerminal($terminalID, $terminalName, $terminalPortID, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($terminalID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO Terminal (terminalName, portID, createdByID, modifiedBy) VALUES(?, ?, ?, ?)")) {
        $stmt->bind_param('siii',$terminalName, $terminalPortID, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE Terminal SET terminalName = ?, portID = ?, modifiedBy = ? WHERE terminalID = ?")) {
        $stmt->bind_param('siii',$terminalName, $terminalPortID, $user_id, $terminalID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getTerminal($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.terminalID, T0.terminalName, T0.portID, T1.portName FROM terminal T0 INNER JOIN port T1 ON T0.portID = T1.portID");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getTerminalByID($terminalID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.terminalID, T0.terminalName, T0.portID, T1.portName 
									FROM terminal T0 INNER JOIN port T1 ON T0.portID = T1.portID 
									WHERE terminalID = $terminalID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delTerminal($terminalID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$terminalID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM terminal WHERE terminalID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* Truck */

function setTruck($truckID, $truckName, $regNumb, $truckTruckTypeID, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($truckID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO Truck (truckName, regNumb, truckTypeID, createdByID, modifiedBy) VALUES(?, ?, ?, ?, ?)")) {
        $stmt->bind_param('ssiii',$truckName, $regNumb, $truckTruckTypeID, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE Truck SET truckName = ?, regNumb = ?, truckTypeID = ?, modifiedBy = ? WHERE truckID = ?")) {
        $stmt->bind_param('ssiii',$truckName, $regNumb, $truckTruckTypeID, $user_id, $truckID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getTruck($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.truckID, T0.truckName, T0.regNumb, T0.truckTypeID, T1.truckTypeName FROM truck T0 INNER JOIN truckType T1 ON T0.truckTypeID = T1.truckTypeID");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getTruckByID($truckID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.truckID, T0.truckName, T0.regNumb, T0.truckTypeID, T1.truckTypeName 
									FROM truck T0 INNER JOIN truckType T1 ON T0.truckTypeID = T1.truckTypeID 
									WHERE truckID = $truckID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delTruck($truckID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$truckID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM truck WHERE truckID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* User Group */

function setUserGroup($userGroupID, $userGroupName, $userGroupDescription, $userGroupCode, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($userGroupID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO UserGroups (userGroupName, userGroupDescription, userGroupCode, createdByID, modifiedByID) VALUES(?, ?, ?, ?, ?)")) {
        $stmt->bind_param('sssii',$userGroupName, $userGroupDescription, $userGroupCode, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE UserGroups SET userGroupName = ?, userGroupDescription = ?, userGroupCode = ?, modifiedByID = ? WHERE userGroupID = ?")) {
        $stmt->bind_param('sssii',$userGroupName, $userGroupDescription, $userGroupCode, $user_id, $userGroupID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getUserGroup($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT userGroupID, userGroupName, userGroupDescription, userGroupCode, dateCreated, createdByID, dateModified, modifiedByID FROM UserGroups");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getUserGroupByID($userGroupID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT userGroupID, userGroupName, userGroupDescription, userGroupCode, dateCreated, createdByID, dateModified, modifiedByID FROM UserGroups WHERE userGroupID = $userGroupID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delUserGroup($userGroupID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$userGroupID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM UserGroups WHERE userGroupID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* Menu */

function setMenu($menuID, $menuName, $menuDescription, $menuCode, $menuRanking, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($menuID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO Menus (menuName, menuDesc, menuCode, menuRanking, createdByID, modifiedByID) VALUES(?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('sssiii',$menuName, $menuDescription, $menuCode, $menuRanking, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE Menus SET menuName = ?, menuDesc = ?, menuCode = ?, menuRanking = ?, modifiedByID = ? WHERE menuID = ?")) {
        $stmt->bind_param('sssiii',$menuName, $menuDescription, $menuCode, $menuRanking, $user_id, $menuID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getMenu($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT menuID, menuName, menuDesc, menuCode, menuRanking, dateCreated, createdByID, dateModified, modifiedByID FROM Menus");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getMenuByID($MenuID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT menuID, menuName, menuDesc, menuCode, menuRanking, dateCreated, createdByID, dateModified, modifiedByID FROM Menus WHERE menuID = $menuID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delMenu($MenuID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$MenuID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM Menus WHERE menuID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

/* Menu Item */

function setMenuItem($menuItemID, $menuMenuID, $menuItemName, $menuItemDescription, $menuItemCode, $menuItemRanking, $mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	
	if ($menuItemID == 0) {
		if ($stmt = $mysqli->prepare("INSERT INTO MenuItems (menuID, menuItemName, menuItemDescription, menuItemCode, menuItemRanking, createdByID, modifiedByID) VALUES(?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('isssiii',$menuMenuID, $menuItemName, $menuItemDescription, $menuItemCode, $menuItemRanking, $user_id, $user_id);
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record inserted successfully.');
			}
		}	
	} else {
		if ($stmt = $mysqli->prepare("UPDATE MenuItems SET menuID = ?, menuItemName = ?, menuItemDescription = ?, menuItemCode = ?, menuItemRanking = ?, modifiedByID = ? WHERE menuItemID = ?")) {
        $stmt->bind_param('isssiii',$menuMenuID, $menuItemName, $menuItemDescription, $menuItemCode, $menuItemRanking, $user_id, $menuItemID);
 
			// Execute the prepared query. 
			if ($stmt->execute()) {
				$response = array('isSuccess'=>'1', 'msg'=>'Record updated successfully.');
			}
		}	
		
	}
    //echo($response);
	echo json_encode($response);
}

function getMenuItem($mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.menuItemID, T1.menuName, T0.menuItemName, T0.menuItemDescription, T0.menuItemCode, T0.menuItemRanking, T0.dateCreated, T0.createdByID, T0.dateModified, T0.modifiedByID FROM MenuItems T0 INNER JOIN Menus T1 ON T1.menuID = T0.menuID ORDER BY T1.menuName ASC");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}

	echo json_encode($rows);
}

function getMenuItemByID($menuItemID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
		$result = $mysqli->query("SELECT T0.menuItemID, T1.menuID, T0.menuItemName, T0.menuItemDescription, T0.menuItemCode, T0.menuItemRanking, T0.dateCreated, T0.createdByID, T0.dateModified, T0.modifiedByID FROM MenuItems T0 INNER JOIN Menus T1 ON T1.menuID = T0.menuID WHERE T0.menuItemID = $menuItemID ");

		//use mysqli->affected_rows
		for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
			$rows[] = $result->fetch_assoc();
		}
	
    
	echo json_encode($rows);
}

function delMenuItem($menuItemID,$mysqli) {
	
	$response = array();
	$user_id = 	$_SESSION['user_id'];
	
	$ids = explode(',',$menuItemID);
	
	
	if (!$mysqli){

		$response = array('isSuccess'=>'0', 'msg'=>'Error connecting to database: '.$mysqli->connect_error);
		return json_encode($response);
		exit();
	}
	$msg = '';
	$flag = 0;
	foreach ($ids as $id) {
		$result = $mysqli->query("DELETE FROM MenuItems WHERE menuItemID = $id ");
		if ($result){
			$msg .= 'Record(s) deleted successfully.,';
		}
	}
		$response = array('isSuccess'=>'1', 'msg'=>$msg); 
		
	echo json_encode($response);
}

?>
