<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLGo! - <?php echo htmlspecialchars($lugar['vcNombre']); ?></title>

    <link rel="stylesheet" href="/css/header-login.css">
    <link rel="stylesheet" href="/css/place-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<?php require 'controller/header-login.php'; ?>

<main class="detailPage">

    <section class="detailHero">

        <div class="detailImgBox">
            <img src="/Image/santalucia.png" class="detailImg" alt="">
        </div>

        <div class="detailInfo">

            <span class="detailCategory">
                <?php echo htmlspecialchars($lugar['categoria']); ?>
            </span>

            <h1 class="detailTitle">
                <?php echo htmlspecialchars($lugar['vcNombre']); ?>
            </h1>

            <p class="detailDesc">
                <?php echo htmlspecialchars($lugar['vcDescr']); ?>
            </p>

            <div class="detailData">
                <div>
                    <strong>Ciudad</strong>
                    <span><?php echo htmlspecialchars($lugar['vcCiudad']); ?></span>
                </div>

                <div>
                    <strong>Estado</strong>
                    <span><?php echo htmlspecialchars($lugar['vcEstado']); ?></span>
                </div>

                <div>
                    <strong>País</strong>
                    <span><?php echo htmlspecialchars($lugar['vcPais']); ?></span>
                </div>

                <div>
                    <strong>Código Postal</strong>
                    <span><?php echo htmlspecialchars($lugar['vcCodigoPostal']); ?></span>
                </div>
            </div>

            <div class="addressBox">
                <h2>Dirección</h2>
                <p>
                    <?php echo htmlspecialchars($lugar['vcCalle']); ?>
                    <?php echo htmlspecialchars($lugar['vcNumeroExterior']); ?>

                    <?php if (!empty($lugar['vcNumeroInterior'])): ?>
                        Int. <?php echo htmlspecialchars($lugar['vcNumeroInterior']); ?>
                    <?php endif; ?>

                    , <?php echo htmlspecialchars($lugar['vcColonia']); ?>,
                    <?php echo htmlspecialchars($lugar['vcCiudad']); ?>,
                    <?php echo htmlspecialchars($lugar['vcEstado']); ?>.
                </p>
            </div>

            <div class="placeReactionsInline">

                <button 
                    type="button" 
                    class="reactionIcon like js-place-reaction" 
                    data-tipo="1"
                >
                    <i class="fa-solid fa-thumbs-up"></i>
                    <span id="placeLikes"><?php echo (int)$lugar['likes']; ?></span>
                </button>

                <button 
                    type="button" 
                    class="reactionIcon dislike js-place-reaction" 
                    data-tipo="-1"
                >
                    <i class="fa-solid fa-thumbs-down"></i>
                    <span id="placeDislikes"><?php echo (int)$lugar['dislikes']; ?></span>
                </button>

            </div>

            <div class="detailActions">

                <button 
                    type="button"
                    id="btnFavorite"
                    class="btnFavorite <?php echo !empty($lugar['esFavorito']) ? 'active' : ''; ?>"
                >
                    <i class="<?php echo !empty($lugar['esFavorito']) ? 'fa-solid' : 'fa-regular'; ?> fa-heart"></i>
                    <span>
                        <?php echo !empty($lugar['esFavorito']) ? 'En favoritos' : 'Agregar a favoritos'; ?>
                    </span>
                </button>

                <a href="/PW2_Proyect/place" class="btnBack">Volver</a>

                <?php if (!empty($lugar['dLatitud']) && !empty($lugar['dLongitud'])): ?>
                    <a 
                        href="https://www.google.com/maps?q=<?php echo $lugar['dLatitud']; ?>,<?php echo $lugar['dLongitud']; ?>" 
                        target="_blank"
                        class="btnMap"
                    >
                        Abrir en Maps
                    </a>
                <?php endif; ?>
            </div>

        </div>

    </section>

    <?php if (!empty($lugar['dLatitud']) && !empty($lugar['dLongitud'])): ?>
        <section class="mapPreview">
            <iframe
                src="https://www.google.com/maps?q=<?php echo $lugar['dLatitud']; ?>,<?php echo $lugar['dLongitud']; ?>&z=15&output=embed"
                loading="lazy">
            </iframe>
        </section>
    <?php endif; ?>

    <section class="socialSection">

        <div class="commentsBox">

            <h2>Comentarios</h2>

            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>

                <form class="commentForm" id="commentForm">
                    <input type="hidden" name="id_locacion" value="<?php echo $lugar['id_locacion']; ?>">

                    <textarea 
                        name="vcComentario" 
                        id="vcComentario"
                        placeholder="Escribe tu comentario..."
                        required
                    ></textarea>

                    <button type="submit">Publicar</button>
                </form>

            <?php else: ?>

                <p class="loginCommentMsg">
                    Inicia sesión para comentar.
                </p>

            <?php endif; ?>

            <div class="commentsList">

                <?php if (empty($comentarios)): ?>
                    <p class="emptyComments">Aún no hay comentarios.</p>
                <?php endif; ?>

                <?php foreach ($comentarios as $comentario): ?>

                    <?php
                        $fotoComentario = '/Image/snoopy-profile.jfif';

                        if (!empty($comentario['imagenPerfil'])) {
                            $fotoComentario = 'data:image/jpeg;base64,' . base64_encode($comentario['imagenPerfil']);
                        }
                    ?>

                    <div class="commentCard">

                        <div class="commentHeader">

                            <div class="commentUser">
                                <img 
                                    src="<?php echo $fotoComentario; ?>" 
                                    class="commentAvatar" 
                                    alt="Foto usuario"
                                >

                                <div>
                                    <strong><?php echo htmlspecialchars($comentario['usuario']); ?></strong>
                                    <span><?php echo htmlspecialchars($comentario['dtFechaRegistro']); ?></span>
                                </div>
                            </div>

                        </div>

                        <p><?php echo htmlspecialchars($comentario['vcComentario']); ?></p>

                        <div class="commentActions">

                            <button 
                                type="button"
                                class="reactionIcon like js-comment-reaction"
                                data-id="<?php echo $comentario['id_comentario']; ?>"
                                data-tipo="1"
                            >
                                <i class="fa-solid fa-thumbs-up"></i>
                                <span id="commentLike_<?php echo $comentario['id_comentario']; ?>">
                                    <?php echo (int)$comentario['likes']; ?>
                                </span>
                            </button>

                            <button 
                                type="button"
                                class="reactionIcon dislike js-comment-reaction"
                                data-id="<?php echo $comentario['id_comentario']; ?>"
                                data-tipo="-1"
                            >
                                <i class="fa-solid fa-thumbs-down"></i>
                                <span id="commentDislike_<?php echo $comentario['id_comentario']; ?>">
                                    <?php echo (int)$comentario['dislikes']; ?>
                                </span>
                            </button>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const idLocacion = <?php echo (int)$lugar['id_locacion']; ?>;

