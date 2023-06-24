<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Section 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function validate() {

            a = document.form.q50.value;
            b = document.form.q51.value;
            c = document.form.q52.value;
            d = document.form.q53.value;
            e = document.form.q54.value;
            f = document.form.q55.value;
            g = document.form.q56.value;
            h = document.form.q57.value;
            i = document.form.q58.value;
            j = document.form.q59.value;
            k = document.form.q60.value;
            l = document.form.q61.value;
            m = document.form.q62.value;
            n = document.form.q63.value;
            o = document.form.q64.value;

            if (a == '' || b == '' || c == '' || d == '' || e == '' || f == '' || g == '' || h == '' || i == '' || j == '' || k == '' ||
                l == '' || m == '' || n == '' || o == '') {
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
        $sect7 = $_POST['q50'] . ',' . $_POST['q51'] . ',' . $_POST['q52'] . ',' . $_POST['q53'] . ',' . $_POST['q54'] . ',' . $_POST['q55'] . ',' . $_POST['q56'] . ',' .
            $_POST['q57'] . ',' . $_POST['q58'] . ',' . $_POST['q59'] . ',' . $_POST['q60'] . ',' . $_POST['q61'] . ',' . $_POST['q62'] . ',' . $_POST['q63'] . ',' .
            $_POST['q64'];

        //Store in cookie
        setcookie('sect7', $sect7);

        //Redirect to next section
        header('location: summary.php');
    }
    ?>

    <h1>Project Requirements Risks (15 Questions)</h1><br />

    <form method="POST" name="form" onSubmit="return validate()">
        <table class="table">
            <?php
            //Get questions from database
            $sql = "SELECT * FROM questions WHERE sectionId = 7";
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

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>