
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
        padding: 5px;
        color: white;
    }

    th{
        background-color: blue;
    }

    td {
        background-color: darkgrey;
    }
</style>

<?php
    $page = "leaderboard";
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
    const leaderboard = [];

    // Adds scores to the leader board
    function displayLeaderboard(){
        html="<tr>"
            +"<th>Level</th>"
                +"<th>Avatar</th>"
                +"<th>Username</th>"
                +"<th>Score</th>"
            +"</tr>";
        console.log(leaderboard.length);
        let count = 0
        leaderboard.forEach(user => {
            count++;
            console.log("[HTML] Creating user html")
            html +="<tr>"
                +"<td>"+count+"</td>"
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

    function parseCSV(csv) {
        emptyLeaderboard()
        const lines = csv.split('\n');
        const headers = lines[0].split(',');

        for (let i = 1; i < lines.length; i++) {
            const currentLine = lines[i].split(',');
            const newUser = createUser(currentLine[0],currentLine[1],currentLine[2],currentLine[3],currentLine[4]);
            leaderboard.push(newUser);
            console.log("[LEADERBOARD] Level 1: "+ leaderboard[i-1].level+" User: "+leaderboard[i-1].username);
        }
        displayLeaderboard();
    }

    function readCSVFile() {
        file = "leaderboard.csv";
        var timestamp = new Date().getTime(); // Generate a unique timestamp

        // Append the timestamp as a query parameter to the CSV URL
        var updatedCsvUrl = file + '?t=' + timestamp;
        const xhr = new XMLHttpRequest();

        xhr.open('GET', updatedCsvUrl);
        xhr.responseType = 'text';

        xhr.onload = function() {
            const csvData = xhr.response;
            const parsedData = parseCSV(csvData);
            return parsedData;
        };

        xhr.send();
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

readCSVFile();

</script>