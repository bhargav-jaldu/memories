<?php

include("dbCon.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = "DELETE from momories WHERE id = $id";
    
    $deleted = mysqli_query($conn, $delete);
    if($deleted) {
        echo "Deleted succesfully";
    } else {
        echo "Not deleted";
    }
}

header("Location: memories.php");

?>