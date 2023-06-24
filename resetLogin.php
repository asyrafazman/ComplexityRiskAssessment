<?php
session_start();
$username = $_SESSION['username'];
$specialkey = $_SESSION['specialkey'];
$password = "";
$passwordConfirm = "";
$errors = "";
$errorsNum = "";

if (isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    if ($password == $passwordConfirm) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        require_once "pdo.php";
        $sql = "UPDATE manager SET password=:newPass WHERE username=:usern";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':newPass' => $password,
            ':usern' => $username
        ));
        $errors = "Successfully Reset!";
        $errorsNum = 1;
    } else {
        $errors = "Both password are not same!";
        $errorsNum = 2;
    }
}
?>
<html lang="en">

<head>
    <title>Reset password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('loginbackground1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .login-form {
            width: 340px;
            margin: 50px auto;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <form method="post">
            <h2 class="text-center">Reset your password</h2>
            <?php

            echo "Name: <strong>" . $username . "</strong>\n";
            echo "Special Pin: <strong>" . $specialkey . "</strong>\n";

            if ($errorsNum == 1) {
                echo '<p style="color:green">' . $errors;
            } else if ($errorsNum == 2) {
                echo '<p style="color:red">' . $errors;
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="password" placeholder="New Password" required="required">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="passwordConfirm" placeholder="Confirm New Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Reset</button>
            </div>
        </form>
        <div class="text-center">Already remember your account? <a href="login.php">Sign in</a></div>
    </div>
</body>

</html>