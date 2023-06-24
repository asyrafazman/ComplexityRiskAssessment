<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Result</title>
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
    <?php
    session_start();
    $managerID = $_SESSION['managerID'];
    if (isset($_GET['projectID'])) {
        $_SESSION['projectID'] = $_GET['projectID'];
        $projectID = $_SESSION['projectID'];

        //Initialize score for each section
        $score1 = $score2 = $score3 = $score4 = $score5 = $score6 = $score7 = 0;

        require_once "pdo.php";
        $stmt = $pdo->prepare("SELECT section1, section2, section3, section4, section5, section6, section7 FROM result where manager_id=:manageID AND projectId=:projID");
        $stmt->execute(array(
            ':manageID' => $managerID,
            ':projID' => $projectID,
        ));

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($rows)
            foreach ($rows as $row) {
                $score1 = $row['section1'];
                $score2 = $row['section2'];
                $score3 = $row['section3'];
                $score4 = $row['section4'];
                $score5 = $row['section5'];
                $score6 = $row['section6'];
                $score7 = $row['section7'];
            }


        //Total score of all section
        $total = $score1 + $score2 + $score3 + $score4 + $score5 + $score6 + $score7;

        //Determine result
        $result1 = '';
        $total2 = ($total / 320) * 100;

        //Get risk definition from database
        require_once "pdo.php";

        $sql = "SELECT level, score_min, score_max FROM define";
        $result = $pdo->query($sql);

        while ($row = $result->fetch()) {

            if ($total2 >= $row['score_min'] && $total2 <= $row['score_max']) {
                $result1 = $row['level'];
            }
        }
    ?>
        <div class="container">
            <h1>Overall Summary</h1>
            <h3>Project ID: <?php echo $projectID ?></h2>

                <table class="table">
                    <tr>
                        <th>Section</th>
                        <th>Score</th>
                    </tr>
                    <tr>
                        <td>Project Characteristics</td>
                        <td><?php echo "$score1"; ?></td>
                    </tr>
                    <tr>
                        <td>Strategic Management Risks</td>
                        <td><?php echo "$score2"; ?></td>
                    </tr>
                    <tr>
                        <td>Procurement Risks</td>
                        <td><?php echo "$score3"; ?></td>
                    </tr>
                    <tr>
                        <td>Human Resource Risks</td>
                        <td><?php echo "$score4"; ?></td>
                    </tr>
                    <tr>
                        <td>Business Risks</td>
                        <td><?php echo "$score5"; ?></td>
                    </tr>
                    <tr>
                        <td>Project Management Integration Risks</td>
                        <td><?php echo "$score6"; ?></td>
                    </tr>
                    <tr>
                        <td>Project Requirements Risks</td>
                        <td><?php echo "$score7"; ?></td>
                    </tr>
                    <tr>
                        <td><b>Total</b></td>
                        <td><b><?php echo "$total"; ?></b></td>
                    </tr>
                </table>

                <p>Complexity and Risk Level: <?php echo "<strong>" . $result1 . "</strong>"; ?></p>

                <input type="button" name="print" value="Print" onclick="window.print();"class="btn btn-primary mr-3" title="Print">
                <input type="button" name="list" value="Return to list" onclick="location.href='list.php'" class="btn btn-info" title="Return to List">
            <?php
        } else {
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            echo '<div class="alert alert-danger"><em>Please answer the assessment first!</em></div>';
            ?>
                <input type="button" name="menu" value="Back to list" onclick="location.href='list.php'">
            <?php
        } ?>
        </div>
</body>

</html>