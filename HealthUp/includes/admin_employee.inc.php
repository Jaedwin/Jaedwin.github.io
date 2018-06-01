<?php

session_start();

if (isset($_POST['submit'])) {
    
    include_once 'dbh.inc.php';
    
    $SIN = mysqli_real_escape_string($conn, $_POST['SIN']);
    $Location = mysqli_real_escape_string($conn, $_POST['Location']);
	$Username = mysqli_real_escape_string($conn, $_POST['Username']);
    //Error handlers
    //Check for empty fields
    if (empty($SIN) || empty($Location) || empty($Username)){
        header("Location: ../admin.php?submit=emptyfields");
        exit();
    } else{
		$sql = "SELECT * FROM user WHERE Username = '$Username';";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if($count != 1){
			header("Location: ../admin.php?submit=$Username-failure-No-User-Found=$count");
			exit();
		}
		$row = mysqli_fetch_assoc($result);
		$UID = $row['ID'];
		$sql = "SELECT * FROM gym WHERE Location = '$Location';";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) != 1){
			header("Location: ../admin.php?submit=failure-No-Gym-Found");
			exit();
		}
		$sql = "INSERT INTO employee(SIN, UserId, Wage, Address, Phone, Schedule) VALUES('$SIN', $UID, 0, '$Location', '--', '--');";
		mysqli_query($conn,$sql) or die("Bad Query: $sql");
		header("Location: ../admin.php?submit=success");
        exit();
		}        
    
} else {
    header("Location: ../signup.php");
    exit();
}