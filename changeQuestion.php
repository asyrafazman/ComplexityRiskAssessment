<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Change question</title>
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
    require_once "pdo.php";

    //Get question number from url
    $questionNum = $_GET['q'];

    //Return to questions page
    if (isset($_POST['back'])) {
        header('location: adminQuestion.php');
    }

    if (isset($_POST['submit'])) {
        //Update Question
        $sql1 = "UPDATE questions SET question = :question WHERE questionNum = $questionNum";
        $q2 = '';

        if ($_POST['totalList'] > 1) {
            for ($j = 1; $j < $_POST['totalList']; $j++) {

                $list = 'list' . $j;
                $q2 .= ";$_POST[$list]";
            }
        }

        //Combine question text and its list
        $q = $_POST['quest'] . $q2;

        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(":question", $param_question);
        $param_question = $q;
        $stmt1->execute();

        //Update Rating
        for ($k = 0; $k < $_POST['totalRating']; $k++) {

            $rateId = 'rateId' . $k;
            $sql2 = "UPDATE rating SET ratingText = :ratingText WHERE ratingId = $_POST[$rateId]";

            $rateText = 'rating' . $k;
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->bindParam(":ratingText", $param_rate);
            $param_rate = $_POST[$rateText];
            $stmt2->execute();
        }

        header('location: changeQuestion.php?q=' . $questionNum);
    }
    ?>

    <h1>Modify Question</h1>
    <form method="POST">
        <table class="table table-bordered">

            <?php
            //Get questions from database
            $sql = "SELECT question FROM questions WHERE questionNum = $questionNum";
            $result = $pdo->query($sql);

            while ($row = $result->fetch()) {

                //Questions with list (a, b, c, d, etc.)
                $questions = explode(";", $row['question']);
                $countList = count($questions);
                echo "<input type='hidden' name='totalList' value='$countList'>";

                echo "<tr>";
                echo "<td><textarea name='quest' cols='100' rows='3'>$questions[0]</textarea>";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br /><textarea name='list$i' cols='100'>$questions[$i]</textarea>";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingId, ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                //Count how many ratings
                $count = 0;

                while ($row2 = $result2->fetch()) {
                    echo "<input type='hidden' name='rateId$count' value='$row2[ratingId]'>";
                    echo "$row2[ratingValue] = <input type='text' name='rating$count' size='100' value='$row2[ratingText]'><br />";
                    $count++;
                }

                echo "<input type='hidden' name='totalRating' value='$count'>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <input type='submit' name='back' value='Back'>
        <input type='submit' name='submit' value='Change'>
    </form>
</body>

</html>