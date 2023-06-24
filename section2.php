<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Section 2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script type="text/javascript">
        function validate() {

            a = document.form.q19.value;
            b = document.form.q20.value;
            c = document.form.q21.value;
            d = document.form.q22.value;
            e = document.form.q23.value;
            f = document.form.q24.value;

            if (a == '' || b == '' || c == '' || d == '' || e == '' || f == '') {
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
        $sect2 = $_POST['q19'] . ',' . $_POST['q20'] . ',' . $_POST['q21'] . ',' . $_POST['q22'] . ',' . $_POST['q23'] . ',' . $_POST['q24'];

        //Store in cookie
        setcookie('sect2', $sect2);

        //Redirect to next section
        if (isset($_COOKIE['sect3']))
            header('location: section3.php');
        else
            header('location: section4.php');
    }
    ?>

    <h1>Strategic Management Risks (6 Questions)</h1><br />

    <form method="POST" name="form" onSubmit="return validate()">
        <table class="table">
            <?php
            //Get questions from database
            $sql = "SELECT * FROM questions WHERE sectionId = 2";
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