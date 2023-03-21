
<style>
    form{
        margin-top: 100px;
        background-color: grey;
        box-shadow: 5px;
        border-radius: 25px;
    }
    label, input, button{
        margin-left: 20%;
        color: black;

    }

    label{
        color: white;
    }

    button{
        background-color: blue;
        color: white;
        font-family: Verdana;
        border-style: none;
        border-radius: 25px;
        padding: 7.5px;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    
</style>
<?php
session_start();
$page = "Registration";
include("header.php");
?>
    <body>
        <div id="main">
            <?php 
            include("navbar.php");
            ?>
            <div>
                <form id="user" action="index.php" method="get">
                Username: <input type="text" name="username"><br><br>
                <input type="submit" onclick="myFunction()">
                </form>
            </div>
        </div>
        <script>
            function getDetails(){
                document.getElementById("user").submit();
            }
        </script>
    </body>
</html>


