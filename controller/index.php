<?php

session_start();
/*
*Gente con el requiere recuerden que ejecutamos y traemos codigo de otro php , en este caso la vista de home , que practicamente es un html porque necesito saber porque me carga un horrorsote :,D 

*Se me olvida a diferencia del include el requiere se detiene cuando truena y el include solo marca error y continua , es todo :D
*/
$page = 'index';

$currentPage = $_SERVER['REQUEST_URI'];

require 'view/index.view.php';
