<?php
    include_once 'header.php';
	include_once 'includes/dbh.inc.php'
?>

<section class ="main-container">
    <div class="main-wrapper">
        <?php
            if(isset($_SESSION['u_id'])){
            $id = $_SESSION['u_id'];
            if($id == 0){
                // GYM's
                $sql = "SELECT * FROM gym";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
				echo "<h1>Admin Panel</h1>";
                echo "<h2>Gyms</h2>";
                
                echo '<form id="form" action="" method="post">';
                echo '<select name="gyms" class="ddList">';
                echo "<option value='default'>Gym Options</option>";
                echo "<option value='new'>Create New</option>";   
                while($row = mysqli_fetch_assoc($result)){
                    $rowname = $row['Name'];
                    echo "<option value='$rowname'>"."Delete ".$rowname."</option>";
                }
                echo '</select>';
                echo '<input type="submit" value="Submit">';
                echo '</form>';    
                $value = $_POST['gyms'];
                
                if($value == "new"){
                    echo '<form class="nutritionplan-form" action="includes/admin_gym.inc.php" method="POST">
                            <input type ="text" name ="name" placeholder="Name">
                            <input type ="text" name ="Location" placeholder="Location">
                            <button type ="submit" name="submit">Submit</button>
                            </form>';          
                }else{
                    $sql = "DELETE FROM gym WHERE Name = '$value'";
                    $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                }
                
				// EMPLOYEE
                $sql = "SELECT * FROM gym";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                echo "<h2>Create Employee Account</h2>";
                
                echo '<form class="nutritionplan-form" action="includes/admin_employee.inc.php" method="POST">
                <input type ="text" name ="Location" placeholder="Location">
                <input type ="text" name ="SIN" placeholder="SIN">
				<input type ="text" name ="Username" placeholder="Username">
                <button type ="submit" name="submit">Submit</button>
                </form>';  
                
				
                // OWNER's
                $sql = "SELECT * FROM owns";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                echo "<h2>Owners</h2>";
                
                echo '<form id="form" action="" method="post">';
                echo '<select name="owners" class="ddList">';
                echo "<option value='default'>Please Select an Owner</option>";
                echo "<option value='new'>Add Owner to Existing Gym</option>";
                while($row = mysqli_fetch_assoc($result)){
                    $rowname = $row['SIN'];
                    echo "<option value='$rowname'>" ."Delete ". $rowname . "</option>";
                }
                echo '</select>';
                echo '<input type="submit" value="Submit">';
                echo '</form>';    
                $value = $_POST['owners'];
                
                if($value == "new"){
                    echo '<form class="nutritionplan-form" action="includes/admin_gymowner.inc.php" method="POST">
                            <input type ="text" name ="Location" placeholder="Location">
                            <input type ="text" name ="SIN" placeholder="SIN">
                            <button type ="submit" name="submit">Submit</button>
                            </form>';  
                }else{
                    $sql = "DELETE FROM owns WHERE SIN = '$value';";
                    $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                }
                
                // FOOD's
                $sql = "SELECT * FROM food";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                echo "<h2>Foods</h2>";
                
                echo '<form id="form" action="" method="post">';
                echo '<select name="foods" class="ddList">';
                echo "<option value='default'>Please Select a Food</option>";
                echo "<option value='new'>Create New</option>";
                while($row = mysqli_fetch_assoc($result)){
                    $rowname = $row['Name'];
                    echo "<option value='$rowname'>" ."Delete ". $rowname . "</option>";
                }
                echo '</select>';
                echo '<input type="submit" value="Submit">';
                echo '</form>';    
                $value = $_POST['foods'];
                
                if($value == "new"){
                    echo '<form class="nutritionplan-form" action="includes/admin_food.inc.php" method="POST">
                            <input type ="text" name ="name" placeholder="Name">
                            <input type ="text" name ="cals" placeholder="Calories">
                            <input type ="text" name ="proteins" placeholder="Proteins">
                            <input type ="text" name ="carbs" placeholder="Carbohydrates">
                            <input type ="text" name ="fats" placeholder="Fats">
                            <button type ="submit" name="submit">Submit</button>
                            </form>';             
                }else{
                    $sql = "DELETE FROM food WHERE Name = '$value'";
                    $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                }

                
                // EXCERCISES's
                $sql = "SELECT * FROM exercise";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                echo "<h2>Excercises</h2>";
                
                echo '<form id="form" action="" method="post">';
                echo '<select name="exercises" class="ddList">';
                echo "<option value='default'>Please Select an Exercise</option>";
                echo "<option value='new'>Create New</option>";
                while($row = mysqli_fetch_assoc($result)){
                    $rowname = $row['Name'];
                    echo "<option value='$rowname'>" . "Delete ". $rowname . "</option>";
                }
                echo '</select>';
                echo '<input type="submit" value="Submit">';
                echo '</form>';    
                $value = $_POST['exercises'];
                
                if($value == "new"){
                    echo '<form class="nutritionplan-form" action="includes/admin_exercise.inc.php" method="POST">
                            <input type ="text" name ="name" placeholder="Name">
                            <input type ="text" name ="bodypart" placeholder="Body Part">
                            <input type ="text" name ="equipment" placeholder="Equipment">
                            <button type ="submit" name="submit">Submit</button>
                            </form>';    
                }else{                
                    $sql = "DELETE FROM exercise WHERE Name = '$value'";
                    $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                }
            }else{
                header("Location: index.php");
                exit();  
            }
            }else{
                header("Location: index.php");
                exit();  
            }
        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>