<?php

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

if (!($page)) {
    $page = 'accueil';
}

require_once './Model/mysql.php';

require_once "./Controlleur/$page.php";