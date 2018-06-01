<?php

session_start();

if (isset($_POST['submit_update_nutri'])) {
    
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
			// make this an UPDATE once the name transfers over
            $sql = "UPDATE NutritionPlan SET MaxCals = $cals, MaxProtein = $protein, MaxCarbs = $carbs, MaxFats = $fats WHERE Name = '$name' AND UserId = $id;";
            mysqli_query($conn, $sql) or die("Bad Query: $sql");
            header("Location: ../nutrition_plan.php?submit=success");
            exit();
        }        
    }
	
}else if (isset($_POST['submit_add_food'])) {
	
	include_once 'dbh.inc.php';
	$id = $_SESSION['u_id'];
	$name = mysqli_real_escape_string($conn, $_POST['name']); //name of routine
	$foodName = mysqli_real_escape_string($conn, $_POST['foodName']);
	
	$sql = "SELECT * FROM Food WHERE Name = '$foodName'"; 
	$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
	$row = mysqli_fetch_assoc($result);
	$foodID = $row['ID'];
	$sql2 = "INSERT into MadeUpOf (UserId, NutritionPlanName, FoodId, FoodName) VALUES ($id, '$name', $foodID, '$foodName')";
	mysqli_query($conn, $sql2) or die("Bad Query: $sql");
	header("Location: ../nutrition_plan.php?submit=success");
    exit();
	
}else if (isset($_POST['submit_Delete'])) {
	include_once 'dbh.inc.php';
	$id = $_SESSION['u_id'];
	$name = mysqli_real_escape_string($conn, $_POST['name']); //name
	$sql3 = "DELETE FROM NutritionPlan WHERE UserId = $id AND Name='$name'";
	mysqli_query($conn, $sql3) or die("Bad Query: $sql");
	header("Location: ../nutrition_plan.php?submit=success");
    exit();
	
} else if (isset($_POST['submit_Remove_Food'])) {
	
	include_once 'dbh.inc.php';
	$id = $_SESSION['u_id'];
	$name = mysqli_real_escape_string($conn, $_POST['name']); //name of routine
	$foodName = mysqli_real_escape_string($conn, $_POST['foodName']);
	
	$sql4 = "DELETE FROM MadeUpOf WHERE UserId = $id AND FoodName = '$foodName'";
	mysqli_query($conn, $sql4) or die("Bad Query: $sql");
	header("Location: ../nutrition_plan.php?submit=success");
    exit();
	
}else {
    header("Location: ../signup.php");
    exit();
}