<?php
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
        $_SESSION["username"] = $username;
        setcookie("username",$username);
    }
    
    if(isset($_POST["skin"])){
        $skin = $_POST['skin'];
        setcookie("skin",$skin);
    }

    if(isset($_POST["eyes"])){
        $eyes = $_POST['eyes'];
        setcookie("eyes",$eyes);
    }

    if(isset($_POST["mouth"])){
        $mouth = $_POST['mouth'];
        setcookie("mouth",$mouth);
    }
?>