<?php

$createProfileTable = "CREATE TABLE createprofile(
    id int(11) AUTO_INCREMENT PRIMARY KEY,
    username varchar(255),
    email varchar(255),
    registerPassword varchar(30),
    cpassword varchar(30)
)";

if(mysqli_query($conn, $createProfileTable) == true) {
        echo "created succesfully";
    } else {
        echo "not created profile table" . mysqli_error($conn);
    }