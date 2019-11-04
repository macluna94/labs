<?php

$servername = "localhost";
$database = "lab";
$username = "root";
$pass = "";
$table = "clases";

$connection = mysqli_connect(
    $servername,
    $username,
    $pass,
    $database
);


$code = $_POST['numA'];

$sql = "SELECT SUM(`alumnos`) FROM registro";

$result = mysqli_query($connection, $sql);

echo "<h1>$result</h1>"

/*

while($row = mysqli_fetch_row($result)){
    echo '<h1>'.$row[0].'</h1>';
}
echo '</select>';
  


Sumatoria 
SELECT SUM(`alumnos`) FROM registro

 

*/

mysqli_close($connection);
?>