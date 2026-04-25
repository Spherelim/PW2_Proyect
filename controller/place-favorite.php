<?php

session_start();

use Core\Database;

header('Content-Type: application/json');

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

$idUsuario = $_SESSION['session_id'] ?? 0;
$idUsuario = (int)$idUsuario;

if ($idUsuario <= 0) {
    echo json_encode([
        'ok' => false,
        'message' => 'Debes iniciar sesión.'
    ]);
    exit;
}

$idLocacion = (int)($_POST['id_locacion'] ?? 0);

if ($idLocacion <= 0) {
    echo json_encode([
        'ok' => false,
        'message' => 'Lugar inválido.'
    ]);
    exit;
}

try {
    $stmt = $db->query(
        "CALL sp_toggle_favorito(?, ?)",
        [$idUsuario, $idLocacion]
    );

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    echo json_encode([
        'ok' => true,
        'esFavorito' => (int)($result['esFavorito'] ?? 0)
    ]);

} catch (Exception $e) {
    echo json_encode([
        'ok' => false,
        'message' => 'Error en servidor.'
    ]);
}

exit;