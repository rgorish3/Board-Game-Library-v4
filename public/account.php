<?php

require_once("../database.php");
require_once("../functions.php");


session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}







?>




<?php include_once "../views/partials/header.php"?>

