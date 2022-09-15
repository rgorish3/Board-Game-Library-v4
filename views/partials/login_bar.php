 


<nav class="navbar navbar-expand-lg">
<div class="container-fluid">
    <div class="nav-item margin-end"></div>
        <span class="navbar-text">

            <?php if(isset($_SESSION['user'])){ ?>

                <h4 class="text-end">Hello <?php echo $_SESSION['user'];?>!</h4>
                <a href="account.php" class='btn btn-primary'>Account Settings</a>
                <a href="logout.php" class='btn btn-primary'>Log Out</a>
            <?php }
            else{ ?>
                <a href="login.php" class='btn btn-primary'>Log In</a>
            <?php } ?>
            
        </span>
    </div>  
</div>
</nav>