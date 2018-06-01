<?php

session_start();

/*
if (isset($_POST['add'])) {
	
	include_once 'dbh.inc.php';
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location1']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
	$totalmembers = mysqli_real_escape_string($conn, $_POST['totalmembers']);
	$livecount = mysqli_real_escape_string($conn, $_POST['livecount']);
	$capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
	
    //Error handlers
  
	//check if this is an employee
	//to-do
	$sid = $_SESSION['u_id'];
	$sql = "SELECT * FROM employee WHERE (userid = $sid);";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
			
	if($resultCheck != 1){
		header("Location: ../gym.php?gym=badcredentials$resultCheck");
		exit();
	}
	//Check for empty fields
	
	if (empty($name) || empty($location) || empty($status) || empty($totalmembers) || empty($livecount) || empty($capacity)){
        header("Location: ../gym.php?gym=empty");
        exit();
    } 
	else {
		
		$sql = "SELECT location FROM gym WHERE location = $location";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
                
        if($resultCheck > 0){
			header("Location: ../gym.php?gym=alreadyregistered");
			exit();
		} else {
				//Insert the user into the database
				$sid = $_SESSION['u_id'];
				$sql = "SELECT SIN FROM employee WHERE userid = '$sid';";
				
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$sin = $row['SIN'];
				
				$sql = "INSERT INTO gym(name, location, status, totalmembers, livecount, capacity) VALUES ('$name', '$location','$status','$totalmembers', '$livecount', '$capacity');"; 
				mysqli_query($conn, $sql);
				$sql = "INSERT INTO owns(Location, SIN) VALUES ('$location', '$sin');"; 
				mysqli_query($conn, $sql);
				
				header("Location: ../gym.php?gym=success");
				exit();
			}
		}
	}
else */
if (isset($_POST['register'])) {
    
    include_once 'dbh.inc.php';
	
    $SIN = mysqli_real_escape_string($conn, $_POST['SIN']);
    $wage = mysqli_real_escape_string($conn, $_POST['wage']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$schedule = mysqli_real_escape_string($conn, $_POST['schedule']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    //Error handlers
    //Check for empty fields
	if (empty($SIN) || empty($wage) || empty($phone) || empty($schedule) || empty($username)){
        header("Location: ../gym.php?employeereg=empty");
        exit();
    }
	else{
		$sid = $_SESSION['u_id'];
		$sql = "SELECT address from employee where userid = '$sid';";
		$result = mysqli_query($conn, $sql) or die($sql);
        $row = mysqli_fetch_assoc($result);
		$address = $row['address'];
		
		$sql = "SELECT ID FROM user WHERE Username = '$username'";
		$result = mysqli_query($conn, $sql) or die($sql);
        $resultCheck = mysqli_num_rows($result);
		
		if($resultCheck != 1){
			header("Location: ../gym.php?employeereg=NoUserFound");
			exit();
		}
		$row = mysqli_fetch_assoc($result);
		$employee_id = $row['ID'];
		
		$sql = "SELECT * FROM gym WHERE location = '$address'";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
		if($resultCheck != 1){
			header("Location: ../gym.php?employeereg=NoLocationFound");
			exit();
		}
		////////////
		
		$sql = "SELECT * FROM employee WHERE UserId = '$employee_id'";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
                
        if($resultCheck > 0){
			header("Location: ../gym.php?employeereg=alreadyregistered");
			exit();
		} else {
				//Insert the user into the database
				$sql = "INSERT INTO employee(sin, userid, wage, address, phone, schedule) VALUES ('$SIN', '$employee_id', '$wage','$address','$phone', '$schedule');"; 
				mysqli_query($conn, $sql);
				header("Location: ../gym.php?employeereg=success");
				exit();
			}
		}
	}
else
	if (isset($_POST['remove'])) {
		include_once 'dbh.inc.php';
		
		$location = mysqli_real_escape_string($conn, $_POST['location2']);
		$SIN = mysqli_real_escape_string($conn, $_POST['sin']);
		
		if (empty($location) || empty($SIN)){
			header("Location: ../gym.php?gym=empty");
			exit();
		}	 
		else {
			$sql = "SELECT * FROM owns WHERE (location = '$location' AND sin = '$SIN');";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck == 1){
				
				$sql = "DELETE FROM gym WHERE location = '$location'";
				mysqli_query($conn, $sql);
				header("Location: ../gym.php?gym=success");
			}
			else{
				header("Location: ../gym.php?gym=badcredentials=$location=$SIN=$result");
				exit();
			}
		}
	}
	else if (isset($_POST['update'])) {
	
		include_once 'dbh.inc.php';
		
		$name = mysqli_real_escape_string($conn, $_POST['name2']);
		$locationOld = mysqli_real_escape_string($conn, $_POST['location3']);
		$locationNew = mysqli_real_escape_string($conn, $_POST['location4']);
		$status = mysqli_real_escape_string($conn, $_POST['status2']);
		$totalmembers = mysqli_real_escape_string($conn, $_POST['totalmembers2']);
		$livecount = mysqli_real_escape_string($conn, $_POST['livecount2']);
		$capacity = mysqli_real_escape_string($conn, $_POST['capacity2']);
		$SIN = mysqli_real_escape_string($conn, $_POST['sin2']);
		//Error handlers
		//Check for empty fields
	
		
		if (empty($name) || empty($locationOld) || empty($locationNew) || empty($status) || empty($totalmembers) || empty($livecount) || empty($capacity)){
			header("Location: ../gym.php?gym=empty");
			exit();
		} 
		else {
			
			$sql = "SELECT * FROM owns WHERE (location = '$locationOld' AND sin = '$SIN')";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck == 1){
				$sql = "UPDATE gym SET name = '$name', location = '$locationNew', status = '$status', totalmembers = '$totalmembers', livecount = '$livecount', capacity = '$capacity' WHERE location = '$locationOld';"; 
				mysqli_query($conn, $sql);
				header("Location: ../gym.php?gym=success");
				exit();
			}
			else{
				header("Location: ../gym.php?gym=badcredentials=$resultCheck");
				exit();
			}
		}
	}
	else{
		header("Location: ../gym.php");
    exit();
}
