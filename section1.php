<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Section 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function validate() {

            a = document.form.q1.value;
            b = document.form.q2.value;
            c = document.form.q3.value;
            d = document.form.q4.value;
            e = document.form.q5.value;
            f = document.form.q6.value;
            g = document.form.q7.value;
            h = document.form.q8.value;
            i = document.form.q9.value;
            j = document.form.q10.value;
            k = document.form.q11.value;
            l = document.form.q12.value;
            m = document.form.q13.value;
            n = document.form.q14.value;
            o = document.form.q15.value;
            p = document.form.q16.value;
            q = document.form.q17.value;
            r = document.form.q18.value;

            if (a == '' || b == '' || c == '' || d == '' || e == '' || f == '' || g == '' || h == '' || i == '' || j == '' || k == '' ||
                l == '' || m == '' || n == '' || o == '' || p == '' || q == '' || r == '') {
                alert("Please answer all questions!");
                return false;
            }
        }
    </script>
</head>

<body>
    <?php
    require_once "pdo.php";
    $_SESSION['projectID'] = $_GET['projectID'];

    if (isset($_POST['submit'])) {

        //Get Answers
        $sect1 = $_POST['q1'] . ',' . $_POST['q2'] . ',' . $_POST['q3'] . ',' . $_POST['q4'] . ',' . $_POST['q5'] . ',' . $_POST['q6'] . ',' . $_POST['q7'] . ',' . $_POST['q8'] . ',' .
            $_POST['q9'] . ',' . $_POST['q10'] . ',' . $_POST['q11'] . ',' . $_POST['q12'] . ',' . $_POST['q13'] . ',' . $_POST['q14'] . ',' . $_POST['q15'] . ',' .
            $_POST['q16'] . ',' . $_POST['q17'] . ',' . $_POST['q18'];

        //Store in cookie
        setcookie('sect1', $sect1);

        //Constraint 1
        if ($_POST['q1'] == 5 && $_POST['q3'] == 5 && $_POST['q5'] == 5)
            setcookie('sect1', '5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5');

        //Constraint 2
        if ($_POST['q2'] == 1)
            setcookie('sect3', '1,1,1,1,1,1,1,1,1');

        //Redirect to next section
        header('location: section2.php');
    }
    ?>

    <h1>Project Characteristics (18 Questions)</h1><br />

    <form method="POST" name="form" onSubmit="return validate()">
        <table class="table">
            <?php
            //Get questions from database
            $sql = "SELECT * FROM questions WHERE sectionId = 1";
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