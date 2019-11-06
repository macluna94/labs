<?php
require('controller/connection.php');

$dateselec = $_POST['codigo'];

$sqlDate = "SELECT * FROM `registro` WHERE `date` = '$dateselec'";

$result = mysqli_query($connection, $sqlDate);


$check = mysqli_num_rows($result);

if ( $check != 0) {

    
    echo '
    <table class="table table-striped">
    <thead class="thead-dark">
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
        echo '
        <tr>
            <td>'.$row[1].'</td>
            <td>'.$row[2].'</td>
            <td>'.$row[3].'</td>
            <td>'.$row[4].'</td>
            <td>'.$row[5].'</td>
            <td>'.$row[6].'</td>
            </tr>
            ';
        }
        
        echo '
        </tbody>
        </table>';
    }
    else {
        echo '<div class="alert alert-warning" role="alert">No hay registros en esa fecha</div>';
    }
        
    
        
        mysqli_close($connection);
        ?>