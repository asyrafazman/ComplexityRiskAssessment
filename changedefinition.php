<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Change definition</title>
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

    //Return to admin page
    if (isset($_POST['back'])) {
        header('location: indexAdmin.php');
    }

    if (isset($_POST['submit'])) {

        //Update Definition
        for ($i = 1; $i < 5; $i++) {
            $sql1 = "UPDATE define SET level = :level WHERE defineId = $i";
            $sql2 = "UPDATE define SET definition = :definition WHERE defineId = $i";
            $sql3 = "UPDATE define SET score_min = :score_min WHERE defineId = $i";
            $sql4 = "UPDATE define SET score_max = :score_max WHERE defineId = $i";

            $stmt1 = $pdo->prepare($sql1);
            $stmt2 = $pdo->prepare($sql2);
            $stmt3 = $pdo->prepare($sql3);
            $stmt4 = $pdo->prepare($sql4);

            $stmt1->bindParam(":level", $param_level);
            $stmt2->bindParam(":definition", $param_define);
            $stmt3->bindParam(":score_min", $param_min);
            $stmt4->bindParam(":score_max", $param_max);

            $level = 'level' . $i;
            $define = 'define' . $i;
            $min = 'min' . $i;
            $max = 'max' . $i;

            $param_level = $_POST[$level];
            $param_define = $_POST[$define];
            $param_min = $_POST[$min];
            $param_max = $_POST[$max];

            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();
            $stmt4->execute();
        }

        header('location: changedefinition.php');
    }
    ?>

    <form method="POST">
        <table class="table">

            <tr>
                <th>Complexity and Risk Level</th>
                <th>Definition</th>
                <th colspan='2'>Score</th>
            </tr>

            <?php
            //Get definition from database
            $sql = "SELECT * FROM define";
            $result = $pdo->query($sql);

            //Distinguish every level
            $count = 1;

            while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td><input type='text' name='level$count' size='20' value='$row[level]'></td>";
                echo "<td><textarea name='define$count' cols='100' rows='6'>$row[definition]</textarea></td>";
                echo "<td><input type='text' name='min$count' size='8' value='$row[score_min]'></td>";
                echo "<td><input type='text' name='max$count' size='8' value='$row[score_max]'></td>";
                echo "</tr>";
                $count++;
            }
            ?>
        </table>

        <input type='submit' name='back' value='Back'>
        <input type='submit' name='submit' value='Change'>
    </form>
</body>

</html>