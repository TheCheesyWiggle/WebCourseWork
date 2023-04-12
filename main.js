

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

function start(){
    hideBtn();
    setupBoard();
}

//sets up the board
function setupBoard(){
    shuffle();
}

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
    if (lockBoard) return;
    if (this === firstCard) return;
    this.classList.add('card-back');

    if (!hasFlippedCard) {
        // First card
        hasFlippedCard = true;
        firstCard = this;
    } else {
        // Second card
        hasFlippedCard = false;
        secondCard = this;
        checkForMatch();
    }
}

// Check for card match function
function checkForMatch() {
    let isMatch = firstCard.dataset.card === secondCard.dataset.card;
    isMatch ? disableCards() : unflipCards();
}

// Disable matched cards function
function disableCards() {
    //keeps matched cards face up
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);
    score++;
    scoreDisplay.textContent = score;
    resetBoard();
}

// Unflip non-matching cards function
function unflipCards() {
    // returns cards if match is false
    lockBoard = true;
    attempts++;
    attemptsDisplay.textContent = attempts;
    setTimeout(() => {
        firstCard.classList.remove('card-front');
        secondCard.classList.remove('card-front');
        resetBoard();
    }, 1000);
}

// Reset board function
function resetBoard() {
    // resets board after guess
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null];
}

// Check for Game End
function checkEndOfGame() {
    //all cards turned over
    //ask user to add to leader board
}

// Reset game function
function resetGame() {
    attempts = 1;
    score = 0;
    attemptsDisplay.textContent = attempts;
    scoreDisplay.textContent = score;
    shuffle();
}

// Hides the start button
function hideBtn(){
    startBtn.classList.add("disappear");
    shuffle();
    cards.forEach(card => {
        card.addEventListener('click', flipCard);
    });
}


// Event Listeners
resetBtn.addEventListener('click', resetGame);
startBtn.addEventListener('click', start);

