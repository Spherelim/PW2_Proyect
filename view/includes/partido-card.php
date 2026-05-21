<div class="imgPartidos">
    <h1 class="ptitulo"><?= htmlspecialchars($equipo1) ?> vs. <?= htmlspecialchars($equipo2) ?></h1>
    <h2 class="fecha"><?= htmlspecialchars($fechaFormateada) ?></h2>
   
    <div class="flexPais">
        <?php 
           $imagenes = [
            'Suecia' => 'suecia',
            'Túnez' => 'tunez',
            'Japón' => 'japan',
            'Sudáfrica' => 'sudafrica',
            'Corea del Sur' => 'corea',
            'Grupo F Ganador' => 'por-definir',      // ← Agregar
            'Grupo C Ganador' => 'por-definir',      // ← Agregar
        ];

        $img1 = $imagenes[$equipo1] ?? 'FIFA';
        $img2 = $imagenes[$equipo2] ?? 'FIFA';

        ?>
        
        <img class="imgP1" src="/image/paises/<?= $img1 ?>.jfif" 
             alt="<?= htmlspecialchars($equipo1) ?>"
             onerror="this.src='/image/paises/FIFA.jfif'">
        <h1 class="Pais1"><?= htmlspecialchars($equipo1) ?></h1>
        <h1 class="vs">VS</h1>
        <h1 class="Pais2"><?= htmlspecialchars($equipo2) ?></h1>
        <img class="imgP2" src="/image/paises/<?= $img2 ?>.jfif" 
             alt="<?= htmlspecialchars($equipo2) ?>"
             onerror="this.src='/image/paises/FIFA.jfif'">
    </div>
</div>