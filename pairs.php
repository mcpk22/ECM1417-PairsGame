<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>memory</title>
    <link rel="stylesheet" href="pairs.css">
</head>

<?php
    include 'NavMenu.php';
?>

<body>
<div id="main">
<img src='LandingPage.jpg' style="width:100%; height:100%; position:fixed; top:0; left:0; z-index:-1; ">
<div class="wrapper">
    <div class="stats-container">
        <div id="moves-count"></div>
        <div id="time"></div>
    </div>
    <div class="game-container"></div>
      

    <div class="controls-container">
        <p id="result"></p>
        <button id="start">Start Game</button>
        
        <div class="score-box" style="display:none; position: absolute; bottom: calc(100% + 10px); left: 50%; transform: translateX(-50%); width: 570px; padding: 0px 20px; border: 5px; margin: -1px; background-color: #fff700; font-size: 20px; border-radius: 40px; align-items: center; justify-content: center; display: flex; z-index: 1; top: -1;">
            <marquee id="marquee" style="font-size: 30px; font-style:bold; text-align: center;" scrollamount="3" direction="up" ></marquee>
            <p id="time-message" style="display:none; padding: 15px; border-radius: 20px;">Time left: <span id="timer"><br>100</span> seconds</p>
            <p id="attempts-message" style="display:none; padding: 15px; border-radius: 20px;">Attempts: <span id="attempts">27</span></p>
            <p id="points-message" style="display:none; background-color: #32da26; padding: 13px; border-radius: 20px;">Points: <span id="points">0</span></p>
            <button id="surrender" class="surrender button" >Surrender</button>
            <button id="show-cards" class="showCards">Show Cards</button>
            <button id="pause-game">⏸️</button>
        </div>



    </div>
    
        
    <div id="game-board"></div>
        
        <div id="end-game" style="display:none">
            <div class="game-over-container">
                <h2>Game Over!</h2>
                <button onclick="submitScore()">Surrender/Submit Score</button>
                <button onclick="game.initGame(10)">Play Again</button>
                <button onclick="game.initGame(10)">Restart Game</button>
            </div>
        

            <!-- <div id="win-game" style="display:none">
            <h2>You Win!</h2>
            <button onclick="submitScore()">Submit Score</button>
            <button onclick="initGame(8)">Play Again</button> -->
        </div>
    </div>
</div>
    <script src="pairs.js"></script>
</body>
</html>
