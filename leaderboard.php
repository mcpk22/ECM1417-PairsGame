<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leaderboard</title>
  <link rel="stylesheet" href="leaderboard.css">
  
  <script>
    function showTab(tabId) {
      document.getElementById('Best/Total').style.display = 'none';
      document.getElementById('allPlayers').style.display = 'none';
      document.getElementById(tabId).style.display = 'block';
    }
  </script>
</head>

<?php
    include 'NavMenu.php';
?>

<body onload="showTab('Best/Total');">
  <img src='LandingPage.jpg' style="width:100%; height:100%; position:fixed; top:0; left:0; z-index:-1; ">
  <div id="main">
    <div style = "display: flex; align-items: center; justify-content: center; transform: translate(0, 180px">
        <button class="tab" onclick="showTab('Best/Total');">Best / Total Score</button>
        <button class="tab" onclick="showTab('allPlayers');">All Players</button>
    </div>


    <div id="Best/Total" class="tab-content">
    <div id="main">
        <table style = "transform: translate(50%, 300%);">
        <thead>
            <tr>
            <th style =  "border-top-left-radius: 38px;">Name</th>
            <th>Best Score</th>
            <th style = " border-top-right-radius: 38px;">Total Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalScore = 0;
            $bestScore = 0;
            for ($level = 1; $level <= 6; $level++):
                $cookie_name = "level_{$level}_points";
                $currentScore = isset($_COOKIE[$cookie_name]) ? (int)$_COOKIE[$cookie_name] : 0;
                $totalScore += $currentScore;
                if ($currentScore > $bestScore) {
                $bestScore = $currentScore;
                }
            endfor;
            ?>
            <tr>
            <td><?php echo $_COOKIE['name']; ?>
            <img src="emoji_assets/emoji_assets/skin/<?php echo $_COOKIE['skin']; ?>" style='position: absolute; width: 34px; height: 34px; padding-left: 8px; ' alt="Avatar" class="avatar">
            <img src="emoji_assets/emoji_assets/eyes/<?php echo $_COOKIE['eyes']; ?>" style='position: absolute; width: 34px; height: 34px; padding-left: 8px;' alt="Avatar" class="avatar">
            <img src="emoji_assets/emoji_assets/mouth/<?php echo $_COOKIE['mouth']; ?>" width= 34px height= 34px style='position: absolute; padding-left: 8px;' alt="Avatar" class="avatar">
            </td>
            <td><?php echo $bestScore; ?></td>
            <td><?php echo $totalScore; ?></td>
            </tr>
        </tbody>
        </table>
        <div class="primary" style="align-items:center;">
                <a href="pairs.php"><button style="align-items:center;" class="primary button">PLAY AGAIN</button></a>
        </div>
    </div>
    </div>


    
<div id="allPlayers" class="tab-content">
    <?php
    // Parse cookies to create an array of user data
    $leaderboard = [];
    foreach ($_COOKIE as $key => $value) {
      $parts = explode("_", $key);
      if (count($parts) === 4 && $parts[1] === "level") {
        $name = $parts[0];
        $level = (int)$parts[2];
        if (!isset($leaderboard[$name])) {
          $leaderboard[$name] = [
            "name" => $name,
            "skin" => $_COOKIE["{$name}_skin"],
            "eyes" => $_COOKIE["{$name}_eyes"],
            "mouth" => $_COOKIE["{$name}_mouth"],
            "scores" => []
          ];
        }
        $leaderboard[$name]["scores"][$level] = (int)$value;
      }
    }
  ?>

    <div id="main">
        <table style = "transform: translate(50%, 300%);">
        <thead>
        <tr>
            <th style = " border-top-left-radius: 38px;">Name</th>
            <?php for ($level = 1; $level <= 6; $level++): ?>
            <th <?php echo ($level == 6) ? 'style="border-top-right-radius: 38px;"' : ''; ?>>Level <?php echo $level; ?></th>
            <?php endfor; ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $_COOKIE['name']; ?>
            <img src="emoji_assets/emoji_assets/skin/<?php echo $_COOKIE['skin']; ?>" style='position: absolute; width: 34px; height: 34px; padding-left: 3px; ' alt="Avatar" class="avatar">
            <img src="emoji_assets/emoji_assets/eyes/<?php echo $_COOKIE['eyes']; ?>" style='position: absolute; width: 34px; height: 34px; padding-left: 3px;' alt="Avatar" class="avatar">
            <img src="emoji_assets/emoji_assets/mouth/<?php echo $_COOKIE['mouth']; ?>" width= 34px height= 34px style='position: absolute; padding-left: 3px;' alt="Avatar" class="avatar">
            </td>
            <?php for ($level = 1; $level <= 6; $level++): ?>
            <td>
                <?php
                $cookie_name = "level_{$level}_points";
                $currentScore = isset($_COOKIE[$cookie_name]) ? (int)$_COOKIE[$cookie_name] : 0;
                if ($currentScore > 0) {
                    echo $currentScore;
                } else {
                    echo "Not played";
                }
                ?>
            </td>
            <?php endfor; ?>
        </tr>
        </tbody>
        </table>
    </div>

    <div class="primary" style="align-items:center;">
                <a href="pairs.php"><button style="align-items:center;" class="primary button">PLAY AGAIN</button></a>
    </div>
</div>

</body>
</html>
