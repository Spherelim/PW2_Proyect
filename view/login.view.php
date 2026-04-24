<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NlGo! - login</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

    <div id="header-login"></div>
    <div class="wrapperLogin ">

        <div class="bodyLogin">

            <h1 class="tLogin">INICIAR SESION</h1>

            <label class="lLogin">Correo electronico</label>
            <input class="iLogin" type="text" name="iCorreoUser" value="<?php echo isset($correo) ? htmlspecialchars($correo) : ''; ?>">

            <label class="lLogin" for="">Contraseña</label>
            <input class="iLogin" type="password" name="iContraUser">

            <p class="txtReg">¿Aun no tienes cuenta?Da click <a href="/PW2_Proyect/register.html " class="linkReg">Registrate</a> </p>

            <div class="wrapperBtn" >
                <button href="" class="btn-reg" type="submit">INGRESAR</button>
            </div>

        </div>

    </div>



</body>

<script src="/js/header-login.js"></script>


</html>