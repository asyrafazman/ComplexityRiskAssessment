<?php
session_start();
$firstName = "";
$lastName = "";

if (isset($_SESSION['managerID'])) {
    $managerID = $_SESSION['managerID'];
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
} else {
    header("Location: logout.php");
}

?>
<html lang="en">

<head>
    <title>Information</title>
    <link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styling2.css">
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
    <nav class="navbar navbar-default">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">Complexity and Risk Assessment Tool</a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li class="active"><a href="indexInformationPage.php">Information</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Services <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="registration.php">Register Project</a></li>
                        <li><a href="list.php">List Project</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle user-action"> <?php echo $firstName . " " . $lastName ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="material-icons">&#xE8AC;</i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1>1. Introduction</h1>
        <h3>Background</h3>
        <p>The Project Complexity and Risk Assessment Tool (PCRA) is intended to support the Treasury Board Policy on the Management of Projects and the Standard for Project Complexity and Risk.</p>

        <p>The Treasury Board Policy on the Management of Projects requires deputy heads to ensure that each planned or proposed project which is subject to the Policy is accurately assessed to determine its level of risk and complexity for the purposes of project approval and expenditure authority.</p>

        <p>This questionnaire is a derivative of Interis Consulting Inc.'s taxonomy-based questionnaire for project risk assessments. Interis' questionnaire draws extensively on the Continuous Risk Management Guidebook (1999) of the Software Engineering Institute (SEI). In consultation with project managers in the Government of Canada Interis has modified and extended the series of questions to reflect public sector and broader strategic considerations.</p>

        <h3>Risk and Complexity Definitions</h3>
        <p>The SEI, the authoring agency of the Continuous Risk Management Guidebook, uses the following definition for the term "risk":</p>

        <p>The Government of Canada (GC) cites the SEI as the basis for the concepts, methods, and guidelines embodied in the Integrated Risk Management Framework (IRMF). Within that Framework, the following definition of risk provides a standard for the GC:</p>

        <p>Risk has three key characteristics. The first is that it looks ahead into the future. The second is that there is an element of uncertainty: a condition or a situation exists that might cause a problem for the project in the future. The third characteristic is related to the outcome. Although it is acknowledged that risk, if managed properly, can lead to opportunity, the definition of risk adopted for the purposes of this policy instrument focuses on adverse outcomes. This definition is consistent with the SEI's Continuous Risk Management software engineering practice supported by An Enhanced Framework for the Management of Information Technology Projects and conforms to the risk management concepts of the Treasury Board of Canada Secretariat's Integrated Risk Management Framework.</p>

        <p>
            <strong>Calculation method:</strong> score = (total rating/320) x 100
        </p>
        <p>
            <strong>Project complexity:</strong> Complexity is, fittingly, a much more difficult concept to define. Once again, the SEI provides a solid definition from Webster's:
        </p>

        <p><strong>Complexity:</strong></p>
        <ol>
            <li>(Apparent) the degree to which a system or component has a design or implementation that is difficult to understand and verify.</li>
            <li>(Inherent) the degree of complication of a system or system component, determined by such factors as the number and intricacy of interfaces, the number and intricacy of conditional branches, the degree of nesting, and the types of data structures.</li>
        </ol>
        <p>The assessment is divided into seven sections or categories of questions. They are described in Table 1.</p>

        <div class="col text-center">
            <h3>Table 1 - Description of the sections</h3>
        </div>
        <table class="table table-striped">
            <tr>
                <th>Section</th>
                <th>Description</th>
            </tr>
            <tr>
                <th>Project Characteristics (18 Questions)</th>
                <td>This category is designed to build a profile of a given project with respect to key attributes, including funding, budget, size and number of resources, duration, scope, technology scope, stakeholders, dependencies, and external considerations.</td>
            </tr>
            <tr>
                <th>Strategic Management Risks (6 Questions)</th>
                <td>This category assesses a project's alignment with the organization's investment plan:
                    <ul>
                        <li>Is the project well-positioned to achieve the goals and objectives of the plan?</li>
                        <li>Is the project a potential risk to the plan?</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Procurement Risks (9 Questions)</th>
                <td>This category assesses the extent to which procurement activities present potential risks to the project.</td>
            </tr>
            <tr>
                <th>Human Resource Risks (5 Questions)</th>
                <td>This category assesses whether the project team has the right skill sets in place, with the appropriate roles and responsibilities.</td>
            </tr>
            <tr>
                <th>Business Risks (5 Questions)</th>
                <td>This category assesses the extent to which the project affects the organization operationally and from a legislative perspective.</td>
            </tr>
            <tr>
                <th>Project Management Integration Risks (6 Questions)</th>
                <td>This category assesses whether the project demonstrates implementation of key project management control measures and deliverables. This assessment includes addressing the state of the project management plan, project management and control disciplines, and information management processes.</td>
            </tr>
            <tr>
                <th>Project Requirements Risks (15 Questions)</th>
                <td>This category assesses, by considering the number, type, and degree of certainty of the requirements, the extent to which the specific requirements of the project add risk and complexity.</td>
            </tr>
        </table>

        <div class="col text-center">
            <h3>Table 2 - Value of the sections</h3>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Section</th>
                <th>Number of Questions</th>
                <th>Maximum Score</th>
            </tr>
            <tr>
                <th>Project Characteristics</th>
                <td>18</td>
                <td>90</td>
            </tr>
            <tr>
                <th>Strategic Management Risks</th>
                <td>6</td>
                <td>30</td>
            </tr>
            <tr>
                <th>Procurement Risks</th>
                <td>9</td>
                <td>45</td>
            </tr>
            <tr>
                <th>Human Resource Risks</th>
                <td>5</td>
                <td>25</td>
            </tr>
            <tr>
                <th>Business Risks</th>
                <td>5</td>
                <td>25</td>
            </tr>
            <tr>
                <th>Project Management Integration Risks</th>
                <td>6</td>
                <td>30</td>
            </tr>
            <tr>
                <th>Project Requirements Risks</th>
                <td>15</td>
                <td>75</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>64</td>
                <td>320</td>
            </tr>
        </table>
        <p>The questions are all of equal value in the overall score. Please note though that if questions 1, 3, and 11, which deal with money, scope, and time in the project characteristics section, are all answered as '5', a triple constraint condition will apply resulting in '5' response scoring for all questions in this section (i.e. the maximum score of 90 for the section). In addition, if the project has no procurement (addressed in question 2) the minimum score is automatically assigned for each question in the procurement section.</p>
        <p>The criteria in the PCRA consider a very broad range of potential project risks which stem from virtually every possible root cause relevant for just about any project. However, not every project risk will apply to every project in every instance. When the PCRA was validated in 2009, it was determined that approximately 70% of the project risks reflected in the assessment criteria would apply to any single project. Therefore, when calculating the final PCRA score, the total numeric value is normalized to accurately reflect the more realistic range of relevant risks for a single project.</p>
        <div class="col text-center">
            <h3>Table 3 - Complexity and Risk Level Defined</h3>
        </div>
        <?php
        // Include pdo file
        require_once "pdo.php";

        // Attempt select query execution
        $sql = "SELECT * FROM define";
        if ($result = $pdo->prepare($sql)) {
            $result->execute();
            if ($result->rowCount() > 0) {
                echo '<table class="table table-bordered table-striped">';
                echo "<thead>";
                echo "<tr>";
                echo "<th>Complexity and Risk Level</th>";
                echo "<th>Definition</th>";
                echo "<th>Score</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo "<th>" . $row['defineId'] . ". " . $row['level'] . "</th>";
                    echo "<td>" . $row['definition'] . "</td>";
                    echo "<td>" . $row['score_min'] . " between " . $row['score_max'] . "</td>";
                    echo "</tr>";
                }
            }
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        unset($result);
        ?>

        <h1>2. Instructions</h1>
        <p>The PCRA contains 64 questions. The questions are all given an equal percentage in the overall score. This tool is accompanied by the PCRA User Guide and an Excel spreadsheet that will tabulate the final score and rating automatically.</p>
        <p>There are a few rules for completing the PCRA:</p>
        <ul>
            <li>Every question must be answered. If you are sure a question does not apply to your project, answer with the lowest score ("1") for that question;</li>
            <li>If the answer to a question is unknown, answer with the highest score ("5") for that question; and</li>
            <li>If you answer "1" to Question 2 in the "Project characteristics" section (3.1), questions in the "Procurement risks" section (3.3) should be answered with a "1" only.</li>
        </ul>
        <p>If you require more specific information regarding the purpose of the section or the significance of a particular rating, please refer to the User Guide. For the definitions of terms, please refer to the Glossary included at the end of the User Guide. Some of the terminology used in the assessment tool may not be a best fit for your organization. Please consult your departmental coordinator on how the terms are to be applied in your organization.</p>
        <p>The tool is also available on-line. For further information on how to setup a user account and complete the assessment online, please contact your departmental coordinator or agency lead.</p>
        <h1>3. Project Complexity and Risk Assessment</h1>
        <h3>3.1 Project Characteristics (18 Questions)</h3>
        <table class="table table-striped">

            <tr>
                <th>Num</th>
                <th id="quest">Question</th>
                <th id="rate">Rating</th>
            </tr>

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
                echo "<td>$questionNum</td>";
                echo "<td>$questions[0]";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br />&nbsp&nbsp&nbsp&nbsp$questions[$i]";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "$row2[ratingValue] = $row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>3.2 Strategic Management Risks (6 Questions)</h3>
        <table class="table table-striped">

            <tr>
                <th>Num</th>
                <th id="quest">Question</th>
                <th id="rate">Rating</th>
            </tr>

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
                echo "<td>$questionNum</td>";
                echo "<td>$questions[0]";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br />&nbsp&nbsp&nbsp&nbsp$questions[$i]";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "$row2[ratingValue] = $row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>3.3 Procurement Risks (9 Questions)</h3>
        <table class="table table-striped">

            <tr>
                <th>Num</th>
                <th id="quest">Question</th>
                <th id="rate">Rating</th>
            </tr>

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
                echo "<td>$questionNum</td>";
                echo "<td>$questions[0]";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br />&nbsp&nbsp&nbsp&nbsp$questions[$i]";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "$row2[ratingValue] = $row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>3.4 Human Resources Risks (5 Questions)</h3>
        <table class="table table-striped">

            <tr>
                <th>Num</th>
                <th id="quest">Question</th>
                <th id="rate">Rating</th>
            </tr>

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
                echo "<td>$questionNum</td>";
                echo "<td>$questions[0]";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br />&nbsp&nbsp&nbsp&nbsp$questions[$i]";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "$row2[ratingValue] = $row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>3.5 Business Risks (5 Questions)</h3>
        <table class="table table-striped">

            <tr>
                <th>Num</th>
                <th id="quest">Question</th>
                <th id="rate">Rating</th>
            </tr>

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
                echo "<td>$questionNum</td>";
                echo "<td>$questions[0]";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br />&nbsp&nbsp&nbsp&nbsp$questions[$i]";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "$row2[ratingValue] = $row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>3.6 Project Management Integration Risks (6 Questions)</h3>
        <table class="table table-striped">

            <tr>
                <th>Num</th>
                <th id="quest">Question</th>
                <th id="rate">Rating</th>
            </tr>

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
                echo "<td>$questionNum</td>";
                echo "<td>$questions[0]";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br />&nbsp&nbsp&nbsp&nbsp$questions[$i]";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "$row2[ratingValue] = $row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h3>3.7 Project Requirements Risks (15 Questions)</h3>
        <table class="table table-striped">

            <tr>
                <th>Num</th>
                <th id="quest">Question</th>
                <th id="rate">Rating</th>
            </tr>

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
                echo "<td>$questionNum</td>";
                echo "<td>$questions[0]";

                for ($i = 1; $i < $countList; $i++) {
                    echo "<br />&nbsp&nbsp&nbsp&nbsp$questions[$i]";
                }
                echo "</td>";
                echo "<td>";

                //Get ratings from database
                $sql2 = "SELECT ratingValue, ratingText FROM rating WHERE questionNum = $questionNum";
                $result2 = $pdo->query($sql2);

                while ($row2 = $result2->fetch()) {
                    echo "$row2[ratingValue] = $row2[ratingText] <br />";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>

    </div>

</html>