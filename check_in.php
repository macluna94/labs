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

$SqlCheckState = "SELECT * FROM `registro` WHERE `teacher` LIKE '$codigo' AND `state` = 0";

$queryCheckState = mysqli_num_rows(mysqli_query($connection, $SqlCheckState));

if ($queryCheckState == 0 ) {

    $findCode = "SELECT * FROM `clases` WHERE `maestro_clase` LIKE '$codigo'";
    $requestCode = mysqli_query($connection, $findCode);
    $checkCode= mysqli_num_rows($requestCode);

    if ($checkCode!= 0) {

        $time = date("H:i:s");
        $date = date("Y-m-d");

        while($row = mysqli_fetch_row($requestCode)){
            $sql2 = "INSERT INTO `registro` (`id`, `teacher`, `class`, `sala` , `carrera` , `time_in`, `time_out`, `date`, `state`) VALUES (NULL, '$row[2]', '$row[1]','$row[3]','$row[4]','$time', NULL, '$date', '0')";
            echo $sql2;
                
        }
        $result = mysqli_query($connection, $sql2);
    }
    else {
        echo '
        <div id="alerta"  class="alert alert-danger alert-dismissible fade show text-center" role="alert"> No existe la Clase</div>
        <script>$("#alerta").fadeOut(5000);</script>';
    }

}
else {
    // Registro de Hora

    $sety = mysqli_query($connection, $SqlCheckState);
    $checkCode= mysqli_num_rows($sety);

    if ($checkCode!= 0) {

        $time = date("H:i:s");
        while($row = mysqli_fetch_row($sety)){
        $datetime1 = date_create($row[5]);
        $datetime2 = date_create($time);

        $interval = date_diff($datetime1, $datetime2);
        $x = $interval->format('%h:%i');
        
            
            $sqlu = "UPDATE `registro` SET `time_out` = '$time', `state` = '1',`total_time` = '$x' WHERE `registro`.`id` = $row[0];";
            echo $sqlu;
                
        }
        
        mysqli_query($connection, $sqlu);
    }
}

//--------- Seccion de la tabla --------------------------------->
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
            <td>'.$row[1].'</td>
            <td>'.$row[2].'</td>
            <td>'.$row[3].'</td>
            <td>'.$row[4].'</td>
            <td>'.$row[5].'</td>
            <td>'.$row[6].'</td>
            <td>';
        echo '</td>
        <td></td>
        </tr>
        ';
}

echo '
    </tbody>
    </table>';



mysqli_close($connection);





?>