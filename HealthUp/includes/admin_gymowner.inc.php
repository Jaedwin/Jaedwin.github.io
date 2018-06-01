<?php

session_start();

if (isset($_POST['submit'])) {
    
    include_once 'dbh.inc.php';
    
    $SIN = mysqli_real_escape_string($conn, $_POST['SIN']);
    $Location = mysqli_real_escape_string($conn, $_POST['Location']);
    
    //Error handlers
    //Check for empty fields
    if (empty($SIN) || empty($Location)){
        header("Location: ../admin.php?submit=emptyfields");
        exit();
    } else{
		$sql = "SELECT * FROM employee WHERE SIN = '$SIN';";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) != 1){
			header("Location: ../admin.php?submit=failure-No-Employee-Found");
			exit();
		}
		$sql = "SELECT * FROM gym WHERE Location = '$Location';";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) != 1){
			header("Location: ../admin.php?submit=failure-No-Gym-Found");
			exit();
		}
		$sql = "INSERT INTO owns(SIN, Location) VALUES('$SIN', '$Location');";
		mysqli_query($conn,$sql) or die("Bad Query: $sql");
		header("Location: ../admin.php?submit=success");
        exit();
		}        
    
} else {
    header("Location: ../signup.php");
    exit();
}