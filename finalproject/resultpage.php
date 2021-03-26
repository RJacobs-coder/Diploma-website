<!DOCTYPE html>
<html lang="en">

<head>
    <title>FinalProject ResultPage</title>
    <meta name="keywords" content="finalproject, diploma, robert, jacobs" />
    <meta name="author" content="Robert Jacobs" />
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="finalstylesheet.css" />

    <!-- Form Style to color code each table to seperate each page.-->
    <style>
        table,
        tr,
        th,
        td {
            padding-right: 150px;
            color: darkblue;
            border: 10px solid darkblue;
            background: rgba(0, 0, 139, 0.20);
        }
    </style>

</head>

<body>
    <div class="jumbotron text-center" style="margin-bottom:0"></div>
    <h2> Result Page </h2>
    </div>
    <!-- Nav bar on side of page.-->
    <div class="row">
        <div class="col-sm-1">
            <nav class="navbar-brand" style="color:black; font-size:larger; border-bottom: solid;" href="#">Nav Bar
            </nav>
            <div>

                <!-- Color coded links to make each page look distinct -->
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="navlink" style="color: purple" href="homepage.html">Home Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:darkblue" href="searchpage.html">Search
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color: slateblue" href="displaypage.php">Display
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:gray" href="topten.php">Display Top 10
                            Page</a>
                    </li>
                </ul>
            </div>
            </nav>
        </div>


        <div class="col-lg-11">
            <h2 style="border-bottom-style:none;">This is the result from the Search Input. </h2>

        </div>
    </div>
    <form action="searchpage.html" method="POST">
        <input type="submit" name="submit" value="Search Again">
    </form>
    </br>

    <?php

    require('connection.php');

    $title = $_POST['title'];
    $studio = $_POST['studio'];
    $rating = $_POST['rating'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];

    // Array to hold values into a combined string to use in query.
    $array = array();

    // sql is the query that accepts all the values of the array and concatonates them to be accepting into the database.
    $sql = "";

    // For loop measures out the max size of the array. Selects specific values to put into array depending on which search parameters were provided by the user.
    for ($i = 0; $i < 5; $i++) {
        switch ($i) {

                // The array currantly is set to the default of Zero Indexes.
                // The switch case will validate the information from "searchpage.php" and format it for SQL.
                // The values are then pushed into the array one by one.
            case 0:
                if ($title === "") { // If nothing is present. Break onto the next step.

                    break;
                } else {
                    $temp = "Title='" . $title . "'"; // Temp value formats the information in a way that is compliant with SQL statements.
                    array_push($array, $temp); // The value is pushed into the array, increasing the number of indexes by one dynamically.
                    echo "Title at Switch Case -- $title </br>";
                }
                break;
            case 1:
                if ($studio === "") {

                    break;
                } else {
                    $temp = "Studio='" . $studio . "'";
                    array_push($array, $temp);
                }
                break;
            case 2:
                if ($rating === "") {

                    break;
                } else {
                    $temp = "Rating='" . $rating . "'";
                    array_push($array, $temp);
                }
                break;
            case 3:
                if ($year === "") {

                    break;
                } else {
                    $temp = "Year='" . $year . "'";
                    array_push($array, $temp);
                }
                break;
            case 4:
                if ($genre === "") {

                    break;
                } else {
                    $temp = "Genre='" . $genre . "'";
                    array_push($array, $temp);
                }
                break;
            default:
                echo "Issue at switch case";
                break;
        }
    }

    // Validates and constructs the SQL Statement to be used in the execute.
    $size = sizeof($array) - 1; // - 1 because indexing starts at zero.


    for ($i = 0; $i < $size + 1; $i++) {
        if ($i < $size) {

            $sql = $sql . $array[$i] . " AND ";
            echo "Jeremy request --- $sql";
        } elseif ($i === $size) {

            $sql = $sql . $array[$i] . " ; ";

            echo "Result from concatonation $sql </br>";
            print_r($array);
        } else {
            echo "</br> Error Occured --  Else Array Size = $i";
        }
    }
    echo "Result after sql string Creation -- Title -> $title";
    echo "</br> sql string --> $sql";
    print_r($array);

    // Query is constructed and inserted into database.
    $query = "SELECT * FROM movies WHERE $sql";
    $result = $conn->prepare($query);

    echo "</br>This is the query after result has been assigned.-- $query";

    try {
        $result->execute();
    } catch (exception $e) {

        echo "Query did not execute. Please try again.";
    } finally {

        // Connection break for security.
        $conn = null;
    }


    // Results printed out in form.
    if ($result->rowcount() <= 0) {

        echo "<p>Search Results not found.</p>";

    } else {

    ?>
        <div class="row">
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-lg-11">

                    <!-- Form to display results from table. -->
                    <table>
                        <tr style="font-size: 120%;">

                            <th>ID</th>
                            <th>Title</th>
                            <th>Studio</th>
                            <th>Status</th>
                            <th>Sound</th>
                            <th>Versions</th>
                            <th>RecRetPrice</th>
                            <th>Rating</th>
                            <th>Year</th>
                            <th>Genre</th>
                            <th>Aspect</th>
                            <th>Aspect</th>
                        </tr>
                        <?php
                        while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        //for ($i = 0; $row = $result->fetch(); $i++) {
                        ?>
                            <tr style="font-size: 65%;">
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['Title']; ?></td>
                                <td><?php echo $row['Studio']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                                <td><?php echo $row['Sound']; ?></td>
                                <td><?php echo $row['Versions']; ?></td>
                                <td><?php echo $row['RecRetPrice']; ?></td>
                                <td><?php echo $row['Rating']; ?></td>
                                <td><?php echo $row['Year']; ?></td>
                                <td><?php echo $row['Genre']; ?></td>
                                <td><?php echo $row['Aspect']; ?></td>
                                <td><?php echo $row['count']; ?></td>
                            </tr>
                    <?php    }
                    }

                    // Connection break for security.
                    $conn = null;
                    ?>
                    </table>
                </div>


            </div>

</body>

</html>