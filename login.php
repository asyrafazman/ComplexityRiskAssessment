<?php
//problem to increment by one if the password fail
session_start();
$username = "";
$password = "";
$errors = "";
if (!isset($_SESSION['activeUser'])) {
    $_SESSION['activeUser'] = "";
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once "pdo.php";
    $stmt = $pdo->prepare("SELECT manager_id, firstName, lastName, username, password, specialPin, attempt FROM manager WHERE username = :usern");
    $stmt->bindParam(":usern", $username);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($rows) {
        foreach ($rows as $row) {
            $username = $row['username'];

            echo "Before username: " . $_SESSION['activeUser'];
            if ($_SESSION['activeUser'] != $username) {
                $_SESSION['attempt'] = $row['attempt'];
                $_SESSION['activeUser'] = $row['username'];
                echo " Active: " . $_SESSION['activeUser'];
                echo " Current Username: " . $username;
            }

            if ($_SESSION['attempt'] > 3) {
                $errors = "Your account has been blocked! Please contact administrator.";
            } else if (password_verify($password, $row['password'])) {
                $_SESSION['managerID'] = $row['manager_id'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                header("Location: index.php");
            } else {
                $stmt = $pdo->prepare("UPDATE manager SET attempt =:attempt WHERE username = :usern");
                $stmt->bindParam(":attempt", $_SESSION['attempt']);
                $stmt->bindParam(":usern", $username);
                $stmt->execute();
                $errors = "<p>Your password is incorrect!</p><p>Left attempt(s): " . (3 - $_SESSION['attempt']) . "</p>";
                $_SESSION['attempt']++;
                echo " Total attempt: " . $_SESSION['attempt'];
            }
        }
    } else {
        $errors = "Your username is not found!";
    }
}

?>
<html lang="en">

<head>
    <title>Login Form</title>
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
            max-width: auto;
            margin: 0 auto;
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
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
            <h2 class="text-center">Log in</h2>
            <?php
            if ($errors != "") {
                echo '<p style="color:red">' . $errors;
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Log in">

            </div>
            <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                <a href="getLogin.php" class="pull-right">Forgot Password?</a>
            </div>
        </form>
        <p class="text-center"><a href="register.php">Create an Account</a></p>
        <p class="text-center"><a href="loginAdmin.php">Login as Admin</a></p>
    </div>
</body>

</html>