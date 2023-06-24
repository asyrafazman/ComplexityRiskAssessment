<?php
session_start();
$username = "";
$specialkey = "";
$errors = "";

if (isset($_POST['specialpin'])) {
    $specialkey = $_POST['specialpin'];
    require_once "pdo.php";
    $stmt = $pdo->prepare("SELECT username, specialPin FROM manager WHERE specialPin = :specialp");
    $stmt->bindParam(":specialp", $specialkey);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($rows) {
        foreach ($rows as $row) {
            $username = $row['username'];
            $specialkey = $row['specialPin'];
        }
        $_SESSION['username'] = $username;
        $_SESSION['specialkey'] = $specialkey;
        header("Location: resetLogin.php");
    } else {
        $errors = "Your special key is invalid!";
    }
}

?>
<html lang="en">

<head>
    <title>Get Your Account</title>
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

        .container {
            max-width: auto;
            margin: 0 auto;
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
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
            <h2 class="text-center">Get your account</h2>
            <?php
            if ($errors) {
                echo '<p style="color:red">' . $errors;
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="specialpin" placeholder="Special Pin" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Get Account</button>
            </div>
        </form>
        <div class="text-center">Already remember your account? <a href="login.php">Sign in</a></div>
    </div>
</body>

</html>