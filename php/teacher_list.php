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
 
$sql = "SELECT * FROM `clases` ORDER BY `clases`.`maestro_clase` ASC";

$result = mysqli_query($connection, $sql);


echo '<select class="form-control" id="teacher_query"  style="margin:1rem">';

while($row = mysqli_fetch_row($result)){
    echo '<option>'.$row[2].'</option>';
}
echo '</select>';
     


mysqli_close($connection);
?>