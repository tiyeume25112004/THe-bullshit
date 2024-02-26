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
CREATE TABLE Users(
userID varchar(100) primary key not null, 
username varchar(100) not null unique, 
password varchar(100) not null, 
email varchar(100) not null unique, 
fullname varchar(100) not null, 
role varchar(10) not null);
*/

/***
CREATE TABLE Challenges(
challengeID varchar(100) primary key not null, 
name varchar(100) not null unique, 
description varchar(100) not null unique,
link varchar(251) default null,
point int default 100
)
 */

/*** 
 CREATE TABLE user_challenge(
   userID varchar(100),
   challengeID varchar(100),
   score int default 0,
   solved_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (userID) REFERENCES users(userID),
   FOREIGN KEY (challengeID) REFERENCES challenges(challengeID)
);
*/
/***
INSERT INTO user_challenge(userID,challengeID,score) value(
    (SELECT userID FROM users where username='user1'),
    (SELECT challengeID FROM challenges where challengeID='65dc84ef56b3c'),
    1000
); 
*/
?>