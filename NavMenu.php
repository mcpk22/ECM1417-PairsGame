<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navstyle.css">
    <title>NavMenu</title>
</head>
<body>
<!-- <?php

	if (isset($_COOKIE['name'])) {
		$button = "Play now";
	}
?> -->
    <header>
      
        <div class="container">
          <homenav>
          <li><a href="index.php">Home</a></li>
          </homenav>

          <nav>
            <ul>
              <li><a href="pairs.php">play pairs</a></li>
              <!-- <li><a href="registration.php">Register</a></li> -->

              
                <?php
                if (isset($_COOKIE['name'])&& isset($_COOKIE['skin']) && isset($_COOKIE['eyes']) && isset($_COOKIE['mouth'])) {
                  echo  "<li><a href='leaderboard.php'>Leaderboard</a></li>";
                  echo "<li><a href='profile.php'><img src='emoji_assets/emoji_assets/skin/" . $_COOKIE['skin'] . "' style='position: absolute; width: 45px; height: 45px; bottom: -19px' alt='Avatar' class='avatar'>";
                  echo "<img src='emoji_assets/emoji_assets/eyes/" .  $_COOKIE['eyes'] . "' style='position: absolute; width: 45px; height: 45px; bottom: -19px;' alt='Avatar' class='avatar'>";
                  echo "<img src='emoji_assets/emoji_assets/mouth/" .$_COOKIE['mouth'] . "' style='position: absolute; width: 45px; height: 45px; bottom: -21px;' alt='Avatar' class='avatar'></a></li>";
                } else {
                  echo  "<li><a href='registration.php'>Register</a></li>";
                }
                
              ?>
            </ul>
          </nav>
        </div>
      
    </header>
</body>
</html>