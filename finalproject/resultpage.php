<!DOCTYPE html>
<html lang="en">


<!-- Result page after the user has input data into searchpage.html. Will remove this page from navbar on final version -->

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
                    <li class="nav-item"><a class="navlink" style="color: darkblue" href="resultpage.php">Result
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color: slateblue" href="displaypage.php">Display
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:gold" href="topten.php">Display Top 10
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


                    require('connection.php');

                    // !!!Work in progress!!!!

                    // values allows user to get values from database for later use.
                    $title = $_POST['title'];
                    $studio = $_POST['studio'];
                    $rating = $_POST['rating'];
                    $year = $_POST['year'];
                    $genre = $_POST['genre'];

                    // Array to hold values into a combined string to use in query.
                    $array = array("", "", "", "", "");
                    $sql = "";



                    // For loop measures out the max size of the array. Selects specific values to put into array depending on which search parameters were provided by the user.
                    for ($i = 0; $i < 5; $i++) {
                        switch ($i) {

                            // Switch case to keep track of which result was input by the user.
                            // Each user input (Form from searchpage.html) is checked to see if there is a value present. If not leave the empty.
                            case 0:
                                if ($title === "") {
                                    echo "Null at 1";
                                    break;
                                } else {
                                    // !!!Known bug!!! 
                                    // After the array is filled I need to create a way remove empty values ,concatonate filled values and create a completed dynamic query.
                                    $array[$i] = "Title='" . $title . "'";
                                }
                                break;
                            case 1:
                                if ($studio === "") {
                                    echo "Null at 2";
                                    break;
                                } else {
                                    $array[$i] = "Studio='" . $studio . "'";
                                }
                                break;
                            case 2:
                                if ($rating === "") {
                                    echo "Null at 3";
                                    break;
                                } else {
                                    $array[$i] = "Rating='" . $rating . "'";
                                }
                                break;
                            case 3:
                                if ($year === "") {
                                    echo "Null at 4";
                                    break;
                                } else {
                                    $array[$i] = "Year='" . $year . "'";
                                }
                                break;
                            case 4:
                                if ($genre === "") {
                                    echo "Null at 5";
                                    break;
                                } else {
                                    $array[$i] = "Genre='" . $genre . "'";
                                }
                                break;
                            default:
                                echo "Issue at switch case";
                                break;
                        }
                    }

                    $counter = $i;
                    echo "\nBefore ForEach Sql";

                    // Takes the result of the switch case and creates a SQL query all the values except the last one.
                    if (sizeof($array) > 0) {
                        for ($i = 0; $i < $counter - 1; $i++) {
                            if (strlen($array[$i]) == 0) {
                                echo "Array at $i = null";
                            } else {
                                $sql = $sql . $array[$i] . "AND ";
                            }
                        }

                        // The end index of the array is formatted correctly for SQL.
                        $sql = $sql . $array[$counter - 1] . " ;";
                    } else {
                        // ELSE only one value in array. The singular value is parsed into the SQL query.
                        $sql = $sql . $array[0] . " ;";
                    }


                    // Query is constructed and inserted into database.
                    $query = "SELECT * FROM movies WHERE $sql";
                    $result = $conn->prepare($query);

                    $result->execute();

                    // Results printed out in form.
                    for ($i = 0; $row = $result->fetch(); $i++) {
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

                    // Connection break for security.
                    $conn = null;
                    ?>
                </table>
            </div>


        </div>

</body>

</html>