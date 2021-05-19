<?php

// $table = "CREATE TABLE momories (
//     id int(11) AUTO_INCREMENT PRIMARY KEY,
//     creator varchar(255),
//     registerDate DATETIME(255) NOT NULL DEFAULT CURRENT_TIMESTAMP
//     title varchar(255),
//     messagee varchar(255),
//     tags varchar(255),
//     imageUrl varchar(255)
// )";

$table = "CREATE TABLE `momories` ( `id` INT(10) NOT NULL AUTO_INCREMENT , `creator` VARCHAR(255) NOT NULL , `registerDate` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP , `title` VARCHAR(255) NOT NULL , `messagee` VARCHAR(255) NOT NULL , `tags` VARCHAR(255) NOT NULL , `imageUrl` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";

if(mysqli_query($conn, $table) == true) {
    echo "created succesfully";
} else {
    echo "not created profile table" . mysqli_error($conn);
}