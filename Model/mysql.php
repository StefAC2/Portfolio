<?php

$connexion = null;

// Fonction qui se connecte à une base de données distante
function connectToDatabase($nom_bd, $utilisateur, $mdp) {
    global $connexion;

    if ($connexion == null) {
        try {
            $adresse = 'localhost'; // le chemin vers le serveur
            $port = '3306'; // le port du serveur
            // des options pour la connexion, on dit qu'elle est en UTF-8 et persistante, ce qui fait que la connexion n'est pas ré-établie à chaque requête SQL
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_PERSISTENT => true);
            $connexion = new PDO("mysql:host=$adresse;port=$port;dbname=$nom_bd", $utilisateur, $mdp, $options);
        } catch (Exception $e) {
            $connexion = FALSE;
        }
    }
    return $connexion;
}