<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
	<link href="profile.css" rel="stylesheet">
</head>
<body>
    <?php
        include 'NavMenu.php';
    ?>
    <img src='LandingPage.jpg' style="width:100%; height:100%; position:fixed; top:0; left:0; z-index:-1; ">
    <div id=main>
        <div class="container">
        <div class="card">
            <h3>Your Profile</h3>
            <img src="emoji_assets/emoji_assets/skin/<?php echo $_COOKIE['skin']; ?>" style='position: absolute;' alt="Avatar" class="avatar">
            <img src="emoji_assets/emoji_assets/eyes/<?php echo $_COOKIE['eyes']; ?>" style='position: absolute;' alt="Avatar" class="avatar">
            <img src="emoji_assets/emoji_assets/mouth/<?php echo $_COOKIE['mouth']; ?>" width=500px height=500px style='position: absolute;' alt="Avatar" class="avatar">
            
            <div class="name">
                <?php echo $_COOKIE['name']; ?>
            </div>
            <div class="primary" style="align-itmes:center;">
                <a href=pairs.php><button style="align-items:center;" class="primary button">PLAY NOW</button></a>
                <a href=registration.php><button style="align-items:center;" class="primary button">EDIT</button></a>
            </div>
        </div>
    </div>
<!-- <script>
    const images = document.querySelectorAll('img');

    images.forEach(img => {
    img.addEventListener('click', () => {
    // Clear selected class from other images in same section
    console.log('Image clicked'); 
    const feature = img.dataset.feature;
    const value = img.dataset.value;
    const imagesInSameSection = document.querySelectorAll(`img[data-feature="${feature}"]`);
    imagesInSameSection.forEach(img => img.classList.remove('selected'));

    // Add selected class to clicked image
    img.classList.add('selected');

    // Set value of hidden form field
    const hiddenInput = document.querySelector(`#${feature}-value`);
    hiddenInput.value = value;
    });
    });
</script> -->
</body>
</html>
