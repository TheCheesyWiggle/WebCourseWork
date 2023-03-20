
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
$page = "Registration";
include("header.php");
?>
    <body>
        <div id="main">
            <?php 
            include("navbar.php");
            ?>
            <div>
                <form action="index.php">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username"><br>
                    <label for="avatar">Avatar:</label><br>

                    <button type="submit" name="submit">Register</button>
                </form>
            </div>
        </div>
    </body>
</html>


