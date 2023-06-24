<?php
session_start();
$managerID = $_SESSION['managerID'];
$projectName = "";
$owners = "";
$funds = "";
$duration = "";
$mode = "";
$errors = "";
$num = "";

?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Project Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styling2.css">
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
<nav class="navbar navbar-default">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">Complexity and Risk Assessment Tool</a>
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Services <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="registration.php">Register Project</a></li>
                        <li><a href="list.php">List Project</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <?php

    if (isset($_POST['projName']) && isset($_POST['owner']) && isset($_POST['funds']) && isset($_POST['duration']) && isset($_POST['mode'])) {

        $projectName = $_POST['projName'];
        $owners = $_POST['owner'];
        $funds = $_POST['funds'];
        $duration = $_POST['duration'];
        $mode = $_POST['mode'];

        // Validate project name
        $input_name = trim($_POST["projName"]);
        if (empty($input_name)) {
            $name_err = "Please enter the project name.";
            echo $name_err;
        } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $name_err = "Please enter a valid project name.";
            echo $name_err;
        } else {
            $name = $input_name;
        }

        // Validate owner
        $input_owner = trim($_POST["owner"]);
        if (empty($input_owner)) {
            $owner_err = "Please enter the owner.";
            echo $owner_err;
        } elseif (!filter_var($input_owner, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $owner_err = "Please enter a valid owner.";
            echo $owner_err;
        } else {
            $owner = $input_owner;
        }

        // Validate funds
        $input_funds = trim($_POST["funds"]);
        if (empty($input_funds)) {
            $funds_err = "Please enter the funds amount.";
            echo $funds_err;
        } elseif (!ctype_digit($input_funds)) {
            $funds_err = "Please enter a positive integer value.";
            echo $funds_err;
        } else {
            $funds = $input_funds;
        }

        // Validate duration
        $input_duration = trim($_POST["duration"]);
        if (empty($input_duration)) {
            $duration_err = "Please enter the project duration.";
            echo $duration_err;
        } elseif (!ctype_digit($input_duration)) {
            $duration_err = "Please enter a positive integer value.";
            echo $duration_err;
        } else {
            $duration = $input_duration;
        }

        // Validate mode
        $input_mode = trim($_POST["mode"]);
        if (empty($input_mode)) {
            $mode_err = "Please select a mode.";
            echo $mode_err;
        } else {
            $mode = $input_mode;
        }

        // Check input errors before inserting into database
        if (empty($name_err) && empty($owner_err) && empty($funds_err) && empty($duration_err) && empty($mode_err)) {
            require_once "pdo.php";
            // Prepare an insert statement
            $sql = "INSERT INTO project (projectName, owner, funds, duration, modeId, manager_ID) VALUES (:name, :owner, :funds, :duration, :mode, :manageID)";

            if ($stmt = $pdo->prepare($sql)) {
                // Set parameters
                $param_name = $name;
                $param_owner = $owner;
                $param_funds = $funds;
                $param_duration = $duration;
                $param_mode = $mode;
                $param_manager = $managerID;

                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":name", $param_name);
                $stmt->bindParam(":owner", $param_owner);
                $stmt->bindParam(":funds", $param_funds);
                $stmt->bindParam(":duration", $param_duration);
                $stmt->bindParam(":mode", $param_mode);
                $stmt->bindParam(":manageID", $param_manager);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    $sql = "SELECT projectID FROM project Where manager_ID = :manageID AND projectName = :name ";
                    $stmt = $pdo->prepare($sql);

                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":manageID", $param_manager);
                    $stmt->bindParam(":name", $param_name);

                    if ($stmt->execute()) {
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row) {
                            $projectID = $row['projectID'];
                        }
                        // Records created successfully. Redirect to landing page
                        $_SESSION['projectName'] = $projectName;
                        $_SESSION['projectID'] = $projectID;
                        $num = 2;
                        header("Location: list.php");
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        }
    }
    ?>
    <div class="container">
        <h1>Register Project</h1>
        <?php
        if ($num == 2) {
            echo '<p style="color:green">' . $errors;
        }
        ?>
        <form method="POST" class="form-group">
            <table class="table">
                <tr>
                    <td>Project name: </td>
                    <td><input type="text" name="projName" /></td>
                </tr>
                <tr>
                    <td>Owner: </td>
                    <td><input type="text" name="owner" /></td>
                </tr>
                <tr>
                    <td>Financial/Funds: </td>
                    <td><input type="text" name="funds" /></td>
                </tr>
                <tr>
                    <td>Project duration: </td>
                    <td><input type="text" name="duration" /> weeks</td>
                </tr>
                <tr>
                    <td>Mode: </td>
                    <td><select name="mode">
                            <option value="">--Select Mode--</option>
                            <option value="1">Insource</option>
                            <option value="2">Outsource</option>
                            <option value="3">Co-source</option>
                            <option value="4">Unspecififed</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Register" class="btn btn-primary mr-3" title="Register"> <a href="index.php">Cancel</a></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>