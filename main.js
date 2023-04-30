// Get DOM elements
let cards = document.querySelectorAll('.card');
const startBtn = document.getElementById('start-btn');
const resetBtn = document.getElementById('reset-btn');
const attemptsDisplay = document.getElementById('attempts');
const scoreDisplay = document.getElementById('score');
const lookingDisplay = document.getElementById('looking');
const currentLevelDisplay = document.getElementById('level');
const gameBoard = document.getElementById('game-board');
const file = "leaderboard.csv";

// Variables
let firstCard, secondCard;
let attempts = 1;
let score = 0;
let count = 0;
let hasFlippedCard = false;
let lockBoard = false;
let startTime;
let timerInterval;
let currentLevel;
// Arrays
var leaderboard = [];
var flippedCards = [];
var scores=[];
// Dictionaries
const levels = [
    {level:1, looking:"Pairs", noCards:2},
    {level:2, looking:"Triplets", noCards:3},
    {level:3, looking:"Quadruplets", noCards:4},
    {level:4, looking:"Pairs", noCards:4},
    {level:5, looking:"Triplets", noCards:6},
    {level:6, looking:"Pairs", noCards:6},
    {level:7, looking:"Pairs", noCards:8},
    {level:8, looking:"Quadruplets", noCards:8},
    {level:9, looking:"Triplets", noCards:9},
    {level:10, looking:"Pairs", noCards:10},
    {level:11, looking:"Triplets", noCards:12},
    {level:12, looking:"Quadruplets", noCards:12},
    {level:13, looking:"Triplets", noCards:15},
    {level:14, looking:"Quadruplets", noCards:16},
    {level:15, looking:"Quadruplets", noCards:24}
]

function start() {
    //sets current level to 0
    currentLevel = 0;
    startTimer();
    genCards();
    readCSVFile();
    hideBtn();
    setupGame();
}

// Shuffle cards function
function shuffle() {
    cards.forEach(card => {
        let randomPos = Math.floor(Math.random() * 6);
        card.style.order = randomPos;
    });
}

// Setup game function
function setupGame() {
    attempts = 1;
    score = 0;
    count = 0;
    attemptsDisplay.textContent = attempts;
    scoreDisplay.textContent = score;
    console.log("[SETUP] Current Level: "+levels[currentLevel].level)
    currentLevelDisplay.textContent = levels[currentLevel].level.toString();
    lookingDisplay.textContent = levels[currentLevel].looking;
    createBoard(genCards());
    shuffle();
    resetCards();
}

function createBoard(setupCards) {
    let html = "";
    for (let i = 0; i < setupCards.length; i++) {
        html += "" 
                +"<div class='card' data-card='" + setupCards[i].data + "'>"
                    + "<div class='card-inner'>"
                        + "<div class='card-front'>"
                            + "<img src='assets/card-back.jpg'>"
                        + "</div>"
                        + "<div class='card-back'>"
                            + "<div id = 'emoji-game'>"
                                +"<img id='skin-game' src='"+setupCards[i].skinURL+"'>"
                                +"<img id='eyes-game' src='"+setupCards[i].eyesURL+"'>"
                                +"<img id='mouth-game' src='"+setupCards[i].mouthURL+"'>"
                            +"</div>"
                        + "</div>"
                    + "</div>"
                + "</div>"
    }
    document.getElementById("game-board").innerHTML = html;
    cards = document.querySelectorAll('.card');
}

// Resets cards
function resetCards() {
    cards.forEach(card => {
        card.classList.remove("flipped");
        card.childNodes[0].classList.remove("flipped");
        card.addEventListener("click", flipCard);
    });
}

// Hides the start button
function hideBtn() {
    startBtn.classList.add("disappear");
    shuffle();
    cards.forEach(card => {
        card.addEventListener('click', flipCard);
    });
}

function flipCard() {
    // Lock the board if there are already 4 cards flipped
    if (flippedCards.length >= 4) { return };
    // Don't allow the same card to be flipped twice
    if (flippedCards.includes(this)) { return };
    // Add flipped class to show the card face
    this.classList.add("flipped");
    this.childNodes[0].classList.add("flipped");
    console.log("[Flip]"+this);
    flippedCards.push(this);
    // Check if all cards have been flipped
    if (flippedCards.length === howManyToMatch()) {
        checkMatch();
    }
}

function howManyToMatch(){
    switch(levels[currentLevel].looking) {
        case "Pairs":
            return 2;
        case "Triplets":
            return 3;
        case "Quadruplets":
            return 4;
        default:
            alert("ERROR: Please revist page an error occurred")
      } 
}

