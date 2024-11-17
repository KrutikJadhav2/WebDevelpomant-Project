<?php
$message = "";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "musicplayer";

    $conn = mysqli_connect($server, $username, $password, $database);

    if (!$conn) {
        die("Connection failed! Probable error: " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $user = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "INSERT INTO `users` (`name`, `user`, `password`) VALUES ('$name', '$user', '$pass');";

    if ($conn->query($sql) === true) {
        $message = "Registration Successful! Log in to explore the world of music!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background">
        <div class="above-background">
            <div id="title">Music Player</div><br><br>
            <div class="type">
                <div class="getinto"><a href="login.php">Sign In </a>| <b>Sign Up</b></div>
                <form method="POST">
                    <br><br>
                    <label for="name">NAME:</label><br>
                    <input type="text" name="name" id="name" required autofocus><br><br>
                    <label for="email">EMAIL:</label><br>
                    <input type="email" name="email" id="email" required><br><br>
                    <label for="pass">PASSWORD:</label><br>
                    <input type="password" name="pass" id="pass" required><br><br>
                    <button type="submit">SIGN UP</button><br><br>
                </form>
                <div id="txt">
                    <?php 
                    if (!empty($message)) {
                        echo $message;
                    } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>