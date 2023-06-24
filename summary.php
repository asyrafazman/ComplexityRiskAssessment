<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    require_once "pdo.php";

    $sect1 = explode(',', $_COOKIE['sect1']);
    $sect2 = explode(',', $_COOKIE['sect2']);
    $sect3 = explode(',', $_COOKIE['sect3']);
    $sect4 = explode(',', $_COOKIE['sect4']);
    $sect5 = explode(',', $_COOKIE['sect5']);
    $sect6 = explode(',', $_COOKIE['sect6']);
    $sect7 = explode(',', $_COOKIE['sect7']);
    ?>

    <h1>Sections Summary</h1>
    <input type="button" name="result" value="Result" onclick="location.href='result.php';" />

    <!-- SECTION 1 -->
    <h3>Section 1: Project Characteristics</h3>

    <table class="table">
        <?php
        //Get questions from database
        $sql = "SELECT * FROM questions WHERE sectionId = 1";
        $result = $pdo->query($sql);

        //Answer counter
        $countAns = 0;

        while ($row = $result->fetch()) {

            $questionNum = $row['questionNum'];

            //Questions with list (a, b, c, d, etc.)
            $questions = explode(";", $row['question']);
            $countList = count($questions);

            echo "<tr>";
            echo "<td>$questionNum. $questions[0]";

            for ($i = 1; $i < $countList; $i++) {
                echo "<br />$questions[$i]";
            }
            echo "</td>";

            //Get answer from cookie
            if ($countAns < 18)
                echo "<td>$sect1[$countAns]</td>";

            echo "</tr>";
            $countAns++;
        }
        ?>
    </table>
    <br />

    <!-- SECTION 2 -->
    <h3>Section 2: Strategic Management Risks</h3>

    <table class="table">
        <?php
        //Get questions from database
        $sql = "SELECT * FROM questions WHERE sectionId = 2";
        $result = $pdo->query($sql);

        //Answer counter
        $countAns = 0;

        while ($row = $result->fetch()) {

            $questionNum = $row['questionNum'];

            //Questions with list (a, b, c, d, etc.)
            $questions = explode(";", $row['question']);
            $countList = count($questions);

            echo "<tr>";
            echo "<td>$questionNum. $questions[0]";

            for ($i = 1; $i < $countList; $i++) {
                echo "<br />$questions[$i]";
            }
            echo "</td>";

            //Get answer from cookie
            if ($countAns < 6)
                echo "<td>$sect2[$countAns]</td>";

            echo "</tr>";
            $countAns++;
        }
        ?>
    </table>
    <br />

    <!-- SECTION 3 -->
    <h3>Section 3: Procurement Risks</h3>

    <table class="table">
        <?php
        //Get questions from database
        $sql = "SELECT * FROM questions WHERE sectionId = 3";
        $result = $pdo->query($sql);

        //Answer counter
        $countAns = 0;

        while ($row = $result->fetch()) {

            $questionNum = $row['questionNum'];

            //Questions with list (a, b, c, d, etc.)
            $questions = explode(";", $row['question']);
            $countList = count($questions);

            echo "<tr>";
            echo "<td>$questionNum. $questions[0]";

            for ($i = 1; $i < $countList; $i++) {
                echo "<br />$questions[$i]";
            }
            echo "</td>";

            //Get answer from cookie
            if ($countAns < 9)
                echo "<td>$sect3[$countAns]</td>";

            echo "</tr>";
            $countAns++;
        }
        ?>
    </table>
    <br />

    <!-- SECTION 4 -->
    <h3>Section 4: Human Resources Risks</h3>

    <table class="table">
        <?php
        //Get questions from database
        $sql = "SELECT * FROM questions WHERE sectionId = 4";
        $result = $pdo->query($sql);

        //Answer counter
        $countAns = 0;

        while ($row = $result->fetch()) {

            $questionNum = $row['questionNum'];

            //Questions with list (a, b, c, d, etc.)
            $questions = explode(";", $row['question']);
            $countList = count($questions);

            echo "<tr>";
            echo "<td>$questionNum. $questions[0]";

            for ($i = 1; $i < $countList; $i++) {
                echo "<br />$questions[$i]";
            }
            echo "</td>";

            //Get answer from cookie
            if ($countAns < 5)
                echo "<td>$sect4[$countAns]</td>";

            echo "</tr>";
            $countAns++;
        }
        ?>
    </table>
    <br />

    <!-- SECTION 5 -->
    <h3>Section 5: Business Risks</h3>

    <table class="table">
        <?php
        //Get questions from database
        $sql = "SELECT * FROM questions WHERE sectionId = 5";
        $result = $pdo->query($sql);

        //Answer counter
        $countAns = 0;

        while ($row = $result->fetch()) {

            $questionNum = $row['questionNum'];

            //Questions with list (a, b, c, d, etc.)
            $questions = explode(";", $row['question']);
            $countList = count($questions);

            echo "<tr>";
            echo "<td>$questionNum. $questions[0]";

            for ($i = 1; $i < $countList; $i++) {
                echo "<br />$questions[$i]";
            }
            echo "</td>";

            //Get answer from cookie
            if ($countAns < 5)
                echo "<td>$sect5[$countAns]</td>";

            echo "</tr>";
            $countAns++;
        }
        ?>
    </table>
    <br />

    <!-- SECTION 6 -->
    <h3>Section 6: Project Management Integration Risks</h3>

    <table class="table">
        <?php
        //Get questions from database
        $sql = "SELECT * FROM questions WHERE sectionId = 6";
        $result = $pdo->query($sql);

        //Answer counter
        $countAns = 0;

        while ($row = $result->fetch()) {

            $questionNum = $row['questionNum'];

            //Questions with list (a, b, c, d, etc.)
            $questions = explode(";", $row['question']);
            $countList = count($questions);

            echo "<tr>";
            echo "<td>$questionNum. $questions[0]";

            for ($i = 1; $i < $countList; $i++) {
                echo "<br />$questions[$i]";
            }
            echo "</td>";

            //Get answer from cookie
            if ($countAns < 6)
                echo "<td>$sect6[$countAns]</td>";

            echo "</tr>";
            $countAns++;
        }
        ?>
    </table>
    <br />

    <!-- SECTION 7 -->
    <h3>Section 7: Project Requirements Risks</h3>

    <table class="table">
        <?php
        //Get questions from database
        $sql = "SELECT * FROM questions WHERE sectionId = 7";
        $result = $pdo->query($sql);

        //Answer counter
        $countAns = 0;

        while ($row = $result->fetch()) {

            $questionNum = $row['questionNum'];

            //Questions with list (a, b, c, d, etc.)
            $questions = explode(";", $row['question']);
            $countList = count($questions);

            echo "<tr>";
            echo "<td>$questionNum. $questions[0]";

            for ($i = 1; $i < $countList; $i++) {
                echo "<br />$questions[$i]";
            }
            echo "</td>";

            //Get answer from cookie
            if ($countAns < 15)
                echo "<td>$sect7[$countAns]</td>";

            echo "</tr>";
            $countAns++;
        }
        ?>
    </table>
</body>

</html>