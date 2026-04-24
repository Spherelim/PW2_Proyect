<?php
/* $page = 'login';

$currentPage = $_SERVER['REQUEST_URI'];

require 'view/login.view.php';
 */

session_start();

use Core\Database;

$config = require 'core/config.php';
$db = new Database($config);




if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //Aqui limpiamos los parametros y mandamos el NAME
    $correo = filter_var(trim($_POST['iCorreoUser'] ?? ''));
    $contraseña = $_POST['iContraUser'] ?? '';

    // Validaciones
    $errors = [];

    if (empty($correo) || empty($contraseña)) {
        $errors[] = "Por favor, complete todos los campos.";
    }
    if (strlen($contraseña) <  8) {
        $errors[] = "La contraseña no puede tener menos de 8 caracteres.";
    } else if (strlen($contraseña)  > 10) {
        $errors[] = "La contraseña no puede tener mas de 10 caracteres.";
    }

    if (!empty($errors)) {
        $error = implode("<br>", $errors);
        $page = 'login';
        require 'view/login.view.php';
        exit();
    }
/* 
    try {

        // Valores del procedure 
        $opcion = 3;
        $idUsuario = null;
        $nombreCompleto = null;
        $fechaNacimiento = null;
        $foto = null;
        $genero = null;
        $pais = null;
        $nacionalidad = null;
        $correo = null;

        $rol = null;


        $stmt = $db->query("CALL sp_usuarios(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $opcion,
            $idUsuario,
            $nombreCompleto,
            $fechaNacimiento,
            $foto,
            $genero,
            $pais,
            $nacionalidad,
            $correo,
            $contraseña,
            $rol,
            $nickname

        ]);



        // Primer resultset: datos del usuario
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Segundo resultset: mensaje y éxito
        $stmt->nextRowset();
        $out = $stmt->fetch(PDO::FETCH_ASSOC);



        if ($out) {
            $mensaje = $out['mensaje'] ?? '';
            $exito   = (bool)$out['exito'];
        } else {
            $mensaje = $out['mensaje'] ?? '';
            $exito   = false;
        }

        if ($usuario && $exito) {
            session_regenerate_id(true);

            //*Usuario id
            $_SESSION['session_id'] = $usuario['idUsuario'];
              

            //*Nombre completo
            $_SESSION['session_nomCom'] = $usuario['nombre_completo'];
            //*Nombre de usuario
            $_SESSION['session_nickname'] = $usuario['nickname'];
            //*Rol
            $_SESSION['session_rol'] = $usuario['rol'];
            //*Fecha de nacimiento
            $_SESSION['session_fecha'] = $usuario['fecha_nacimiento'];
            //*Genero
            $_SESSION['session_genero'] = $usuario['genero'];
            //*Nacionalidad
            $_SESSION['session_nacionalidad'] = $usuario['nacionalidad'];
            //*Correo
            $_SESSION['session_correo'] = $usuario['correo'];
            //*Contraseña
            $_SESSION['session_contra'] = $usuario['contraseña'];
            //*Foto
            $_SESSION['session_foto']      = $usuario['foto'];
            //*activo
            $_SESSION['session_activo']      = $usuario['activo'];


            $_SESSION['logged_in'] = true;

            
            if ($_SESSION['session_rol'] === 'Administrador') {
                require 'controllers/mainAdmin.php';
            } else {
                require 'controllers/main.php';
            }

            exit();

        } else {
            $error = $mensaje ?: "Credenciales inválidas.";
            $page = 'inicioSesion';
            require 'views/inicioSesion.view.php';
            exit();
        }
    } catch (Exception $e) {
        error_log("Error en login: " . $e->getMessage());
        die("Error exacto: " . htmlspecialchars($e->getMessage()));
        $error = "Error del sistema. Por favor, intente más tarde.";
        $page = 'inicioSesion';
        require 'views/inicioSesion.view.php';
        exit();
    } */
}
