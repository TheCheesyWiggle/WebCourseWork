<style>
    form {
        margin-top: 100px;
        background-color: grey;
        box-shadow: 5px;
        border-radius: 25px;
        justify-content: center;
    }
    /* Slideshow container */
    .container {
    position: relative;
    margin: auto;
    }
    /*
    #emoji{
        position: relative;
    }
    
    #emoji img {
        position: absolute;
        top: 0;
        left: 0;
        height: 250px;
        width: 250px;
    }*/

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
                    <img id="skin" src="assets/emoji-assets/skin/green.png" alt="green">
                    <img id="eyes" src="assets/emoji-assets/eyes/closed.png" alt="closed">
                    <img id="mouth" src="assets/emoji-assets/mouth/open.png" alt="open">
                </div>
                <div>
                    <button class="prev" onclick="change_skin(-1)" >&#10094;</button>
                    Skin
                    <button class="next" onclick="change_skin(1)" >&#10095;</button>
                    <button class="prev" onclick="add_image(-1)" >&#10094;</button>
                    Mouth
                    <button class="next" onclick="add_image(1)" >&#10095;</button>
                    <button class="prev" onclick="add_image(-1)" >&#10094;</button>
                    Eyes
                    <button class="next" onclick="plusSlides(1)">&#10095;</button>
                </div>
            </div>
        </form>
</body>
<script>
    const skin = ["green.png","red.png","yellow.png"];
    const eyes =  ["closed.png","laughing.png","long.png","normal.png","rolling.png","winking.png"];
    const mouth = ["open.png","sad.png","smiling.png","straight.png","surprised.png","teeth.png"];
    let skin_index = 1;
    let eyes_index = 1;
    let mouth_index = 1;

    function change_skin(index) {
        var image  = document.getElementById('skin');
        image.src = "assets/emoji-assets/skin/red.png";
        console.log("Works");
    }
</script>
</html>