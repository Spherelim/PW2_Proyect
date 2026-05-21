<?php

require_once __DIR__ . '/game-load.php';
require_once __DIR__ . '/../core/functions.php';

$config = require __DIR__ . '/../core/config.php';
$partidoModel = new PartidoModel($config);

$nombreEstadio = "Estadio BBVA";

$partidos = $partidoModel->getPartidosPorEstadio($nombreEstadio);
$infoEstadio = $partidoModel->getInfoEstadio($nombreEstadio);

// Formatear fechas en español
foreach ($partidos as &$partido) {
    $partido['FechaFormateada'] = formatearFechaEspañol($partido['Fecha']);
}

require __DIR__ . '/../view/game.view.php';
?>