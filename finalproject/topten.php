<!DOCTYPE html>
<html lang="en">
<!-- Displays top 10 values based on the 'count' column in the database. -->

<head>
    <title>FinalProject SearchPage</title>
    <meta name="keywords" content="finalproject, diploma, robert, jacobs" />
    <meta name="author" content="Robert Jacobs" />
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="finalstylesheet.css" />

    <!-- Style for table, not in stylesheet due to the need to color code each page. -->
    <style>
        h4 {
            border-bottom-style: solid;
            text-align: center;
            color: gray;
            font-size: 300%;

        }

        table,
        tr,
        th,
        td {
            padding-right: 150px;
            color: gray;
            border: 10px solid slategray;
            background: rgba(192, 192, 192, 0.25);
        }
    </style>
    <!-- Script to allow Graph Be created and introduced to page.-->

</head>

<body>

    <!-- Start of Page Proper.-->
    <div class="jumbotron text-center" style="margin-bottom:0"></div>
    <h4> Display Top Ten </h4>
    </div>

    <div class="row">
        <div class="col-sm-1">
            <nav class="navbar-brand" style="color:black; font-size:larger; border-bottom: solid;" href="#">Nav Bar
            </nav>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="navlink" style="color: purple" href="homepage.html">Home Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:darkblue" href="searchpage.html">Search
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:slateblue" href="displaypage.php">Display
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:gray" href="topten.php">Display Top 10
                            Page</a>
                    </li>
                </ul>
            </div>

            </nav>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-lg-2">

                <?php

                // Opens connection to database and executes SQL Statement.
                require('connection.php');
                $result = $conn->prepare("SELECT * FROM movies ORDER BY count DESC LIMIT 10");
                $result->execute();

                $arrayCount;
                // Puts data from SQL into Array to be used for Graph Array (dataPoints).
                for ($i = 0; $row = $result->fetch(); $i++) {

                    $arrayCount[$i] = $row['count'];
                }
                // Inserts Value into Graph.
                $dataPoints = array(
                    array("x" => 1, "y" =>  $arrayCount[0]),
                    array("x" => 2, "y" =>  $arrayCount[1]),
                    array("x" => 3, "y" =>  $arrayCount[2]),
                    array("x" => 4, "y" =>  $arrayCount[3]),
                    array("x" => 5, "y" =>  $arrayCount[4]),
                    array("x" => 6, "y" =>  $arrayCount[5]),
                    array("x" => 7, "y" =>  $arrayCount[6]),
                    array("x" => 8, "y" =>  $arrayCount[7]),
                    array("x" => 9, "y" =>  $arrayCount[8]),
                    array("x" => 10, "y" =>  $arrayCount[9])
                );
                ?>

                <!-- Allows for graph to appear -->
                <div id="chartContainer" style="height: 405px; width: 100%;" style="padding-left: 150px;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                <script>
                    window.onload = function() {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            exportEnabled: true,
                           theme: "dark1", // "light1", "light2", "dark1", "dark2"
                            title: {
                                text: "Top Ten Graph."
                            },
                            axisY: {
                                includeZero: true
                            },
                            data: [{
                                type: "pie", //change type to bar, line, area, pie, etc
                                indexLabel: "{y}", //Shows y value on all Data Points
                                indexLabelFontColor: "#5A5757",
                                indexLabelPlacement: "outside",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                    }
                </script>
            </div>
            <div class="col-lg-9">
                <table>
                    <!-- New smaller form to rest beside Graph to give basic into about 10 ten results. -->
                    <tr style="font-size: 120%;">
                        <th>Placement</th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Count</th>
                    </tr>

                    <?php
                    $result = $conn->prepare("SELECT * FROM movies ORDER BY count DESC LIMIT 10");
                    $result->execute();
                    for ($i = 0; $row = $result->fetch(); $i++) {
                    ?>
                        <tr style="font-size: 65%;">
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['Title']; ?></td>
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