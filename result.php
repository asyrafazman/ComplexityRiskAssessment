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
</head>

<body>
    <?php
    session_start();
    $managerID = $_SESSION['managerID'];
    $projectID = $_SESSION['projectID'];

    //Get answers from cookies
    $sect1 = explode(',', $_COOKIE['sect1']);
    $sect2 = explode(',', $_COOKIE['sect2']);
    $sect3 = explode(',', $_COOKIE['sect3']);
    $sect4 = explode(',', $_COOKIE['sect4']);
    $sect5 = explode(',', $_COOKIE['sect5']);
    $sect6 = explode(',', $_COOKIE['sect6']);
    $sect7 = explode(',', $_COOKIE['sect7']);

    //Initialize score for each section
    $score1 = $score2 = $score3 = $score4 = $score5 = $score6 = $score7 = 0;

    //Sum up the score for each section
    foreach ($sect1 as $section1) {
        $score1 += $section1;
    }

    foreach ($sect2 as $section2) {
        $score2 += $section2;
    }

    foreach ($sect3 as $section3) {
        $score3 += $section3;
    }

    foreach ($sect4 as $section4) {
        $score4 += $section4;
    }

    foreach ($sect5 as $section5) {
        $score5 += $section5;
    }

    foreach ($sect6 as $section6) {
        $score6 += $section6;
    }

    foreach ($sect7 as $section7) {
        $score7 += $section7;
    }

    require_once "pdo.php";
    $stmt = $pdo->prepare("SELECT * FROM result where manager_id=:manageID AND projectId=:projID");
    $stmt->execute(array(
        ':manageID' => $managerID,
        ':projID' => $projectID,
    ));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows) {
        $sql = "INSERT INTO result (section1, section2, section3, section4, section5, section6, section7, manager_id, projectId) 
    VALUES(:sec1, :sec2, :sec3, :sec4, :sec5, :sec6, :sec7, :manageID, :projID)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':sec1' => $score1,
            ':sec2' => $score2,
            ':sec3' => $score3,
            ':sec4' => $score4,
            ':sec5' => $score5,
            ':sec6' => $score6,
            ':sec7' => $score7,
            ':manageID' => $managerID,
            ':projID' => $projectID,
        ));
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

    <h2>Overall Summary</h2>

    <table class="table table-stripped">
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

    <p>Complexity and Risk Level: <?php echo "$result1"; ?></p>

    <input type="button" name="print" value="Print" onclick="window.print();">
    <input type="button" name="list" value="Return to list" onclick="location.href='list.php'">
    <input type="button" name="summary" value="Return to summary" onclick="location.href='summary.php'">
</body>

</html>