<style>
    #container {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        background-color: grey;
        margin-top: 5rem;
        padding-bottom: 25px;
        border-radius: 25px;
        box-shadow: 5px;
    }

    h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    #game-board {
        display: flex;
        flex-wrap: wrap;
        margin-top: 2rem;
        margin-bottom: 2rem;
        justify-content: center;
    }
    .card {
        background-color: transparent;
        width: 100px;
        height: 100px;
        perspective: 1000px;
        border: solid grey;
        margin: 5px;
    }
    .card-inner {
        position: relative;
        width: 100px;
        height: 100px;
        text-align: center;
        transition: transform 0.5s;
        transform-style: preserve-3d;
        border: 2px solid black;
    }

    .flipped {
        transform: rotateY(180deg);
    }

    .card-front, .card-back {
        position: absolute;
        width: 100px;
        height: 100px;
        backface-visibility: hidden;
    }
    .card-front {
        background-color: blue;
       
    }
    .card-back img, .card-front img{
        height: 100px;
        width: 100px;
    }

    .card-back {
        background-color: white;
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

    #emoji-game{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100px;
    }

    #skin-game, #eyes-game, #mouth-game {
        height: 100px;
        margin: 0 10px;
        position: absolute;
        top: auto;
        left: auto;
    }

    #eyes-game{
        margin-bottom: 5px;
    }
</style>

<?php
    $page = "memory";
    include_once("header.php");
?>
    <body>
        <div id="main">
            <?php
            include_once("navbar.php");
            ?>
            <div id="container">
                <h1>Memory Game</h1>
                <button id="start-btn">Start the game</button>
                <p>Attempts: <span id="attempts">1</span></p>
                <p>Score: <span id="score">0</span></p>
                <p>Looking for: <span id="looking">Pairs</span></p>
                <p>Current Level: <span id="level">1</span></p>
                <div id="game-board">
                    <!-- Game Board dynamically generated -->
                </div>
                <button id="reset-btn">Reset Game</button>
            <script src="main.js"></script>
        </div>
    </body>
</html>