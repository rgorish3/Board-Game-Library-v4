<?php


session_start();
if($_SESSION['type'] <> 2)
{
    header('Location: index.php');
}

require_once("../database.php");
require_once("../functions.php");



?>


<?php include_once "../views/partials/header.php"?>
<body>
    <?php include_once("../views/partials/login_bar.php");?>
    <div class="main">
        <p>
            <a href="index.php" class="btn btn-secondary">Go Back to Board Game Library</a>
        </p>
</body>