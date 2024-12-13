<?php 

    function borrar_producto($conexion, $id){
        $query = "DELETE FROM productos WHERE id = ".$id;
        return mysqli_query($conexion, $query);
    }

    function agregar_producto($conexion, $producto){
        $query = "INSERT INTO productos (nombre, imagen) VALUES ('".$producto['nombre_producto']."', '".$producto['imagen_producto']."')";
        return mysqli_query($conexion, $query);
    }

    function editar_producto($conexion, $producto){
        $query = "UPDATE productos ";

        $contadorComa = 0;

        echo sizeof($producto);

        if(sizeof($producto) > 1){
            $query = $query." SET ";
        }

        if(!empty($producto["imagen_producto"])){
            $query = $query."imagen = '".$producto['imagen_producto']."'";
            $contadorComa ++;
        }if(!empty($producto["nombre_producto"])){
            if($contadorComa > 0){
                $query = $query."',";
            }
            $query = $query."nombre = '".$producto['nombre_producto']."'";
        }
        
        $query = $query." WHERE id = ".$producto["id"];
        echo $query;
        return mysqli_query($conexion, $query);
    }

?>