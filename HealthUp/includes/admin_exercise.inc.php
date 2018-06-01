<?php

session_start();

if (isset($_POST['submit'])) {
    
    include_once 'dbh.inc.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $bodypart = mysqli_real_escape_string($conn, $_POST['bodypart']);
    $equipment = mysqli_real_escape_string($conn, $_POST['equipment']);
    
    //Error handlers
    //Check for empty fields
    if (empty($name) || empty($bodypart) || empty($equipment)){
        header("Location: ../admin.php?submit=emptyfields");
        exit();
    } else {
        $id = $_SESSION['u_id'];
        $sql = "INSERT INTO exercise(ID, Name, BodyPart, Equipment) VALUES ($id,'$name','$bodypart','$equipment');";
        mysqli_query($conn, $sql) or die("Bad Query: $sql");
        header("Location: ../admin.php?submit=success");
        exit();           
    }
    
} else {
    header("Location: ../signup.php");
    exit();
}