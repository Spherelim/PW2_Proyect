<?php

session_start();

use Core\Database;

$config = require __DIR__ . '/../core/config.php';
$db = new Database($config);

// TOP 9 lugares por likes
$stmt = $db->query("CALL sp_top_lugares_likes()");
$topLugares = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();

require __DIR__ . '/../view/index.view.php';