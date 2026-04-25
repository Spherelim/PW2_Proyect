<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLGo! - Favoritos</title>

    <link rel="stylesheet" href="/css/header-login.css">
    <link rel="stylesheet" href="/css/favorite.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<?php require 'controller/header-login.php'; ?>

<main class="favoritePage">

    <section class="favoriteHeader">
        <h1>Mis favoritos</h1>
        <p>Lugares que guardaste para visitar después</p>
    </section>

    <?php if (empty($favoritos)): ?>

        <div class="emptyFav">
            <i class="fa-solid fa-heart-crack"></i>
            <h2>Aún no tienes favoritos</h2>
            <p>Explora lugares y guarda los que más te gusten.</p>
            <a href="/PW2_Proyect/menu-place">Explorar lugares</a>
        </div>

    <?php else: ?>

        <div class="grid">

            <div class="flexCard">

                <?php foreach ($favoritos as $lugar): ?>

                    <div class="wrapperCards favCard">

                        <button 
                            type="button"
                            class="favRemoveBtn"
                            data-id="<?php echo (int)$lugar['id_locacion']; ?>"
                            title="Quitar de favoritos"
                        >
                            <i class="fa-solid fa-heart"></i>
                        </button>

                        <div class="containerCard">

                            <h1 class="titulo">
                                <?php echo htmlspecialchars($lugar['vcNombre']); ?>
                            </h1>

                            <span class="favCategory">
                                <?php echo htmlspecialchars($lugar['categoria']); ?>
                            </span>

                            <div class="wrapperFoto">
                                <img 
                                    src="<?php echo !empty($lugar['image_url']) ? htmlspecialchars($lugar['image_url']) : '/PW2_Proyect/Image/default.png'; ?>" 
                                    alt="<?php echo htmlspecialchars($lugar['vcNombre']); ?>" 
                                    class="imgFav"
                                    onerror="this.onerror=null; this.src='/PW2_Proyect/Image/default.png';"
                                >
                            </div>

                            <p class="favCity">
                                <i class="fa-solid fa-location-dot"></i>
                                <?php echo htmlspecialchars($lugar['vcCiudad'] . ', ' . $lugar['vcEstado']); ?>
                            </p>

                            <div class="wrapperGo">
                                <a 
                                    href="/PW2_Proyect/place-detail?id=<?php echo (int)$lugar['id_locacion']; ?>" 
                                    class="aVolver"
                                >
                                    Ver
                                </a>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    <?php endif; ?>

</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1800,
    timerProgressBar: true
});

document.querySelectorAll('.favRemoveBtn').forEach(btn => {
    btn.addEventListener('click', async function () {
        const card = this.closest('.favCard');
        const idLocacion = this.dataset.id;

        const formData = new FormData();
        formData.append('id_locacion', idLocacion);

        this.disabled = true;

        try {
            const res = await fetch('/PW2_Proyect/place-favorite', {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (!data.ok) {
                Toast.fire({
                    icon: 'error',
                    title: data.message || 'No se pudo quitar'
                });
                this.disabled = false;
                return;
            }

            card.classList.add('removing');

            setTimeout(() => {
                card.remove();

                Toast.fire({
                    icon: 'success',
                    title: 'Quitado de favoritos'
                });

                if (document.querySelectorAll('.favCard').length === 0) {
                    location.reload();
                }
            }, 250);

        } catch (e) {
            Toast.fire({
                icon: 'error',
                title: 'Error de conexión'
            });

            this.disabled = false;
        }
    });
});
</script>

</body>
</html>