
<style>
    #content{
        background-color: blue;
        color: white;
        margin-top: 17.5rem;
        text-align: center;
        border-radius: 20px;
        min-width: 160px;
        max-width: 350px;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>
<?php
$page = "Home";
include_once("header.php");
?>

    <body>
        <div id="main">
            <?php
            include_once("navbar.php");
            ?>
            <div id="content">
            </div>
        </div>
    </body>
</html>
<script>

    let button = "";

    if (sessionStorage.getItem("insession")) {
        button += "<p>Welcome to Pairs</p>"
            +"<a href='pairs.php'>Click here to play!</a>";
    } else {
        button += "<p>You are not using a registered session?<p>"
            +"<a href='registration.php'>Register now</a>";
    }

    document.getElementById("content").innerHTML = button;
</script>