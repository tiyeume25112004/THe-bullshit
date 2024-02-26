<!DOCTYPE html>
<?php require('./function/function.php');?>
<html>
    <head></head>
    <body>
        <div class="p">
            <a href="#">Home page</a>
        </div>
        <div class="p">
            <a href="login.php">Login page</a>
        </div>
        <div class="p">
            <a href="/logout.php">Logout page</a>
        </div>
        <div class="p">
            <a href="/info.php">info user</a>
        </div>
        <div class="p">
            <a href="/upload.php">upload</a>
        </div>
        <div class="p">
            <a href="/challenges.php">Challenge page</a>
        </div>
        <?php
        if(checkRole()=="admin"){
            echo '<div class="p">
                    <a href="/quanly.php">Quan ly</a>
                </div>';
        }?>
    </body>
</html>