<!DOCTYPE html>
<html lang="en">


<!-- !!!!Work In progress!!!! page to display Top ten values based on the 'count'  column in the table.
Potential for gold plating so topten.php is linked as a placeholder until this page is ready.-->


<head>
    <title>FinalProject SearchPage</title>
    <meta name="keywords" content="finalproject, diploma, robert, jacobs" />
    <meta name="author" content="Robert Jacobs" />
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="finalstylesheet.css" />
</head>

<body>
    <div class="jumbotron text-center" style="margin-bottom:0"></div>
    <h2> Search Page </h2>
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
                </ul>
            </div>

            </nav>
        </div>

        <div class="col-lg-11">
            <h2 style="border-bottom-style:none;">Please input the Search Query. </h2>
            <?php 
            require_once("connection.php");
            $array = array();
            $result = $conn->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'movies'");
            $result->execute();
            for ($i = 0; $row = $result->fetch(); $i++) {

              
                array_push($array, $row);
            }
           
         ?>
         
            <form action="topten.php" method="post">
                <p>Select the Category You wish to use.<br>
                    <select name="Cat_Choose">
                        <?php 
                        foreach($array as $item){
                     
                        $thing = implode($item);
                        echo "<option value=>$thing</option>";
                        }
                       ?>
                    </select><br>
                    <input type="submit" name="button" value="Submit" />
            </form>
            <?php 
            $array = array();
            $result = $conn->prepare("SELECT * FROM $thing ORDER BY count ASC;");
            $result->execute();
            for ($i = 0; $row = $result->fetch(); $i++) {

              
                array_push($array, $row);
            }
           
         ?>
         
            <form action="topten.php" method="post">
                <p>Select the Category You wish to use.<br>
                    <select name="Cat_Choose">
                        <?php 
                        foreach($array as $item){
                     
                        $thing = implode($item);
                        echo "<option value=>$thing</option>";
                        }
                       ?>
                    </select><br>
                    <input type="submit" name="button" value="Submit" />
            </form>
        </div>
    </div>

    </div>
    

</body>

</html>