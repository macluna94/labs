<?php

require('connection.php');

date_default_timezone_set("America/Mexico_City");
 

$codigo = $_POST['codigo'];

$SqlCheckState = "SELECT * FROM `registro` WHERE `teacher` LIKE '$codigo' AND `state` = 0";

$queryCheckState = mysqli_num_rows(mysqli_query($connection, $SqlCheckState));

if ($queryCheckState == 0 ) {

    $findCode = "SELECT * FROM `clases` WHERE `maestro_clase` LIKE '$codigo'";
    $requestCode = mysqli_query($connection, $findCode);
    $checkCode= mysqli_num_rows($requestCode);

    // Registro de Entrada
    if ($checkCode!= 0) {

        $time = date("H:i:s");
        $date = date("Y-m-d");

        while($row = mysqli_fetch_row($requestCode)){
            $sql2 = "INSERT INTO `registro` (`id`, `teacher`, `class`, `sala` , `carrera`, `alumnos` , `time_in`, `time_out`, `date`, `state`, `total_time`) VALUES (NULL, '$row[2]', '$row[1]','$row[3]','$row[4]','$row[5]','$time', NULL, '$date', '0', NULL)";
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
    // Hora de Salida
    $sety = mysqli_query($connection, $SqlCheckState);
    $checkCode= mysqli_num_rows($sety);

    if ($checkCode != 0) {

        $time = date("H:i:s");
        while($row = mysqli_fetch_row($sety)){
        $datetime1 = date_create($row[6]);
        $datetime2 = date_create($time);

        $interval = date_diff($datetime1, $datetime2);
        $x = $interval->format('%h:%i');
        
            
            $sqlu = "UPDATE `registro` SET `time_out` = '$time', `state` = '1',`total_time` = '$x' WHERE `registro`.`id` = $row[0];";
                
        }
        
        mysqli_query($connection, $sqlu);
    }
}

//--------- Seccion de la tabla --------------------------------->
echo '
    <table class="table table-striped">
    <thead class="thead-dark">
    <tr>
    <th scope="col">Maestro</th>
    <th scope="col">Clase</th>
    <th scope="col">Sala</th>
    <th scope="col">Carrera</th>
    <th scope="col">Alumnos</th>
    <th scope="col">Hora Entrada</th>
    <th scope="col">Hora Salida</th>
    </tr>
    </thead>
    <tbody>';

$result = mysqli_query($connection, "SELECT * FROM `registro`");

while($row = mysqli_fetch_row($result)){
    if ($row[7] == '') {
        
        echo '
        <tr>
        <td>'.$row[1].'</td>
        <td>'.$row[2].'</td>
        <td>'.$row[3].'</td>
        <td>'.$row[4].'</td>
        <td> <input type="text" class ="form-control sm-2" value="'.$row[5].'"  id="'.$row[0].'" onchange="setAlumnos(this.value,this.id);" >    </td>
        <td>'.$row[6].'</td>
        <td>'.$row[7].'</td>
        </tr>
        ';
    }
    else{
        echo '
        <tr>
        <td>'.$row[1].'</td>
        <td>'.$row[2].'</td>
        <td>'.$row[3].'</td>
        <td>'.$row[4].'</td>
        <td> <input type="text" class ="form-control sm-2" value="'.$row[5].'"  id="'.$row[0].'" disabled></td>
        <td>'.$row[6].'</td>
        <td>'.$row[7].'</td>
        </tr>
        ';
    }
}

echo '
    </tbody>
    </table>
    

    
    
    ';

    

mysqli_close($connection);
?>