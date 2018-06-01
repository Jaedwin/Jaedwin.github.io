<?php

session_start();

if (isset($_POST['register'])) {
    
    include_once 'dbh.inc.php';
	
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);
    
    //Error handlers
    //Check for empty fields
	
	if (empty($phone) || empty($address) || empty($availability)){
        header("Location: ../client.php?clientreg=empty");
        exit();
    } 
	else {
		$sid = $_SESSION['u_id'];
		$sql = "SELECT * FROM client WHERE userid = $sid";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
                
        if($resultCheck > 0){
			header("Location: ../client.php?clientreg=alreadyregistered");
			exit();
		} else {
				//Insert the user into the database
				$sql = "INSERT INTO client(userid, phone, address, availability) VALUES ('$sid', '$phone','$address','$availability');"; 
				mysqli_query($conn, $sql);
				header("Location: ../client.php?clientreg=success");
				exit();
			}
		}
	}
else if (isset($_POST['update'])) {
    
	include_once 'dbh.inc.php';
	
    $phone = mysqli_real_escape_string($conn, $_POST['uphone']);
    $address = mysqli_real_escape_string($conn, $_POST['uaddress']);
    $availability = mysqli_real_escape_string($conn, $_POST['uavailability']);
    
    //Error handlers
    //Check for empty fields
	
	if (empty($phone) || empty($address) || empty($availability)){
        header("Location: ../client.php?clientupdate=empty");
        exit();
    } 
	else {
		$sid = $_SESSION['u_id'];
		
		//Insert the user into the database
		$sql = "UPDATE client SET phone = '$phone', address = '$address', availability = '$availability' WHERE userid = '$sid';"; 
		mysqli_query($conn, $sql);
		header("Location: ../client.php?clientupdate=success");
		exit();
			
		}
}
else if(isset($_POST['addgym'])){
	
	include_once 'dbh.inc.php';
	$loc = $_POST['gym'];
	$sid = $_SESSION['u_id'];
	
	$sql = "SELECT * FROM client WHERE (userid ='$sid');";
	$result = mysqli_query($conn, $sql);
	
	$row = mysqli_fetch_assoc($result);
	$id = $row['ID'];
	//check if already member
	$sql = "SELECT * from canbememberof where memberid = '$id' and location = '$loc';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck != 0){
		header("Location: ../client.php?addgym=alreadymember");
		exit();
	}
	//
	$sql = "INSERT INTO canbememberof(location, memberid) VALUES('$loc','$id');";
	mysqli_query($conn, $sql);
	header("Location: ../client.php?addgym=success");
	exit();
}
else if(isset($_POST['removegym'])){
	
	include_once 'dbh.inc.php';
	$loc = $_POST['gym_remove'];
	$sid = $_SESSION['u_id'];
	
	$sql = "SELECT * FROM client WHERE (userid ='$sid');";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	$row = mysqli_fetch_assoc($result);
	$id = $row['ID'];
	
	$sql = "DELETE FROM canbememberof WHERE memberid = '$id' and location = '$loc';";
	mysqli_query($conn, $sql);
	
	header("Location: ../client.php?removegym=success");
	exit();
}
else if(isset($_POST['addcoach'])){
	
	include_once 'dbh.inc.php';
	$sin = $_POST['coach_add'];
	$sid = $_SESSION['u_id'];
	
	$sql = "SELECT * FROM client WHERE (userid ='$sid');";
	$result = mysqli_query($conn, $sql);
	
	
	$row = mysqli_fetch_assoc($result);
	$id = $row['ID'];
	
	$sql = "SELECT * from coaches where SIN = '$sin' and memberid = '$id';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		header("Location: ../client.php?addcoach=already_added");
		exit();
	}
	$sql = "INSERT INTO coaches(SIN, memberid) VALUES('$sin','$id')";
	mysqli_query($conn, $sql);
	
	header("Location: ../client.php?addcoach=success=$sin=$id");
	exit();
}
else if(isset($_POST['removecoach'])){
	
	include_once 'dbh.inc.php';
	$sin = $_POST['coach_remove'];
	$sid = $_SESSION['u_id'];
	
	$sql = "SELECT * FROM client WHERE (userid ='$sid');";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$id = $row['ID'];
	
	$sql = "DELETE FROM coaches WHERE memberid = '$id' and SIN = '$sin';";
	mysqli_query($conn, $sql);
	
	header("Location: ../client.php?removecoach=success");
	exit();
}
else {
    header("Location: ../client.php");
    exit();
}