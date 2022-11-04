<?php


session_start();
if($_SESSION['type'] <> 2)
{
    header('Location: index.php');
}

require_once("../database.php");
require_once("../functions.php");

$hashedPassword = $_POST["hash_password"] ?? "";

?>


<?php include_once "../views/partials/header.php"?>
<body>
    <?php include_once("../views/partials/login_bar.php");?>
    <div class="main">
        <p>
            <a href="index.php" class="btn btn-secondary">Go Back to Board Game Library</a>
        </p>
        
        <DL>
            <DT>Add User</DT>
            <DT>Reset User's Password</DT>
                <DD>-At First this can just be a pw to hash so the database can be updated</DD>
            <DT>Manage libraries</DT>
        </DL>

        
        <div class="container-fluid"> 

            <div class="row justify-content-center mt-5">
                <div class="col-lg-5 col-md-10 me-10 mb-5 bg-light">
                    <h2 class="text-center">Reset User's Password</h2>
                    <form method="post">
                        <div class="form-group my-3 mx-5">
                            <input type="text" class="form-control" Placeholder=password name="hash_password" value ="<?php echo $hashedPassword;?>">
                        </div>
                        <div class="form-group mb-3 mt-3 text-end">
                            <button class="btn btn-primary" type="submit" name="hash_submit" id="button-addon">Hash Password</button>
                        </div>
                    </form>

                    <?php
                        if(!empty($hashedPassword)){?>
                            <STRONG><?php echo password_hash($hashedPassword,PASSWORD_DEFAULT)?></STRONG>
                        <?php }
                    ?>
                </div>
            </div>
        </div>

</body>