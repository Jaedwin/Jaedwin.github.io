<?php

session_start();

if (isset($_POST['submit'])) {
    
    include_once 'dbh.inc.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $cals = mysqli_real_escape_string($conn, $_POST['cals']);
    $proteins = mysqli_real_escape_string($conn, $_POST['proteins']);
    $carbs = mysqli_real_escape_string($conn, $_POST['carbs']);
    $fats = mysqli_real_escape_string($conn, $_POST['fats']);
    
    //Error handlers
    //Check for empty fields
    if (empty($proteins) || empty($fats) || empty($carbs) || empty($name) || empty($cals)){
        header("Location: ../admin.php?submit=emptyfields");
        exit();
    } else {
        if(!is_numeric($proteins) || !is_numeric($fats) || !is_numeric($carbs) || !is_numeric($cals)){
            header("Location: ../admin.php?submit=non_numerics_entered");
            exit();
        }else{
            $sql = "INSERT INTO food(Name, Calories, Protein, Carbs, Fat) VALUES ('$name',$cals,$proteins,$carbs,$fats);";
            mysqli_query($conn, $sql) or die("Bad Query: $sql");
            header("Location: ../admin.php?submit=success");
            exit();
        }        
    }
    
} else {
    header("Location: ../signup.php");
    exit();
}