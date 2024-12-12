<?php 

    require 'conexion_base.php';
    require 'producto.php';

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];

        if(!empty($_POST["nombre_producto"])){
            $nombre = $_POST["nombre_producto"];
        } else {
            echo "error al no completar el nombre";
            exit;
        }

        $name = $_FILES["imagen_producto"]["name"];
        
        $type = strtolower(pathinfo($_FILES["imagen_producto"]["name"], PATHINFO_EXTENSION));
        if(!in_array($type, [".jpg", ".png", ".heic"])){
            echo "extension no permitida";
            exit;
        }
        
        $size = $_FILES["imagen_producto"]["size"];
        
        $maxSize = 4*1024*1024; //4MB
        if($size > $maxSize){
            echo "archivo muy pesado";
            exit;
        }

        $imagePath = "imagenes/".$name;

        $pathTemp = $_FILES["imagen_producto"]["tmp_name"];
        
        //Guardar la imagen
        if(move_uploaded_file($pathTemp, $imagePath)){
            echo "archivo subido con exito en: ".$imagePath;
        }
        else {
            echo "error al subir archivo";
        }
        
        echo $_POST["imagen_producto"];

        $producto = [
            "nombre_producto" => $nombre,
            "imagen_producto" => $imagen,
            "id" => $id
        ];

        $conexion = conectar_base();

        $resultado = editar_producto($conexion, $producto);

        desconectar_base($conexion);
    } else {
        $id = $_GET["id"];
        echo '
        <form action="" method="post" enctype="multipart/form-data">
        <input type="text" id="identif" name="id" value="'.$id.'"><br>
        <label>Nombre:</label><input type="text" id="nombre_producto" name="nombre_producto" autocomplete="off"><br>
        <label>Imagen:</label><input type="file" id="imagen_producto" name="imagen_producto"><br>
        <button>Editar producto</button>
        <a href="./productos.php">Volver</a>
        </form>
        ';
    }
    
?>