function checkMatch() {
    if(calcScore>leaderboard[currentLevel].score){
        document.getElementById("container").style.backgroundColor = "#FFD700";
    }
    let matched = true;
    for (let i = 0; i < flippedCards.length - 1; i++) {
        console.log("[CHECK MATCH] card 1: "+flippedCards[i].dataset.card);
        console.log("[CHECK MATCH] card 2: "+flippedCards[i+1].dataset.card);
        if (flippedCards[i].dataset.card !== flippedCards[i+1].dataset.card) {
            matched = false;
            console.log("[CHECK MATCH] False");
            break;
        }
    }
    console.log("[CHECK MATCH] "+ matched);
    // Disable click events and update score and count
    disableCards();
    attempts++;
    document.getElementById("attempts").textContent = attempts;
    if (matched) {
        // All cards match
        let currentTime = new Date().getTime();
        const elapsedTime = currentTime - startTime;
        calcScore(elapsedTime);
        count+=flippedCards.length;
        flippedCards = [];
        checkEndLevel();
    } else {
        // Cards don't match, flip them back
        setTimeout(() => {
            for (let card of flippedCards) {
                card.classList.remove("flipped");
                card.childNodes[0].classList.remove("flipped");
            }
            flippedCards = [];
            enableCards();
            attempts++;
            document.getElementById("attempts").textContent = attempts;
        }, 1000);
    }
}

function disableCards() {
    for (let card of flippedCards) {
        card.removeEventListener("click", flipCard);
    }
}

function enableCards() {
    for (let card of document.querySelectorAll(".card:not(.flipped)")) {
        card.addEventListener("click", flipCard);
    }
}

// Checks if the game has ended
function checkEndLevel() {
    // Win and lose conditions
    if (attempts > 20) {
        // Alerts player to loss
        alert("You have lost due to too many attempts");
        // Redirects the player
        window.location.href = "./pairs.php";
    } else if (count === levels[currentLevel].noCards) {
        const elapsedTime = stopTimer();
        calcScore(elapsedTime)
        document.getElementById("score").textContent = score;
        scores.push(score);
        count = 0;
        currentLevel++;
        setupGame();
    }
}

function calcScore(elapsedTime){
    score = currentLevel*1000+Math.round((attempts*-100)- elapsedTime);
    if(score<=0){
        score = 0;
    }
}

function checkHighscore(){
    if(score>leaderboard[currentLevel].score){
        return true;
    }
    false;
}

function updateLeaderboard(){
    // Checks if user is in register session
    if (sessionStorage.getItem("insession")) {
        if(checkHighscore()===true){
            // Asks if they want theri score to be added to the leaderboard
            if (confirm("Game Ended\n You got a highscore would you like your score to go to the leader board?\n Press cancel to play again")) {
                console.log("[CSV] Adding to leaderboard...");
                // Add to leader board
                console.log("[CSV] leaderboard: "+leaderboard[currentLevel].username);
                let user = createUser(getCookie("username"), getCookie("skin"), getCookie("eyes"), getCookie("mouth"), score);
                leaderboard[currentLevel]=user;
                console.log("[CSV] leaderboard: "+leaderboard[currentLevel].username);
                //update csv file
                overwriteCSVFile();
                console.log("[CSV] Finished adding to leaderboard...");
                alert("HELLO");
                window.location.href = "./leaderboard.php";
            }
            else {
                alert("Page will reset");
                window.location.href = "./pairs.php";
                console.log("[RESET]");
            }
        }
    }
    alert("Not using registered session so the page will reset");
    window.location.href = "./pairs.php";
}

function checkEndGame(){
    if(currentLevel===15){
        updateLeaderboard();
    }
}

function emptyLeaderboard(){
    leaderboard.forEach(user=>{
        leaderboard.pop(user);
    });
}


function parseCSV(csv) {
    emptyLeaderboard()
    const lines = csv.split('\n');
    const headers = lines[0].split(',');

    for (let i = 1; i < lines.length; i++) {
        const currentLine = lines[i].split(',');
        const newUser = createUser(currentLine[0],currentLine[1],currentLine[2],currentLine[3],currentLine[4]);

        leaderboard.push(newUser);
    }
    console.log("[CSV] Leaderboard: ", leaderboard);
}

