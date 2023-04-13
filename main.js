

// Get DOM elements
const cards = document.querySelectorAll('.card');
const startBtn = document.getElementById('start-btn');
const resetBtn = document.getElementById('reset-btn');
const attemptsDisplay = document.getElementById('attempts');
const scoreDisplay = document.getElementById('score');
const gameBoard = document.getElementById('game-board');

// Variables
let firstCard, secondCard;
let attempts = 1;
let score = 0;
let count = 0;
let hasFlippedCard = false;
let lockBoard = false;
const skin = ["green.png","red.png","yellow.png"];
const eyes =  ["closed.png","laughing.png","long.png","normal.png","rolling.png","winking.png"];
const mouth = ["open.png","sad.png","smiling.png","straight.png","surprise.png","teeth.png"];

function start(){
    hideBtn();
    resetGame();
}

// Shuffle cards function
function shuffle() {
    cards.forEach(card => {
        let randomPos = Math.floor(Math.random() * 6);
        card.style.order = randomPos;
    });
}

// Reset game function
function resetGame() {
    attempts = 1;
    score = 0;
    count = 0;
    attemptsDisplay.textContent = attempts;
    scoreDisplay.textContent = score;
    shuffle();
    resetCards();
}
// Resets cards
function resetCards(){
    cards.forEach(card => {
        card.classList.remove("flipped");
        card.childNodes[1].classList.remove("flipped");
        card.addEventListener("click", flipCard);
    });
}

// Hides the start button
function hideBtn(){
    startBtn.classList.add("disappear");
    shuffle();
    cards.forEach(card => {
        card.addEventListener('click', flipCard);
    });
}

function flipCard() {
    // Lock the board if there are two cards flipped
    if (lockBoard) {return};
    // Don't allow the same card to be flipped twice
    if (this === firstCard){return};
    // Add flipped class to show the card face
    this.classList.add("flipped");
    this.childNodes[1].classList.add("flipped");
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
        firstCard.childNodes[1].classList.remove("flipped");
        secondCard.classList.remove("flipped");
        secondCard.childNodes[1].classList.remove("flipped");
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
function checkEndGame(){
    // Win and lose conditions
    if(attempts>10){
        // Refreshes page
        alert("You have lost due to too many attempts");
        window.location.href = "./pairs.php";
    } else if(count===(cards.length/2)){
        score = Math.round(((cards.length/2)/attempts)*100);
        document.getElementById("score").textContent = score;
        // Checks if user is in register session
        if (sessionStorage.getItem("insession")) {
            // Asks if they want theri score to be added to the leaderboard
            if(confirm("Game Ended\n Would you like your score to go to the leader board?\n Press cancel to play again")){
                // Add to datastructure for leader board
                window.location.href = "./leaderboard.php";
            }
            else{
                resetGame();
            }
        }
        return true;
    }
    else{
        return false;
    }
}

function AddToJSON(data){
    var data = JSON.parse(txt);

}

function getJSON(){
    
    fetch('./leaderboard.json')
        .then((response) => response.json())
        .then((json) => console.log(json));

}
function saveJSON(){

}


// Event Listeners
resetBtn.addEventListener('click', resetGame);
startBtn.addEventListener('click', start);

