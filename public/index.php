<?php

session_start();
require_once('../search.php');



?>


<?php include_once("../views/partials/header.php");?>

<body>
    <?php include_once("../views/partials/login_bar.php");?>


    <div class="main">
        <h1>Board Game Library</h1> 


        <!--ADD BUTTON. LINKS TO ADD GAME PAGE-->

        <?php
        if(isset($_SESSION['user']))
        { ?>
            <p>
                <a href="create.php" class="btn btn-success">Add Game</a>
            </p>
        <?php } ?>


        <!--RESET BUTTON-->

        <p>
            <a href="index.php" class="btn btn-secondary">Reset</a>
        </p>


        <!-- ADD Search Form. -->

        <?php include_once('../views/partials/search_form.php'); ?>
        

        <!--DISPLAY TABLE FOR DISPLAYING THE BOARD GAMES-->


        <?php 
            //echo var_export($_SESSION); 
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Base/Expansion</th>
                    <th scope="col">Min Players</th>
                    <th scope="col">Max Players</th>
                    <th scope="col">Min Time</th>
                    <th scope="col">Max Time</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($boardgames as $i => $boardgame) : ?>
                    <tr>
                        <th scope="row"><?php echo $i+1; ?></th>

                        <td>  
                            <img src="<?php echo $boardgame['imageURL']; ?>" class="thumb-image">
                        </td>

                        <td><?php echo $boardgame['name']; ?></td>
                        <td><?php echo $boardgame['baseOrExpansion']; ?></td>
                        <td><?php echo $boardgame['minimumPlayers']; ?></td>
                        <td><?php echo $boardgame['maximumPlayers']; ?></td>
                        <td><?php echo $boardgame['minimumTime']; ?></td>
                        <td><?php echo $boardgame['maximumTime']; ?></td>
                        <td><?php echo $boardgame['fullName']; ?></td>
                    

                        <!--DEFINE THE ACTION BUTTONS-->
                        
                        <td>
                            
                            <a href="view.php?id=<?php echo $boardgame['id'] ?>" type="button" class="btn btn-sm btn-info mb-2">View</a>
                           
                            <?php if(isset($_SESSION['user'])){
                                    if(($_SESSION['user'] === $boardgame['fullName']) or ($_SESSION['type'] == 2 ))

                                    {
                                    
                                    
                                    ?>
                                
                                    <a href="update.php?id=<?php echo $boardgame['id'] ?>" type="button" class="btn btn-sm btn-warning mb-2">Edit</a>
                                    
                                     <!--Deletions should done through Post, not Get, so  using a 
                                         form instead of an anchor tag to pass hidden information
                                         to be used in a post request-->
                                    
                                    
                                     <?php $nameWithoutQuotes = str_replace(array('"',"'"), "",$boardgame['name']);      //removing quotes and single quotes so as to not close quotes in
                                                                                                                         //  confirm_delete in delete button below.
                                    
                                     ?>            

                                     <form style="display: inline-block" method="post" action="delete.php">
                                         <input type="hidden" name="id" value="<?php echo $boardgame['id'] ?>">
                                         <button type="submit" class="btn btn-sm btn-danger mb-2" onclick="return confirm_delete('<?php echo $nameWithoutQuotes ?>')">Delete</button>
                                     </form>
                            <?php   }
                            } ?>
                        </td>
                        
                    </tr>


                <?php endforeach;?>    


            </tbody>

    


    </div>


</body>
</html>