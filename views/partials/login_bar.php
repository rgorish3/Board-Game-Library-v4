 


<nav class="navbar navbar-expand-lg">
<div class="container-fluid">
    <div class="nav-item margin-end"></div>
        <span class="navbar-text">

            <?php if(isset($_SESSION['user'])){ 
                if($_SESSION['type']<>2){?>
                    <span class="pe-3"><strong>Hello <?php echo $_SESSION['user'];?>!</strong></span>
                    <a href="account.php" class='btn btn-primary'>Account Settings</a>
                    <a href="logout.php" class='btn btn-primary'>Log Out</a>
                <?php } 
                else{ ?>
                    <span class="pe-3"><strong>Hello <?php echo $_SESSION['user'];?>!</strong></span>
                    <a href="management.php" class='btn btn-primary'>Site Management</a>
                    <a href="account.php" class='btn btn-primary'>Account Settings</a>
                    <a href="logout.php" class='btn btn-primary'>Log Out</a>
                <?php }
             }
            else{ ?>
                <a href="login.php" class='btn btn-primary'>Log In</a>
            <?php } ?>
            
        </span>
    </div>  
</div>
</nav>