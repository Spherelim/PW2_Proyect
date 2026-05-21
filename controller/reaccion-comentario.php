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

$idComentario = (int)($_POST['id_comentario'] ?? 0);
$tipo = (int)($_POST['tipo'] ?? 0);
$idLocacion = (int)($_POST['id_locacion'] ?? 0);
$idUsuario = (int)$_SESSION['session_id'];

if ($idComentario <= 0 || $idLocacion <= 0 || !in_array($tipo, [1, -1])) {
    echo json_encode([
        'ok' => false,
        'message' => 'Reacción inválida.'
    ]);
    exit;
}

$stmt = $db->query("CALL sp_reaccion_comentario(?, ?, ?)", [
    $idComentario,
    $idUsuario,
    $tipo
]);
$stmt->closeCursor();

$stmt = $db->query("CALL sp_place_comentarios(?)", [$idLocacion]);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();

$actual = null;

foreach ($comentarios as $comentario) {
    if ((int)$comentario['id_comentario'] === $idComentario) {
        $actual = $comentario;
        break;
    }
}

echo json_encode([
    'ok' => true,
    'likes' => (int)($actual['likes'] ?? 0),
    'dislikes' => (int)($actual['dislikes'] ?? 0)
]);
exit;