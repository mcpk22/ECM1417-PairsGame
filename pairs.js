class Game {
  constructor(level) {
    this.level = level;
    this.pairs = 0;
    this.cardsToMatch = 0;
    this.timeAllowed = 0;
    this.attemptsAllowed = 0;
    this.thirdCard = null;
    this.fourthCard = null;
    this.matchedCards = 0;
    this.gameStarted = false;  
    
    
    this.configureLevel();
  }

configureLevel() {
  switch (this.level) {
    case 1:
      this.pairs = 7;
      this.cardsToMatch = 2;
      this.timeAllowed = 60; // Adjust this to the original time allowed in your game
      this.attemptsAllowed = 20;
      break;
    case 2:
      this.pairs = 8;
      this.cardsToMatch = 2;
      this.timeAllowed = 50; // 10 seconds less than level 1
      this.attemptsAllowed = 25;
      break;
    case 3: //level 3 matching 3 cards
      this.pairs = 7;
      this.cardsToMatch = 3;
      this.timeAllowed = 150; 
      this.attemptsAllowed = 45;
      break;
    case 4:
      this.pairs = 10;
      this.cardsToMatch = 3;
      this.timeAllowed = 135; 
      this.attemptsAllowed = 80;
      break;
    case 5: // level 5 matching 4 cards
      this.pairs = 7;
      this.cardsToMatch = 4;
      this.timeAllowed = 130; 
      this.attemptsAllowed = 80;
      break;
      default:
      console.error("Invalid level");
  }
}
  
  
getRandomItem(arr) {
  return arr[Math.floor(Math.random() * arr.length)];
}

generateRandomAvatar() {
  const eyes = ['closed.png', 'laughing.png', 'long.png', 'normal.png', 'rolling.png', 'winking.png'];
  const mouth = ['open.png', 'sad.png', 'smiling.png', 'straight.png', 'surprise.png', 'teeth.png'];
  const skin = ['green.png', 'yellow.png', 'red.png'];

  const randomEyes = this.getRandomItem(eyes);
  const randomMouth = this.getRandomItem(mouth);
  const randomSkin = this.getRandomItem(skin);

  return {
  eyes: randomEyes,
  mouth: randomMouth,
  skin: randomSkin
  };
}

shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
}

createAvatarElement(avatar) {
  const avatarElement = document.createElement('div');
  avatarElement.classList.add('avatar');

  const skinElement = document.createElement('img');
  skinElement.src = 'emoji_assets/emoji_assets/skin/' + avatar.skin;
  avatarElement.appendChild(skinElement);

  const eyesElement = document.createElement('img');
  eyesElement.src = 'emoji_assets/emoji_assets/eyes/' + avatar.eyes;
  avatarElement.appendChild(eyesElement);

  const mouthElement = document.createElement('img');
  mouthElement.src = 'emoji_assets/emoji_assets/mouth/' + avatar.mouth;
  avatarElement.appendChild(mouthElement);

  
  return avatarElement;
}

createCard(avatar) {
  const cardElement = document.createElement('div');
  cardElement.classList.add('card');

  const cardFront = document.createElement('div');
  cardFront.classList.add('card-face', 'card-front');
  cardElement.appendChild(cardFront);

  const cardBack = document.createElement('div');
  cardBack.classList.add('card-face', 'card-back');
  const avatarElement = this.createAvatarElement(avatar);
  cardBack.appendChild(avatarElement);
  cardElement.appendChild(cardBack);

  cardElement.onclick = () => {
      this.flipCard(cardElement);
  };

  return cardElement;
}

