

<?php
$page = "Home";
include_once("header.php"); 
?>

    <body>
        <div id="main">
            <?php
            if (empty($_SESSION['username'])){
                echo "<p>You are not using a registered session?<p>";
                echo "<a href='registration.php'>Register now</a>";
            }else{
                echo "<h1>Welcome to Pairs</h1>";
                echo "<a href='pairs.php'>Click here to play!</a>";
            }
            ?>
        </div>
    </body>
</html>