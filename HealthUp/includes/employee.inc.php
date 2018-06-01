<?php

session_start();
/*
if (isset($_POST['register'])) {
    
    include_once 'dbh.inc.php';
	
    $SIN = mysqli_real_escape_string($conn, $_POST['SIN']);
    $wage = mysqli_real_escape_string($conn, $_POST['wage']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$schedule = mysqli_real_escape_string($conn, $_POST['schedule']);
    
    //Error handlers
    //Check for empty fields
	if (empty($SIN) || empty($wage) || empty($address) || empty($phone) || empty($schedule)){
        header("Location: ../employee.php?employeereg=empty");
        exit();
    }
	else{
		$sql = "SELECT * FROM gym WHERE location = '$address'";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
		if($resultCheck != 1){
			header("Location: ../employee.php?employeereg=NoLocationFound");
			exit();
		}
		////////////
		$sid = $_SESSION['u_id'];
		$sql = "SELECT * FROM employee WHERE userid = '$sid'";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
                
        if($resultCheck > 0){
			header("Location: ../employee.php?employeereg=alreadyregistered");
			exit();
		} else {
				//Insert the user into the database
				$sql = "INSERT INTO employee(sin, userid, wage, address, phone, schedule) VALUES ('$SIN', '$sid', '$wage','$address','$phone', '$schedule');"; 
				mysqli_query($conn, $sql);
				header("Location: ../employee.php?employeereg=success");
				exit();
			}
		}
	}
else*/ 
if (isset($_POST['update'])) {
    
    include_once 'dbh.inc.php';
	
	$phone = mysqli_real_escape_string($conn, $_POST['uphone']);
	$schedule = mysqli_real_escape_string($conn, $_POST['uschedule']);
    
    //Error handlers
    //Check for empty fields
	
	if (empty($phone) || empty($schedule)){
        header("Location: ../employee.php?employeeupdate=empty");
        exit();
    } 
	else 
	{
		$sid = $_SESSION['u_id'];
			
		//Insert the user into the database
		$sql = "UPDATE employee SET phone = '$phone', schedule = '$schedule' WHERE userid = '$sid';"; 
		
		mysqli_query($conn, $sql);
		header("Location: ../employee.php?employeeupdate=success");
		exit();
	}
}
else if(isset($_POST['addclient'])){
	
	include_once 'dbh.inc.php';
	
	$id = $_POST['client_add'];
	$sid = $_SESSION['u_id'];
	
	$sql = "SELECT * FROM employee WHERE (userid ='$sid');";
	$result = mysqli_query($conn, $sql);
	
	$row = mysqli_fetch_assoc($result);
	$sin = $row['SIN'];
	
	$sql = "SELECT * from coaches where SIN = '$sin' and memberid = '$id';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		header("Location: ../employee.php?addclient=already_added");
		exit();
	}
	$sql = "INSERT INTO coaches(SIN, memberid) VALUES('$sin','$id')";
	mysqli_query($conn, $sql);
	
	header("Location: ../employee.php?addclient=success=$sin=$id");
	exit();
}
else if(isset($_POST['removeclient'])){
	
	include_once 'dbh.inc.php';
	$id = $_POST['client_remove'];
	$sid = $_SESSION['u_id'];
	
	$sql = "SELECT * FROM employee WHERE (userid ='$sid');";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sin = $row['SIN'];
	
	$sql = "DELETE FROM coaches WHERE memberid = '$id' and SIN = '$sin';";
	mysqli_query($conn, $sql);
	
	header("Location: ../employee.php?removeclient=success=$sin=$id");
	exit();
}
else {
    header("Location: ../employee.php");
    exit();
}