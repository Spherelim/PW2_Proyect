<?php

session_start();
$page = 'place';

$currentPage = $_SERVER['REQUEST_URI'];

require 'view/place.view.php';
