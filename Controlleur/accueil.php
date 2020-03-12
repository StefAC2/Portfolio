<?php

$posts = getAllPosts();

function showPosts($posts) {
  $output = '';

  foreach ($posts as $post) {
    $output .= '<figure class="figure jumbotron col-12">';

    foreach ($post['medias'] as $media) {
      $type = explode('/', $media['typeMedia'])[0];
      if ($type == 'image') {
        $output .= '<img src="./media/' . $media['nomMedia'] . '" class="figure-img rounded img-fluid" alt=""/>&nbsp;';
      } else {
        $output .= '<' . $type . ' class="img-fluid col-12" controls';
        $output .= $type == 'video' ? ' autoplay loop' : '';
        $output .= '><source src="./media/' . $media['nomMedia'] . '" type="' . $media['typeMedia'] . '"/></' . $type . '>';
      }
    }

    $output .= '<br>' . $post['commentaire'] . '<br>';
    $output .= '<figcaption class="figure-caption">Date de création: ' . $post['creationDate'] . ' <br>Date de modification: ' . $post['modificationDate'] . '<//figcaption>';
    $output .= '<a href="Controlleur/deletePost.php?idPost=' . $post['idPost'] . '"><button class="btn btn-danger">Supprimer</button></a>';
    $output .= '</figure>';
  }

  return $output;
}

include_once './View/accueil.php';