function showError(msg) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: msg,
        confirmButtonColor: '#F91B40',
        background: '#FBFBF6',
        color: '#464646'
    });
}

function showSuccess(msg) {
    Swal.fire({
        icon: 'success',
        title: '¡Listo!',
        text: msg,
        timer: 1200,
        showConfirmButton: false,
        background: '#FBFBF6',
        color: '#464646'
    });
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

/* FAVORITOS */
const btnFavorite = document.getElementById('btnFavorite');

if (btnFavorite) {
    btnFavorite.addEventListener('click', async function () {
        const button = this;
        const icon = button.querySelector('i');
        const text = button.querySelector('span');

        button.disabled = true;

        const formData = new FormData();
        formData.append('id_locacion', idLocacion);

        try {
            const res = await fetch('/PW2_Proyect/place-favorite', {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (!data.ok) {
                showError(data.message || 'No se pudo actualizar favoritos.');
                return;
            }

            if (parseInt(data.esFavorito) === 1) {
                button.classList.add('active');
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                text.textContent = 'En favoritos';
                showSuccess('Agregado a favoritos.');
            } else {
                button.classList.remove('active');
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
                text.textContent = 'Agregar a favoritos';
                showSuccess('Quitado de favoritos.');
            }

        } catch (e) {
            showError('Error al conectar con el servidor.');
        } finally {
            button.disabled = false;
        }
    });
}

document.querySelectorAll('.js-place-reaction').forEach(btn => {
    btn.addEventListener('click', async function () {
        const formData = new FormData();
        formData.append('id_locacion', idLocacion);
        formData.append('tipo', this.dataset.tipo);

        const res = await fetch('/PW2_Proyect/reaccion-locacion', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (!data.ok) {
            showError(data.message);
            return;
        }

        document.getElementById('placeLikes').textContent = data.likes;
        document.getElementById('placeDislikes').textContent = data.dislikes;
    });
});

const commentForm = document.getElementById('commentForm');

if (commentForm) {
    commentForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const textarea = document.getElementById('vcComentario');
        const texto = textarea.value.trim();

        if (!texto) {
            showError('Escribe un comentario.');
            return;
        }

        const formData = new FormData(commentForm);

        const res = await fetch('/PW2_Proyect/comentario-store', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (!data.ok) {
            showError(data.message);
            return;
        }

        const list = document.querySelector('.commentsList');
        const empty = document.querySelector('.emptyComments');

        if (empty) {
            empty.remove();
        }

        const foto = data.comentario.foto || '/Image/snoopy-profile.jfif';

        const card = document.createElement('div');
        card.className = 'commentCard';

        card.innerHTML = `
            <div class="commentHeader">
                <div class="commentUser">
                    <img src="${foto}" class="commentAvatar" alt="Foto usuario">

                    <div>
                        <strong>${escapeHtml(data.comentario.usuario)}</strong>
                        <span>${escapeHtml(data.comentario.fecha)}</span>
                    </div>
                </div>
            </div>

            <p>${escapeHtml(data.comentario.texto)}</p>

            <div class="commentActions">
                <button type="button" class="reactionIcon like" disabled>
                    <i class="fa-solid fa-thumbs-up"></i>
                    <span>0</span>
                </button>

                <button type="button" class="reactionIcon dislike" disabled>
                    <i class="fa-solid fa-thumbs-down"></i>
                    <span>0</span>
                </button>
            </div>
        `;

        list.prepend(card);
        textarea.value = '';
        showSuccess('Comentario publicado.');
    });
}

document.querySelectorAll('.js-comment-reaction').forEach(btn => {
    btn.addEventListener('click', async function () {
        const idComentario = this.dataset.id;

        const formData = new FormData();
        formData.append('id_comentario', idComentario);
        formData.append('id_locacion', idLocacion);
        formData.append('tipo', this.dataset.tipo);

        const res = await fetch('/PW2_Proyect/reaccion-comentario', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (!data.ok) {
            showError(data.message);
            return;
        }

        document.getElementById('commentLike_' + idComentario).textContent = data.likes;
        document.getElementById('commentDislike_' + idComentario).textContent = data.dislikes;
    });
});
</script>

</body>
</html>