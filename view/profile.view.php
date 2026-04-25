<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - NLGo!</title>

    <link rel="stylesheet" href="/css/header-login.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>

<body>

<?php require 'controller/header-login.php'; ?>

<?php
$fotoPerfil = '/Image/snoopy-profile.jfif';

if (!empty($usuario['imagenPerfil'])) {
    $fotoPerfil = 'data:image/jpeg;base64,' . base64_encode($usuario['imagenPerfil']);
}
?>

<main class="profilePage">

    <section class="profileCard">

        <div class="profileTop">

            <div class="avatarBox">
                <input 
                    type="file" 
                    id="fileOpener" 
                    style="display:none" 
                    accept="image/*"
                >

                <img 
                    id="preview" 
                    class="profileAvatar" 
                    src="<?php echo $fotoPerfil; ?>" 
                    alt="Foto de perfil"
                >

                <button type="button" class="avatarEditBtn" id="avatarEditBtn">
                    Cambiar foto
                </button>
            </div>

            <div class="profileSummary">
                <span class="profileTag">Mi cuenta</span>

                <h1>
                    <?php echo htmlspecialchars($usuario['vcNombre'] ?? 'Perfil'); ?>
                </h1>

                <p>
                    @<?php echo htmlspecialchars($usuario['vcNickname'] ?? 'usuario'); ?>
                </p>

                <div class="profileActions">
                    <button type="button" id="editIcon" class="btnEditProfile">
                        Editar perfil
                    </button>

                    <button type="button" id="saveProfile" class="btnSaveProfile" style="display:none;">
                        Guardar cambios
                    </button>

                    <a href="/PW2_Proyect/favorite" class="btnFavorites">
                        Favoritos
                    </a>
                </div>
            </div>

        </div>

        <div class="profileBody">

            <div class="profileSection">
                <h2>Información personal</h2>

                <div class="profileGrid">

                    <div class="fieldBox">
                        <label>Nombre completo</label>
                        <input 
                            type="text" 
                            class="profileInput" 
                            id="nomProf"
                            value="<?php echo htmlspecialchars($usuario['vcNombre'] ?? ''); ?>"
                            disabled
                        >
                    </div>

                    <div class="fieldBox">
                        <label>Fecha de nacimiento</label>
                        <input 
                            type="date" 
                            class="profileInput" 
                            id="fechaNacProf"
                            value="<?php echo htmlspecialchars($usuario['dtFechaNacimiento'] ?? ''); ?>"
                            disabled
                        >
                    </div>

                    <div class="fieldBox">
                        <label>Apodo</label>
                        <input 
                            type="text" 
                            class="profileInput" 
                            id="apodoProf"
                            value="<?php echo htmlspecialchars($usuario['vcNickname'] ?? ''); ?>"
                            disabled
                        >
                    </div>

                    <div class="fieldBox">
                        <label>Correo electrónico</label>
                        <input 
                            type="email" 
                            class="profileInput" 
                            id="correoProf"
                            value="<?php echo htmlspecialchars($usuario['vcEmail'] ?? ''); ?>"
                            disabled
                        >
                    </div>

                </div>
            </div>

            <div class="profileSection passwordBox" id="passwordBox" style="display:none;">
                <h2>Cambiar contraseña</h2>

                <div class="profileGrid">

                    <div class="fieldBox">
                        <label>Contraseña actual</label>
                        <input 
                            type="password" 
                            class="profileInput" 
                            id="passwordActual"
                            placeholder="Tu contraseña actual"
                        >
                    </div>

                    <div class="fieldBox">
                        <label>Nueva contraseña</label>
                        <input 
                            type="password" 
                            class="profileInput" 
                            id="passwordNuevo"
                            placeholder="Mínimo 6 caracteres"
                        >
                    </div>

                    <div class="fieldBox">
                        <label>Confirmar contraseña</label>
                        <input 
                            type="password" 
                            class="profileInput" 
                            id="passwordConfirmar"
                            placeholder="Repite la nueva contraseña"
                        >
                    </div>

                </div>
            </div>

        </div>

    </section>

</main>

