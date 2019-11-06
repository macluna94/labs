<?php
require('php/connection.php');


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


$x=0;
$y;
while($row = mysqli_fetch_row($req)){
    var trace1 = {
        x: ['Matematicas', 'Quimica'],
    }     
    $x = countAlum($connection, "SELECT SUM(`alumnos`) FROM registro WHERE `class` = '$row[1]'");
}

//$y = countTime($connection, "SELECT `total_time` FROM `registro` WHERE `class` ='$row[1]'");




/*
var trace1 = {
    x: ['Matematicas', 'Quimica'],
    y: [20, 14],
    name: 'Alumnos',
    type: 'bar'
};
var trace2 = {
    x: ['Matematicas', 'Quimica'],
    y: [12.6, 11.5],
    name: 'Tiempo',
    type: 'bar'
};
var data = [trace1, trace2];
var layout = {barmode: 'group'};
Plotly.newPlot('myDiv', data, layout, {}, {showSendToCloud: false});


*/
?>