<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Section 4</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function validate() {

            a = document.form.q34.value;
            b = document.form.q35.value;
            c = document.form.q36.value;
            d = document.form.q37.value;
            e = document.form.q38.value;

            if (a == '' || b == '' || c == '' || d == '' || e == '') {
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
        $sect4 = $_POST['q34'] . ',' . $_POST['q35'] . ',' . $_POST['q36'] . ',' . $_POST['q37'] . ',' . $_POST['q38'];

        //Store in cookie
        setcookie('sect4', $sect4);

        //Redirect to next section
        header('location: section5.php');
    }
    ?>

    <h1>Human Resources Risks (5 Questions)</h1><br />

    <form method="POST" name="form" onSubmit="return validate()">
        <table class="table">
            <?php
            //Get questions from database
            $sql = "SELECT * FROM questions WHERE sectionId = 4";
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