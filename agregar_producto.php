<?php 

    require 'conexion_base.php';
    require 'producto.php';

    if(isset($_POST["nombre_producto"]) && isset($_FILES["imagen_producto"])){
        /*
        echo "Estan llegando los datos!";
        echo "<br>";
        */
        $producto = array();
        $producto["nombre_producto"] = $_POST["nombre_producto"];

        //cuando tengo un input de tipo "file", lo vamos a agarrar con la variable
        //$_FILES (tambien es un array asociativo)
        //var_dump($_FILES["imagen_producto"]);

        //NECESITO LA EXTENSION DEL ARCHIVO
        /*
        $type = pathinfo($_FILES["imagen_producto"]["name"], PATHINFO_EXTENSION);
        
        //NECESITO LA DATA BINARIA DEL ARCHIVO
        $data = file_get_contents($_FILES["imagen_producto"]["tmp_name"]);
        
        //TRANSFORMAR ESTO A BASE64
        $producto["imagen_producto"] = "data: image/".$type."; base64,".base64_encode($data);
        */
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

        $producto["imagen_producto"] = $imagePath;

        $conexion = conectar_base();

        $resultado = agregar_producto($conexion, $producto);

        if($resultado){
            echo "Salio bien!";
            echo "<br>";
            header('Location: productos.php');
        }
        else{
            echo "Salio mal!";
            echo "<br>";
        }

        desconectar_base($conexion);
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    <label>Nombre:</label><input type="text" id="nombre_producto" name="nombre_producto" autocomplete="off"><br>
    <label>Imagen:</label><input type="file" id="imagen_producto" name="imagen_producto"><br>
    <button>Agregar Producto</button>
    <a href="./productos.php">Volver</a>
</form>