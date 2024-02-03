<?php
@session_start();
require("sql.php");
$message = "Only user be there";
//=====================Authenticate function===========================//
function checkauth(){ //done api
    /**
     * cach file can authenticate se su dung ham nay
    */
    if(empty($_SESSION['role'])){
        header("Location:/login.php");
        exit();
    }
    return true;
}
function checkRole(){ //done api
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == "admin"){
            return "admin";
        } 
        if($_SESSION['role'] === "guest"){
            return "guest";
        }
    }
}
function register($username,$password){ // done api
    /**
     * Only add role student.
    */
    $username = trim($username);
    $password = trim($password);
    $ma = genMa();
    $sql = "INSERT INTO users(ma,username,password,email,fullname,role) VALUES (?,?,?,'tricker@gmail.com','tobirama','admin')";
    
    try{
        global $conn;
        $query = $conn->prepare($sql);
        $query->bind_param("sss",$ma,$username,$password);
        $query->execute();
    }catch(Exception $e){
        echo "Error!";
    }
    header("Location:/login.php");
    exit();
}
function login($username,$password){ // done api
    /**
     * login success -> add session role and redirect role by role
    */
    $username = trim($username);
    $password = trim($password);
    global $conn;
    $sql = "SELECT * FROM users WHERE username = ? and password = ?";
    try{
        $query = $conn->prepare($sql);
        $query->bind_param("ss",$username,$password);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows>0){
            $rows = $result->fetch_assoc();
            $_SESSION['ma'] = $rows["ma"];
            $_SESSION['name'] = $rows["username"];
            $_SESSION['role'] = $rows["role"];
            echo '<script>alert("Login thành công")</script>';
            header("Location:/");
            exit();
        }else{
            echo "<script>alert('Incorrect username or password')</script>";
        }
    }catch(Exception $e){
        $message = "Connect error!!";
    }
    
}
//====================CHUNG=======================================//
function getAllChallenge(){ // done api
    try{
        header("Content-type:application/json;charset:utf-8");
        $arrayChallenges = array();
        global $conn;
        $query = $conn->prepare("SELECT * FROM challenges");
        $query->execute();
        $rows = $query->get_result();
        while($result = $rows->fetch_assoc()){
            array_push($arrayChallenges,(object)$result);
        }
        echo json_encode(["challenges"=>$arrayChallenges]);
    }catch(Exception $e){
        echo "Not any challenges is available!!";
    }
}
function getOneChallenge($ma){ //done api
    try{
        $arrayChallenges = array();
        global $conn;
        $query = $conn->prepare("SELECT * FROM challenges where ma = ?");
        $query->bind_param("s",$ma);
        $query->execute();
        $rows = $query->get_result();
        while($result = $rows->fetch_assoc()){
            array_push($arrayChallenges,(object)$result);
        }
        echo json_encode(["challenges"=>$arrayChallenges]);
    }catch(Exception $e){
        echo "Not any challenges is available!!";
    }
}
function getInformation(){ // done api
    try{
        header("Content-type:application/json;charset:utf-8");
        $arrayUser = array();
        global $conn;
        $query = $conn->prepare("SELECT * FROM users WHERE ma = ?");
        $query->bind_param("s",$_SESSION['ma']);
        $query->execute();
        $result = $query->get_result();
        while($row = $result->fetch_assoc()){
            array_push($arrayUser,(object)$row);
        }
        echo json_encode(['user'=>(object)$arrayUser]);
    }catch(Exception $e){
        echo "Infomation not validate";
    }
}
function updateInfomation(){ //done api
    try{
        global $conn;
        $_fullname = $_POST['fullname'];
        $_email = $_POST['email'];
        $_password = $_POST['password'];
        $_ma = $_SESSION['ma'];
        $sql = "UPDATE users SET fullname = ?,email =?,password =? WHERE ma =?";
        $query = $conn->prepare($sql);
        $query->bind_param("ssss",$_fullname,$_email,$_password,$_ma);
        $query->execute();
        echo json_encode(["status"=>"ok"]);
    }catch(Exception $e){
        echo json_encode(["status"=>"Something error!!"]);
    }
}
function deleteInformation(){ // done api
    try{
        global $conn;
        $_ma = $_SESSION['ma'];
        $sql = "Delete from users where ma = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("ssss",$_ma);
        $query->execute();
        echo json_encode(["status"=>"ok"]);
    }catch(Exception $e){
        echo json_encode(["status"=>"Something error!!"]);
    }
}
function updateScore(){ 
}
function genMa(){ //done
    return uniqid();
}
function uploadFile(){ //done
    $dir_uploaded = "";
    if(isset($_FILES['file'])){
        $filename = $_FILES['file']['name'];
        $role = $_SESSION['role'];
        $dir_uploaded = "/uploads/$role/". genMa() . $filename;
        move_uploaded_file($_FILES['file']['tmp_name'],__DIR__ . $dir_uploaded);
    }
    return $dir_uploaded;
}
function getRanking(){
}
//=====================CTF-Admin==============================//
function createChallange(){ //done api
    /**
     * Nhan link tu uploadFile()
     * Chen thong tin vo database
    */
    if(isset($_POST['sub'])){
        try{
            $link = uploadFile();
            echo $link;
            $name = $_POST['name'];
            $description = $_POST['description'];
            $point = $_POST['point'];
            $ma = genMa();
            global $conn;
            $query = $conn->prepare("INSERT INTO challenges(ma,name,description,link,point) values (?,?,?,?,?)");
            $query->bind_param("ssssi",$ma,$name,$description,$link,$point);
            $query->execute();
            echo json_encode(["challenge"=>"okay"]);
        }catch(Exception $e){
            echo json_encode(["status"=>"Can't create challenge!!"]);
        }
    }
}
function updateChallenge($ma){ //done api
    try{
        if($_POST['link_fixed']){
            $link = uploadFile();
        }else{
            $link = "www";
        }
        $name = $_POST['name'];
        $description = $_POST['description'];
        $point = $_POST['point'];
        global $conn;
        $query = $conn->prepare("UPDATE challenges SET name=?,description=?,link=?,point=? WHERE ma=?");
        $query->bind_param("sssis",$name,$description,$link,$point,$ma);
        $query->execute();
        echo json_encode(["status"=>"ok"]);
    }catch(Exception $e){
        echo json_encode(["status"=>"Can't update challenge!!"]);
    }
}
function deleteChallenge($ma){
    try{
        global $conn;
        $query = $conn->prepare("DELETE FROM challenges WHERE ma=?");
        $query->bind_param("s",$ma);
        $query->execute();
        echo json_encode(["status"=>"ok"]);
    }catch(Exception $e){
        echo json_encode(["status"=>"Can't update challenge!!"]);
    }
}
function getAllUser(){ //done api
    $arratUser = array();
    header("Content-type: application/json; charset=utf-8");
    global $conn;
    $limit = $_GET['limit'];
    $sql = "SELECT * from users order by ma limit ?";
    $query = $conn->prepare($sql);
    $query->bind_param("s",$limit);
    $query->execute();
    $result = $query->get_result();
    while($row =$result->fetch_assoc()){
        array_push($arratUser,$row);
    };
    echo json_encode(["users"=>$arratUser]);
}
//======================CTF-Playyer================================//
function addSolution(){

}
?>
