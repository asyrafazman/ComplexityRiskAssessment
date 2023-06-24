<?php
session_start();
if (!isset($_SESSION['adminID'])) {
    header("Location: logoutAdmin.php");
}
?>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('loginbackground1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .wrapper {
            width: 700px;
            margin: 0 auto;
            max-width: auto;
            margin: 0 auto;
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
        }

        table tr td:last-child {
            width: 120px;
        }

        h5 {
            color: darkgreen;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Registered Manager Details</h2>
                        <h5 class="pull-right"><?php echo "Admin ID: <small>" . $_SESSION['adminID'] . "</small>"; ?></h5>
                    </div>
                    <div class="mt-3 mb-3 clearfix">
                        <a href="logoutAdmin.php" class="btn btn-warning pull-right m-2">Log Out</a>
                        <a href="changedefinition.php" class="btn btn-primary pull-left m-2">Change Definition</a>
                        <a href="adminQuestion.php" class="btn btn-primary pull-left m-2">Questions List</a>
                    </div>
                    <?php

                    // Include pdo file
                    require_once "pdo.php";

                    // Attempt select query execution
                    $sql = "SELECT manager_ID, firstName, lastName, username, attempt FROM manager";
                    if ($result = $pdo->query($sql)) {
                        if ($result->rowCount() > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Manager ID</th>";
                            echo "<th>Name</th>";
                            echo "<th>Username</th>";
                            echo "<th>Attempt</th>";
                            echo "<th>Tools</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['manager_ID'] . "</td>";
                                echo "<td>" . $row['firstName'] . " " . $row['lastName'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['attempt'] . "</td>";
                                echo "<td>";
                                echo '<a href="resetAttempt.php?id=' . $row['manager_ID'] . '" title="Reset Record" data-toggle="tooltip" class="btn btn-warning" style="margin-right: 3px; font-size: 12px; padding: 4px 8px;">Reset Record</a>';
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
    </div>
</body>

</html>