<?php


include("dbCon.php");

$updateId = 0;
$updateBtn = false;

$editCreator = '';
$editTitle = '';
$editMessage = '';
$editTags = '';
$editImageUrl = '';

if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $updateBtn = true;

    $select = "SELECT * from momories where id = $id";
    $result =  mysqli_query($conn, $select);
    $results = mysqli_fetch_assoc($result);
    
    $editCreator = $results['creator'];
    $_SESSION['creator'] = $editCreator;
    $editTitle = $results['title'];
    $editMessage = $results['messagee'];
    $editTags = $results['tags'];
    $editImageUrl = $results['imageUrl'];


    // header("Location: memories.php");
}

if(isset($_POST['update'])) {
    $updateId = $_GET['edit'];

    $updateCreator = mysqli_real_escape_string($conn,$_POST['creator']);
    $updateTitle = mysqli_real_escape_string($conn,$_POST['title']);
    $updateMessage = mysqli_real_escape_string($conn, $_POST['message']);
    $updateTags = mysqli_real_escape_string($conn,$_POST['tags']);
    // $updateImageUrl = $_POST['image'];
    // echo $updateImageUrl;

    $update = "UPDATE momories SET creator='$updateCreator', title='$updateTitle', messagee='$updateMessage', tags='$updateTags' WHERE id=$updateId ";
    mysqli_query($conn, $update);

    header("Location: memories.php");
}

if(isset($_POST['clear'])) {
    $editCreator = '';
    $editTitle = '';
    $editMessage = '';
    $editTags = '';
    $editImageUrl = '';
}

?>