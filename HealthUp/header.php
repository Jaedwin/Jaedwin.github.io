<?php
    session_start();
?>
    
<!DOCTYPE html>
<html>
<head>
    <title>HealthUp</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav>
        <div class ="main-wrapper">
            <img src="healthUP.png">
            <ul>
             <?php
                    if(isset($_SESSION['u_id'])){
                        $id = $_SESSION['u_id'];
                        if($id != 0){
                            echo '<li><a href ="index.php">Home</a></li>
                            <li><a href ="nutrition_plan.php">Nutrition Plan</a></li>
                            <li><a href ="workout_routine.php">Workout Routine</a></li>
                            <li><a href ="client.php">Client</a></li>';
                        }
                    }else{
                        echo '<li><a href ="index.php">Home</a></li>';
                    }
                ?>
            </ul>
            <div class ="nav-login">
                <?php
                    if(isset($_SESSION['u_id'])){
                            echo '<form action="includes/logout.inc.php" method="POST">
                                    <button type="submit" name="submit">Logout</button>
                                    </form>';
                    }else{
                        echo '<form action="includes/login.inc.php" method="POST">
                    <input type ="text" name="uid" placeholder="Username/Email">
                    <input type ="password" name="pwd" placeholder="Password">
                    <button type="submit" name="submit">Login</button>
                </form>
                <a href="signup.php">Sign up</a>';
                    }
                ?>
            </div>
        </div>
    </niv>
</header>