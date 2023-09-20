<!DOCTYPE html>
<html>
<head>
	<title>pairs</title>
	<link href="index.css" rel="stylesheet">
</head>
<?php
	include 'NavMenu.php';
?>
<?php
$p = "You're not using a registered session?";
$button = "Register now";
$link = "registration.php";
	if (isset($_COOKIE['name'])) {
		$p = "Let's start playing!";
		$button = "Click here to play";
		$link = "pairs.php";
	}
?>
<body>

	<div id="main">
		<img src='LandingPage.jpg' style="width:100%; height:100%; position:fixed; top:0; left:0; z-index:-1;">
		<div class="container">
			
			<h1>Welcome to Pairs</h1>
			<p id="welcome-text"><?=$p?></p>
			
			<div class="primary">
				<a href=<?=$link?>><button class="primary button"><?=$button?></button></a>
			</div>
		
		</div>
	</div>


<script>
    if (document.cookie.includes("name=")) {
        document.getElementById("welcome-text").style.fontSize = "47px";
		document.getElementById("welcome-text").style.fontWeight = "bold";
		document.getElementById("welcome-text").style.backgroundColor = "#b58045";
		document.getElementById("welcome-text").style.padding = "20px";
		document.getElementById("welcome-text").style.borderRadius = "50px";
	}
</script>

</body>
</html>
