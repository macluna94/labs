<?php

require('connection.php');




$nombre = $_POST['nombres'];
$clase = $_POST['clases'];
$sala = $_POST['salas'];
$carrera = $_POST['carreras'];
$semestre = $_POST['semestre'];
$estudiante = $_POST['estudiantes'];
$periodo = $_POST['periodo'];

if ($nombre[0] != "") {
    
    for($i = 0; $i < count($nombre) ;$i++){
        
        $sql = "
        INSERT INTO `clases` (`id_clase`, `nombre_clase`, `maestro_clase`, `sala_clase`, `carrera_clase`, `semestre`, `alumnos_clase`, `periodo_clase`) VALUES (NULL, '$clase[$i]', '$nombre[$i]', '$sala[$i]', '$carrera[$i]', '$semestre[$i]','$estudiante[$i]', '$periodo[$i]');
";

    

        if (mysqli_query($connection, $sql)) { 
            echo '
                <div id="alerta"  class="alert alert-success alert-dismissible fade show" role="alert">
                Clases registradas
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <script>
                $("#alerta").fadeOut(4000);
                setTimeout( \'location.href="index.html"\', 5000);
                ;
                </script>';
        }
        else {
            echo $sql."<br>";
            mysqli_error($connection);
        }
    }
}
else{
    echo '
    <div id="alerta"  class="alert alert-danger alert-dismissible fade show" role="alert">
    Problema de registro
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <script>
    $("#alerta").fadeOut(5000);
    </script>';  
}

mysqli_close($connection);


?>