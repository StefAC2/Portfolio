<?php

$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

if (!empty($_FILES)) {
    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
        $tmpName = $_FILES['images']['tmp_name'][$i];
        $name = substr($tmpName, 5) . (new DateTime())->getTimestamp();
        $extension = '.' . substr($_FILES['images']['type'][$i], 6);
        $destination = './media/img/' . $name . $extension;
        move_uploaded_file($tmpName, $destination);
    }
    header('Location: ?');
}

require_once './View/post.php';