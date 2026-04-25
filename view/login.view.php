<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NlGo! - login</title>
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

    <form class="wrapperLogin " action="/login-process" method="POST"  >

        <div class="bodyLogin">

            <h1 class="tLogin">INICIAR SESION</h1>

            <label class="lLogin">Correo electronico</label>
            <input class="iLogin" type="text" name="iCorreoUser" >

            <label class="lLogin" for="">Contraseña</label>
            <input class="iLogin" type="password" name="iContraUser">

              <!-- Mostrar errores si existen -->
                    <?php if (isset($error) && !empty($error)): ?>
                        <div id="passwordHelpBlock" class="form-text" style="font-size:14px;   color: #FB7187 ; text-align:center ;font-weight: bold;font-family: var(--font-Monserrat);">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
            <p class="txtReg">¿Aun no tienes cuenta?Da click <a href="/PW2_Proyect/register " class="linkReg">Registrate</a> </p>

            <div class="wrapperBtn">
                <button class="btn-reg" type="submit">INGRESAR</button>
            </div>

        </div>

    </form>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>



</html>