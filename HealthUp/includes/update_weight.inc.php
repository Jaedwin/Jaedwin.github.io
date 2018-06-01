<?php

session_start();

if (isset($_POST['updateCurrWeight'])) {
    
    include_once 'dbh.inc.php';
    
    $cweight = mysqli_real_escape_string($conn, $_POST['new_cweight']);
    
    //Error handlers
    //Check for empty fields
    if (empty($cweight)){
        header("Location: ../index.php?submit=empty");
        exit();
    } else {
        if(!is_numeric($cweight)){
            header("Location: ../index.php?submitcurrentweight=error_non_numeric_entered");
            exit();
        }else{
            $id = $_SESSION['u_id'];
            $sql = "UPDATE user SET CurrentWeight = $cweight WHERE ID = $id";
            mysqli_query($conn, $sql) or die("Bad Query: $sql");
            header("Location: ../index.php?submit=success");
            exit();
        }        
    }
} else if (isset($_POST['updateGoalWeight'])) {
    
    include_once 'dbh.inc.php';
    
    $gweight = mysqli_real_escape_string($conn, $_POST['new_gweight']);
    
    //Error handlers
    //Check for empty fields
    if (empty($gweight)){
        header("Location: ../index.php?submit=empty");
        exit();
    } else {
        if(!is_numeric($gweight)){
            header("Location: ../index.php?submitgoalweight=error_non_numeric_entered");
            exit();
        }else{
            $id = $_SESSION['u_id'];
            $sql = "UPDATE user SET GoalWeight = $gweight WHERE ID = $id;";
            mysqli_query($conn, $sql) or die("Bad Query: $sql");
            header("Location: ../index.php?submit=success");
            exit();
        }        
    }    
} else if (isset($_POST['updateAge'])) {
    
    include_once 'dbh.inc.php';
    
    $age = mysqli_real_escape_string($conn, $_POST['new_age']);
    
    //Error handlers
    //Check for empty fields
    if (empty($age)){
        header("Location: ../index.php?submit=empty");
        exit();
    } else {
        if(!is_numeric($age)){
            header("Location: ../index.php?submitgoalweight=error_non_numeric_entered");
            exit();
        }else{
            $id = $_SESSION['u_id'];
            $sql = "UPDATE user SET Age = $age WHERE ID = $id;";
            mysqli_query($conn, $sql) or die("Bad Query: $sql");
            header("Location: ../index.php?submit=success");
            exit();
        }        
    }    
} else {
    header("Location: ../index.php?updateweight=error");
    exit();
}