initGame(numPairs) {
  attempts = 0;
  matchedPairs = 0;
  this.updateAttempts();
  this.updatePoints();
  const avatars = [];
  for (let i = 0; i < numPairs; i++) {
    avatars.push(this.generateRandomAvatar());
  }

  const cardData = [];
  for (let i = 0; i < this.cardsToMatch; i++) {
    cardData.push(...avatars);
  }
  this.shuffleArray(cardData);

  const gameBoard = document.getElementById('game-board');
  gameBoard.innerHTML = '';

  for (const avatar of cardData) {
    const card = this.createCard(avatar);
    gameBoard.appendChild(card);
  }

  
  const cards = gameBoard.getElementsByClassName('card');
  
  for (let card of cards) {
    card.style.visibility = 'visible';
  }

  // Set the initial value of attempts to maxAttempts
  attempts = maxAttempts;
  this.updateAttempts();

  // Show the marquee when the "Start game" button is pressed
  this.updateMarquee();


  // Reset game variables
  timeLeft = this.timeAllowed;
  attempts = this.attemptsAllowed;
  points = 0;
  matchedPairs = 0;
  firstCard = null;
  secondCard = null;
  this.thirdCard = null;
  isFlipping = false;

  // Update UI elements
  this.updateAttempts();
  this.updatePoints();
  document.getElementById('timer').textContent = timeLeft;
  document.getElementById('end-game').style.display = 'none';
  document.getElementById('pause-game').style.display = 'none';
  document.getElementById('show-cards').addEventListener('click', () => this.ShowAllCards());


  // Call checkWin() to see if the game is already won
  this.checkWin();

  // Restart the timer
  this.startTimer();
}

// Add this function to handle card flipping
flipCard(card) {  
  if (card.classList.contains('matched') || card === firstCard || card === secondCard || card === this.thirdCard) return;
  
  if (paused) {
    return;
  }
  
  const flippedCards = document.querySelectorAll('.card.flipped:not(.matched)');
  if (flippedCards.length >= this.cardsToMatch) return;

  card.classList.add('flipped');
  if (!firstCard ) {
    firstCard = card;
  } else if (!secondCard ) {
    secondCard = card;
    if (this.cardsToMatch === 2) {
      this.checkMatch();
    }
  } else if (!this.thirdCard ) {
    this.thirdCard = card;
    if (this.cardsToMatch === 3) {
      this.checkMatch();
    }
  } else if (!this.fourthCard ) {
    this.fourthCard = card;
    if (this.cardsToMatch === 4) {
      this.checkMatch();
    }
  }
}


// Add this function to check for a match
checkMatch() {
  attempts--;
  this.updateAttempts();
  isFlipping = true;
  if (this.cardsToMatch === 4 && this.fourthCard) {
      const isMatchedFirst = this.compareCards(firstCard, secondCard);
      const isMatchedSecond = this.compareCards(firstCard, this.thirdCard);
      const isMatchedThird = this.compareCards(firstCard, this.fourthCard);
  
      if (isMatchedFirst && isMatchedSecond && isMatchedThird) {
          firstCard.classList.add('matched');
          secondCard.classList.add('matched');
          this.thirdCard.classList.add('matched');
          this.fourthCard.classList.add('matched');
          points += 10 + this.addExtraPointsAttempt() + this.addExtraPointsTime();
          this.updatePoints();
          matchedPairs++;
          firstCard = null;
          secondCard = null;
          this.thirdCard = null;
          this.fourthCard = null;
          this.checkWin();
          isFlipping = false;
      } else {
          setTimeout(() => {
          firstCard.classList.remove('flipped');
          secondCard.classList.remove('flipped');
          this.thirdCard.classList.remove('flipped');
          this.fourthCard.classList.remove('flipped');
          firstCard = null;
          secondCard = null;
          this.thirdCard = null;
          this.fourthCard = null;
          isFlipping = false;
        }, 1000);
      }
    } else if (this.cardsToMatch === 3 && this.thirdCard) {
    // Level 3 logic
    const isMatched = this.compareCards(firstCard, secondCard);

    if (isMatched) {
      isFlipping = true;
      const isThirdCardMatched = this.compareCards(firstCard, this.thirdCard);

      if (isThirdCardMatched) {
        points += 10 + this.addExtraPointsAttempt() + this.addExtraPointsTime();
        this.updatePoints();
        matchedPairs++;
        firstCard.classList.add('matched');
        secondCard.classList.add('matched');
        this.thirdCard.classList.add('matched');
        firstCard = null;
        secondCard = null;
        this.thirdCard = null;
        this.checkWin();
        isFlipping = false;
      } else {
        setTimeout(() => {
          this.thirdCard.classList.remove('flipped');
          this.thirdCard = null;
          isFlipping = false;
        }, 1000);
      }
    } else {
      setTimeout(() => {
          firstCard.classList.remove('flipped');
          secondCard.classList.remove('flipped');
          this.thirdCard.classList.remove('flipped');
          firstCard = null;
          secondCard = null;
              this.thirdCard = null;
          isFlipping = false;
      }, 1000);
    }
  } else if (this.cardsToMatch === 2 && secondCard) {
    // Level 2 logic
    const isMatched = this.compareCards(firstCard, secondCard);

    if (isMatched) {
      firstCard.classList.add('matched');
      secondCard.classList.add('matched');
      points += 10 + this.addExtraPointsAttempt() + this.addExtraPointsTime();
      this.updatePoints();
      matchedPairs++;
      firstCard = null;
      secondCard = null;
      this.checkWin();
    } else {
      setTimeout(() => {
        firstCard.classList.remove('flipped');
        secondCard.classList.remove('flipped');
        firstCard = null;
        secondCard = null;
        isFlipping = false;
      }, 1000);
    }
  }

  if (attempts === 0) {
    this.endGame(false);
  }
}
    
    
    
