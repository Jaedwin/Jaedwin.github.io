<?php

session_start();

if (isset($_POST['submit_Delete'])) {
	include_once 'dbh.inc.php';
	$id = $_SESSION['u_id'];
	$name = mysqli_real_escape_string($conn, $_POST['name']); //name
	$sql3 = "DELETE FROM workoutroutine WHERE UserId = $id AND Name='$name'";
	mysqli_query($conn, $sql3) or die("Bad Query: $sql");
	header("Location: ../workout_routine.php?submit=success");
    exit();
	
}else if (isset($_POST['submit_search'])) {
	include_once 'dbh.inc.php';
	$id = $_SESSION['u_id'];
	$bodypart = mysqli_real_escape_string($conn, $_POST['bodypart']); 
	$equipment = mysqli_real_escape_string($conn, $_POST['equipment']);

	//if bodypart null
	if(empty($bodypart)){
		echo "<h2>Exercises</h2>";
		echo "<table border='1'>";
        echo "<tr><td>Excercises</td><td>Targeted Body Part</td><td>Equipment</td></tr>";
        $sql3 = "SELECT * FROM exercise WHERE equipment = '$equipment'";
        $result3 = mysqli_query($conn,$sql3) or die("Bad Query: $sql3");
        while($row = mysqli_fetch_assoc($result3)){
            $name = $row['Name'];
            $bodyPart = $row['BodyPart'];
            $equip = $row['Equipment'];
            echo "<tr><td>$name</td><td>$bodyPart</td><td>$equip</td></tr>";		
		}
		// return button
		echo "<a href='../workout_routine.php' ><button>RETURN</button></a>";
		//if equipment null
	}else if(empty($equipment)){
		echo "<h2>Exercises</h2>";
		echo "<table border='1'>";
        echo "<tr><td>Excercises</td><td>Targeted Body Part</td><td>Equipment</td></tr>";
        $sql = "SELECT * FROM exercise WHERE bodypart = '$bodypart'";
		$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['Name'];
            $bodyPart = $row['BodyPart'];
            $equip = $row['Equipment'];
            echo "<tr><td>$name</td><td>$bodyPart</td><td>$equip</td></tr>";		
		}
		// return button
		echo "<a href='../workout_routine.php' ><button>RETURN</button></a>";
	}else{
		// if equipment and body part both given
		echo "<h2>Exercises</h2>";
		echo "<table border='1'>";
        echo "<tr><td>Excercises</td><td>Targeted Body Part</td><td>Equipment</td></tr>";
        $sql = "SELECT * FROM exercise WHERE bodypart = '$bodypart' AND equipment = '$equipment'";
		$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['Name'];
            $bodyPart = $row['BodyPart'];
            $equip = $row['Equipment'];
            echo "<tr><td>$name</td><td>$bodyPart</td><td>$equip</td></tr>";
		}
		// return button
		echo "<a href='../workout_routine.php' ><button>RETURN</button></a>";
	}	
}else if(isset($_POST['submit_add'])){
	include_once 'dbh.inc.php';
	$id = $_SESSION['u_id'];
	$exercise = mysqli_real_escape_string($conn, $_POST['exercise']);
	$sets = mysqli_real_escape_string($conn, $_POST['sets']);
	$reps = mysqli_real_escape_string($conn, $_POST['reps']);
	$name = mysqli_real_escape_string($conn, $_POST['name']); //name of routine
	$w_id = mysqli_real_escape_string($conn, $_POST['w_id']); //id of routine
	
	//get exercise ID
	$sql = "SELECT * FROM exercise WHERE Name = '$exercise'"; 
	$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
	$row = mysqli_fetch_assoc($result);
	$e_id = $row['ID'];
	
	$sql2 = "INSERT into ConsistsOf (UserId, Workout_ID, Name, ExerciseId, Sets, Reps) VALUES ($id, $w_id, '$name', $e_id, $sets, $reps)";
	mysqli_query($conn, $sql2) or die("Bad Query: $sql");
	header("Location: ../workout_routine.php?submit=success");
    exit();

}else if(isset($_POST['submit_remove'])){
	include_once 'dbh.inc.php';
	$id = $_SESSION['u_id'];
	$exercise = mysqli_real_escape_string($conn, $_POST['exercise']);
	$name = mysqli_real_escape_string($conn, $_POST['name']); //name of routine
	$w_id = mysqli_real_escape_string($conn, $_POST['w_id']); //id of routine
	
	//get exercise ID
	$sql = "SELECT * FROM exercise WHERE Name = '$exercise'"; 
	$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
	$row = mysqli_fetch_assoc($result);
	$e_id = $row['ID'];
	
	$sql2 = "DELETE FROM ConsistsOf WHERE UserId = $id AND ExerciseID = $e_id AND Workout_Id = $w_id";
	mysqli_query($conn, $sql2) or die("Bad Query: $sql2");
	header("Location: ../workout_routine.php?submit=success");
    exit();
	
	
}else{    header("Location: ../signup.php");
    exit();
}


