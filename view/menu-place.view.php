<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLGo! - Lugares</title>

    <link rel="stylesheet" href="/css/header-login.css">
    <link rel="stylesheet" href="/css/menu-place.css">
</head>

<body>

<?php require 'controller/header-login.php'; ?>

<h1 class="titulo">Tu próxima aventura comienza aquí</h1>

<div class="wrapperSearch">
    <div class="search">
        <input 
            class="inputSearch" 
            type="text" 
            id="searchPlaces"
            placeholder="Buscar lugar, ciudad o categoría..."
        >
    </div>

    <div class="iconSearch">
        <img src="/image/icons/icon-search.png" alt="">
    </div>
</div>

<div class="categoryFilter">
    <button class="categoryBtn active" data-category="all">Todas</button>

    <?php foreach ($categorias as $cat): ?>
        <button 
            class="categoryBtn" 
            data-category="<?php echo $cat['id_categoria']; ?>"
        >
            <?php echo htmlspecialchars($cat['vcNombre']); ?>
        </button>
    <?php endforeach; ?>
</div>

<div class="container-fluid">

    <div class="placesGrid" id="placesGrid">

        <?php foreach ($locaciones as $lugar): ?>

            <div 
                class="card place-card"
                data-category="<?php echo $lugar['id_categoria']; ?>"
                data-search="<?php echo strtolower(
                    $lugar['vcNombre'] . ' ' .
                    $lugar['vcDescr'] . ' ' .
                    $lugar['vcCiudad'] . ' ' .
                    $lugar['vcEstado'] . ' ' .
                    $lugar['categoria']
                ); ?>"
            >

                <img 
                    src="<?php echo !empty($lugar['image_url']) ? htmlspecialchars($lugar['image_url']) : '/PW2_Proyect/Image/default.png'; ?>" 
                    class="place-img" 
                    alt="<?php echo htmlspecialchars($lugar['vcNombre']); ?>"
                    onerror="this.onerror=null; this.src='/PW2_Proyect/Image/default.png';"
                >

                <div class="card-body">

                    <span class="place-category">
                        <?php echo htmlspecialchars($lugar['categoria']); ?>
                    </span>

                    <h5 class="card-title">
                        <?php echo htmlspecialchars(strtoupper($lugar['vcNombre'])); ?>
                    </h5>

                    <p class="place-desc">
                        <?php echo htmlspecialchars($lugar['vcDescr']); ?>
                    </p>

                    <p class="place-city">
                        <?php echo htmlspecialchars($lugar['vcCiudad'] . ', ' . $lugar['vcEstado']); ?>
                    </p>

                    <div class="wrapper-places">
                        <a 
                            href="/PW2_Proyect/place-detail?id=<?php echo $lugar['id_locacion']; ?>" 
                            class="btn-places"
                        >
                            Más información
                        </a>

                        <img class="icon-flecha" src="/image/icons/icon-flecha.png" alt="">
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

    <p id="noResults" style="display:none;">
        No se encontraron lugares.
    </p>

</div>

<script src="/js/header-login.js"></script>

<script>
const input = document.getElementById('searchPlaces');
const cards = document.querySelectorAll('.place-card');
const noResults = document.getElementById('noResults');
const categoryButtons = document.querySelectorAll('.categoryBtn');

let selectedCategory = 'all';

function normalizeText(text) {
    return text
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');
}

function filterPlaces() {
    const val = normalizeText(input.value.trim());
    let visibles = 0;

    cards.forEach(card => {
        const searchText = normalizeText(card.dataset.search);
        const matchesText = searchText.includes(val);
        const matchesCategory = selectedCategory === 'all' || card.dataset.category === selectedCategory;

        if (matchesText && matchesCategory) {
            card.style.display = '';
            visibles++;
        } else {
            card.style.display = 'none';
        }
    });

    noResults.style.display = visibles === 0 ? 'block' : 'none';
}

input.addEventListener('input', filterPlaces);

categoryButtons.forEach(btn => {
    btn.addEventListener('click', function () {
        categoryButtons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        selectedCategory = this.dataset.category;
        filterPlaces();
    });
});
</script>

</body>
</html>