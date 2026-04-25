<?php

use Core\Database;
// Incluir la configuración y la clase Database
$config = require 'core/config.php';

// Crear instancia de la base de datos
$db = new Database($config);

//*Es la cabecera para lod json 
header('Content-Type: application/json; charset=utf-8');

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //!   MUCHO OJO ES EL NAME JAJAJA
    $nombre_completo = trim($_POST['input_NomCom']);
    $nickname = $_POST['input_NomUsu'];
    $fecha_nacimiento = $_POST['input_fechaNac'];
    $genero = $_POST['genero'];
    $rol = $_POST['input_Rol'];
    $nacionalidad = trim($_POST['nacionalidad']);
    $correo = trim($_POST['input_Correo']);
    $contraseña = $_POST['input_Contra'];


    // Validaciones básicas
    if (
        empty($nombre_completo) || empty($nickname) || empty($fecha_nacimiento) || empty($genero) ||
        empty($rol) || empty($nacionalidad) || empty($correo) || empty($contraseña)
    ) {
        echo json_encode([
            "status" => "error",
            "message" => "Todos los campos son obligatorios."
        ]);
        exit;
    }

    //Nombre completo

    $soloLetrasYEspacios = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/";

    if (!preg_match($soloLetrasYEspacios, $nombre_completo)) {
        echo json_encode([
            "status" => "error",
            "message" => "El nombre completo solo puede contener letras y espacios."
        ]);
        exit;
    }

    //Nickname
    if (!preg_match($soloLetrasYEspacios, $nickname)) {
        echo json_encode([
            "status" => "error",
            "message" => "El nombre de usuario solo puede contener letras y espacios."
        ]);
        exit;
    }

    //Fecha de nacimiento
    if (!empty($_POST['input_fechaNac'])) {
        $fecha_nacimiento = $_POST['input_fechaNac'];

        // Convertir a objeto DateTime
        $fechaNac = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();

        // Calcular diferencia en años
        $edad = $hoy->diff($fechaNac)->y;

        if ($edad < 18) {
            echo json_encode([
                "status" => "error",
                "message" => "Debes ser mayor de edad para registrarte."
            ]);
            exit;
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Debes seleccionar una fecha de nacimiento."
        ]);
        exit;
    }


    //Genero
    if ($genero === 'Sin seleccionar' || empty($genero)) {
        echo json_encode([
            "status" => "error",
            "message" => "Por favor selecciona un género."
        ]);
        exit;
    }

    //Rol
    if ($rol === 'Ninguno' || empty($rol)) {
        echo json_encode([
            "status" => "error",
            "message" => "Por favor selecciona un rol."
        ]);
        exit;
    }

    //Gentilicios
    $gentilicios = [
        'México' => ['Hombre' => 'Mexicano', 'Mujer' => 'Mexicana'],
        'Estados Unidos' => ['Hombre' => 'Estadounidense', 'Mujer' => 'Estadounidense'],
        'Canadá' => ['Hombre' => 'Canadiense', 'Mujer' => 'Canadiense'],
        'Argentina' => ['Hombre' => 'Argentino', 'Mujer' => 'Argentina'],
        'Colombia' => ['Hombre' => 'Colombiano', 'Mujer' => 'Colombiana'],
        'España' => ['Hombre' => 'Español', 'Mujer' => 'Española'],
        'Brasil' => ['Hombre' => 'Brasileño', 'Mujer' => 'Brasileña'],
        'Chile' => ['Hombre' => 'Chileno', 'Mujer' => 'Chilena'],
        'Perú' => ['Hombre' => 'Peruano', 'Mujer' => 'Peruana'],
        'Otro' => ['Hombre' => 'Otro', 'Mujer' => 'Otra']
    ];
    //Nacionalidad
     if ($nacionalidad === 'Selecciona tu nacionalidad' || empty($nacionalidad)) {
        echo json_encode([
            "status" => "error",
            "message" => "Por favor selecciona un pais."
        ]);
        exit;
    }else{

        //*Pasamos el nombre del pais a la variable $pais
        $paisSeleccionado = $nacionalidad; 
        
        $pais = $paisSeleccionado;

        // Nacionalidad = gentilicio adaptado
        if (isset($gentilicios[$paisSeleccionado])) {
            $nacionalidad = $gentilicios[$paisSeleccionado][$genero]
                ?? ($gentilicios[$paisSeleccionado]['Hombre'] ?? $paisSeleccionado);
        } else {
            $nacionalidad = $paisSeleccionado;
        }
    }
 
  

    //Validar correo
    $sql = "CALL sp_validarCorreoUnico(?)";
    $stmt = $db->query($sql, [$correo]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    // avanzar por todos los result sets aunque no los uses
    while ($stmt->nextRowset()) {
        // aquí no necesitas poner nada, basta con recorrer
    }

    $stmt->closeCursor(); // ahora sí se libera todo
    if ($resultado && $resultado['correo_existe']> 0) {

        echo json_encode([
            "status" => "error",
            "message" => "El correo electrónico ya está registrado."
        ]);
        exit; // detiene el registro

    }


   //Contraseña
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";

    if (!preg_match($passwordRegex, $contraseña) || strlen( $contraseña) < 8 ) {
        echo json_encode([
            "status" => "error",
            "message" => "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número."
        ]);
        exit;
    }else if (!preg_match($passwordRegex, $contraseña) || strlen( $contraseña) > 10 ) {
        echo json_encode([
            "status" => "error",
            "message" => "La contraseña no debe tener mas de 10 caracteres, debe de tener una mayúscula, una minúscula y un número."
        ]);
        exit;
    }

    // Procesar la foto si se subió
    $foto_blob = null;

    if (isset($_FILES['input_foto'])) {
        if ($_FILES['input_foto']['error'] === UPLOAD_ERR_OK) {
            $foto = $_FILES['input_foto'];

            // Validaciones de tipo y extensión
            $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
            $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];

            $file_extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

            if (
                in_array($foto['type'], $tipos_permitidos) &&
                in_array($file_extension, $extensiones_permitidas)
            ) {

                $max_size = 5 * 1024 * 1024; // 5MB
                if ($foto['size'] <= $max_size) {
                    if (!@getimagesize($foto['tmp_name'])) {
                        echo json_encode([
                            "status" => "error",
                            "message" => "El archivo no es una imagen valida."
                        ]);
                        exit;
                    }

                    $foto_blob = file_get_contents($foto['tmp_name']);
                } else {
                    echo json_encode([
                        "status" => "error",
                        "message" => "La imagen no debe de superar los 5mb."
                    ]);
                    exit;
                }
            } else {
                
                echo json_encode([
                    "status" => "error",
                    "message" => "Solo se permiten imágenes JPEG, PNG o GIF."
                ]);
                exit;
            }
        } elseif ($_FILES['input_foto']['error'] === UPLOAD_ERR_NO_FILE) {


            echo json_encode([
                "status" => "error",
                "message" => "Debes seleccionar una foto de perfil."
            ]);
            exit;
        } else {
           
             echo json_encode([
                "status" => "error",
                "message" => "Hubo un problema al subir la foto."
            ]);
            exit;

        }
    }


    try {

        $sql = "CALL sp_usuarios(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            1,
            null,
            $nombre_completo,
            $fecha_nacimiento,
            $foto_blob,
            $genero,
            $pais,
            $nacionalidad,
            $correo,
            $contraseña,
            $rol,
            $nickname
        ];

        $stmt = $db->query($sql, $params);
        $out  = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if ($out && $out['exito']) {
            echo json_encode([
                "status" => "success",
                "message" => $out['mensaje']
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => $out['mensaje'] ?? 'Error desconocido'
            ]);
        }
    } catch (Exception $e) {
        error_log("Error en registro: " . $e->getMessage());

        
        $error = "Error del sistema. Por favor, intente más tarde.";

        // Si quieres mostrar el error exacto solo en desarrollo:
        // $error = "Error exacto: " . htmlspecialchars($e->getMessage());

        $page = 'registro';
        require 'views/registro.view.php';
        exit();
    }
}