function readCSVFile() {
    const xhr = new XMLHttpRequest();

    xhr.open('GET', file);
    xhr.responseType = 'text';

    xhr.onload = function() {
        const csvData = xhr.response;
        const parsedData = parseCSV(csvData);
        return parsedData;
    };

    xhr.send();
}
function stringifyCSV() {
    const header = "username,skin,eyes,mouth,score";
    let rows = "";
    leaderboard.forEach(user =>{
        rows += user.username+","+user.skin+","+user.eyes+","+user.mouth+","+user.score+"\n";
    });
    return `${header}\n${rows}`;
  }


function overwriteCSVFile() {
    var csvData = stringifyCSV();
    // Make an AJAX request to a PHP file
    $.ajax({
        url: 'updateLeaderboard.php', // Path to your PHP file
        type: 'POST',
        data: { csvData: csvData }, // Pass the CSV data to PHP
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
        console.error('AJAX Error:', error);
        }
    });
}

function genCards() {
    var setupCards = [];
    const skin = ["green.png", "red.png", "yellow.png"];
    const eyes = ["closed.png", "laughing.png", "long.png", "normal.png", "rolling.png", "winking.png"];
    const mouth = ["open.png", "sad.png", "smiling.png", "straight.png", "surprise.png", "teeth.png"];
    switch(levels[currentLevel].looking) {
        case "Pairs":
            setupCards =addPairs(setupCards,skin,eyes,mouth)
            break;
        case "Triplets":
            setupCards = addTriplets(setupCards,skin,eyes,mouth);
            break;
        case "Quadruplets":
            setupCards = addQuadruplets(setupCards,skin,eyes,mouth);
            break;
        default:
            alert("ERROR: Please revist page an error occurred")
      } 
    
    return setupCards;
}

//TODO: Clean up add fucntions (neater way to do it)

function addPairs(setupCards,skin,eyes,mouth){
    for (let i = 0; i < levels[currentLevel].noCards/2; i++) {
        const skinRand = Math.floor(Math.random() *  skin.length);
        const eyesRand = Math.floor(Math.random() *  eyes.length);
        const mouthRand = Math.floor(Math.random() *  mouth.length);
        const skinURL = "assets/emoji-assets/skin/" + skin[skinRand];
        const eyesURL = "assets/emoji-assets/eyes/" + eyes[eyesRand];
        const mouthURL = "assets/emoji-assets/mouth/" + mouth[mouthRand];
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
    };
    return setupCards;
}
function addTriplets(setupCards,skin,eyes,mouth){
    for (let i = 0; i < levels[currentLevel].noCards/3; i++) {
        const skinRand = Math.floor(Math.random() *  skin.length);
        const eyesRand = Math.floor(Math.random() *  eyes.length);
        const mouthRand = Math.floor(Math.random() *  mouth.length);
        const skinURL = "assets/emoji-assets/skin/" + skin[skinRand];
        const eyesURL = "assets/emoji-assets/eyes/" + eyes[eyesRand];
        const mouthURL = "assets/emoji-assets/mouth/" + mouth[mouthRand];
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
    };
    return setupCards;
}
function addQuadruplets(setupCards,skin,eyes,mouth){
    for (let i = 0; i < levels[currentLevel].noCards/4; i++) {
        const skinRand = Math.floor(Math.random() *  skin.length);
        const eyesRand = Math.floor(Math.random() *  eyes.length);
        const mouthRand = Math.floor(Math.random() *  mouth.length);
        const skinURL = "assets/emoji-assets/skin/" + skin[skinRand];
        const eyesURL = "assets/emoji-assets/eyes/" + eyes[eyesRand];
        const mouthURL = "assets/emoji-assets/mouth/" + mouth[mouthRand];
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
        setupCards.push(createCard(skinURL, eyesURL, mouthURL, (i + 1)));
    };
    return setupCards;
}

function createCard(skinURL, eyesURL, mouthURL, data) {
    const card = {
        "skinURL": skinURL,
        "eyesURL": eyesURL,
        "mouthURL": mouthURL,
        "data": data,
    }
    return card;
}

function createUser(username, skinURL, eyesURL, mouthURL, score) {
    let user = {
        "username": username,
        "skin": skinURL,
        "eyes": eyesURL,
        "mouth": mouthURL,
        "score": score,
    }
    return user;
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
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

function startTimer(){
    // set the start time to the current time
  startTime = new Date().getTime();

  // start the timer and execute the callback function every second
  timerInterval = setInterval(() => {
    const currentTime = new Date().getTime();
  }, 1000);
}

function stopTimer(){
    // stop the timer
  clearInterval(timerInterval);

  // get the final elapsed time and display it in the UI
  const currentTime = new Date().getTime();
  return currentTime - startTime;
}


// Event Listeners
resetBtn.addEventListener('click', start);
startBtn.addEventListener('click', start);