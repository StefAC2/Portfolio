<?php

$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

var_dump($commentaire);

print_r($_FILES);



include_once './View/post.php';