<script src="/js/header-login.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const editIcon = document.getElementById('editIcon');
const saveProfile = document.getElementById('saveProfile');
const avatarEditBtn = document.getElementById('avatarEditBtn');
const fileOpener = document.getElementById('fileOpener');
const preview = document.getElementById('preview');

const nomProf = document.getElementById('nomProf');
const fechaNacProf = document.getElementById('fechaNacProf');
const apodoProf = document.getElementById('apodoProf');
const correoProf = document.getElementById('correoProf');

const passwordBox = document.getElementById('passwordBox');
const passwordActual = document.getElementById('passwordActual');
const passwordNuevo = document.getElementById('passwordNuevo');
const passwordConfirmar = document.getElementById('passwordConfirmar');

const inputs = [
    nomProf,
    fechaNacProf,
    apodoProf,
    correoProf
];

let selectedFile = null;
let editMode = false;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2200,
    timerProgressBar: true
});

function showToast(icon, title) {
    Toast.fire({
        icon,
        title
    });
}

function setEditMode(active) {
    editMode = active;

    inputs.forEach(input => {
        input.disabled = !active;
    });

    passwordBox.style.display = active ? 'block' : 'none';
    saveProfile.style.display = active ? 'inline-flex' : 'none';
    editIcon.textContent = active ? 'Editando...' : 'Editar perfil';
    editIcon.disabled = active;

    if (!active) {
        passwordActual.value = '';
        passwordNuevo.value = '';
        passwordConfirmar.value = '';
    }
}

editIcon.addEventListener('click', function () {
    setEditMode(true);
    showToast('info', 'Modo edición activado');
});

avatarEditBtn.addEventListener('click', function () {
    if (!editMode) {
        setEditMode(true);
        showToast('info', 'Modo edición activado');
    }

    fileOpener.click();
});

preview.addEventListener('click', function () {
    avatarEditBtn.click();
});

fileOpener.addEventListener('change', function () {
    const file = this.files[0];

    if (!file) {
        return;
    }

    if (!file.type.startsWith('image/')) {
        showToast('error', 'Selecciona una imagen válida');
        return;
    }

    selectedFile = file;

    const reader = new FileReader();

    reader.onload = function (e) {
        preview.src = e.target.result;
        showToast('success', 'Imagen cargada');
    };

    reader.readAsDataURL(file);
});

saveProfile.addEventListener('click', async function () {
    const nombre = nomProf.value.trim();
    const fecha = fechaNacProf.value;
    const apodo = apodoProf.value.trim();
    const correo = correoProf.value.trim();

    const passActual = passwordActual.value.trim();
    const passNuevo = passwordNuevo.value.trim();
    const passConfirmar = passwordConfirmar.value.trim();

    if (!nombre || !fecha || !apodo || !correo) {
        showToast('warning', 'Completa los campos obligatorios');
        return;
    }

    if (passActual || passNuevo || passConfirmar) {
        if (!passActual || !passNuevo || !passConfirmar) {
            showToast('warning', 'Completa todos los campos de contraseña');
            return;
        }

        if (passNuevo.length < 6) {
            showToast('warning', 'La nueva contraseña debe tener mínimo 6 caracteres');
            return;
        }

        if (passNuevo !== passConfirmar) {
            showToast('error', 'Las contraseñas no coinciden');
            return;
        }
    }

    const formData = new FormData();

    formData.append('vcNombre', nombre);
    formData.append('dtFechaNacimiento', fecha);
    formData.append('vcNickname', apodo);
    formData.append('vcEmail', correo);

    formData.append('passwordActual', passActual);
    formData.append('passwordNuevo', passNuevo);
    formData.append('passwordConfirmar', passConfirmar);

    if (selectedFile) {
        formData.append('imagenPerfil', selectedFile);
    }

    saveProfile.disabled = true;
    saveProfile.textContent = 'Guardando...';

    try {
        const res = await fetch('/PW2_Proyect/profile-update', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (!data.ok) {
            showToast('error', data.message || 'No se pudo actualizar');
            return;
        }

        selectedFile = null;
        setEditMode(false);
        showToast('success', data.message || 'Perfil actualizado');

    } catch (e) {
        showToast('error', 'Error al conectar con el servidor');
    } finally {
        saveProfile.disabled = false;
        saveProfile.textContent = 'Guardar cambios';
    }
});
</script>

</body>
</html>