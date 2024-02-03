<?php
require('./function/function.php');
checkauth();

$message = "";
if($_GET['choose']){
    try{
        switch($_GET['choose']){
            //chung
            case "listOneUser": checkauth();getInformation(); break;
            case "listAllChallenge": checkauth();getAllChallenge(); break;
            // case "listOneChallenge": checkauth();getOneChallenge(); break;
            case "updateOneUser": checkauth();updateInfomation();break;
            case "getRanking": break; // GET - radar chart - http://www.pchart.net/download
            case "UpdateScore": break;

            //admin
            case "listAllUser": if(checkRole()=="admin"){getAllUser();};break;
            case "deleteOneUser": if(checkRole()=="admin"){deleteInformation();};break;
            case "createChallenge": if(checkRole()=="admin"){createChallange();};break;
            case "updateChallenge": if(checkRole()=="admin"){updateChallenge($_GET['ma']);};break;
            case "deleteChallenge": if(checkRole()=="admin"){deleteChallenge($_GET['ma']);};break;
        }
    }catch(Exception $e){
        echo "<script>alert`Something error`</script>";
    }
};

?>