<?php

require_once("../database.php");
require_once("../functions.php");


session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}



$statement = $pdo->prepare('SELECT * FROM libraries ORDER BY library');
$statement->execute();    
$libraries = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare('SELECT l.id, l.library
    FROM usersInLibraries AS uil 
    INNER JOIN libraries AS l ON (uil.libraryId=l.id)
    WHERE (userID=:id)
    ORDER BY l.library');
$statement -> bindValue(':id',$_SESSION['id']);
$statement->execute();
$library = $statement->fetch(PDO::FETCH_ASSOC);

$library = $library['id']

?>




<?php include_once "../views/partials/header.php"?>
<body>
    <?php include_once("../views/partials/login_bar.php");?>
    <div class="main ">
        <p>
            <a href="index.php" class="btn btn-secondary">Go Back to Board Game Library</a>
            <div class="container-fluid ">
                <div class="row justify-content-center mt-5">

                    <div class="col-lg-5 col-md-10 me-10 mb-5 bg-light">
                        <h2 class="text-center">Change Password</h2>
            
                            <?php
                                if (!empty($errorMessage)){?>
                                    <div>
                                        <span class="text-danger"><strong><?php echo $errorMessage;?></strong></span>
                                    </div>
                                <?php } ?>
            

                            <form method="post">
                               <div class="form-group my-3 mx-5">
                                    <input type="password" class="form-control" placeholder="Old Password" name="oldPassword">
                                </div>
                                <div class="form-group my-3 mx-5">
                                    <input type="password" class="form-control" placeholder="New Password" name="newPassword1">
                                </div>
                                <div class="form-group my-3 mx-5">
                                    <input type="password" class="form-control" placeholder="Retype New Password" name="newPassword2">
                                </div>
                                <div class="form-group mb-3 mt-3 text-end ">
                                    <button class="btn btn-primary" type="submit" name="submit" id="button-addon2">Change Password</button>
                                </div>
                            </form>
                            
                        
                    </div>
                    
                    <div class="col-lg-1"></div>

                    <div class="col-lg-5 col-md-10 mb-5 bg-light">
                        <h2 class="text-center">Library</h2>
                    
                        <div class= "col-md-4 col-sm-4">
                            <label for="library_select">Library</label>
                            <select class="form-select" id="library_select" name="owners_select">

                                <?php 
                                    foreach($libraries as $i => $indivLib):

                                        $str= "<option value=".$indivLib["id"];
                                        if($indivLib["id"]==$library){
                                            $str.= " selected=selected ";
                                        }
                                        $str.=">".$indivLib["library"]."</option>";
                                        
                                        echo $str;

                                    endforeach
                                ?>

                                
                        </select>
                    </div>





                        </div>
                    </div>


                </div>
            </div>
        
        </p>
        




    </div>
</body>
