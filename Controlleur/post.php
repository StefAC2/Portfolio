<?php

$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

$isGoodType = true;
$isTooBig = false;

$invalidMedias = [];

foreach ($_FILES['medias']['error'] as $key => $value) {
  if ($value != 0) {
    $invalidMedias[] = $key;
    $isTooBig = true;
  }
}

$count = count($_FILES['medias']['name']);

beginTransaction();
if (!empty($commentaire) && !empty($_FILES) && $count != count($invalidMedias)) {
  $idPost = addPost($commentaire);

  for ($i = 0; $i < $count; $i++) {
    if (in_array($i, $invalidMedias)) {
      continue;
    }

    $tmpName = $_FILES['medias']['tmp_name'][$i];
    $name = md5($tmpName . (new DateTime())->getTimestamp());

    $fullType = mime_content_type($tmpName);
    $type = explode('/', $fullType);

    $types = ['img' => 'image', 'vid' => 'video', 'aud' => 'audio'];

    if (in_array($type[0], $types)) {
      $extension = '.' . $type[1];

      $folder = array_search($type[0], $types);

      $destination = $folder . '/' . $name . $extension;
      move_uploaded_file($tmpName, './media/' . $destination);
      addMedia([$fullType, $destination], $idPost);
    } else {
      $isGoodType = false;
    }
  }

  if ($isGoodType && !$isTooBig) {
    commitTransaction();
    header('Location: ?');
  } else {
    rollBack();
  }
}

require_once './View/post.php';
