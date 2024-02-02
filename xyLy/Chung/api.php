<?php
require('./function/function.php');
checkauth();

$message = "";
if($_GET['choose']){
    try{
        switch($_GET['choose']){
            case "listOneUser": getInformation(); break;
            case "listAllUser": if(checkRole()=="admin"){getAllUser();};break;
            case "listAllChallenge": checkauth();getAllChallenge(); break;
            case "": break;
        }
    }catch(Exception $e){
        echo "<script>alert`Something error`</script>";
    }
};

?>