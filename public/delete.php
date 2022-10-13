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

    $statement =$pdo->prepare('SELECT OwnerUserID FROM boardGamesUpdated WHERE id=:id');
    $statement->bindValue(':id',$id);
    $boardgame = $statement->fetch(PDO::FETCH_ASSOC);

    if($boardgame['ownerUserID'] != $_SESSION['id'] AND $_SESSION['type'] == '1')
    {
        header('Location: index.php');
    }


    $statement = $pdo->prepare('DELETE FROM boardGamesUpdated WHERE id = :id');
    $statement->bindValue(':id',$id);
    $statement->execute();

    header('Location: index.php');