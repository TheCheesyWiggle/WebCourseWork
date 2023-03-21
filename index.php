
<style>
    #content{
        background-color: blue;
        color: white;
        border-radius: 25px;
        position: absolute;
        top: 50%;
        left: 50%;
        text-align: center;
        width: 40%;
        min-width: 160px;
        max-width: 350px;
    }
</style>
<?php
$page = "Home";
include_once("header.php");
$_SESSION["username"] = $_GET["username"];
?>

    <body>
        <div id="main">
            <?php
            include_once("navbar.php");
            ?>
            <div id="content">
                <div>
                    <?php
                    if (empty($_SESSION["username"])){;
                        echo "<p>You are not using a registered session?<p>";
                        echo "<a href='registration.php'>Register now</a>";
                    }else{
                        echo "<p>Welcome to Pairs</p>";
                        echo "<a href='pairs.php'>Click here to play!</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>