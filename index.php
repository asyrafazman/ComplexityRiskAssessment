<?php
session_start();
$firstName = "";
$lastName = "";

if (isset($_SESSION['managerID'])) {
    $managerID = $_SESSION['managerID'];
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
} else {
    header("Location: logout.php");
}

?>
<html lang="en">

<head>
    <title>Home</title>
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
                <li class="active"><a href="indexInformationPage.php">Information</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Services <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="registration.php">Register Project</a></li>
                        <li><a href="list.php">List Project</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action"><?php echo $firstName . " " . $lastName ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="material-icons">&#xE8AC;</i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>Project Complexity and Risk Assessment Tool</h1>
        <p>Please select your desired function on the navigation bar.</p>
    </div>

</html>