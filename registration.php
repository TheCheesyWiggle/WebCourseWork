<style>
    form {
        margin-top: 100px;
        background-color: grey;
        box-shadow: 5px;
        border-radius: 25px;
    }

    label,
    input,
    button {
        margin-left: 20%;
        color: black;

    }

    label {
        color: white;
    }

    button {
        background-color: blue;
        color: white;
        font-family: Verdana;
        border-style: none;
        border-radius: 25px;
        padding: 7.5px;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .grid-container-skin {
        display: grid;
        grid-template-columns: auto auto auto;
        padding: 5px;
    }

    .grid-container-rest {
        display: grid;
        grid-template-columns: auto auto auto auto auto auto;
        padding: 5px;
    }


    .grid-item {
        padding: 20px;

        text-align: center;

    }

    .grid-item:hover {
        background-color: black;
        cursor: pointer;
    }

    .image {
        max-width: 50px;
        max-height: 50px;
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
            <form id="user" method="post">
                Username: <input type="text" name="username"><br><br>
                <p>Skin</p>
                <div class="grid-container-skin">
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/skin/green.png" alt="Green">
                        <input type="radio" name="skin" value="green">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/skin/yellow.png" alt="Yellow"><input type="radio"
                            name="skin" value="yellow">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/skin/red.png" alt="Red">
                        <input type="radio" name="skin" value="red">
                    </div>
                </div>
                <p>Eyes</p>
                <div class="grid-container-rest">
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/eyes/closed.png" alt="Closed">
                        <input type="radio" name="eyes" value="closed">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/eyes/laughing.png" alt="Laughing">
                        <input type="radio" name="eyes" value="laughing">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/eyes/long.png" alt="Long">
                        <input type="radio" name="eyes" value="long">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/eyes/normal.png" alt="Normal">
                        <input type="radio" name="eyes" value="normal">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/eyes/rolling.png" alt="Rolling">
                        <input type="radio" name="eyes" value="rolling">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/eyes/winking.png" alt="Winking">
                        <input type="radio" name="eyes" value="winking">
                    </div>
                </div>
                <p>Mouth</p>
                <div class="grid-container-rest">
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/mouth/open.png" alt="Open">
                        <input type="radio" name="mouth" value="open">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/mouth/sad.png" alt="Sad">
                        <input type="radio" name="mouth" value="sad">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/mouth/smiling.png" alt="Smiling">
                        <input type="radio" name="mouth" value="smiling">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/mouth/straight.png" alt="Straight">
                        <input type="radio" name="mouth" value="straight2>
                        </div>
                        <div class=" grid-item">
                        <img class="image" src="assets/emoji-assets/mouth/surprise.png" alt="Surprise">
                        <input type="radio" name="mouth" value="surprise">
                    </div>
                    <div class="grid-item">
                        <img class="image" src="assets/emoji-assets/mouth/teeth.png" alt="Teeth">
                        <input type="radio" name="mouth" value="teeth">
                    </div>
                </div>
                <input class="submit" type="submit" name="submit-btn" id="submit-btn" value="Register">
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST["submit-btn"])) {
        $_SESSION["insession"] = true;
        setcookie('username', $_POST['username']);
        setcookie('skin', $_POST['skin']);
        setcookie('eyes',$_POST['eyes']);
        setcookie('mouth',$_POST['mouth']);
    }
    ?>
</body>

</html>