compareCards(card1, card2) {
  const card1Avatar = card1.children[1].children[0];
  const card2Avatar = card2.children[1].children[0];
  
  const card1EyesSrc = card1Avatar.children[1].src;
  const card1MouthSrc = card1Avatar.children[2].src;
  const card1SkinSrc = card1Avatar.children[0].src;
  
  const card2EyesSrc = card2Avatar.children[1].src;
  const card2MouthSrc = card2Avatar.children[2].src;
  const card2SkinSrc = card2Avatar.children[0].src;

  return (
    card1EyesSrc === card2EyesSrc &&
    card1MouthSrc === card2MouthSrc &&
    card1SkinSrc === card2SkinSrc
  );
}
    
  

resetGame() {
  // Get all the card elements
  const cards = document.querySelectorAll('.card');
  
  // Loop through all the card elements and flip them back to the front face
  for (const card of cards) {
    card.classList.remove('flipped');
  }
  
  // Generate new random avatars for the cards
  const avatars = [];
  for (let i = 0; i < this.pairs; i++) {
    avatars.push(this.generateRandomAvatar());
  }

  const cardData = [];
  for (let i = 0; i < this.cardsToMatch; i++) {
    cardData.push(...avatars);
  }
  this.shuffleArray(cardData);

  // Loop through all the card elements again and update the avatar images
  for (let i = 0; i < cards.length; i++) {
    const avatarElement = cards[i].querySelector('.card-back img');
    avatarElement.src = 'emoji_assets/emoji_assets/skin/' + cardData[i].skin;
    avatarElement.nextElementSibling.src = 'emoji_assets/emoji_assets/eyes/' + cardData[i].eyes;
    avatarElement.nextElementSibling.nextElementSibling.src = 'emoji_assets/emoji_assets/mouth/' + cardData[i].mouth;
  }
  
  // Reset game variables
  timeLeft = this.timeAllowed;
  attempts = maxAttempts;
  points = 0;
  matchedPairs = 0;
  firstCard = null;
  secondCard = null;
  this.thirdCard = null;
  isFlipping = false;
  
  // Update UI elements
  this.updateAttempts();
  this.updatePoints();
  document.getElementById('timer').textContent = timeLeft;
  document.getElementById('end-game').style.display = 'none';
  
  // Call checkWin() to see if the game is already won
  this.checkWin();
  
  // Restart the timer
  this.startTimer();
}



