<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLGo! - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/header-login.css">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

<header>
    <nav class="navbar">
        <div class="wrapper-logo">
            <h1 id="titulo">NLGo!</h1>
        </div>

        <div class="wrapper-opc">
            <a id="subtitulo" href="/PW2_Proyect/place">LUGARES</a>
        </div>

        <div class="wrapper-btn">
            <a href="/PW2_Proyect/" class="btn-login">Inicio</a>
        </div>
    </nav>
</header>

<form class="wrapperLogin" action="/PW2_Proyect/login-process" method="POST">

    <div class="bodyLogin">

        <h1 class="tLogin">INICIAR SESIÓN</h1>

        <label class="lLogin">Correo electrónico</label>
        <input class="iLogin" type="email" name="iCorreoUser" id="iCorreoUser">

        <label class="lLogin">Contraseña</label>
        <input class="iLogin" type="password" name="iContraUser" id="iContraUser">

        <?php if (isset($error) && !empty($error)): ?>
            <div id="passwordHelpBlock" class="form-text" style="font-size:14px; color:#FB7187; text-align:center; font-weight:bold; font-family:var(--font-Monserrat);">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <p class="txtReg">
            ¿Aún no tienes cuenta? Da click
            <a href="/PW2_Proyect/register" class="linkReg">Regístrate</a>
        </p>

        <div class="wrapperBtn">
            <button class="btn-reg" type="submit">INGRESAR</button>
        </div>

    </div>

</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const formLogin = document.querySelector('.wrapperLogin');

function showLoginError(msg) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: msg,
        confirmButtonColor: '#F91B40',
        background: '#FBFBF6',
        color: '#464646'
    });
}

function showLoginSuccess(msg) {
    Swal.fire({
        icon: 'success',
        title: '¡Listo!',
        text: msg,
        confirmButtonColor: '#F91B40',
        background: '#FBFBF6',
        color: '#464646'
    });
}

formLogin.addEventListener('submit', function(e) {
    const correo = document.getElementById('iCorreoUser').value.trim();
    const contra = document.getElementById('iContraUser').value.trim();

    if (!correo || !contra) {
        e.preventDefault();
        showLoginError('Ingresa tu correo y contraseña.');
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(correo)) {
        e.preventDefault();
        showLoginError('Correo electrónico inválido.');
        return;
    }

    if (contra.length < 6) {
        e.preventDefault();
        showLoginError('La contraseña debe tener mínimo 6 caracteres.');
        return;
    }
});

const params = new URLSearchParams(window.location.search);

if (params.get('registro') === 'ok') {
    showLoginSuccess('Registro exitoso. Ya puedes iniciar sesión.');
}

<?php if (isset($error) && !empty($error)): ?>
showLoginError('<?php echo addslashes($error); ?>');
<?php endif; ?>
</script>

</body>
</html>