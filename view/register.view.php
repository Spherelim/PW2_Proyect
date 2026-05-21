<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLGo! - Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/header-login.css">
    <link rel="stylesheet" href="/css/register.css">
</head>

<body>

<header>
    <nav class="navbar">
        <div class="wrapper-logo">
            <h1 id="titulo">NLGo!</h1>
        </div>

        <div class="wrapper-btn">
            <a href="/PW2_Proyect/" class="btn-login">Inicio</a>
        </div>
    </nav>
</header>

<form class="wrapperReg" action="/PW2_Proyect/register-process" method="POST" enctype="multipart/form-data">

    <div class="bodyReg">

        <div class="perfilReg">
            <input 
                type="file" 
                id="fileOpener" 
                name="imagenPerfil"
                style="display:none" 
                accept="image/*"
            >

            <img 
                id="preview" 
                class="imgReg" 
                src="/Image/snoopy-profile.jfif" 
                alt=""
                onclick="document.getElementById('fileOpener').click()"
            >
        </div>

        <div class="gridReg">

            <div class="flexReg">
                <h1 class="tReg">Registro</h1>
            </div>

            <div class="flexReg">
                <label class="lReg">Correo electrónico</label>
                <label class="lReg">Nickname</label>
            </div>

            <div class="flexReg">
                <input class="iReg" type="email" name="vcEmail" required>
                <input class="iReg" type="text" name="vcNickname" required minlength="3" maxlength="40">
            </div>

            <div class="flexReg">
                <label class="lReg">Nombre completo</label>
                <label class="lReg">Fecha de nacimiento</label>
            </div>

            <div class="flexReg">
                <input class="iReg" type="text" name="vcNombre" required minlength="3" maxlength="120">
                <input class="iReg" type="date" name="dtFechaNacimiento" required>
            </div>

            <div class="flexReg">
                <label class="lReg">Contraseña</label>
            </div>

            <div class="flexReg">
                <input class="iReg" type="password" name="vcPassword" required minlength="6">
                <button class="formBtnReg" type="submit">Registro</button>
            </div>

        </div>

    </div>

</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const form = document.querySelector('.wrapperReg');
const fileInput = document.getElementById('fileOpener');
const preview = document.getElementById('preview');

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

fileInput.addEventListener('change', function(e) {
    const file = e.target.files[0];

    if (!file) return;

    if (!file.type.startsWith('image/')) {
        showError('Solo se permiten imágenes.');
        this.value = '';
        return;
    }

    if (file.size > 2 * 1024 * 1024) {
        showError('La imagen no debe pesar más de 2 MB.');
        this.value = '';
        return;
    }

    preview.src = URL.createObjectURL(file);
});

form.addEventListener('submit', function(e) {
    const nombre = document.querySelector('[name="vcNombre"]').value.trim();
    const email = document.querySelector('[name="vcEmail"]').value.trim();
    const nickname = document.querySelector('[name="vcNickname"]').value.trim();
    const fecha = document.querySelector('[name="dtFechaNacimiento"]').value;
    const password = document.querySelector('[name="vcPassword"]').value;
    const file = fileInput.files[0];

    if (!email || !nickname || !nombre || !fecha || !password) {
        e.preventDefault();
        showError('Todos los campos son obligatorios.');
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        e.preventDefault();
        showError('Correo electrónico inválido.');
        return;
    }

    if (nickname.length < 3) {
        e.preventDefault();
        showError('El nickname debe tener mínimo 3 caracteres.');
        return;
    }

    if (nombre.length < 3) {
        e.preventDefault();
        showError('El nombre debe tener mínimo 3 caracteres.');
        return;
    }

    if (password.length < 6) {
        e.preventDefault();
        showError('La contraseña debe tener mínimo 6 caracteres.');
        return;
    }

    const fechaNacimiento = new Date(fecha);
    const hoy = new Date();

    if (fechaNacimiento >= hoy) {
        e.preventDefault();
        showError('La fecha de nacimiento no es válida.');
        return;
    }

    if (file) {
        if (!file.type.startsWith('image/')) {
            e.preventDefault();
            showError('Solo se permiten imágenes.');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            e.preventDefault();
            showError('La imagen no debe pesar más de 2 MB.');
            return;
        }
    }
});
</script>

</body>
</html>