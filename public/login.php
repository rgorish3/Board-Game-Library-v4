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
    $response = checkCredentials($_POST['email'], $_POST['password']);
    
    if($response['status'] == 'success')
    {
        $_SESSION = array('id' => $response['id'],'user' => $response['fullName']);
        header('Location: index.php');
        //$errorMessage = $responsep['id']
    }

    $errorMessage = $response['status'] == 'error' ? $response['message'] : '';
}

?>




<?php include_once "../views/partials/header.php"?>




<div class="container bg-light py-3 mt-3 login-input">

    <?php
        if (!empty($errorMessage)){?>
            <div>
                <span class="text-danger"><strong><?php echo $errorMessage;?></strong></span>
            </div>
        <?php } ?>
        

    <form method="post">
        <div class="form-group my-3 mx-5">
            <input type="text" class="form-control" placeholder="Email Address" name="email">
        </div>
        <div class="form-group my-3 mx-5">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>

    
        <div class="form-group mb-3 mt-3 text-end ">
            <button class="btn btn-primary" type="submit" name="submit" id="button-addon2">Log In</button>
        </div>
    </form>


</div>