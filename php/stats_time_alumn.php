<?php
require('connection.php');


$sql1 = 'SELECT * FROM `clases`';

$req = mysqli_query($connection, $sql1);

function countAlum($connection, $id){
    $sql = mysqli_query($connection, $id);
    while($row = mysqli_fetch_row($sql)){
        return $row[0];
    }
}


//El problema del offset es porque un registro aun no se cierra

function countTime($connection, $sql_tiempo){
    $sql = mysqli_query($connection, $sql_tiempo);
    $horas = 0;
    $minutos = 0;
    while($row = mysqli_fetch_row($sql)){
        
        $timeTo = explode(':', $row[0]);
        
        $horas += intval($timeTo[0]);
        $minutos += intval($timeTo[1]);
        
    }
    $final_time = intval((($horas*60) + $minutos)/60).":".(($horas*60) + $minutos)%60;
    return  $final_time;
}


echo '

<div class="row">
<div class="col-4"></div>
<div class="col-4">
<table class="table table-sm text-center">
<thead class="bg-info">
<tr>
<th class="text-white">Tiempo Total</td>
<th class="text-white">Alumnos Totales</td>
</tr>
</thead>
<tbody>
<tr>
<td class="text-danger"><h5><strong>'.countTime($connection, "SELECT `total_time` FROM `registro`").'</strong></h5></td>
<td class="text-danger"><h5><strong>'.countAlum($connection, "SELECT SUM(`alumnos`) FROM `registro`").'</strong></h5></td>
</tr>
</tbody>
</table>
</div>

<div class="col-4"></div>

</div>
';





echo '
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Materia</th>
                <th scope="col">Alumnos</th>
                <th scope="col">Tiempo</th>
            </tr>
        </thead>
    <tbody>';

while($row = mysqli_fetch_row($req)){         
    echo '<tr>
    <td>'.$row[1].'</td>';
    echo '<td>'.countAlum($connection, "SELECT SUM(`alumnos`) FROM registro WHERE `class` = '$row[1]'").'</td>';
    echo '<td>'.countTime($connection, "SELECT `total_time` FROM `registro` WHERE `class` ='$row[1]'").'</td>
                </tr>';
    }

echo '</tbody></table>';         
    





mysqli_close($connection);
?>