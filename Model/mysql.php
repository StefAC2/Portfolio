<?php

// Fonction qui se connecte à une base de données distante
function ConnectDB($nom_bd = 'portfolio', $utilisateur = 'root', $mdp = 'root') {
    static $connection = null;

    if ($connection == null) {
        try {
            $adresse = 'localhost'; // le chemin vers le serveur
            $port = '3306'; // le port du serveur
            // des options pour la connexion, on dit qu'elle est en UTF-8 et persistante, ce qui fait que la connexion n'est pas ré-établie à chaque requête SQL
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_PERSISTENT => true);
            $connection = new PDO("mysql:host=$adresse;port=$port;dbname=$nom_bd", $utilisateur, $mdp, $options);
        } catch (Exception $e) {
            $connection = FALSE;
        }
    }
    return $connection;
}

function beginTransaction() {
  ConnectDB()->beginTransaction();
}

function commitTransaction() {
  if (ConnectDB()->inTransaction()) {
    ConnectDB()->commit();
  }
}

function rollback() {
  if (ConnectDB()->inTransaction()) {
    ConnectDB()->rollBack();
  }
}

/**
 * @param $commentaire = commentaire récupéré du form
 */
function addPost($commentaire) {
  $connection = ConnectDB();

  try {
    $requete = $connection->prepare('INSERT INTO Post (commentaire) VALUES (:commentaire);');

    $requete->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

    $requete->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
  }

  return $connection->lastInsertId();
}

/**
 * @param $image = ['typeMedia', 'nomMedia']
 * @param $idPost = id du post lié a ces images
 */
function addImage($image, $idPost) {
  $connection = ConnectDB();

  try {
    $requete = $connection->prepare('INSERT INTO Media (typeMedia, nomMedia, idPost) VALUES (:typeMedia, :nomMedia, :idPost);');

    $requete->bindParam(':typeMedia', $image[0], PDO::PARAM_STR);
    $requete->bindParam(':nomMedia', $image[1], PDO::PARAM_STR);
    $requete->bindParam(':idPost', $idPost, PDO::PARAM_INT);

    $requete->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }

  return true;
}

/**
 * return the post data and the images associated with it
 */
function getAllPosts() {
  $connection = ConnectDB();

  $posts = [];

  try
  {
    $postQuery = $connection->prepare('SELECT * FROM Post ORDER BY modificationDate DESC;');
    $postQuery->execute();

    while ($post = $postQuery->fetch(PDO::FETCH_NAMED))
    {
      $imageQuery = $connection->prepare('SELECT nomMedia, creationDate, modificationDate FROM Media WHERE idPost = :id;');
      $imageQuery->bindParam(':id', $post['idPost'], PDO::PARAM_INT);
      $imageQuery->execute();

      $images = $imageQuery->fetchAll(PDO::FETCH_NAMED);

      $post['images'] = $images;

      $posts[] = $post;
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  return $posts;
}