// Add this function to update the attempts counter
updateAttempts() {
  document.getElementById('attempts').textContent = attempts;

  if (attempts <= 10) {
      document.getElementById('attempts-message').style.backgroundColor = 'red';
      document.getElementById('attempts-message').style.color = 'white';
    } else {
      document.getElementById('attempts-message').style.backgroundColor = '#e8cb1d';
      document.getElementById('attempts-message').style.color = 'black';
    } 
}

// Add this function to update the points counter
updatePoints() {
  document.getElementById('points').textContent = points;

  if(this.updatePoints){
    document.getElementById('points-message').style.backgroundColor = '#2da26';
  }
}

addExtraPointsAttempt() {
  const oneThirdAttempts = maxAttempts / 3;
  if (attempts >= oneThirdAttempts * 2) {
    return 10;
  } else if (attempts >= oneThirdAttempts) {
    return 5;
  } else {
    return 0;
  }
}

addExtraPointsTime() {
  const oneThirdTime = this.timeAllowed / 3;
  if (timeLeft >= oneThirdTime * 2) {
    return 10;
  } else if (timeLeft >= oneThirdTime) {
    return 5;
  } else {
    return 0;
  }
}

// Add this function to start the countdown timer
startTimer() {
  clearInterval(timerInterval);
  timerInterval = setInterval(() => {
    if(!paused){  
    timeLeft--;
    document.getElementById('timer').textContent = timeLeft;

    if (timeLeft <= 10) {
      document.getElementById('time-message').style.backgroundColor = 'red';
      document.getElementById('time-message').style.color = 'white';
      } else {
      document.getElementById('time-message').style.backgroundColor = '#e8cb1d';
      }

    if (timeLeft <= 0) {
      clearInterval(timerInterval);
      this.endGame();
    }
  }
  }, 1000);
}

endGame(isWin) {
  clearInterval(timerInterval);
  paused = false;

  // Update the end-game message based on the game result
  const endGameMessage = isWin ? 'You Won!' : 'Game Over!';
  document.getElementById('end-game').querySelector('h2').innerText = endGameMessage;

  const submitButtonText = isWin ? 'Submit Score' : 'Surrender/Submit Score';
  document.querySelector('#end-game button:nth-of-type(1)').innerText = submitButtonText;
  
  // const playAgainButtonText = isWin ? 'Play Again' : 'Restart Game';
  // document.querySelector('#end-game button:nth-of-type(2)').innerText = playAgainButtonText;

  // Display the end-game message
  document.getElementById('end-game').style.display = 'block';

  // Call nextLevel() if the player wins
  if (isWin) {
    document.cookie = `level_${this.level}_points=${points};path=/;max-age=86400`; // 24 hours
    this.changeGameBoardColor();
    this.nextLevel();
  }
}
  
  
checkWin() {
  if (matchedPairs === this.pairs) { // Change this number if you have more or fewer pairs
    clearInterval(timerInterval);
    this.endGame(true); // Pass 'true' to indicate that the game is won
  }
}
  
nextLevel() {
  if (this.level < 6) {
    setTimeout(() => {
      this.level++;
      this.configureLevel();
      this.changeGameBoardColor();
      this.initGame(this.pairs);
    }, 10);
  } else {
      // Display a message when all levels are completed
      this.endGame(true);
  }
}
 
changeGameBoardColor() {
  const previousLevel = this.level - 1;
  if (previousLevel > 0) {
    const previousLevelPoints = parseInt(document.cookie.split(`level_${previousLevel}_points=`)[1].split(';')[0]);
    if (points > previousLevelPoints) {
      document.getElementById('game-board').style.backgroundColor = '#ffd700';
    } else {
      document.getElementById('game-board').style.backgroundColor = 'grey';
    }
  } else {
    document.getElementById('game-board').style.backgroundColor = 'grey';
  }
}

ShowAllCards() {
  const cards = document.querySelectorAll('.card:not(.matched)');

  for (let card of cards) {
    card.classList.add('flipped');
  }

  setTimeout(() => {
    for (let card of cards) {
      card.classList.remove('flipped');
    }
  }, 300); // Adjust the duration to display cards before flipping them back (in milliseconds)
}



