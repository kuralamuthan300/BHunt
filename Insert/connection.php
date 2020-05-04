<?php

/*
$servername = "sql311.epizy.com";
$username = "epiz_25621024";
$password = "CCt5XuZLbQG";
$dbname = "epiz_25621024_birthday";
*/



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "birthdayhunt";

/*
DB create SQL

CREATE TABLE `epiz_25621024_birthday`.`response` ( `solved` INT NOT NULL , `hint` LONGTEXT NOT NULL , `ques1` LONGTEXT NOT NULL , `ques2` LONGTEXT NOT NULL , `ques3` LONGTEXT NOT NULL , `ques4` LONGTEXT NOT NULL , `ques5` LONGTEXT NOT NULL , `ques6` LONGTEXT NOT NULL , `ques7` LONGTEXT NOT NULL , `ques8` LONGTEXT NOT NULL , `ques9` LONGTEXT NOT NULL , `ques10` LONGTEXT NOT NULL , `ques11` LONGTEXT NOT NULL , `ques12` LONGTEXT NOT NULL , `ques13` LONGTEXT NOT NULL , `ques14` LONGTEXT NOT NULL , `photo` LONGTEXT NOT NULL , `phone` VARCHAR(10) NOT NULL ) ENGINE = InnoDB;
ALTER TABLE `response` ADD PRIMARY KEY(`phone`);
*/

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>