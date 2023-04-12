<style>
    .container {
        max-width: 800px;
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

    .card:active, .card-inner:active {
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
                <button id="start-btn" onclick="start()">Start the game</button>
                <p>Attempts: <span id="attempts">1</span></p>
                <p>Score: <span id="score">0</span></p>
                <div id="game-board">
                    <div class="card" data-card="1">
                        <div class="card-inner">
                            <div class="card-front">
                                <img src="assets/card-back.jpg">
                            </div>
                            <div class="card-back">
                                <img src="assets/emoji-assets/skin/green.png">
                            </div>
                        </div>
                    </div>
                    <div class="card" data-card="2">
                        <div class="card-inner">
                            <div class="card-front">
                                <img src="assets/card-back.jpg">
                            </div>
                            <div class="card-back">
                                <img src="assets/emoji-assets/skin/red.png">
                            </div>
                        </div>
                    </div>
                    <div class="card" data-card="3">
                        <div class="card-inner">
                            <div class="card-front">
                                <img src="assets/card-back.jpg">
                            </div>
                            <div class="card-back">
                                <img src="assets/emoji-assets/skin/yellow.png">
                            </div>
                        </div>
                    </div>
                    <div class="card" data-card="4">
                        <div class="card-inner">
                            <div class="card-front">
                                <img src="assets/card-back.jpg">    
                            </div>
                            <div class="card-back">
                                <img src="assets/emoji-assets/skin/green.png">
                            </div>
                        </div>
                    </div>
                    <div class="card" data-card="5">
                        <div class="card-inner">
                            <div class="card-front">
                                <img src="assets/card-back.jpg">
                            </div>
                            <div class="card-back">
                                <img src="assets/emoji-assets/skin/red.png">
                            </div>
                        </div>
                    </div>
                    <div class="card" data-card="6">
                        <div class="card-inner">
                            <div class="card-front">
                                <img src="assets/card-back.jpg">
                            </div>
                            <div class="card-back">
                                <img src="assets/emoji-assets/skin/yellow.png">
                            </div>
                        </div>
                    </div>
                </div>
                <button id="reset-btn">Reset Game</button>
            <script src="main.js"></script>
        </div>
    </body>
</html>