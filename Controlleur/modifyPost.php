<?php

$id = filter_input(INPUT_GET, 'idPost', FILTER_SANITIZE_NUMBER_INT);

require_once '../Model/mysql.php';

$post = getPost($id);

require_once '../View/modifyPost.php';
