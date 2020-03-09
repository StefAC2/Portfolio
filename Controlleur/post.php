<?php

$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

$isGoodType = true;
$isTooBig = false;

$invalidImages = [];

foreach ($_FILES['images']['error'] as $key => $value) {
  if ($value != 0) {
    $invalidImages[] = $key;
    $isTooBig = true;
  }
}

$count = count($_FILES['images']['name']);

beginTransaction();
if (!empty($commentaire) && !empty($_FILES) && $count != count($invalidImages)) {
  $idPost = addPost($commentaire);

  for ($i = 0; $i < $count; $i++) {
    if (in_array($i, $invalidImages)) {
      continue;
    }

    $tmpName = $_FILES['images']['tmp_name'][$i];
    $name = md5($tmpName . (new DateTime())->getTimestamp());

    $fullType = mime_content_type($tmpName);
    $type = explode('/', $fullType);

    if ($type[0] == 'image') {
      $extension = '.' . $type[1];
      $destination = 'img/' . $name . $extension;
      move_uploaded_file($tmpName, './media/' . $destination);
      addImage([$fullType, $destination], $idPost);
    } else {
      $isGoodType = false;
    }
  }
  
  if ($isGoodType && !$isTooBig) {
    commitTransaction();
    //header('Location: ?');
  } else {
    rollBack();
  }
}

require_once './View/post.php';
