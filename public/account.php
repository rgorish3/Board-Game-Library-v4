<?php


session_start();
if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}

require_once("../database.php");
require_once("../functions.php");



/*      PASSWORD        */




if(isset($_POST['submit']))
{

    $response = resetPassword($_POST['oldPassword'],$_POST['newPassword1'],$_POST['newPassword2']);

}




/*      LIBRARIES       */






/*     add          */


if(isset($_POST['submit-new-library']))
{

    $nlibResponse = addLibrary($_POST['new-library']);
    if($nibResponse['status']= 'success')
    {
        $libResponse = changeLibrary($nlibResponse['libraryId']);
        $library = $nlibResponse['libraryId'];
    }
}



/*  build select */

$statement = $pdo->prepare('SELECT * FROM libraries ORDER BY library');
$statement->execute();    
$libraries = $statement->fetchAll(PDO::FETCH_ASSOC);


if(!isset($_POST['submit-library']) && !isset($_POST['submit-new-library'])){
    $statement = $pdo->prepare('SELECT l.id, l.library
    FROM usersInLibraries AS uil 
    INNER JOIN libraries AS l ON (uil.libraryId=l.id)
    WHERE (userID=:id)
    ORDER BY l.library');   
    $statement -> bindValue(':id',$_SESSION['id']);
    $statement->execute();

    $library = $statement->fetch(PDO::FETCH_ASSOC);


    $library = $library['id'];
}


/*     change          */


if(isset($_POST['submit-library']))
{
    if($library != $_POST['libraries_select']){
        $libResponse=changeLibrary($_POST['libraries_select']);
        $library = $_POST['libraries_select'];
    }
    
}

?>




<?php include_once "../views/partials/header.php"?>
<body>
    <?php include_once("../views/partials/login_bar.php");?>
    <div class="main ">




        <a href="index.php" class="btn btn-secondary">Go Back to Board Game Library</a>
        <div class="container-fluid ">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-5 col-md-10 me-10 mb-5 bg-light">
                    <h2 class="text-center">Change Password</h2>
        
                        <?php
                            if (!empty($response)){?>
                                <div>
                                    <span class=<?php
                                        if($response['status'] == 'error'){
                                            echo "text-danger";
                                        } 
                                        else{ 
                                            echo 'text-success';
                                        }?>
                                    ><strong><?php echo $response['message'];?></strong></span>
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
                        <?php
                            if (!empty($libResponse)){?>
                                <div>
                                    <span class=<?php
                                        if($libResponse['status'] == 'error'){
                                            echo "text-danger";
                                        } 
                                        else{ 
                                            echo 'text-success';
                                        }?>
                                    ><strong><?php echo $libResponse['message'];?></strong></span>
                                </div>
                            <?php } ?>

                        <form method="post">
                            <select class="form-select form-group my-3 mx-5" id="library_select" name="libraries_select">
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
                            
                            <div class="form-group mb-5 mt-3 text-end ">
                                <button class="btn btn-primary" type="submit" name="submit-library" id="submit-library">Change Library</button>
                            </div>
                        </form>

                        <form method="post">
                            <div class="form-group my-3 mx-5">
                                <input type="text" class="form-control" placeholder="Add New Library" name="new-library">
                            </div>
                            <div class="form-group mb-3 mt-3 text-end ">
                                <button class="btn btn-primary" type="submit" name="submit-new-library" id="submit-new-library">Add Library</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
