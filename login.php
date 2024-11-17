<?php
    $message = "";
    session_start();

    if (isset($_POST["email"]) && isset($_POST["pass"])) {
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "musicplayer";

        $conn = mysqli_connect($server, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $sql = "SELECT * FROM `users` WHERE `user` = '$email' AND `password` = '$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $message = "Login successful! Welcome, " . htmlspecialchars($email) . ".";
            echo "<script>
                    setTimeout(() => {
                        window.location.href = 'home.php';
                    }, 5000);
                  </script>";
        } else {
            $message = "Invalid email or password.";
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background">
        <div class="above-background">
            <div id="title">Music Player</div><br><br>
            <div class="type">
                <div class="getinto"><b>Sign In</b> | <a href="index.php">Sign Up</a></div>
                <form method="POST">
                    <br><br>
                    <label for="email">EMAIL:</label><br>
                    <input type="email" name="email" id="email" required><br><br>
                    <label for="pass">PASSWORD:</label><br>
                    <input type="password" name="pass" id="pass" required><br><br>
                    <button type="submit">LOG IN</button><br><br>
                </form>
                <a href="forget_password.php">forgot password </a>
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
