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
        $query = "UPDATE FROM productos";
        if(!empty($producto["imagen_producto"])){
            $query = $query."SET imagen = ".$producto['imagen_producto'].",";
        }
        if(!empty($producto["nombre_producto"])){
            $query = $query."SET nombre = ".$producto['nombre_producto'];
        }
        $query = $query."WHERE id = ".$producto["id"];
        return mysqli_query($conexion, $query);
    }

?>