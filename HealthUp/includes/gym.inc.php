<?php

session_start();

if (isset($_POST['register'])) {
    
    include_once 'dbh.inc.php';
	
    $SIN = mysqli_real_escape_string($conn, $_POST['SIN']);
    $wage = mysqli_real_escape_string($conn, $_POST['wage']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$schedule = mysqli_real_escape_string($conn, $_POST['schedule']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    //Error handlers
    //Check for empty fields
	if (empty($SIN) || empty($wage)|| empty($phone) || empty($schedule) || empty($username)){
        header("Location: ../gym.php?employeereg=empty");
        exit();
    }
	else{
		$sql = "SELECT ID FROM user WHERE Username = '$username'";
		$result = mysqli_query($conn, $sql) or die($sql);
        $resultCheck = mysqli_num_rows($result);
		
		if($resultCheck != 1){
			header("Location: ../gym.php?employeereg=NoUserFound");
			exit();
		}
		$row = mysqli_fetch_assoc($result);
		$employee_id = $row['ID'];
		
		////
		$sid = $_SESSION['u_id'];
		$sql = "SELECT * from employee WHERE UserId = '$sid';";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$address = $row['Address'];
		
		$sql = "SELECT * FROM gym WHERE location = '$address'";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
		if($resultCheck != 1){
			header("Location: ../gym.php?employeereg=NoLocationFound=$address");
			exit();
		}
		
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
		$SIN = mysqli_real_escape_string($conn, $_POST['sin2']);
		//Error handlers
		//Check for empty fields
	
		
		if (empty($name) || empty($locationOld) || empty($locationNew)){
			header("Location: ../gym.php?gym=empty");
			exit();
		} 
		else {
			
			$sql = "SELECT * FROM owns WHERE (location = '$locationOld' AND sin = '$SIN')";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck == 1){
				$sql = "UPDATE gym SET name = '$name', location = '$locationNew' WHERE location = '$locationOld';"; 
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
