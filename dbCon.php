<?php

// $serverName = "sql109.epizy.com";
// $username = "epiz_28475640";
// $password = "Qe0RBwpevW";
// $databaseName = "epiz_28475640_memories";

$serverName = "localhost";
$username = "root";
$password = "";
$databaseName = "create_profile";

$conn = mysqli_connect($serverName,$username,$password,$databaseName);

if(!$conn) {
    die("Data base is not connected: ".mysqli_connect_error());
}

?>