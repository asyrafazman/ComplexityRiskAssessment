<?php
$first_name = "";
$last_name = "";
$position = "";
$username = "";
$password = "";
$confirmpass = "";
$pin = "";
$errors = "";
$errorNum = "";

if (
    isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['position']) && isset($_POST['username']) && isset($_POST['password']) &&
    isset($_POST['confirm_password']) && isset($_POST['forgotPin'])
) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $position = $_POST['position'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpass = $_POST['confirm_password'];
    $pin = $_POST['forgotPin'];

    if ($password != $confirmpass) {
        $errors = "Please enter same confirm password with password!";
        $errorNum = 1;
    } else if($position == "Manager"){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        require_once "pdo.php";
        $sql = "INSERT INTO manager (firstName, lastname, position, username, password, specialPin) VALUES(:fname, :lname, :pos, :usern, :pass, :specialp)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':fname' => $first_name,
            ':lname' => $last_name,
            ':pos' => $position,
            ':usern' => $username,
            ':pass' => $password,
            ':specialp' => $pin
        ));
        $errors = "Successfully Registered!";
        $errorNum = 2;
    }
    else if($position == "Admin"){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        require_once "pdo.php";
        $sql = "INSERT INTO admin (admin_name, password) VALUES(:usern, :pass)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':usern' => $username,
            ':pass' => $password,
        ));
        $errors = "Successfully Registered!";
        $errorNum = 2;
    }
}
?>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styling.css">
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
    </style>
</head>

<body>
    <div class="signup-form">
        <form method="post">
            <h2>Register</h2>
            <p class="hint-text">Create your account. It's free and only takes a minute.</p>

            <?php
            if ($errorNum == 1) {
                echo '<p style="color:red">' . $errors;
            } else if ($errorNum == 2) {
                echo '<p style="color:green">' . $errors;
            }
            ?>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="position" placeholder="Position" required="required">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="forgotPin" placeholder="Special pin" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
    </div>
</body>

</html>