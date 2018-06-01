<?php

session_start();

if (isset($_POST['submit'])) {
    
    include_once 'dbh.inc.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $protein = mysqli_real_escape_string($conn, $_POST['proteins']);
    $fats = mysqli_real_escape_string($conn, $_POST['fats']);
    $carbs = mysqli_real_escape_string($conn, $_POST['carbs']);
    $cals = $protein*4 + $fats*9 + $carbs*4;
    
    //Error handlers
    //Check for empty fields
    if (empty($protein) || empty($fats) || empty($carbs)){
        header("Location: ../nutrition_plan.php?submit=empty");
        exit();
    } else {
        if(!is_numeric($protein) || !is_numeric($fats) || !is_numeric($carbs)){
            header("Location: ../nutrition_plan.php?submit=error_non_numeric_entered");
            exit();
        }else{
            $id = $_SESSION['u_id'];
            $sql = "INSERT INTO NutritionPlan(UserId, Name, MaxCals, MaxProtein, MaxCarbs, MaxFats) VALUES ($id,'$name',$cals,$protein,$carbs,$fats);";
            mysqli_query($conn, $sql) or die("Bad Query: $sql");
            header("Location: ../nutrition_plan.php?submit=success");
            exit();
        }        
    }
    
} else {
    header("Location: ../signup.php");
    exit();
}