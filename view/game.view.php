<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLGo! - games </title>
    <link rel="stylesheet" href="/css/game.css">
    <link rel="stylesheet" href="/css/header-login.css">
</head>

<body>

    <?php require __DIR__ . '/../controller/header-login.php'; ?>

    <div class="estadio">
        <img src="/image/mty-estadio.jfif" alt="" class="imgEst">
        <div class="infEstadio">
            <h1 class="titulo"><?= htmlspecialchars($infoEstadio['Estadio'] ?? 'Estadio BBVA') ?></h1>
            <h4 class="subtitulo">"El gigante de acero"</h4>
            
            <p class="descripcionEstadio">
                Sede oficial del Mundial 2026. Un estadio icónico con vista espectacular a la Sierra Madre.
            </p>

            <div class="sede">
                <div class="sede-item">
                    <label class="sede-label">Sede:</label>
                    <span class="sede-valor"><?= htmlspecialchars($infoEstadio['País'] ?? 'México') ?></span>
                </div>

                <div class="sede-item">
                    <label class="sede-label">Ubicación:</label>
                    <span class="sede-valor"><?= htmlspecialchars($infoEstadio['Municipio'] ?? 'Guadalupe, Nuevo León') ?></span>
                </div>
            </div>
        </div>
    </div>

    <h1 class="tPartido">Partidos</h1>

    <div class="ColumnaP">
        <div class="partidoInfo">
            <div class="partido">
                <?php if (!empty($partidos)): ?>
                    <?php foreach ($partidos as $partido): 
                        $equipos = explode(' vs. ', $partido['Titular']);
                        $equipo1 = $equipos[0] ?? 'Equipo 1';
                        $equipo2 = $equipos[1] ?? 'Equipo 2';
                        $fechaFormateada = $partido['FechaFormateada'];
                        include __DIR__ . '/includes/partido-card.php';
                    endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; padding: 50px;">No hay partidos programados para este estadio.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>