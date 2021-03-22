
<?php

// Allows the user (lecturer) to randomly generate values to put into the 'count' column of the database. 
// This simulates a natural count of different search results that the topten.php can then display.

require_once("connection.php");
$counter = 1;
for($i = 0; $i < 2300; $i++)
{
    $rando = rand(100,10000);
    $array[$i] = $rando;

}

foreach($array as $items)
{
   
      $result = $conn->prepare("UPDATE movies
      SET count = $items
      Where ID = $counter;");
      $result->execute();

    $counter++;
}

// Connection break for security.
$conn = null;

echo '<meta http-equiv="refresh" content="0; homepage.html"/>';
?>