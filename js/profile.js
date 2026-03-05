const editIcon = document.getElementById('editIcon');
const passwordSection = document.getElementById('passwordProf');
const passwordInput = document.getElementById('passInputProf');
const favSection = document.getElementById('linkFav');
const Nom = document.getElementById("nomProf");
const Fecha = document.getElementById("fechaNacProf");
const apodo = document.getElementById("apodoProf");
const correoProf = document.getElementById("correoProf");
const favLink = document.getElementById("aFav");
let activo = 1;

editIcon.addEventListener('click', () => {
    

    if (activo == 1) {

        /* alert(activo); */
         
        activo = 2;

        passwordSection.style.display = 'block';
        passwordInput.style.display = 'block';
       

        editIcon.src = "/image/icons/icon-save.png";
        editIcon.alt = "Guardar";
        Nom.disabled = false; 
        Fecha.disabled = false;
        apodo.disabled = false; 
        correoProf.disabled = false;

       favLink.style.pointerEvents = "none";

    } else if (activo == 2) {

        activo = 1;
      /*   alert(activo); */
        passwordSection.style.display = 'none';
        passwordInput.style.display = 'none';
       
        editIcon.src = "/image/icons/icon-edit.png";
        editIcon.alt = "Guardar";

        Nom.disabled = true; 
        Fecha.disabled = true;
        apodo.disabled = true; 
        correoProf.disabled = true;

        favLink.style.pointerEvents = "auto";
    }

});