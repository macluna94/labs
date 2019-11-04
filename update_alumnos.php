<?php $servername="localhost";
$database="lab";
$username="root";
$pass="";
$table="clases";

$connection=mysqli_connect($servername,
    $username,
    $pass,
    $database);

$id = $_POST['id'];
$alumnos = $_POST['alumnos'];

$sqlUpdate="UPDATE `registro` SET `alumnos` = '$alumnos' WHERE `registro`.`id` = $id";

$queryCheckState=mysqli_num_rows(mysqli_query($connection, $sqlUpdate));


mysqli_close($connection);

?>