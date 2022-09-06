<?php

session_start();
if(isset($_SESSION['user']))
{
    header('Location: account.php');
}


require_once("../database.php");
require_once("../functions.php");


$errorMessage = '';

if(isset($_POST['submit']))
{
    $response = checkCredentials($_POST('email'), $_POST('password'));
    
    if($response['status'] == 'success')
    {
        $_SESSION = array('id' => $response['id'],'user' => $response[$fullName]);
        header('Location: index.php');
    }

    $errorMessage = $response['status'] == 'error' ? $response['message'] : '';
}

?>




<?php include_once "../views/partials/header.php"?>

