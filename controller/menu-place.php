<?php

use Core\Database;

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

$stmt = $db->query("CALL sp_menu_place_data()");

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt->nextRowset();

$locaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/../view/menu-place.view.php';