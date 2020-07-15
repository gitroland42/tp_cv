<?php
    session_start();
    require_once("utilitaires/header.php");
    require_once("utilitaires/connexionBDD.php");
    require_once("utilitaires/fonctions.php");

 
    $query = $pdo->prepare('DELETE FROM competence WHERE id = :id');
    $query->execute(['id'=> $_GET['id']]);
    header('Location: competences.php');

?>