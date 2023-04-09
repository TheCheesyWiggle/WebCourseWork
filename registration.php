<style>
    form {
        margin-top: 100px;
        background-color: grey;
        box-shadow: 5px;
        border-radius: 25px;
    }
    /* Slideshow container */
    .container {
    max-width: 1000px;
    position: relative;
    margin: auto;
    }

    .emoji{
        position: relative;
    }
    img {
        position: absolute;
        height: 250px;
        width: 250px;
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
        <form id="user" method="post">
            Username: <input type="text" name="username"><br>
            Cannot Inlude: ” ! @ # % ˆ& * ( ) + = { } [ ] — ; : “ ’ < > ? /
            <br>
            <div class="container">
                <div id = "emoji">
                    <img src="assets/emoji-assets/skin/green.png" alt="green">
                    <img src="assets/emoji-assets/eyes/closed.png" alt="closed">
                    <img src="assets/emoji-assets/mouth/open.png" alt="open">
                </div>
                <div>
                    <button class="prev" onclick="add_image_s()" >&#10094;</button>
                    Skin
                    <button class="prev" onclick="add_image(-1)" >&#10095;</button>
                    <button class="next" onclick="add_image(1)" >&#10094;</button>
                    Mouth
                    <button class="prev" onclick="add_image(-1)" >&#10095;</button>
                    <button class="next" onclick="add_image(1)" >&#10094;</button>
                    Eyes
                    <button class="next" onclick="plusSlides(1)">&#10095;</button>
                </div>
            </div>
        </form>
</body>
<script src="registration.js"></script>
</html>