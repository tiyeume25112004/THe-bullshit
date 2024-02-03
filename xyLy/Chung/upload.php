<?php 
@error_reporting(1);
require("./function/function.php");
if(!checkauth()){
    die("Only admin");
}
if(checkRole()!=="admin"){
    die("Only admin, the suck user");
}
?>

<!DOCTYPE html>
<html>
    <head><title>Upload</title></head>
    <body>
        <?= createChallange(); ?>
        <form method="post" enctype="multipart/form-data" id="usrform">
            <div>
                <input type="file" name="file">
            </div>
            <div>
                <input type="text" name="name" placeholder="name">
            </div>
            <div>
                <textarea rows="4" cols="50" name="description" form="usrform" placeholder="Description"></textarea>
            </div>
            <div>
                <input type="text" name="point" placeholder="point">
            </div>
            <button name="sub">Enter</button>
        </form>
    </body>
</html>