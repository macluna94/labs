<?php
require('php/connection.php');


$sql1 = 'SELECT * FROM `clases`';
$req = mysqli_query($connection, $sql1);


$materias=array();

$query1 = mysqli_query($connection, "SELECT * FROM `clases` ORDER BY `clases`.`nombre_clase` ASC");

// Materias
while($row = mysqli_fetch_row($query1)){
    array_push($materias, "$row[1]");
}
$de = sizeof($materias);
// Alumnos-Materias
$alumnos = "";
for ($i=0; $i < $de; $i++) { 
    $alumnos = $alumnos."'".countAlum($connection, "SELECT SUM(`alumnos`) FROM registro WHERE `class` ='$materias[$i]'")."',";
}

echo $alumnos;

function countAlum($connection, $id){
    $sql = mysqli_query($connection, $id);
    while($row = mysqli_fetch_row($sql)){
        
        if ($row[0] == '') {
            return 0;
        }
        else{
            return $row[0];
        }
    }
}


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


//var trace1 = {$x: ['Matematicas', 'Quimica']";
//$y = countTime($connection, "SELECT `total_time` FROM `registro` WHERE `class` ='$row[1]'");


for ($i=0; $i < $de; $i++) { 
    $max = $max."'".$materias[$i]."',";
}


echo " 

<script>
var alumnos = {
    x: [$max], 
    y: [$alumnos], 
    name: 'Alumnos', 
    type: 'bar'
  };
  
  var trace2 = {
    x: [$max], 
    y: [12, 18, 29, 14, 23, 14, 23], 
    name: 'Horas', 
    type: 'bar'
  };
  
  var data = [alumnos, trace2];
  var layout = {barmode: 'group'};
  
  Plotly.newPlot('myDiv', data, layout, {}, {showSendToCloud:true});

  </script>
";
/*
var data = [trace1, trace2];
var layout = {barmode: 'group'};
Plotly.newPlot('myDiv', data, layout, {}, {showSendToCloud: false});


*/
?>