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
    <title>List</title>
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
                        <li><a href="#">List Project</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action"><?php echo $firstName . " " . $lastName ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="material-icons">&#xE8AC;</i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mr-2">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">List Company</h2>
                </div>
                <?php
                // Include pdo file
                require_once "pdo.php";

                // Attempt select query execution
                $sql = "SELECT projectId, projectName, owner, funds, duration, modeId FROM project where manager_id=:manageID";
                if ($result = $pdo->prepare($sql)) {
                    $result->bindParam(":manageID", $managerID);
                    $result->execute();
                    if ($result->rowCount() > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Project ID</th>";
                        echo "<th>Project Name</th>";
                        echo "<th>Owner</th>";
                        echo "<th>Funds</th>";
                        echo "<th>Duration</th>";
                        echo "<th>Mode Id</th>";
                        echo "<th>Tools</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $row['projectId'] . "</td>";
                            echo "<td>" . $row['projectName'] . "</td>";
                            echo "<td>" . $row['owner'] . "</td>";
                            echo "<td>" . $row['funds'] . "</td>";
                            echo "<td>" . $row['duration'] . "</td>";
                            echo "<td>" . $row['modeId'] . "</td>";
                            echo "<td>";
                            echo '<a href="section1.php?projectID=' . $row['projectId'] . '" class="btn btn-primary mr-3" title="Answer the Assessment" data-toggle="tooltip">Answer Assessment</a>';
                            echo '<a href="displayResult.php?projectID=' . $row['projectId'] . '" class="btn btn-info" title="View Result" data-toggle="tooltip">View Result</a>';
                            echo "</td>";
                            echo "</tr>";
                        }                        
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        unset($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                unset($pdo);
                ?>
            </div>
        </div>
    </div>
</body>

</html>