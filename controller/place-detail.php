<?php

session_start();

use Core\Database;

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: /PW2_Proyect/place');
    exit;
}

$idUsuario = $_SESSION['session_id'] ?? 0;
$idUsuario = (int)$idUsuario;

$stmt = $db->query("CALL sp_place_detail(?, ?)", [$id, $idUsuario]);
$lugar = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();

if (!$lugar) {
    header('Location: /PW2_Proyect/place');
    exit;
}
$fotoLugar = !empty($lugar['image_url']) 
    ? $lugar['image_url'] 
    : '/Image/default.png';

$stmt = $db->query("CALL sp_place_comentarios(?)", [$id]);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();

require __DIR__ . '/../view/place-detail.view.php';