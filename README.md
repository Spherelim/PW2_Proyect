<h1 align=center> Integrantes <h1>

<div align=center>
    <table>
        <tr align=center>
            <th>
                Alumnos
            </th>
            <th>
                matricula
            </th>
        </tr>
        <tr>
            <td>
                <p> Mauricio Eleuterio Ortiz Rodríguez</p>
            </td>
            <td>
                <p> 2001170 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Martha  Lizbeth Hernandez Hrndz</p>
            </td>
            <td>
                <p> 1957543 </p>
            </td>
        </tr>
        <tr>
            <td>
                <p> Naydelin Vanessa Torres Galván</p>
            </td>
            <td>
                <p> 1917319 </p>
            </td>
        </tr>
    </table>
</div>
<br>
<h3> Descripción de la pagina: </h2>

<div>
    <p> NLGO! es un sitio web de turismo especializado para el mundial en Nuevo León! 2026, Encontrarás Muchos lugares interesantes por visitar Como Paseo la fe, Barrio antiguo, Fundidora, la macroplaza, etc. <br></p>
    <p> Puedes Calificar los Lugares! y comentar sobre tu experiencia, si te encanta un lugar Guardalo como Favorito! <br></p>
    <p> ¿No sabes donde comer? <br> Aqui tambien encontraras distintos restaurantes en nuestra pagina web!, incluyendo Museos!! <br></p>
    <p> ¿Quieres saber Cuando van a ser los partidos? <br> Aqui te los mostramos!! y tambien donde se hubica!<br></p>
</div>

<br>
<hr>
<h2 align=center> Descripción Carpetas: </h2>

<div>
    <p>📂 PW2_Proyect: contiene los principal para el proyecto<br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 controller: se guardaran todos los procesos que necesita la pagina web, llamadas a la base de datos llamar una ruta de una pagina, etc. <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 core: se guarda la configuracion para la conexiond e la DB <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 css: se guarda el estilo de las paginas (front) <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 fonts: se guarda la tipografia/fuente de la pagina <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 image: contiene las imagenes para el front <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;📂 icons: contiene los iconos para el fornt <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;📂 paises: contiene las imagenes de los paises partipes de los aprtidos. <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 js: contiene archivos para el manejo del front <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 middleware: contiene el archivo para el cierre de sesión <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 src: contiene la configuración de Taildwind <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;📂 view: Contiene los archivos html para la visualizacion de las paginas en php <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;📂 includes: contiene el archivo para incluir las targetas de los partidos. <br></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;📂 partial: contiene el footer y headers en html para la visualizaciond en php. <br></p>
</div>

<hr>
<h2> Instrucciones de ejecución: </h3>
El proyecto se ejecuta con composer serve en la terminal, eso abre el servidor , se agrega de forma manual en composer.json
en la parte de scripts, se agrega como variable el php -S localhost:1080.

<div>
    <p> Se utilizo php  , mysql y composer serve <br>
    </p>

</div>

<br>
Instalar tailwind 

Paso 1: Instalar el node.js

Paso 2: Abrir una nueva terminal en modo command promt , escribir npm init , darle a todo enter hasta que deje escribir un nuevo comando

Paso 3: En la pagina oficial de tailwind , trae los comandos a ejecutar
https://tailwindcss.com/docs/installation/tailwind-cli , le damos a la opcion Tailwind CLI

    Paso 3.1: Ejecutamos en la cmd
    npm install tailwindcss @tailwindcss/cli

    Paso 3.2 Creamos una carpeta src , ahi agregamos un input.css con lo siguiente: @import "tailwindcss";

    Paso 3.3 Creamos un index.html con el contenido del html del paso 4 de la pagina del tailwind.

    Paso 3.4 Ejecutamos el comando : npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch

    Paso 3.5 Deberiamos poder usar tailind css


*Mover el index.html en la carpeta html

Paso 1: Despues de colocar el archivo index.html en html(carpeta) y output.css en css(carpeta) , vamos a irnos a package.json.

Paso 2: En la parte de script agregamos la siguiente linea:
 "dev": "npx @tailwindcss/cli -i ./src/input.css -o ./css/index.css --watch"

Paso 3: Significa del input.css create en siguiente ruta el output.css se puede cambiar el nombre en el caso index.css .Tambien tenemos que pasarle la ruta correcta al index.html (   <link href="/css/index.css" rel="stylesheet">)

Paso 4: Damos ctrl + c , agregamos el comando npm run dev .

Paso 5: Volvemos a tener tailwind.

Referencia: https://www.youtube.com/watch?v=HxSbC2k_Yng
