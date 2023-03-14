<style>
    * {
        margin: 0;
        padding: 0;
        left: 0px;
        top: 0px;
        z-index: 10000;
    }
    nav{
        position: fixed;
        padding: 10px;
        background-color: blue;
        width: 100%;
    }

    li{
        display: inline;
        padding: 10px;
    }

    a{
        color: white;
        text-decoration: none;
        font-family: Verdana;
        font-weight: bold;
        font-size: 12px;
    }

</style>
<nav>
    <ul>
        <li style= "float:left"><a href="index.php">Home</a></li>
        <?php
            if (empty($_SESSION['username'])){
                echo "<li style='float:right; padding-right: 2.5%'><a href='registration.php'>Register</a></li>";
            }
            else{
                echo "<li style='float:right; padding-right: 2.5%''><a href='leaderboard.php'>Leaderboard</a></li>";
            }
            ?>
        <li style= "float:right"><a href="pairs.php">Pairs</a></li>
    </ul>   
</nav>