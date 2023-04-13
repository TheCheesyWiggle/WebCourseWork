

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

function start(){
    hideBtn();
    setupBoard();
}

//sets up the board
function setupBoard(){
    shuffle();
    resetCards();
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

    console.log(firstCard.dataset.card === secondCard.dataset.card);
    console.log(firstCard.dataset.card);
    console.log(secondCard.dataset.card);
    // Check if the two cards match
    if (firstCard.dataset.card === secondCard.dataset.card) {
      // The cards match, disable click events and increase score and count
      disableCards();
      score++;
      count++;
      document.getElementById("score").textContent = score;
      console.log("Game:"+checkEndGame())
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

// Function to disable click events on matched cards
function disableCards() {
    firstCard.removeEventListener("click", flipCard);
    secondCard.removeEventListener("click", flipCard);
}

// Checks if the game has ended
function checkEndGame(){
    if(count===(cards.length/2)){
        alert("You Win");
        return true;
    }
    else{
        return false;
    }
}

// Event Listeners
resetBtn.addEventListener('click', resetGame);
startBtn.addEventListener('click', start);

