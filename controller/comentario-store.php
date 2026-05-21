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

$idLocacion = (int)($_POST['id_locacion'] ?? 0);
$idUsuario = (int)$_SESSION['session_id'];
$comentario = trim($_POST['vcComentario'] ?? '');

if ($idLocacion <= 0 || $comentario === '') {
    echo json_encode([
        'ok' => false,
        'message' => 'Comentario inválido.'
    ]);
    exit;
}

$stmt = $db->query("CALL sp_insert_comentario(?, ?, ?)", [
    $idLocacion,
    $idUsuario,
    $comentario
]);

$stmt->closeCursor();

echo json_encode([
    'ok' => true,
    'message' => 'Comentario publicado.',
    'comentario' => [
        'usuario' => $_SESSION['session_nomCom'],
        'texto' => $comentario,
        'fecha' => date('Y-m-d H:i:s'),
        'likes' => 0,
        'dislikes' => 0
    ]
]);
exit;