<?php

$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);
$images = filter_input(INPUT_POST, 'images', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

var_dump($commentaire);
var_dump($images);

include_once './View/post.php';