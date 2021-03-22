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
        table,
        tr,
        th,
        td {
            padding-right: 150px;
            color: black;
            border: 10px solid gold;
            background: rgba(255, 255, 0, 0.25);
        }
    </style>
</head>

<body>
    <div class="jumbotron text-center" style="margin-bottom:0"></div>
    <h2> Display Top Ten </h2>
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
                    <li class="nav-item"><a class="navlink" style="color: darkblue" href="resultpage.php">Result
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:slateblue" href="displaypage.php">Display
                            Page</a>
                    </li>
                    <li class="nav-item"><a class="navlink" style="color:gold" href="topten.php">Display Top 10
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
            <div class="col-lg-11">

            <!-- Form to display all columns but restricting the values to the top ten highest values on the 'count' column -->
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
                        <th>Count</th>
                    </tr>

                    <?php
                    require_once('connection.php');
                    $result = $conn->prepare("SELECT * FROM movies ORDER BY count DESC LIMIT 10");
                    $result->execute();
                    for ($i = 0; $row = $result->fetch(); $i++) {
                 ?>
                   <tr style="font-size: 65%;">
                        <td><?php echo $row['ID'];?></td>
                        <td><?php echo $row['Title'];?></td>
                        <td><?php echo $row['Studio'];?></td>
                        <td><?php echo $row['Status'];?></td>
                        <td><?php echo $row['Sound'];?></td>
                        <td><?php echo $row['Versions'];?></td>
                        <td><?php echo $row['RecRetPrice'];?></td>
                        <td><?php echo $row['Rating'];?></td>
                        <td><?php echo $row['Year'];?></td>
                        <td><?php echo $row['Genre'];?></td>
                        <td><?php echo $row['Aspect'];?></td>
                        <td><?php echo $row['count'];?></td>

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