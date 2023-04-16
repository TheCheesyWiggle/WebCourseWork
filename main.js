// Get DOM elements
let cards = document.querySelectorAll('.card');
const startBtn = document.getElementById('start-btn');
const resetBtn = document.getElementById('reset-btn');
const attemptsDisplay = document.getElementById('attempts');
const scoreDisplay = document.getElementById('score');
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
// Arrays
var leaderboard = [];

function start() {
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
    createBoard(genCards());
    shuffle();
    resetCards();
}

function createBoard(setupCards) {
    let html = "";
    for (let i = 0; i < 10; i++) {
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
    // Lock the board if there are two cards flipped
    if (lockBoard) { return };
    // Don't allow the same card to be flipped twice
    if (this === firstCard) { return };
    // Add flipped class to show the card face
    this.classList.add("flipped");
    this.childNodes[0].classList.add("flipped");
    if (!hasFlippedCard) {
        // This is the first card flipped
        hasFlippedCard = true;
        firstCard = this;
        return;
    }
    // This is the second card flipped
    hasFlippedCard = false;
    secondCard = this;
    // Check if the two cards match
    if (firstCard.dataset.card === secondCard.dataset.card) {
        // The cards match, disable click events and increase score and count
        disableCards();
        attempts++;
        document.getElementById("attempts").textContent = attempts;
        count++;
        checkEndGame();
    } else {
        // The cards don't match, flip them back
        lockBoard = true;
        setTimeout(() => {
            firstCard.classList.remove("flipped");
            firstCard.childNodes[0].classList.remove("flipped");
            secondCard.classList.remove("flipped");
            secondCard.childNodes[0].classList.remove("flipped");
            lockBoard = false;
            attempts++;
            document.getElementById("attempts").textContent = attempts;
        }, 1000);
    }
}

// Disable click events on matched cards
function disableCards() {
    firstCard.removeEventListener("click", flipCard);
    secondCard.removeEventListener("click", flipCard);
}

// Checks if the game has ended
function checkEndGame() {
    // Win and lose conditions
    if (attempts > 20) {
        // Alerts user to loss
        alert("You have lost due to too many attempts");
        window.location.href = "./pairs.php";
    } else if (count === (cards.length / 2)) {
        const elapsedTime = stopTimer();
        score = Math.round((attempts*100)+ elapsedTime);
        document.getElementById("score").textContent = score;
        // Checks if user is in register session
        if (sessionStorage.getItem("insession")) {
            // Asks if they want theri score to be added to the leaderboard
            if (confirm("Game Ended\n Would you like your score to go to the leader board?\n Press cancel to play again")) {
                console.log("[CSV] Adding to leaderboard...");
                // Add to leader board
                let user = createUser(getCookie("username"), getCookie("skin"), getCookie("eyes"), getCookie("mouth"), score);
                leaderboard.push(user);
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
        alert("Not using registered session so the page will reset");
        window.location.href = "./pairs.php";
    }
    else {
        return false;
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

function downloadFile(text) {
    const element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', file);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}
function overwriteCSVFile() {
    // Read the existing CSV file
    const xhr = new XMLHttpRequest();
    xhr.open('GET', file);
    xhr.responseType = 'text';
    xhr.onload = function() {
        // Convert the leaderboards to csv string
        const csvString = stringifyCSV();

        // Overwrite the existing CSV file with the updated data
        const blob = new Blob([csvString], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);

        downloadFile(csvString);
    };
    xhr.send();
}

function genCards() {
    var setupCards = [];
    const skin = ["green.png", "red.png", "yellow.png"];
    const eyes = ["closed.png", "laughing.png", "long.png", "normal.png", "rolling.png", "winking.png"];
    const mouth = ["open.png", "sad.png", "smiling.png", "straight.png", "surprise.png", "teeth.png"];
    for (let i = 0; i < 5; i++) {
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
    const elapsedTime = currentTime - startTime;
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
resetBtn.addEventListener('click', setupGame);
startBtn.addEventListener('click', start);