updateMarquee() {
  // Update marquee text
  const marquee = document.getElementById('marquee');
  marquee.innerText = `Level ${game.level}: Match ${game.cardsToMatch} cards`;
  
  // Hide other elements
  document.getElementById('time-message').style.display = 'none';
  document.getElementById('attempts-message').style.display = 'none';
  document.getElementById('points-message').style.display = 'none';
  document.getElementById('surrender').style.display = 'none';
  document.getElementById('pause-game').style.display = 'none';
  document.getElementById('show-cards').style.display = 'none';
  
  // Show marquee
  marquee.style.display = 'block';

  // Hide marquee and show other elements after 1 second
  setTimeout(() => {
    marquee.style.display = 'none';
    document.getElementById('time-message').style.display = 'inline';
    document.getElementById('attempts-message').style.display = 'inline';
    document.getElementById('points-message').style.display = 'inline';
    document.getElementById('surrender').style.display = 'block';
    document.getElementById('pause-game').style.display = 'block';
    document.getElementById('show-cards').style.display = 'block';
  }, 1000);
}


pauseGame() {
  paused = !paused;
  document.getElementById('pause-game').textContent = paused ? '▶️' : '⏸️';
}

  // Add this function to submit the score (requires server-side implementation)
submitScore() {
  location.href = 'leaderboard.php';
}
  
// deletePointsCookies() {
//   for (let level = 1; level <= 5; level++) {
//   const cookieName = `level_${level}_points`;
//   document.cookie = `${cookieName}=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC`;
//   }
// }


}


let game;
const startButton = document.getElementById('start');
// const maxAttempts = 27 // Change this to the number of attempts you want to allow
// Add this global variable at the beginning of your JavaScript file
let maxAttempts = this.attemptsAllowed;
const submitScoreButton = document.querySelector('#end-game button:nth-of-type(1)');
const playAgainButton = document.querySelector('#end-game button:nth-of-type(2)');
const restartGameButton = document.querySelector('#end-game button:nth-of-type(3)');
const surrender = document.getElementById('surrender');
let timeLeft = this.timeAllowed;
let attempts = 0;
let points = 0;
let matchedPairs = 0;
let timerInterval;
let firstCard = null;
let secondCard = null;
let isFlipping = false;
let paused = false;

//const game = new Game(1); // Initialize a game at level 1
  






startButton.addEventListener('click', () => {  
  game.startTimer();
  game.initGame(game.pairs); // Use the configured pairs based on the level
  startButton.disabled = true; // Optionally disable the start button after clicking to prevent multiple starts
  document.getElementById('start').style.visibility = 'hidden';


  // Show the score-box when the "Start game" button is pressed
  const scoreBox = document.querySelector('.score-box');
  scoreBox.style.display = 'flex';
  scoreBox.style.justifyContent = 'center';
  scoreBox.style.alignItems = 'center';
  scoreBox.style.padding = '0 90px';
  scoreBox.style.margin = '0 0 20px 0';
  scoreBox.style.border = '1px solid #ccc';
  scoreBox.style.position = 'relative';

  // Add padding to the game-board after the "Start game" button is pressed
  const gameBoard = document.getElementById('game-board');
  gameBoard.style.paddingTop = '22px';
  gameBoard.style.paddingBottom = '22px';
});



playAgainButton.addEventListener('click', () => {
  document.getElementById('end-game').style.display = 'none';
  game.initGame(game.pairs); // Reset the game with the same number of pairs
  startButton.disabled = false;
});

restartGameButton.addEventListener('click', () => {
  document.getElementById('end-game').style.display = 'none';
  location.reload();
  startButton.disabled = false;
  this.deletePointsCookies();
});

submitScoreButton.addEventListener('click', () => {
  game.submitScore();
});

surrender.addEventListener('click', () => {
  clearInterval(timerInterval);
  game.endGame(false); // Pass 'false' to indicate that the game is lost
});

document.getElementById('pause-game').addEventListener('click', () => {
  game.pauseGame();
});


game = new Game(1); // Pass the desired level as an argument
