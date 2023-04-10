<style>
    .container{
        margin-top: 100px;
        display: flex; 
        align-items: center; 
    }
    #user {
        margin-top: 100px;
        background-color: grey;
        box-shadow: 5px;
        border-radius: 25px;
        width: 50%;
        margin: 0 auto;
        position: relative;
        display: flex;
        flex-direction: column;
        text-align: center;
    }
    #user p{
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    #emoji{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 250px;
    }

    #skin, #eyes, #mouth {
        height: 250px;
        margin: 0 10px;
        position: absolute;
        top: auto;
        left: auto;
    }

    .selectors {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        margin bottom: 10px;
        flex-wrap: wrap;
        margin-bottom: 10px;

    }
    .prev, .next {
        background-color: blue;
        border: none;
        color: white;
        cursor: pointer;
        padding: 10px 15px;
        margin: 0 5px;
        font-size: 14px;
        border-radius: 5px;
    }
    .prev:hover, .next:hover{
        background-color: darkblue;
    }

    .submit {
        background-color: blue;
        border: none;
        color: white;
        cursor: pointer;
        padding: 10px 15px;
        margin: 0 5px;
        font-size: 14px;
        border-radius: 5px;
    }
    .submit:hover{
        background-color: darkblue;
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
        <div class="container">
            <form id="user" method="post">
                <p>
                    Username: <input type="text" name="username" id="username"><br>
                    <div>Cannot Include: ” ! @ # % ˆ& * ( ) + = { } [ ] — ; : “ ’ < > ? /</div>
                </p>
                <br>
                <div class="container-2">
                    <div id = "emoji">
                        <img id="skin" src="assets/emoji-assets/skin/green.png">
                        <img id="eyes" src="assets/emoji-assets/eyes/closed.png">
                        <img id="mouth" src="assets/emoji-assets/mouth/open.png">
                    </div>
                    <div class="selectors">
                        <button class="prev" onclick="change_skin(-1)" >&#10094;</button>
                        Skin
                        <button class="next" onclick="change_skin(1)" >&#10095;</button>
                        <button class="prev" onclick="change_eyes(-1)" >&#10094;</button>
                        Eyes
                        <button class="next" onclick="change_eyes(1)" >&#10095;</button>
                        <button class="prev" onclick="change_mouth(-1)" >&#10094;</button>
                        Mouth
                        <button class="next" onclick="change_mouth(1)">&#10095;</button>

                        <button class="submit" onclick="validation()">Submit</button>
                    </div>
                </div>
            </form>
        </div>
</body>
<script>
    const skin = ["green.png","red.png","yellow.png"];
    const eyes =  ["closed.png","laughing.png","long.png","normal.png","rolling.png","winking.png"];
    const mouth = ["open.png","sad.png","smiling.png","straight.png","surprised.png","teeth.png"];
    let skindex = 0;
    let eyes_index = 0;
    let mouth_index = 0;

    function change_skin(select) {
        var image  = document.getElementById('skin');
        console.log(select);
        skindex =+ select;
        console.log(skindex);
        image.src = ("assets/emoji-assets/skin/"+skin[skindex]).src;
        console.log(document.getElementById('skin').src);
    }

    function change_eyes(index) {
        const source ="assets/emoji-assets/eyes/normal.png";
        const img = document.querySelector('#eyes');
        console.log(document.querySelector('#eyes').getAttribute("src"));
        img.removeAttribute("src");
        console.log(document.querySelector('#eyes').getAttribute("src"));
    }
    function change_mouth(index) {
        var image  = document.getElementById('mouth');
        image.src = "assets/emoji-assets/mouth/"+mouth[2];
        console.log("Works M");
    }

    function validation(){
        const invalidChars = /[!@#%^&*()+={}\[\]\—;:'"<>\?/]/;
        if (invalidChars.test(document.getElementById("username").value)) {
            alert("Error: Username contains invalid characters.");
        } else if(document.getElementById("username").length<0){
            alert("Error: No characters.");
        } else {
            alert("Username is valid.");
        }

    }
</script>
</html>