<?php

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

require_once "./Controlleur/$page.php";