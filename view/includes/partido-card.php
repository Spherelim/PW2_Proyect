<div class="imgPartidos">
    <h1 class="ptitulo"><?= htmlspecialchars($equipo1) ?> vs. <?= htmlspecialchars($equipo2) ?></h1>
    <h2 class="fecha"><?= htmlspecialchars($fechaFormateada) ?></h2>

    <div class="flexPais">
        <?php 
        // Limpiar nombre para la imagen
        $img1 = strtolower(trim($equipo1));
        $img1 = str_replace([' ', 'ñ', 'á', 'é', 'í', 'ó', 'ú'], ['-', 'n', 'a', 'e', 'i', 'o', 'u'], $img1);
        
        $img2 = strtolower(trim($equipo2));
        $img2 = str_replace([' ', 'ñ', 'á', 'é', 'í', 'ó', 'ú'], ['-', 'n', 'a', 'e', 'i', 'o', 'u'], $img2);
        ?>
        
        <img class="imgP1" src="/image/<?= $img1 ?>.jfif" 
             alt="<?= htmlspecialchars($equipo1) ?>"
             onerror="this.src='/image/FIFA.jfif'">
        <h1 class="Pais1"><?= htmlspecialchars($equipo1) ?></h1>
        <h1 class="vs">VS</h1>
        <h1 class="Pais2"><?= htmlspecialchars($equipo2) ?></h1>
        <img class="imgP2" src="/image/<?= $img2 ?>.jfif" 
             alt="<?= htmlspecialchars($equipo2) ?>"
             onerror="this.src='/image/FIFA.jfif'">
    </div>
</div>