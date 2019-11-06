<?php 
require('controller/connection.php');

$id = $_POST['id'];
$alumnos = $_POST['alumnos'];

$sqlUpdate="UPDATE `registro` SET `alumnos` = '$alumnos' WHERE `registro`.`id` = $id";

$queryCheckState=mysqli_num_rows(mysqli_query($connection, $sqlUpdate));


mysqli_close($connection);

?>