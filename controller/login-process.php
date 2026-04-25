<?php

session_start();

use Core\Database;

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /PW2_Proyect/login');
    exit;
}

$correo = trim($_POST['iCorreoUser'] ?? '');
$contrasena = $_POST['iContraUser'] ?? '';

$errors = [];

if ($correo === '' || $contrasena === '') {
    $errors[] = 'Por favor, complete todos los campos.';
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Correo electrónico inválido.';
}

if (strlen($contrasena) < 6) {
    $errors[] = 'La contraseña debe tener mínimo 6 caracteres.';
}

if (!empty($errors)) {
    $error = implode('<br>', $errors);
    $page = 'login';
    require __DIR__ . '/../view/login.view.php';
    exit;
}

try {
    $usuario = $db->query(
        "SELECT 
            id_usuario,
            vcNombre,
            vcEmail,
            vcNickname,
            dtFechaNacimiento,
            vcPassword,
            imagenPerfil,
            iActivo
        FROM usuarios
        WHERE vcEmail = ?
        LIMIT 1",
        [$correo]
    )->fetch();

    if (!$usuario) {
        $error = 'Credenciales inválidas.';
        $page = 'login';
        require __DIR__ . '/../view/login.view.php';
        exit;
    }

    if ((int)$usuario['iActivo'] !== 1) {
        $error = 'Usuario inactivo.';
        $page = 'login';
        require __DIR__ . '/../view/login.view.php';
        exit;
    }

    if (!password_verify($contrasena, $usuario['vcPassword'])) {
        $error = 'Credenciales inválidas.';
        $page = 'login';
        require __DIR__ . '/../view/login.view.php';
        exit;
    }

    session_regenerate_id(true);

    $_SESSION['session_id'] = $usuario['id_usuario'];
    $_SESSION['session_nomCom'] = $usuario['vcNombre'];
    $_SESSION['session_nickname'] = $usuario['vcNickname'];
    $_SESSION['session_fecha'] = $usuario['dtFechaNacimiento'];
    $_SESSION['session_correo'] = $usuario['vcEmail'];
    $_SESSION['session_foto'] = $usuario['imagenPerfil'];
    $_SESSION['logged_in'] = true;

    header('Location: /PW2_Proyect/');
    exit;

} catch (Exception $e) {
    error_log('Error en login: ' . $e->getMessage());

    $error = 'Error del sistema. Por favor, intente más tarde.';
    $page = 'login';
    require __DIR__ . '/../view/login.view.php';
    exit;
}