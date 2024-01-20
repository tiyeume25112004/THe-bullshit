<?php
@session_start();
require("sql.php");
$message = "Only user be there";
//=====================Authenticate function===========================//
function checkauth(){ //done
    /**
     * cach file can authenticate se su dung ham nay
    */
    if(empty($_SESSION['role'])){
        header("Location:/login.php");
        exit();
    }
    return true;
}
function checkRole(){ //done
    if($_SESSION['role'] == "admin"){
        return "admin";
    } 
    if($_SESSION['role'] === "guest"){
        return "guest";
    }
}
function register($username,$password){ // done
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
function login($username,$password){ // done
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
function getAllChallenge(){ // done
    try{
        global $conn;
        $query = $conn->prepare("SELECT * FROM challenges");
        $query->execute();
        $rows = $query->get_result();
        while($result = $rows->fetch_assoc()){
            echo "
            <div class='container-fluid'>
                <div class='row justify-content-center'>
                    <div class='col-12 col-md-8 col-lg-6 col-xl-4'>
                        <div class='card bg-purple shadow p-4 m-4 max-h-screen overflow-y-auto'>
                        <button class='close' onclick='this.parentElement.style.display='none''>×</button>
                        <div class='card-body text-white'>
                            <div class='flex flex-row justify-between items-center mb-4'>
                                <h1 class='card-title text-xl font-bold'>$result[name]</h1>
                                <span class='card-subtitle text-sm font-light'>$result[point] Points</span>
                            </div>
                            <p class='card-text text-lg font-light'>$result[description]. You will need this and this: konctf{uwsp_ _ _}</p>
                            <span><a href='$result[link]'>Link</a></span>
                            <div class='flex flex-col mt-4'>
                                <button class='btn btn-purple mt-4'>Show 104 others</button>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
            ";
        }
    }catch(Exception $e){
        echo "Not any challenges is available!!";
    }
}
function getInformation($ma){ // done
    try{
        global $conn;
        $query = $conn->prepare("SELECT * FROM users WHERE ma = ?");
        $query->bind_param("s",$ma);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        echo "
          <tr>
            <th scope='row'>$result[ma]</th>
            <td>$result[fullname]</td>
            <td>$result[email]</td>
            <td>$result[role]</td>
          </tr>
        ";
    }catch(Exception $e){
        echo "Infomation not validate";
    }
}
function updateInfomation(){

}
function deleteInformation(){
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
function createChallange(){ //done
    /**
     * Nhan link tu uploadFile()
     * Chen thong tin vo database
    */
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
    }catch(Exception $e){
        echo "Can't create challenge!!";
    }
}
function updateChallenge(){

}
function deleteChallenge(){
}
//======================CTF-Playyer================================//
function addSolution(){

}
?>
