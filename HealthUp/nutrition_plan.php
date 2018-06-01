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
				$sql = "SELECT * FROM nutritionplan WHERE UserID = $id";
                $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                // if 
                echo "<h2>$firstname's Nutrition Plans</h2>";
                
                echo '<form id="form" action="" method="post">';
                echo '<select name="nutrition" class="ddList">';
                echo "<option value='default'>Please Select a Plan</option>";
                echo "<option value='new'>Create New</option>";
                while($row = mysqli_fetch_assoc($result)){
                    $rowname = $row['Name'];
                    echo "<option value='$rowname'>" . $rowname . "</option>";
                }
                echo '</select>';
                echo '<input type="submit" value="Select">';
                echo '</form>';
                
                $value = $_POST['nutrition'] ?? 'default';
                                
                if($value == "default"){
                }else if($value == "new"){
                    echo '<form class="nutritionplan-form" action="includes/nutrition_plan.inc.php" method="POST">
                                <h2>New Nutrition Plan</h2>
                                <input type ="text" name ="name" placeholder="Plan Name">
                                <input type ="text" name ="proteins" placeholder="Desired Proteins">
                                <input type ="text" name ="carbs" placeholder="Desired Carbohydrates">
                                <input type ="text" name ="fats" placeholder="Desired Fats">
                                <button type ="submit" name="submit">Submit</button>
                                </form>';
                }else{
					// Shows your macros and info
                    echo "<h2>Nutritional Information for Plan:</h2>";
                    echo "<h2>$value</h2>";
                    echo "<table border='1'>";
                    echo "<tr><td>Calories</td><td>Protein</td><td>Carbohydrates</td><td>Fats</td></tr>";
                    $sql = "SELECT * FROM nutritionplan WHERE UserID = $id AND Name = '$value'";
                    $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                    while($row = mysqli_fetch_assoc($result)){
                          $rowcals = $row['MaxCals'];
                          $rowprot = $row['MaxProtein'];
                          $rowcarb = $row['MaxCarbs'];
                          $rowfats = $row['MaxFats'];
                          echo "<tr><td>$rowcals</td><td>$rowprot</td><td>$rowcarb</td><td>$rowfats</td></tr>";
                    }
                    echo "</table>";
					
					//  update macros //
					echo "<form action='includes/nutrition_plan_update.inc.php' method='POST'>
							<input type='hidden' name='name' value='$value'>
							<input type='text' name='proteins' placeholder='Update Proteins'>
							<input type='text' name='carbs' placeholder='Update Carbs'>
							<input type='text' name='fats' placeholder='Update Fats'>
							<button type='submit' name='submit_update_nutri'>Update</button>
							</form>";
					
                    
                    // SUGGESTED FOODS //
                    echo "<h2>Your Suggested Foods:</h2>";
                    echo "<table border='1'>";
                    echo "<tr><td>Name</td><td>Calories</td><td>Protein</td><td>Carbohydrates</td><td>Fats</td></tr>";
                    $sql = "SELECT f.name, f.calories, f.protein, f.carbs, f.fat FROM `madeupof` AS m, `food` AS f WHERE f.ID = m.foodId AND m.UserId = $id AND m.NutritionPlanName = '$value'";
                    $result = mysqli_query($conn,$sql) or die("Bad Query: $sql");
                    while($row = mysqli_fetch_assoc($result)){
                          $rname = $row['name'];
                          $rowcals = $row['calories'];
                          $rowprot = $row['protein'];
                          $rowcarb = $row['carbs'];
                          $rowfats = $row['fat'];
                          echo "<tr><td>$rname</td><td>$rowcals</td><td>$rowprot</td><td>$rowcarb</td><td>$rowfats</td></tr>";
                    }
                    echo "</table>";
					
					//  add food //
					echo "<form action='includes/nutrition_plan_update.inc.php' method='POST'>
							<input type='hidden' name='name' value='$value'>
							<input type='text' name='foodName' placeholder='Food Name'>
							<button type='submit' name='submit_add_food'>Add Food</button>
							</form>";
					
					//remove food//
					echo "<form action='includes/nutrition_plan_update.inc.php' method='POST'>
							<input type='hidden' name='name' value='$value'>
							<input type='text' name='foodName' placeholder='Food Name'>
							<button type='submit' name='submit_Remove_Food'>Remove Food</button>
							</form>";
					
					
					//DELETE the plan TODO: play with the color of the button some more //
					echo "<h2>___________________________________</h2>";
					echo "<form action='includes/nutrition_plan_update.inc.php' method='POST'>
							<input type='hidden' name='name' value='$value'> 
							<button style='background:  #e74c3c  ;' button type='submit' name='submit_Delete'>DELETE PLAN</button>
							</form>";
					
					
                }  
            }
            else{
				header("Location: index.php?error=notloggedin");
                //echo '<h2>Please Login</h2>';
            }
        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>