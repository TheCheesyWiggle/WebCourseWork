<style>
    .container{
        display: flex; 
        align-items: center;
        margin: 0 auto; 
        margin-top: 100px;
        background-color: grey;
        box-shadow: 5px;
        border-radius: 25px;
        width: 50%;
        position: relative;
        display: flex;
        flex-direction: column;
        text-align: center;
    }
    #user {
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

    #eyes {
        margin-bottom: 40px;
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
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registration</title>
        <link rel="stylesheet" href="global.css" type="text/css">
    </head>
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
                </form>
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
    </body>
    <script>
        const skin = ["green.png","red.png","yellow.png"];
        const eyes =  ["closed.png","laughing.png","long.png","normal.png","rolling.png","winking.png"];
        const mouth = ["open.png","sad.png","smiling.png","straight.png","surprise.png","teeth.png"];
        let skindex = 1;
        let eyes_index = 1;
        let mouth_index = 1;

        function change_skin(select) {
            skindex = Math.abs(avatar_helper(skindex+select) % 3);
            url = "assets/emoji-assets/skin/"+skin[skindex];
            console.log(url);
            let img = document.querySelector("#skin");
            img.setAttribute("src",url);

        }

        function change_eyes(select) {
            eyes_index = Math.abs(avatar_helper(eyes_index+select) % 6);
            url = "assets/emoji-assets/eyes/"+eyes[eyes_index];
            console.log(url);
            let img = document.querySelector("#eyes");
            img.setAttribute("src",url);

        }
        function change_mouth(select) {
            mouth_index = Math.abs(avatar_helper(mouth_index+select) % 6);
            url = "assets/emoji-assets/mouth/"+mouth[mouth_index];
            console.log(url);
            let img = document.querySelector("#mouth");
            img.setAttribute("src",url);

        }

        //allows the user to scroll backwards without getting into a loop due to abs values
        function avatar_helper(number){
            if(number===-1){
                return 5
            }
            else{
                return number;
            }
        }

        // validates the username
        function validation(){
            const invalidChars = /[!@#%^&*()+={}\[\]\—;:'"<>\?/]/;
            const username = document.getElementById("username").value;
            console.log("Invalid chars: "+ invalidChars.test(username.value));
            if (invalidChars.test(username)) {
                alert("Error: Username contains invalid characters.");
                document.getElementById("user").reset(); 
            } else if(document.getElementById("username").value.length<=0){
                alert("Error: Username needs to contain characters");
                document.getElementById("user").reset(); 
            } else {

                let skinURL = document.getElementById("skin").src;
                let mouthURL = document.getElementById("mouth").src;
                let eyeURL = document.getElementById("eyes").src;
                setcookies(username, skinURL, eyeURL, mouthURL);
                setsession(username);

                window.location.href = "./index.php";
            }

        }

        function setcookies(username,skinURL,eyesURL,mouthURL){
            document.cookie = "username=" + username;
            document.cookie = "skin="+skinURL;
            document.cookie = "eyes=" + eyesURL;
            document.cookie = "mouth="+ mouthURL;
        }

        function setsession(username){
            sessionStorage.setItem("username", username);
            sessionStorage.setItem("insession", true);
        }
    </script>
</html>