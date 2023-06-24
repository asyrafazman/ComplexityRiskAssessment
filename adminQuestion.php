<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Admin</title>
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
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <script>
function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
}
</script>
    <div class="container">
        <!--Return to admin page-->
        <input type="button" value="Back" onclick="location.href='indexAdmin.php'" />

        <!-- SECTION 1 -->
        <h3>Section 1: Project Characteristics </h3>

        <table class="table">
            <?php
            require_once "pdo.php";

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
                echo "<td><a href='changeQuestion.php?q=$questionNum'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br />

        <!-- SECTION 2 -->
        <h3>Section 2: Strategic Management Risks</h3>
        <button onclick="scrollToTop()" class="btn btn-primary">Scroll to Top</button>


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
                echo "<td><a href='changeQuestion.php?q=$questionNum'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br />

        <!-- SECTION 3 -->
        <h3>Section 3: Procurement Risks</h3>
        <button onclick="scrollToTop()" class="btn btn-primary">Scroll to Top</button>


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
                echo "<td><a href='changeQuestion.php?q=$questionNum'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br />

        <!-- SECTION 4 -->
        <h3>Section 4: Human Resources Risks</h3>
        <button onclick="scrollToTop()" class="btn btn-primary">Scroll to Top</button>


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
                echo "<td><a href='changeQuestion.php?q=$questionNum'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br />

        <!-- SECTION 5 -->
        <h3>Section 5: Business Risks</h3>
        <button onclick="scrollToTop()" class="btn btn-primary">Scroll to Top</button>


        <table class="table">
            <?php
            //Get questions from database
            $sql = "SELECT * FROM questions WHERE sectionId = 5";
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
                echo "<td><a href='changeQuestion.php?q=$questionNum'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br />

        <!-- SECTION 6 -->
        <h3>Section 6: Project Management Integration Risks</h3>
        <button onclick="scrollToTop()" class="btn btn-primary">Scroll to Top</button>


        <table class="table">
            <?php
            //Get questions from database
            $sql = "SELECT * FROM questions WHERE sectionId = 6";
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
                echo "<td><a href='changeQuestion.php?q=$questionNum'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br />

        <!-- SECTION 7 -->
        <h3>Section 7: Project Requirements Risks</h3>
        <button onclick="scrollToTop()" class="btn btn-primary">Scroll to Top</button>


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
                echo "<td><a href='changeQuestion.php?q=$questionNum'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>