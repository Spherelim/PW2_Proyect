<?php

session_start();

use Core\Database;

header('Content-Type: application/json');

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode([
        'ok' => false,
        'message' => 'Debes iniciar sesión.'
    ]);
    exit;
}

$idUsuario = (int)($_SESSION['session_id'] ?? 0);

$nombre = trim($_POST['vcNombre'] ?? '');
$email = trim($_POST['vcEmail'] ?? '');
$nickname = trim($_POST['vcNickname'] ?? '');
$fecha = trim($_POST['dtFechaNacimiento'] ?? '');
$password = trim($_POST['vcPassword'] ?? '');

if ($nombre === '' || $email === '' || $nickname === '' || $fecha === '') {
    echo json_encode([
        'ok' => false,
        'message' => 'Completa todos los campos obligatorios.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'ok' => false,
        'message' => 'Correo inválido.'
    ]);
    exit;
}

$passwordHash = '';

if ($password !== '') {
    if (strlen($password) < 6) {
        echo json_encode([
            'ok' => false,
            'message' => 'La contraseña debe tener mínimo 6 caracteres.'
        ]);
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
}

$imagen = null;

if (isset($_FILES['imagenPerfil']) && $_FILES['imagenPerfil']['error'] === UPLOAD_ERR_OK) {
    $tipo = $_FILES['imagenPerfil']['type'];

    if (!in_array($tipo, ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])) {
        echo json_encode([
            'ok' => false,
            'message' => 'Formato de imagen no válido.'
        ]);
        exit;
    }

    $imagen = file_get_contents($_FILES['imagenPerfil']['tmp_name']);
}

try {
    $stmt = $db->query(
        "CALL sp_usuario_actualizar_perfil(?, ?, ?, ?, ?, ?, ?)",
        [
            $idUsuario,
            $nombre,
            $email,
            $nickname,
            $fecha,
            $passwordHash,
            $imagen
        ]
    );

    $stmt->closeCursor();

    $_SESSION['session_nomCom'] = $nombre;
    $_SESSION['session_nickname'] = $nickname;
    $_SESSION['session_correo'] = $email;

    echo json_encode([
        'ok' => true,
        'message' => 'Perfil actualizado correctamente.'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'ok' => false,
        'message' => 'Error al actualizar perfil.'
    ]);
}

exit;