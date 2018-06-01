<?php
    include_once 'header.php';
	include_once 'includes/dbh.inc.php'
?>

<section class ="main-container">
    <div class="main-wrapper">
		<form class="signup-form" action="includes/client.inc.php" method="POST">
		<h2>Register Client Information</h2>
		<input type ="text" name ="phone" placeholder="Phone Number">
		<input type ="text" name ="address" placeholder="Address">
		<input type ="text" name ="availability" placeholder="Availability">
		<button type ="submit" name="register">Register</button>
		<h2>Update Client Information</h2>
		<input type ="text" name ="uphone" placeholder="Phone Number">
		<input type ="text" name ="uaddress" placeholder="Address">
		<input type ="text" name ="uavailability" placeholder="Availability">
		<button type ="submit" name="update">Update</button>
		<h2>Add Gym Membership</h2>
		 <?php
            if(isset($_SESSION['u_uid'])){
				
                $id = $_SESSION['u_id'];
				$sql = "SELECT location, name FROM gym;";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
               
                echo"<select name ='gym'>";
				echo"<option value=''>Select...</option>";
                
				while($row = mysqli_fetch_assoc($result)){
                    $name = $row['name'];
					$rowname = $row['location'];
					
					$loc_name = $name . ", " . $rowname;
                    echo "<option value='$rowname'>" . $loc_name . "</option>";
                }

				echo '</select>';
				echo '<button type="submit" name="addgym">Add Gym</button>';
			}
		
		?>
		<h2>Remove Gym Membership</h2>
		 <?php
            if(isset($_SESSION['u_uid'])){
				
                $uid = $_SESSION['u_id'];
				$sql = "SELECT * FROM client WHERE (userid ='$uid');";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
	
				$row = mysqli_fetch_assoc($result);
				$mid = $row['ID'];
                
				$sql = "SELECT c.location, g.name FROM canbememberof as c, gym as g WHERE memberid = '$mid' and g.location = c.location;";
				$result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				
                echo"<select name ='gym_remove'>";
				echo"<option value=''>Select...</option>";
                while($row = mysqli_fetch_assoc($result)){
                    $rowname = $row['location'];
					$name = $row['name'];
					$loc_name = $name . ", " . $rowname;
                    echo "<option value='$rowname'>" . $loc_name . "</option>";
                }

				echo '</select>';
				echo '<button type="submit" name="removegym">Remove Gym</button>';
				
			}
		?>
		<h2>Add Coach</h2>
		 <?php
            if(isset($_SESSION['u_uid'])){
				
                $uid = $_SESSION['u_id'];
				$sql = "SELECT * FROM client WHERE (userid ='$uid');";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
	
				$row = mysqli_fetch_assoc($result);
				$mid = $row['ID'];
                
				$sql = "SELECT u.firstname, u.lastname, g.name, e.SIN from gym as g, user as u, employee as e, client as c, canbememberof as cbmo where u.ID = e.UserId and c.ID = '$mid' and c.ID = cbmo.MemberId and cbmo.Location = e.Address and g.location = cbmo.location;";
				
				$result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				
                echo"<select name ='coach_add'>";
				echo"<option value=''>Select...</option>";
                while($row = mysqli_fetch_assoc($result)){
                    
					$fname = $row['firstname'];
					$lname = $row['lastname'];
					$name = $row['name'];
					$sin = $row['SIN'];
					$stn = $fname . " " . $lname . ", " .$name;
                    
					echo "<option value='$sin'>" . $stn. "</option>";
                }

				echo '</select>';
				echo '<button type="submit" name="addcoach">Add Coach</button>';
				
			}
		?>
		<h2>Remove Coach</h2>
		 <?php
            if(isset($_SESSION['u_uid'])){
				
                $uid = $_SESSION['u_id'];
				$sql = "SELECT * FROM client WHERE (userid ='$uid');";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
	
				$row = mysqli_fetch_assoc($result);
				$mid = $row['ID'];
                
				$sql = "SELECT u.firstname, u.lastname, g.name, e.SIN from gym as g, user as u, employee as e, coaches as co where co.memberid = '$mid' and co.SIN = e.SIN and e.userid = u.id and g.location = e.address;";
				
				$result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				
                echo"<select name ='coach_remove'>";
				echo"<option value=''>Select...</option>";
                while($row = mysqli_fetch_assoc($result)){
                    
					$fname = $row['firstname'];
					$lname = $row['lastname'];
					$name = $row['name'];
					$sin = $row['SIN'];
					$stn = $fname . " " . $lname . ", " .$name;
                    
					echo "<option value='$sin'>" . $stn. "</option>";
                }

				echo '</select>';
				echo '<button type="submit" name="removecoach">Remove Coach</button>';
				echo '</form>';
			}
		?>
		</form> 
    </div>
	
</section>

<?php
    include_once 'footer.php';
?>