<?php

session_start();

if (isset($_POST['submit_routine'])) {
    
    include_once 'dbh.inc.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    
    //Error handlers
    //Check for empty fields
    if (empty($name)){
        header("Location: ../workout_routine.php?submit=empty");
        exit();
    } else {
        
        $id = $_SESSION['u_id'];
        $sql = "INSERT INTO WorkoutRoutine(UserId, Name) VALUES ($id,'$name');";
        mysqli_query($conn, $sql) or die("Bad Query: $sql");
        header("Location: ../workout_routine.php?submit=success");
        exit();
                
    }
    
} else {
    header("Location: ../signup.php");
    exit();
}