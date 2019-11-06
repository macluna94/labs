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

$sql = "SELECT * FROM `clases` ORDER BY `clases`.`nombre_clase` ASC";

$result = mysqli_query($connection, $sql);


echo '<select class="form-control" id="class_query" style="margin:1rem">';

while($row = mysqli_fetch_row($result)){
    echo '<option>'.$row[1].'</option>';
}
echo '</select>';
  


/*
Sumatoria 
SELECT SUM(`alumnos`) FROM registro



*/

mysqli_close($connection);
?>