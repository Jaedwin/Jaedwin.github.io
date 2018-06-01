<?php
    include_once 'header.php';
?>

<section class ="main-container">
    <div class="main-wrapper">
        <form class="signup-form" action="includes/signup.inc.php" method="POST">
			<h2>Account Information</h2>
            <input type ="text" name ="first" placeholder="Firstname">
            <input type ="text" name ="last" placeholder="Lastname">
            <input type ="text" name ="email" placeholder="Email Address">
            <input type ="text" name ="uid" placeholder="Username">
            <input type ="password" name ="pwd" placeholder="Password">
			<h2>Personal Information</h2>
            <input type ="text" name ="age" placeholder="Age">
            <input type ="text" name ="currweight" placeholder="Current Weight (in lbs)">
            <input type ="text" name ="goalweight" placeholder="Goal Weight (in lbs)">
            <input type ="text" name ="height" placeholder="Height (in cm)">
            <button type ="submit" name="submit">Sign up</button>
        </form>
    </div>
</section>

<?php
    include_once 'footer.php';
?>