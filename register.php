
<?php

session_start();

$_SESSION["username"] = $_GET["username"];

header("index.php");

echo "<script>console.log('Debug Objects: " . $_SESSION["username"]. "' );</script>";
?>
