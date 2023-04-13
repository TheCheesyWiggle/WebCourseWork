// div with grey background
// formatted tabel with usernames and sorted by best scores per level and in total
// table has 2px border
// use database

<style>
    .leaderboard{
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        background-color: grey;
        margin-top: 5rem;
        padding-bottom: 25px;
        border-radius: 25px;
        box-shadow: 5px;
    }
    .leaderboard h1{    
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    table, th, td {
        border: 2px solid grey;
        border-collapse: collapse;
    }

    table{
        margin-left: auto;
        margin-right: auto;
    }

    th, td{
        background-color: blue;
        padding: 5px;
        border-radius: 7.5px;
        color: white;
    }

</style>

<?php
    $page = "Leaderboard";
    include_once("header.php");
?>
    <body>
        <div id="main">
            <?php
            include_once("navbar.php");
            ?>
            <div class="leaderboard">
                <h1>Leaderboard </h1>
                <table id="table">
                </table>
            </div>
        </div>
    </body>
</html>

<script>
    var leaderboard =[];

    // Adds scores to the leader board
    function displayLeaderboard(){
        html="<tr>"
                +"<th>Avatar</th>"
                +"<th>Username</th>"
                +"<th>Score</th>"
            +"</tr>";
        console.log(leaderboard.length);
        leaderboard.forEach(user => {
            console.log("[HTML] Creating user html")
            html +="<tr>"
                +"<td><div id = 'emoji_nav'>"
                    +"<img id='skin_nav' src='"+user.skin+"'>"
                    +"<img id='eyes_nav' src='"+user.eyes+"'>"
                    +"<img id='mouth_nav' src='"+user.mouth+"'>"
                    +"</div></td>"
                +"<td>"+user.username+"</td>"
                +"<td>"+user.score+"</td>"
            +"</tr>"
        });

        document.getElementById("table").innerHTML= html;
    }

function loadJSON(){
    console.log("[JSON] Empting local leaderboard");
    emptyLeaderboard()
    console.log("[JSON] Loading...");
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'leaderboard.json');
    xhr.responseType = 'json';
    // Send the request to retrieve the JSON data
    xhr.send();
    
    xhr.onload = function() {
        // Check status code to see id it was succesfull
        if (xhr.status === 200) {
            let XMLresponse = JSON.parse(JSON.stringify(xhr.response)).scores;
            console.log("[XML] XMLResponse: "+XMLresponse );
            // Populate leaderboard in here because otherwise it executes before the XML data has loaded
            populateLeaderboard(XMLresponse);
            sortLeaderboard();
            displayLeaderboard();
        }
    }; 
}

function createUser(username, skinURL, eyesURL, mouthURL, score){
    console.log("[JS] Creating user...");
    let user = {
        "username": username,
        "skin": skinURL,
        "eyes": eyesURL,
        "mouth": mouthURL,
        "score":score,
    }
    return user;
}

function emptyLeaderboard(){
    leaderboard.forEach(user=>{
        leaderboard.pop(user);
    });
}

function populateLeaderboard(XMLresponse){
    if (XMLresponse !== undefined && XMLresponse !== null) {
            XMLresponse.forEach(element =>{
            leaderboard.push(createUser(element.username, element.skin, element.eyes, element.mouth, element.score))
        });
    }
    else{
        console.log("[POPULATE] ERROR");
    }
    console.log("[LEADERBOARD] Leaderboard: "+leaderboard)
    
}

function sortLeaderboard(){
    leaderboard.sort((a, b) => {
        return b.score - a.score;
    });
}

loadJSON();

</script>