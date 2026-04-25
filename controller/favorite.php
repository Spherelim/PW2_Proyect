<?php

session_start();

use Core\Database;

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /PW2_Proyect/login');
    exit;
}

$idUsuario = (int)($_SESSION['session_id'] ?? 0);

$stmt = $db->query("CALL sp_usuario_favoritos(?)", [$idUsuario]);
$favoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();

require __DIR__ . '/../view/favorite.view.php';