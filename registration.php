// set session variables and cookies for user profile
// registration includes: Username + Avatar selector
// Username cannot have (: ” ! @ # % ˆ& * ( ) + = { } [ ] — ; : “ ’ < > ? /)
// Avatar selector select and configure features to assemble an emoji Avatar/image
<?php
session_start();
$page = "Registration";
$cookie_name = "user";
include("header.php");
?>
    <body>
        <form action="index.php">
            <label for="name">Username:</label><br>
            <input type="text" id="name" name="name"><br>
            <?php
            //if username contains invaild characters show error tag
            ?>
        </form>
        <?php
            $_SESSION["username"] = $_GET['name'];
        ?>
    </body>
</html>