<?php

session_start();

if (isset($_POST['submit'])) {
    
    include_once 'dbh.inc.php';
    
    $Name = mysqli_real_escape_string($conn, $_POST['name']);
    $Location = mysqli_real_escape_string($conn, $_POST['Location']);
    
    //Error handlers
    //Check for empty fields
    if (empty($Name) || empty($Location)){
        header("Location: ../admin.php?submit=emptyfields");
        exit();
    } else{
		$sql = "INSERT INTO gym(Name, Location) VALUES('$Name', '$Location');";
		mysqli_query($conn,$sql) or die("Bad Query: $sql");
		header("Location: ../admin.php?submit=success");
        exit();
		}        
    
} else {
    header("Location: ../signup.php");
    exit();
}