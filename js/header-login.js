fetch("/PW2_Proyect/header") .then(response => response.text()) .then(data => { document.getElementById("header").innerHTML = data; });


fetch("/PW2_Proyect/header-login") .then(response => response.text()) .then(data => { document.getElementById("header-login").innerHTML = data; });



fetch("/PW2_Proyect/footer") .then(response => response.text()) .then(data => { document.getElementById("footer").innerHTML = data; });