<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php'
?>
 
<section class ="main-container">
    <div class="main-wrapper">
        <?php
            if(isset($_SESSION['u_uid'])){
                $firstname = $_SESSION['u_first'];
                $id = $_SESSION['u_id'];
                $sql = "SELECT * FROM workoutroutine WHERE UserID = $id";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                // if 
                echo "<h2>$firstname's Routines</h2>";
                 
                echo '<form id="form" action="" method="post">';
                echo '<select name="routine" class="ddList">';
                echo "<option value='default'>Please Select a Routine</option>";
                echo "<option value='new'>Create New</option>";
                while($row = mysqli_fetch_assoc($result)){
                    $rowname = $row['Name'];
                    echo "<option value='$rowname'>" . $rowname . "</option>";
                }
                echo '</select>';
                echo '<input type="submit" value="Select">';
                echo '</form>';
                $value = $_POST['routine'] ?? 'default';
                                 
                if($value == "default"){
                }else if($value == "new"){
					//Create new Routine
                     echo '<form class="workoutroutine-form" action="includes/workout_routine.inc.php" method="POST"> 
                                <h2>New Routine</h2>
                                <input type ="text" name ="name" placeholder="Routine Name">
                                <button type ="submit" name="submit_routine">Create</button>
                                </form>';
                }else{
					//get workoutID
					$sql = "SELECT * FROM workoutRoutine WHERE Name = '$value' AND UserID = $id"; 
					$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
					$row = mysqli_fetch_assoc($result);
					$w_id = $row['WorkoutID'];
										
                    // Shows routine info
                    echo "<h2>Routine Breakdown:</h2>";
                    echo "<h2>$value</h2>";
                    echo "<table border='1'>";
                    echo "<tr><td>Excercises</td><td>Targeted Body Part</td><td>Sets</td><td>Reps</td><td>Equipment</td></tr>";
                    $sql = "SELECT e.name, e.bodyPart, e.equipment, c.sets, c.reps FROM `exercise` AS e, `consistsof` AS c WHERE c.UserID = $id AND c.Workout_Id = $w_id AND c.exerciseId = e.ID";
                    $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                    while($row = mysqli_fetch_assoc($result)){
                          $name = $row['name'];
                          $part = $row['bodyPart'];
                          $sets = $row['sets'];
                          $reps = $row['reps'];
                          $equip = $row['equipment'];
                          echo "<tr><td>$name</td><td>$part</td><td>$sets</td><td>$reps</td><td>$equip</td></tr>";
                    }
                    echo "</table>";
					
					//  add exercise //
					echo "<form action='includes/routine_update.inc.php' method='POST'>
							<input type='hidden' name='name' value='$value'>
							<input type='hidden' name='w_id' value='$w_id'>
							<input type='text' name='exercise' placeholder='Exercise Name'>
							<input type='text' name='sets' placeholder='# of Sets'>
							<input type='text' name='reps' placeholder='# of Reps'>
							<button type='submit' name='submit_add'>Add to Routine</button>
							</form>";
					
					//remove exercise//
					echo "<form action='includes/routine_update.inc.php' method='POST'>
							<input type='hidden' name='name' value='$value'>
							<input type='hidden' name='w_id' value='$w_id'>
							<input type='text' name='exercise' placeholder='Exercise Name'>
							<button type='submit' name='submit_remove'>Remove from Routine</button>
							</form>";
					
					/*  Search  by body part and/or equipment */
					echo "<h2>_____________________________________________</h2>";
					echo "<form action= 'includes/routine_update.inc.php' method='POST'>
							<input type='text' name='bodypart' placeholder='Bodypart'>
							<input type='text' name='equipment' placeholder='Equipment'>
							<button type='submit' name='submit_search'>Search Exercises</button>
							</form>";
					
					
                    echo "<h2>_____________________________________________</h2>";
                    echo "<form action='includes/routine_update.inc.php' method='POST'>
                            <input type='hidden' name='name' value='$value'> 
                            <button style='background:  #e74c3c  ;' button type='submit' name='submit_Delete'>DELETE ROUTINE</button>
                            </form>";
                     
                     
                }  
            }
            
        ?>
    </div>
</section>
 
<?php
    include_once 'footer.php';
?>