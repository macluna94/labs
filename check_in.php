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

//$reg = $_POST['reg'];
$codigo = $_POST['codigo'];

$ref = "SELECT * FROM `registro` WHERE `teacher` LIKE '$codigo' AND `state` = 0";
$x = mysqli_num_rows(mysqli_query($connection, $ref));

if ($x == 0 ) {


$find = "SELECT * FROM `clases` WHERE `maestro_clase` LIKE '$codigo'";
$request = mysqli_query($connection, $find);
$field_cnt = mysqli_num_rows($request);
if ($field_cnt != 0) {

    $time = date("H:i:s");
    $date = date("Y-m-d");

    while($row = mysqli_fetch_row($request)){
            $sql2 = "INSERT INTO `registro` (`id`, `teacher`, `class`, `time_in`, `time_out`, `date`, `state`) VALUES (NULL, '$row[2]', '$row[1]', '$time', NULL, '$date', '0')";
    }
    $result = mysqli_query($connection, $sql2);
}
else{
    echo '
    <div id="alerta"  class="alert alert-danger alert-dismissible fade show text-center" role="alert">
    No existe la Clase
    </div>


    <script>
    $("#alerta").fadeOut(5000);
    </script>';
}

}
else{


// regsitro de Hora





$sety = mysqli_query($connection, $ref);
$field_cnt = mysqli_num_rows($sety);

if ($field_cnt != 0) {
    $time = date("H:i:s");
        while($row = mysqli_fetch_row($sety)){

            $sqlu = "UPDATE `registro` SET `time_out` = '$time', `state` = '1' WHERE `registro`.`id` = $row[0];";
            
        }
        mysqli_query($connection, $sqlu);

    
}
}

/*

$date_x = time();

echo $date."<br>";

echo date("i", $date_x).'  --  '.$date_x;
//sleep(20);
$date_y = time();
echo "<br>";

echo date("s", $date_y).'  --  '.$date_y;

echo "<br>";
echo date("s", $date_y) - date("s", $date_x);
echo "<br> f:".date("s", ($date_y - $date_x));

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

$result = mysqli_query($connection, "SELECT * FROM `registro`");

while($row = mysqli_fetch_row($result)){






echo '
    <tr>
    <td>'.$row[0].'</td>
    <td>'.$row[1].'</td>
    <td>'.$row[2].'</td>
    <td>'.$row[3].'</td>
    <td>'.$row[4].'</td>
    <td>'.$row[5].'</td>
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