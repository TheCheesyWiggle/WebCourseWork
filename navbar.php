<style>
    * {
        margin: 0;
        padding: 0;
        left: 0px;
        top: 0px;
        z-index: 10000;
    }
    nav{
        position: fixed;
        padding: 10px;
        background-color: blue;
        width: 100%;
    }

    li{
        display: inline;
        padding: 10px;
    }

    a{
        color: white;
        text-decoration: none;
        font-family: Verdana;
        font-weight: bold;
        font-size: 12px;
    }
    #emoji_nav{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 25px;
    }

    #skin_nav, #eyes_nav, #mouth_nav {
        height: 25px;
        margin: 0 10px;
        position: absolute;
        top: auto;
        left: auto;
    }

    #eyes_nav{
        margin-bottom: 5px;
    }

</style>
<nav>
    <ul id="list">
        <li style= "float:left"><a href="index.php">Home</a></li> 
        <li id="dynamic" style="float:right; padding-right: 2.5%"></li>
        <li style= "float:right;"><a href="pairs.php">Pairs</a></li>
        <li id="avatar" style="float:right; padding-right: 2.5%"></li>
    </ul>   
</nav>
<script>

    let content = "";
    let emoji = "";
    let skinURL = getCookie("skin");
    let eyesURL = getCookie("eyes");
    let mouthURL = getCookie("mouth");

    if (sessionStorage.getItem("insession")) {
        content += "<a href='leaderboard.php'>Leaderboard</a>";
        emoji += "<div id = 'emoji_nav'>"
                    +"<img id='skin_nav' src='"+skinURL+"'>"
                    +"<img id='eyes_nav' src='"+eyesURL+"'>"
                    +"<img id='mouth_nav' src='"+mouthURL+"'>"
                    +"</div>";
    } else {
        content += "<a href='registration.php'>Register</a>";
    }

    document.getElementById("dynamic").innerHTML = content;
    document.getElementById("avatar").innerHTML = emoji;

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
            }
        }
        return null;
    }
</script>