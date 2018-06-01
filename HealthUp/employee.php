<?php
    include_once 'header.php';
	include_once 'includes/dbh.inc.php'
?>

<section class ="main-container">
    <div class="main-wrapper">
		<form class="signup-form" action="includes/employee.inc.php" method="POST">
		
		<h2>Update Employee Information</h2>
		<input type ="text" name ="uphone" placeholder="Phone">
		<input type ="text" name ="uschedule" placeholder="Availability">
		<button type ="submit" name="update">Update</button>
		
		<h2>Add Client</h2>
		 <?php
            if(isset($_SESSION['u_uid'])){
				
                $uid = $_SESSION['u_id'];
				$sql = "SELECT * FROM employee WHERE (userid ='$uid');";
				$result = mysqli_query($conn, $sql);
	
				$row = mysqli_fetch_assoc($result);
				$sin = $row['SIN'];
                
				$sql = "SELECT u.firstname, u.lastname, c.id from gym as g, user as u, employee as e, client as c, canbememberof as cbmo where u.ID = c.UserId and c.ID = cbmo.MemberId and cbmo.Location = e.Address and g.location = cbmo.location and e.SIN = '$sin'";
				
				$result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				
                echo"<select name ='client_add'>";
				echo"<option value=''>Select...</option>";
                while($row = mysqli_fetch_assoc($result)){
                    
					$fname = $row['firstname'];
					$lname = $row['lastname'];
					$id = $row['id'];
					$stn = $fname . " " . $lname;
                    
					echo "<option value='$id'>" . $stn. "</option>";
                }

				echo '</select>';
				echo '<button type="submit" name="addclient">Add Client</button>';
				
			}
		?>
		<h2>Remove Client</h2>
		 <?php
            if(isset($_SESSION['u_uid'])){
				
                $uid = $_SESSION['u_id'];
				$sql = "SELECT * FROM employee WHERE (userid ='$uid');";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$sin = $row['SIN'];
                
				$sql = "SELECT u.firstname, u.lastname, co.memberid from user as u, client as c, coaches as co where co.sin = '$sin' and co.memberid = c.id and c.userid = u.id";
				
				$result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				
                echo"<select name ='client_remove'>";
				echo"<option value=''>Select...</option>";
                while($row = mysqli_fetch_assoc($result)){
                    
					$fname = $row['firstname'];
					$lname = $row['lastname'];
					$memberid = $row['memberid'];
					$stn = $fname . " " . $lname;
                    
					echo "<option value='$memberid'>" . $stn. "</option>";
                }

				echo '</select>';
				echo '<button type="submit" name="removeclient">Remove Client</button>';
				echo '</form>';
			}
		?>
		</form> 
    </div>
</section>

<?php
    include_once 'footer.php';
?>