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
$tipo = (int)($_POST['tipo'] ?? 0);
$idUsuario = (int)$_SESSION['session_id'];

if ($idLocacion <= 0 || !in_array($tipo, [1, -1])) {
    echo json_encode([
        'ok' => false,
        'message' => 'Reacción inválida.'
    ]);
    exit;
}

$stmt = $db->query("CALL sp_reaccion_locacion(?, ?, ?)", [
    $idLocacion,
    $idUsuario,
    $tipo
]);
$stmt->closeCursor();

$stmt = $db->query("CALL sp_place_detail(?, ?)", [$idLocacion, $idUsuario]);
$lugar = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();

echo json_encode([
    'ok' => true,
    'likes' => (int)$lugar['likes'],
    'dislikes' => (int)$lugar['dislikes']
]);
exit;