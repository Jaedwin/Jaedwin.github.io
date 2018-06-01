<?php

session_start();

if (isset($_POST['submit'])) {
	
	include 'dbh.inc.php';
	
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	
	//Error handlers
	//Check if inputs are empty
	if (empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM user WHERE username='$uid' OR email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error2");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['Password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?login=error3");
					exit();
				} elseif ($hashedPwdCheck == true) {
					//Log in the user here
                    $id = $row['ID'];
                    if($id == 0){
                        $_SESSION['u_id'] = $row['ID'];
                        header("Location: ../admin.php?login=success");
                        exit();                    
                    }else{
                        $_SESSION['u_id'] = $row['ID'];
                        $_SESSION['u_first'] = $row['Firstname'];
                        $_SESSION['u_last'] = $row['Lastname'];
                        $_SESSION['u_email'] = $row['Email'];
                        $_SESSION['u_uid'] = $row['Username'];
                        $_SESSION['u_cweight'] = $row['CurrentWeight'];
                        $_SESSION['u_gweight'] = $row['GoalWeight'];
                        $_SESSION['u_height'] = $row['Height'];
                        $_SESSION['u_bodyfat'] = $row['BodyFat'];
                        header("Location: ../index.php?login=success");
                        exit();
                    }
				}
			}
		}
	}
} else {
	header("Location: ../index.php?login=error");
	exit();
}