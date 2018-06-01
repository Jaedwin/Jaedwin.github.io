<?php
    include_once 'header.php';
?>

<section class ="main-container">
    <div class="main-wrapper">
		<form class="nutritionplan-form" action="includes/gym.inc.php" method="POST">
		
		<h2>Remove Gym</h2>
		<input type ="text" name ="location2" placeholder="Location">
		<input type ="text" name ="sin" placeholder="SIN">
		<button type ="submit" name="remove">Remove</button>
		
		<h2>Update Gym</h2>
		<input type ="text" name ="location3" placeholder="Current Location">
		<input type ="text" name ="location4" placeholder="Updated Location">
		<input type ="text" name ="name2" placeholder="Name">
		<input type ="text" name ="sin2" placeholder="SIN">
		<button type ="submit" name="update">Update</button>
		<h2>Register Employee Information</h2>
		<input type ="text" name ="SIN" placeholder="SIN">
		<input type ="text" name ="wage" placeholder="Wage">
		<input type ="text" name ="phone" placeholder="Phone">
		<input type ="text" name ="schedule" placeholder="Availability">
		<input type ="text" name ="username" placeholder="Username">
		<button type ="submit" name="register">Register</button>
		</form> 
    </div>
</section>

<?php
    include_once 'footer.php';
?>