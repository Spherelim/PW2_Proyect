<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLogged = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLGO! - Inicio</title>

    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/<?php echo $isLogged ? 'header-login.css' : 'header-public.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<?php if ($isLogged): ?>
    <?php require 'controller/header-login.php'; ?>
<?php else: ?>
    <?php require 'controller/header.php'; ?>
<?php endif; ?>

<div class="wrapper-NL">
    <img src="/image/conteiner-text.png" alt="NLGo">
</div>

<section class="topPlacesSection">

    <div class="topPlacesHeader">
        <h1 class="titulo">Explora</h1>
        <p>Top 9 lugares más queridos por la comunidad</p>
    </div>

    <?php if (empty($topLugares)): ?>

        <div class="emptyTop">
            <i class="fa-solid fa-map-location-dot"></i>
            <h2>Aún no hay lugares con likes</h2>
            <a href="/PW2_Proyect/place">Ver lugares</a>
        </div>

    <?php else: ?>

        <div class="topPlacesGrid">

            <?php foreach ($topLugares as $index => $lugar): ?>

                <article class="topPlaceCard">

                    <div class="topRank">
                        #<?php echo $index + 1; ?>
                    </div>

                    <img 
                        src="<?php echo !empty($lugar['image_url']) ? htmlspecialchars($lugar['image_url']) : '/PW2_Proyect/Image/default.png'; ?>" 
                        alt="<?php echo htmlspecialchars($lugar['vcNombre']); ?>" 
                        class="topPlaceImg"
                        onerror="this.onerror=null; this.src='/PW2_Proyect/Image/default.png';"
                    >

                    <div class="topPlaceBody">

                        <span class="topPlaceCategory">
                            <?php echo htmlspecialchars($lugar['categoria']); ?>
                        </span>

                        <h3>
                            <?php echo htmlspecialchars(strtoupper($lugar['vcNombre'])); ?>
                        </h3>

                        <p class="topPlaceCity">
                            <i class="fa-solid fa-location-dot"></i>
                            <?php echo htmlspecialchars($lugar['vcCiudad'] . ', ' . $lugar['vcEstado']); ?>
                        </p>

                        <div class="topPlaceStats">
                            <span>
                                <i class="fa-solid fa-thumbs-up"></i>
                                <?php echo (int)$lugar['likes']; ?>
                            </span>

                            <span>
                                <i class="fa-solid fa-thumbs-down"></i>
                                <?php echo (int)$lugar['dislikes']; ?>
                            </span>
                        </div>

                        <a 
                            href="<?php echo $isLogged 
                                ? '/PW2_Proyect/place-detail?id=' . (int)$lugar['id_locacion'] 
                                : '/PW2_Proyect/login'; ?>"
                            class="topPlaceBtn"
                        >
                            Más información
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>

<script src="/js/header-login.js"></script>

</body>
</html>