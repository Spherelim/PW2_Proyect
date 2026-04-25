<?php

require_once __DIR__ . '/../core/database.php';

use Core\Database;

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /PW2_Proyect/register');
    exit;
}

$vcEmail = trim($_POST['vcEmail'] ?? '');
$vcNickname = trim($_POST['vcNickname'] ?? '');
$vcNombre = trim($_POST['vcNombre'] ?? '');
$dtFechaNacimiento = trim($_POST['dtFechaNacimiento'] ?? '');
$vcPassword = trim($_POST['vcPassword'] ?? '');

if ($vcEmail === '' || $vcNickname === '' || $vcNombre === '' || $dtFechaNacimiento === '' || $vcPassword === '') {
    die('Todos los campos son obligatorios.');
}

if (!filter_var($vcEmail, FILTER_VALIDATE_EMAIL)) {
    die('Correo electrónico inválido.');
}

if (strlen($vcNickname) < 3) {
    die('El nickname debe tener mínimo 3 caracteres.');
}

if (strlen($vcNombre) < 3) {
    die('El nombre debe tener mínimo 3 caracteres.');
}

if (strlen($vcPassword) < 6) {
    die('La contraseña debe tener mínimo 6 caracteres.');
}

$existe = $db->query(
    "SELECT id_usuario FROM usuarios WHERE vcEmail = ? OR vcNickname = ? LIMIT 1",
    [$vcEmail, $vcNickname]
)->fetch();

if ($existe) {
    die('El correo o nickname ya está registrado.');
}

$imagenPerfil = null;

if (isset($_FILES['imagenPerfil']) && $_FILES['imagenPerfil']['error'] === UPLOAD_ERR_OK) {
    $tipo = $_FILES['imagenPerfil']['type'];
    $tamano = $_FILES['imagenPerfil']['size'];

    if (strpos($tipo, 'image/') !== 0) {
        die('Solo se permiten imágenes.');
    }

    if ($tamano > 2 * 1024 * 1024) {
        die('La imagen no debe pesar más de 2 MB.');
    }

    $imagenPerfil = file_get_contents($_FILES['imagenPerfil']['tmp_name']);
}

$vcPasswordHash = password_hash($vcPassword, PASSWORD_DEFAULT);

$db->query(
    "INSERT INTO usuarios 
    (vcNombre, vcEmail, vcNickname, dtFechaNacimiento, vcPassword, imagenPerfil) 
    VALUES (?, ?, ?, ?, ?, ?)",
    [
        $vcNombre,
        $vcEmail,
        $vcNickname,
        $dtFechaNacimiento,
        $vcPasswordHash,
        $imagenPerfil
    ]
);

header('Location: /PW2_Proyect/login?registro=ok');
exit;