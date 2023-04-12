

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


// Shuffle cards function
function shuffle() {
    cards.forEach(card => {
        let randomPos = Math.floor(Math.random() * 6);
        card.style.order = randomPos;
    });
}

// Flip card function
function flipCard() {
    //flips the card face up
}

// Check for card match function
function checkForMatch() {
    let isMatch = firstCard.dataset.card === secondCard.dataset.card;
    isMatch ? disableCards() : unflipCards();
}

// Disable matched cards function
function disableCards() {
    //keeps matched cards face up
}

// Unflip non-matching cards function
function unflipCards() {
    // returns cards if match is false
}

// Reset board function
function resetBoard() {
    // resets board after guess
}

// Check for Game End
function checkEndOfGame() {
    //all cards turned over
    //ask user to add to leader board
}

// Reset game function
function resetGame() {
    // resets the game
    attempts = 1;
    score = 0;
    attemptsDisplay.textContent = attempts;
    scoreDisplay.textContent = score;
    shuffle();
}

resetBtn.addEventListener('click', resetGame);

function hideBtn(){
    startBtn.classList.add("disappear");
    shuffle();
    cards.forEach(card => {
        card.addEventListener('click', flipCard);
    });
}