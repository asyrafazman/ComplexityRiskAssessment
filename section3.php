<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Section 3</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function validate() {

            a = document.form.q25.value;
            b = document.form.q26.value;
            c = document.form.q27.value;
            d = document.form.q28.value;
            e = document.form.q29.value;
            f = document.form.q30.value;
            g = document.form.q31.value;
            h = document.form.q32.value;
            i = document.form.q33.value;

            if (a == '' || b == '' || c == '' || d == '' || e == '' || f == '' || g == '' || h == '' || i == '') {
                alert("Please answer all questions!");
                return false;
            }
        }
    </script>
</head>

<body>
    <?php
    require_once "pdo.php";

    if (isset($_POST['submit'])) {

        //Get Answers
        $sect3 = $_POST['q25'] . ',' . $_POST['q26'] . ',' . $_POST['q27'] . ',' . $_POST['q28'] . ',' . $_POST['q29'] . ',' . $_POST['q30'] . ',' . $_POST['q31'] . ',' .
            $_POST['q32'] . ',' . $_POST['q33'];

        //Store in cookie
        setcookie('sect3', $sect3);

        //Redirect to next section
        header('location: section4.php');
    }
    ?>

    <h1>Procurement Risks (9 Questions)</h1><br />

    <form method="POST" name="form" onSubmit="return validate()">
        <table class="table">
            <?php
            //Get questions from database
            $sql = "SELECT * FROM questions WHERE sectionId = 3";
            $result = $pdo->query($sql);

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
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "<input type='radio' name='q$questionNum' value='$row2[ratingValue]' />$row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <input type="submit" name="submit" value="Next">
    </form>
</body>

</html>