

// Get DOM elements
const cards = document.querySelectorAll('.card');
const startBtn = document.getElementById('start-btn');
const resetBtn = document.getElementById('reset-btn');
const attemptsDisplay = document.getElementById('attempts');
const scoreDisplay = document.getElementById('score');
const gameBoard = document.getElementById('game-board');

// Variables
let firstCard, secondCard;
let hasFlippedCard = false;
let lockBoard = false;
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
    if (lockBoard) return;
    if (this === firstCard) return;
    this.classList.add('flip');

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
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);
    score++;
    scoreDisplay.textContent = score;
    resetBoard();
    checkForWin();
}

// Unflip non-matching cards function
function unflipCards() {
    lockBoard = true;
    attempts++;
    attemptsDisplay.textContent = attempts;
    setTimeout(() => {
        firstCard.classList.remove('flip');
        secondCard.classList.remove('flip');
        resetBoard();
    }, 1000);
}

// Reset board function
function resetBoard() {
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null];
}

// Check for win function
function checkForWin() {
    if (score === 3) {
        alert(`Congratulations! You won in ${attempts} attempts.`);
        resetGame();
    }
}

// Reset game function
function resetGame() {
    cards.forEach(card => {
        card.classList.remove('flip');
        card.addEventListener('click', flipCard);
    });
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