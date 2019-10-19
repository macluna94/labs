<?php

$servername = "localhost";
$database = "Lab";
$username = "root";
$pass = "";
$table = "clases";

$connection = mysqli_connect(
    $servername,
    $username,
    $pass,
    $database
);

date_default_timezone_set("America/Mexico_City");

$codigo = $_POST['codigo'];

$sql = "SELECT * FROM `clases` WHERE `name_teacher` LIKE '$codigo'";


$result = mysqli_query($connection, $sql);

$date = date("H:i A");
$date_x = time();

echo date("s", $date_x).'  --  '.$date_x;
sleep(20);
$date_y = time();
echo "<br>";

echo date("s", $date_y).'  --  '.$date_y;

echo "<br>".$date_y - $date_x." f:".date("s", ($date_x - $date_y));

/*
echo "<h1>inciando<h2>";

sleep(120);
$date2 = date("H:i A");
$date_y = strtotime($date2);

echo "<br>Normal(y):",$date2 ,"<br> N2:", $date_y;
*/

echo '
<table class="table table-dark">
<thead>
<tr>
<th scope="col">Maestro</th>
<th scope="col">Clase</th>
<th scope="col">Sala</th>
<th scope="col">Carrera</th>
<th scope="col">Hora Entrada</th>
<th scope="col">Hora Salida</th>
</tr>
</thead>
<tbody>';

while($row = mysqli_fetch_row($result)){


#$sql2 = "INSERT INTO `registro` (`id`, `teacher`, `class`, `time_in`, `time_out`, `date`, `state`) VALUES (NULL, 'nana', 'mate', '21:12:09.218210', '31:15:00.000000', '2019-09-10', '1')";




echo '
    <tr>
    <td>'.$row[0].'</td>
    <td>'.$row[1].'</td>
    <td>'.$row[2].'</td>
    <td>'.$row[3].'</td>
    <td>';
    echo '</td>
    <td></td>
    </tr>
    ';
}
echo '
    </tbody>
    </table>


';


//Diana Caballero

mysqli_close($connection);

//echo "N1 - N2: ", "<br>", date("i",($date_x - $date_y) );
?>