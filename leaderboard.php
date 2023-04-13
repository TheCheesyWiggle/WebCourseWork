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
                <table>
                <tr>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Score</th>
                </tr>
                <tr>
                    <td>User1</td>
                    <td>User1</td>
                    <td>User1</td>
                </tr>
                <tr>
                    <td>User2</td>
                    <td>User2</td>
                    <td>User2</td>
                </tr>
                <tr>
                    <td>User3</td>
                    <td>User3</td>
                    <td>User3</td>
                </tr>
                <tr>
                    <td>User4</td>
                    <td>User4</td>
                    <td>User4</td>
                </tr>
                <tr>
                    <td>User5</td>
                    <td>User5</td>
                    <td>User5</td>
                </tr>
                <tr>
                    <td>User6</td>
                    <td>User6</td>
                    <td>User6</td>
                </tr>
                <tr>
                    <td>User7</td>
                    <td>User7</td>
                    <td>User7</td>
                </tr>
                <tr>
                    <td>User8</td>
                    <td>User8</td>
                    <td>User8</td>
                </tr>
                <tr>
                    <td>User9</td>
                    <td>User9</td>
                    <td>User9</td>
                </tr>
                <tr>
                    <td>User10</td>
                    <td>User10</td>
                    <td>User10</td>
                </tr>
                </table>
            </div>
        </div>
    </body>
</html>

<script>
    // Adds scores to the leader board
    function poplateLeaderboard(){

    }

    function convertJSON(){

    }

</script>