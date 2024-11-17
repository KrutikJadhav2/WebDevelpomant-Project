<?php
require_once('connection.php');
session_start();

$err = "";
$success = "";

if (isset($_POST['reset'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        $err = "<font color='red'>All fields are required</font>";
    } elseif ($new_password != $confirm_password) {
        $err = "<font color='red'>Passwords do not match</font>";
    } else {
        $hashed_password = ($new_password);
        $sql = mysqli_query($con, "SELECT * FROM users WHERE user='$email'");
        if (mysqli_num_rows($sql) > 0) {
            $update = mysqli_query($con, "UPDATE users SET password='$hashed_password' WHERE users='$email'");
            if ($update) {
                $success = "<font color='green'>Password updated successfully. <a href='index.php'>Login here</a></font>";
            } else {
                $err = "<font color='red'>Error updating password. Please try again.</font>";
            }
        } else {
            $err = "<font color='red'>Email not found</font>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
        body {
            background-color: #5a0533;
            color: #fff;
            font-family: 'PT Serif', serif;
        }

        .card {
          
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
   

    border: 4px solid #7a1e56; /* Purple inner border */
    border-radius: 10px;
    box-shadow: inset 0px 4px 10px rgba(90, 5, 51, 0.2); /* Inner shadow */
    padding: 20px;
}


        .card-header h3 {
            color: #000;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #5a0533;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3b0222;
        }

        a {
            color: #5a0533;
        }

        a:hover {
            color: #3b0222;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card p-4" style="width: 30rem;">
                <div class="card-header text-center">
                    <h3>Reset Your Password</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <p align="center"><?php echo $err; ?><?php echo $success; ?></p>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" placeholder="Enter new password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm new password" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="reset" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="index.php">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>