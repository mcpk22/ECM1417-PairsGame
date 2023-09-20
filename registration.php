<!DOCTYPE html>
<html>
<head>
    <title>register</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    
    <?php
        include 'NavMenu.php';
        
        // if (isset($_GET['error'])) {
        //     $error = $_GET['error'];
        // }
        // $name_error = isset($_GET['name_error']) ? $_GET['name_error'] : null;
        // if ($name_error) {
        //     echo "<p style='color: red;'>Error: $name_error</p>";
        // }
        // // else{    
        // //     echo "Error: $error";
        // // }
    ?>
    
    <div id="main">
        
        <img src='LandingPage.jpg' style="width:100%; height:100%; position:fixed; top:0; left:0; z-index:-1; ">
        <div class="container">
            <form method="POST" action="cookies.php" >
                <div class="input-group mb-3">
                    <h3><span class="input-group-text" id="basic-addon1">Username*</span></h3>
                    <input type="text" name="name" class="form-control" placeholder="Type your name here" aria-label="Username" aria-describedby="basic-addon1">
                    <?php if (isset($_GET['name_error'])): ?>
                        <p style="color: red; font-size: 18px;" ><?php echo $_GET['name_error']; ?></p>
                    <?php endif; ?>
                </div>

                <br/>

                <h3>Create Your Avatar*</h3>

                <div>
                    <h4>Skin</h4>
                    <div id="skin" style="background-color: lightblue; border-radius: 10px; padding-top: 5px; padding-bottom: 5px; float: none; margin-left: 160px; margin-right: 160px;">
                        <?php
                            // Load skin images from directory
                            // $dir = 'emoji_assets/emoji_assets/skin/';
                            // $files = scandir($dir);
                            // foreach ($files as $file) {
                            //     if ($file == '.' || $file == '..') {
                            //         continue;
                            //     }
                            echo '<img width=40px height=40px src="emoji_assets\emoji_assets\skin\green.png" data-feature="skin" data-value="green.png" />';
                            echo '<img width=40px height=40px src="emoji_assets\emoji_assets\skin\red.png" data-feature="skin" data-value="red.png" />';
                            echo '<img width=40px height=40px src="emoji_assets\emoji_assets\skin\yellow.png" data-feature="skin" data-value="yellow.png" />';
                            // }

                            
                        ?>
                    </div>
                        <?php if (isset($_GET['skin_error'])) {
                                $skin_error = $_GET['skin_error']; echo "<p style='color:red;'>$skin_error</p>";
                            }
                        ?>
                    <div id="skin-selection-box" class="selection-box"></div>
                </div>

                <div>
                    <h4>Eyes</h4>
                    <div id="eyes" style="background-color: lightblue; border-radius: 10px; padding-top: 5px; float: none; margin-left: 160px; margin-right: 160px;">
                        <?php
                            // Load eyes images from directory
                            // $dir = 'emoji_assets/emoji_assets/eyes/';
                            // $files = scandir($dir);
                            // foreach ($files as $file) {
                            //     if ($file == '.' || $file == '..') {
                            //         continue;
                            //     }
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\eyes\closed.png" data-feature="eyes" data-value="closed.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\eyes\laughing.png" data-feature="eyes" data-value="laughing.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\eyes\long.png" data-feature="eyes" data-value="long.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\eyes\normal.png" data-feature="eyes" data-value="normal.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\eyes\rolling.png" data-feature="eyes" data-value="rolling.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\eyes\winking.png" data-feature="eyes" data-value="winking.png" />';
                            // }

                            
                            
                            
                        ?>
                    </div>
                        <?php if (isset($_GET['eyes_error'])) {
                                $eyes_error = $_GET['eyes_error']; echo "<p style='color:red;'>$eyes_error</p>";
                            }
                        ?>
                    <div id="eyes-selection-box" class="selection-box"></div>
                </div>

                <div>
                    <h4>Mouth</h4>
                    <div id="mouth" style="background-color: lightblue; border-radius: 10px; float: none; margin-left: 160px; margin-right: 160px; padding-top: 5px;">
                        <?php
                            // // Load mouth images from directory
                            // $dir = 'emoji_assets/emoji_assets/mouth/';
                            // $files = scandir($dir);
                            // foreach ($files as $file) {
                            //     if ($file == '.' || $file == '..') {
                            //         continue;
                            //     }
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\mouth\open.png" data-feature="mouth" data-value="open.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\mouth\sad.png" data-feature="mouth" data-value="sad.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\mouth\smiling.png" data-feature="mouth" data-value="smiling.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\mouth\straight.png" data-feature="mouth" data-value="straight.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\mouth\surprise.png" data-feature="mouth" data-value="surprise.png" />';
                                echo '<img width=40px height=40px src="emoji_assets\emoji_assets\mouth\teeth.png" data-feature="mouth" data-value="teeth.png" />';
                            // }

                            
                        ?>
                    </div>
                         <?php if (isset($_GET['mouth_error'])) {
                                $mouth_error = $_GET['mouth_error']; echo "<p style='color:red;'>$mouth_error</p>";
                            }
                        ?>
                    <div id="mouth-selection-box" class="selection-box"></div>

                </div>

                
                <input type="hidden" name="eyes" id="eyes-value" value="eyes">
                <input type="hidden" name="mouth" id="mouth-value" value="mouth">
                <input type="hidden" name="skin" id="skin-value" value="skin">

                <br/>
                <input style="right:50%" type="submit" value="Register">
            </form>
        </div>
    </div>

    <script>
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

        // // Create selection box around clicked image
        // const selectionBox = document.querySelector(`#${feature}-selection-box`);
        // selectionBox.style.display = 'block';
        // selectionBox.style.top = `${img.offsetTop}px`;
        // selectionBox.style.left = `${img.offsetLeft}px`;
        });
        });

    </script>
</body>
</html>
