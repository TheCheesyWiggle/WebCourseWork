<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        background-color: grey;
        margin-top: 5rem;
        padding-bottom: 25px;
        border-radius: 25px;
    }

    h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    #game-board {
        display: flex;
        flex-wrap: wrap;
        margin-top: 2rem;
        justify-content: center;
        box-shadow: 5px;
    }
    .card {
        width: 100px;
        height: 100px;
        margin: 10px;
        position: relative;
        cursor: pointer;
        transform-style: preserve-3d;
        transition: transform 0.5s;
    }
    .card img {
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
    }

    .card.active {
        transform: rotateY(180deg);
    }


    #start-btn,
    #reset-btn {
        background-color: blue;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        margin-top: 1rem;
        cursor: pointer;
        font-size: 1rem;
    }
    #start-btn:hover, #reset-btn:hover{
        background-color: darkblue;
    }

    #start-btn.disappear{
        display:none;
    }

    #reset-btn {
        margin-left: 1rem;
    }
</style>

<?php
    $page = "Pairs";
    include_once("header.php");
?>
    <body>
        <div id="main">
            <?php
            include_once("navbar.php");
            ?>
            <div class="container">
                <h1>Memory Game</h1>
                <button id="start-btn" onclick="hideBtn()">Start the game</button>
                <p>Attempts: <span id="attempts">1</span></p>
                <p>Score: <span id="score">0</span></p>
                <div id="game-board">
                    <div class="card" data-card="1"><img src="assets/emoji-assets/skin/green.png"></div>
                    <div class="card" data-card="2"><img src="assets/emoji-assets/skin/red.png"></div>
                    <div class="card" data-card="3"><img src="assets/emoji-assets/skin/yellow.png"></div>
                    <div class="card" data-card="1"><img src="assets/emoji-assets/skin/green.png"></div>
                    <div class="card" data-card="2"><img src="assets/emoji-assets/skin/red.png"></div>
                    <div class="card" data-card="3"><img src="assets/emoji-assets/skin/yellow.png"></div>
                </div>
                <button id="reset-btn">Reset Game</button>
            <script src="main.js"></script>
        </div>
    </body>
</html>