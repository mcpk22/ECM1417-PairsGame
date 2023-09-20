<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cookie page</title>
</head>
<body>


<?php
$error_messages = array();

if (empty($_POST['eyes']) || $_POST['eyes'] === 'eyes') {
    $error_messages['eyes_error'] = 'select eye element';
} else {
    setcookie("eyes", $_POST['eyes'], time() + (86400), "/"); // 86400 = 24 hours
}

if ($_POST['mouth'] === '' || $_POST['mouth'] === 'mouth') {
    $error_messages['mouth_error'] = 'select mouth element';
} else {
    setcookie("mouth", $_POST['mouth'], time() + (86400), "/"); // 86400 = 24 hours
}

if ($_POST['skin'] === '' || $_POST['skin'] === 'skin') {
    $error_messages['skin_error'] = 'select skin element';
} else {
    setcookie("skin", $_POST['skin'], time() + (86400), "/"); // 86400 = 24 hours
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];

    // Validate input using regular expression
    if (preg_match('/[@!#"&\^*\(\)\+=\[\]\-_:;"\'<>\?\/]/', $name)) {
        $error_messages['name_error'] = "Name cannot contain the following characters: @!#\"&^*()+=[]-_:;\"'<>?/";
    }
    if (trim($name) === "" || $name === null) {
        $error_messages['name_error'] = 'Name cannot be empty';
    } else {
        setcookie("name", $name, time() + (86400), "/"); // 86400 = 24 hours
    }
}

if (!empty($error_messages)) {
    $query_string = http_build_query($error_messages);
    header("Location: registration.php?" . $query_string);
    exit();
}


echo "<img style='position: absolute;' src='emoji_assets/emoji_assets/skin/" . $_POST['skin'] . "'/>";
echo "<img style='position: absolute;' src= 'emoji_assets/emoji_assets/eyes/" . $_POST['eyes'] . "'/>";
echo "<img style='position: absolute;' width=500px height=500px src='emoji_assets/emoji_assets/mouth/" . $_POST['mouth'] . "'/>";

header('Location: profile.php');

echo "</ul>";
?>

<script>
    <?php if (isset($error_messages['name_error'])): ?>
        const nameError = "<?php echo addslashes($error_messages['name_error']); ?>";
        alert(nameError);
    <?php endif; ?>
</script>

</body>
</html>