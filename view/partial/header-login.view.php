<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nombreUsuario = $_SESSION['session_nomCom'] ?? 'Usuario';
$fotoPerfil = '/Image/snoopy-profile.jfif';

if (!empty($_SESSION['session_foto'])) {
    $fotoPerfil = 'data:image/jpeg;base64,' . base64_encode($_SESSION['session_foto']);
}
?>

<header class="nlgoHeader">
    <nav class="nlgoNavbar">

        <a href="/PW2_Proyect/" class="nlgoLogo">
            NLGo!
        </a>

        <ul class="nlgoMenu">
            <li>
                <a href="/PW2_Proyect/game" class="nlgoIconBtn" title="Juegos">
                    <i class="fa-regular fa-futbol"></i>
                </a>
            </li>

            <li>
                <a href="/PW2_Proyect/menu-place" class="nlgoIconBtn" title="Lugares">
                    <i class="fa-solid fa-map-location-dot"></i>
                </a>
            </li>

            <li>
                <a href="/PW2_Proyect/favorite" class="nlgoIconBtn" title="Favoritos">
                    <i class="fa-solid fa-heart"></i>
                </a>
            </li>
        </ul>

        <div class="nlgoUserArea">
            <div class="nlgoWelcome">
                Bienvenid@, <strong><?php echo htmlspecialchars($nombreUsuario); ?></strong>
            </div>

            <a href="/PW2_Proyect/profile" class="nlgoProfileLink">
                <img 
                    src="<?php echo $fotoPerfil; ?>" 
                    alt="Perfil" 
                    class="nlgoProfileImg"
                >
            </a>

            <a href="/PW2_Proyect/logout" class="nlgoLogoutBtn" title="Cerrar sesión">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>

    </nav>
</header>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">