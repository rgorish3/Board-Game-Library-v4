<?php

    session_start();
    if(!isset($_SESSION['user']))
    { 
        header('Location: index.php');
    }   


    require_once("../database.php");


    $id = $_POST['id'] ?? null;

    if(!$id){
        header('Location: index.php');
        exit;
    }

    $statement = $pdo->prepare('DELETE FROM boardGames WHERE id = :id');
    $statement->bindValue(':id',$id);
    $statement->execute();

    header('Location: index.php');