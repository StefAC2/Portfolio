<?php

$posts = getAllPosts();

function showPosts($posts) {
  $output = '';

  foreach ($posts as $post) {
    $output .= '<figure class="figure jumbotron col-12">';

    foreach ($post['images'] as $image) {
      $output .= '<img src="./media/' . $image['nomMedia'] . '" class="figure-img rounded img-fluid" alt=""/>&nbsp;';
    }

    $output .= '<br>' . $post['commentaire'] . '<br>';
    $output .= '<figcaption class="figure-caption">Date de création: ' . $post['creationDate'] . ' <br>Date de modification: ' . $post['modificationDate'] . '<//figcaption>';

    $output .= '</figure>';
  }

  return $output;
}

include_once './View/accueil.php';
