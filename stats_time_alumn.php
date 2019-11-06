<?php
require('controller/connection.php');


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
    <table class="table">
        <thead>
            <th>Materia</th>
            <th>Alumnos</th>
            <th>Tiempo</th>
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
    



echo "<h1>Tiempo Total<h1>
<h3>".countTime($connection, "SELECT `total_time` FROM `registro`")."<h3>";
echo "<h1>Tiempo Total<h1>
<h3>".countAlum($connection, "SELECT SUM(`alumnos`) FROM `registro`")."<h3>";

mysqli_close($connection);
?>