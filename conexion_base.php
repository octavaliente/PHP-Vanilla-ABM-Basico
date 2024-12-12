<?php 

    function conectar_base(){
        $conexion = mysqli_connect("127.0.0.1:3306", "root", "1111", "curso_fullstack_uso");
        return $conexion;
    }

    function desconectar_base($conexion){
        mysqli_close($conexion);
    }

?>