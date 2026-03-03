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