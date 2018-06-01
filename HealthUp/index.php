<?php
    include_once 'header.php';
	include_once 'includes/dbh.inc.php'
?>

<section class ="main-container">
    <div class="main-wrapper">
        <?php
            if(isset($_SESSION['u_uid'])){
				$id = $_SESSION['u_id'];
				$sql = "SELECT * FROM user WHERE id = $id";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				
                $row = mysqli_fetch_assoc($result);
				// ID, Age, Email, Firstname, Lastname, Username, Password, CurrentWeight, GoalWeight, Height, BodyFat //
				$age = $row['Age'];
				$firstname = $row['Firstname'];
				$lastname = $row['Lastname'];
				$currweight = $row['CurrentWeight'];
				$goalweight = $row['GoalWeight'];
				$height = $row['Height'];
				
				//BMI calculation//
				$weightInKg = $currweight/2.2;
				$heightInM = $height/100;
				
				$bmi = $weightInKg/($heightInM*$heightInM); 
				$bmi = number_format((float)$bmi, 2, '.', '');
				if($bmi <= 18.4){
					$bmiStat = "low -- gain weight";
				} else if ($bmi > 25.5){
					$bmiStat = "high -- reduce weight";
				} else {
					$bmiStat = "normal -- maintain weight";
				}
				echo "<h2>Welcome $firstname $lastname!</h2>";
					
				echo "<table border='1'>";
				echo "<tr><td>Age</td><td>Height</td><td>Current Weight</td><td>Goal Weight</td><td>BMI</td><td>BMI Status</td></tr>";
				echo "<tr><td>$age</td><td>$height</td><td>$currweight</td><td>$goalweight</td><td>$bmi</td><td>$bmiStat</td></tr>";
				echo "</table>";
				//Update buttons//
				echo '<form action="includes/update_weight.inc.php" method="post">
					<input type ="text" name ="new_cweight" placeholder="New current weight">
					<button type ="submit" name ="updateCurrWeight">Update Current Weight</button>
					</form>';
				echo '<form action="includes/update_weight.inc.php" method="POST">
					<input type ="text" name ="new_gweight" placeholder="New goal weight">
					<button type ="submit" name="updateGoalWeight">Update Goal Weight</button>
					</form>';
				echo '<form action="includes/update_weight.inc.php" method="POST">
					<input type ="text" name ="new_age" placeholder="New Age">
					<button type ="submit" name="updateAge">Update Age</button>	
					</form>';
					
				// Checking if user is client //
				$sql = "SELECT * FROM client WHERE UserId = $id";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				$resultCheck = mysqli_num_rows($result);
				
				if ($resultCheck > 0){
					echo "<h2>Client Information:</h2>";
					echo "<table border='1'>";
					echo "<tr><td>Home Address</td><td>Training Availability</td><td>Phone Number</td></tr>";
					$row = mysqli_fetch_assoc($result);
					$cAvail = $row['Availability'];
					$cAddress = $row['Address'];
					$cPhone = $row['Phone'];
					echo "<tr><td>$cAddress</td><td>$cAvail</td><td>$cPhone</td></tr>";
					echo "</table>";
					
					// Checking if Client has gym membership
					$memID = $row['ID'];
					$sql2 = "SELECT * FROM canbememberof WHERE MemberID = $memID";
					$result2 = mysqli_query($conn,$sql2) or die("Bad Query: $sql2");
					$resultCheck2 = mysqli_num_rows($result2);
					if ($resultCheck2 > 0){
					echo "<h2>Gym Membership(s):</h2>";
					echo "<table border='1'>";
					echo "<tr><td>Gym Name</td><td>Address</td></tr>";
					while($row2 = mysqli_fetch_assoc($result2)){
						$gAddress = $row2['Location'];
						// fetching Gym's name from gym using address //
						$sql3 = "SELECT Name FROM gym WHERE Location = '$gAddress'";
						$result3 = mysqli_query($conn,$sql3) or die("Bad Query: $sql3");
						$row3 = mysqli_fetch_assoc($result3);
						$gName = $row3['Name'];
						echo "<tr><td>$gName</td><td>$gAddress</td></tr>";					
						}
					echo "</table>";
					}
				}
				
				// Checking if user is an employee
				$sql = "SELECT * FROM employee WHERE UserId = $id";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				$resultCheck = mysqli_num_rows($result);
				if($resultCheck == 1){
					$row = mysqli_fetch_assoc($result);
					$wSched = $row['Schedule'];
					$wage = $row['Wage'];
					$wAddress = $row['Address'];
					// fetching Gym's name from gym using address //
					$sql2 = "SELECT Name FROM gym WHERE Location = '$wAddress'";
					$result2 = mysqli_query($conn,$sql2) or die("Bad Query: $sql2");
					$row2 = mysqli_fetch_assoc($result2);
					$wName = $row2['Name'];
					echo "<h2>Work Information:</h2>";
					echo "<table border='1'>";
					echo "<tr><td>Work</td><td>Address</td><td>Current Wage</td><td>Schedule</td></tr>";
					echo "<tr><td>$wName</td><td>$wAddress</td><td>\$$wage/hr</td><td>$wSched</td></tr>";
					echo "</table>";
					echo '<form class="signup-form" action="employee.php" method="post">
						<button type ="submit" name ="updateEmp">Manage Employee Info</button>
						</form>';
					// checking if user is an owner //
					$SIN = $row['SIN'];
					$sql3 = "SELECT * FROM owns WHERE SIN = $SIN";
					$result3 = mysqli_query($conn,$sql3) or die("Bad Query: $sql3");
					$resultCheck3 = mysqli_num_rows($result3);
					if ($resultCheck3 > 0){
						echo '<form class="signup-form" action="gym.php" method="post">
						<button type ="submit" name ="updateGym">Manage Gym</button>
						</form>';
					}
				}
            }else{
                echo '<h2>Please Login or Signup</h2>';
            }
        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>