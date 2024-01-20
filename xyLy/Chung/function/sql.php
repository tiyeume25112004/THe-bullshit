<?php
$servername_db = "localhost";
$username_db = "root";
$password_db = "root";
$dbname = "ctf";

$conn =  new mysqli($servername_db,$username_db,$password_db,$dbname);

if($conn->connect_error){
    echo "Error!!";
    exit();
}
/*** 
 * CREATE TABLE Users(
 * ma varchar(100) primary key not null, 
 * username varchar(100) not null unique, 
 * password varchar(100) not null, 
 * email varchar(100) not null unique, 
 * fullname varchar(100) not null, 
 * role varchar(10) not null)
*/

/**
 * CREATE TABLE Challenges(
 * ma varchar(100) primary key not null, 
 * name varchar(100) not null unique, 
 * description varchar(100) not null unique,
 * link varchar(251) not null,
 * point int not null)
 */
?>