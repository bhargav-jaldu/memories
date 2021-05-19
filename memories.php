<?php

ob_flush();

session_start();

include("dbCon.php");
include("editMemory.php");
include_once("memoriesTable.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="memories.css?v=<?php echo time(); ?>">
    <title>Memories</title>
</head>

<style>
.update {
    width: 100%;
    background-color: green;
    color: #eee;
}

.edit-name {
    font-size: 20px;
    color: red;
}
</style>

<body>

    <div class="title-c">
        <div class="title-flex">
            <h1 class="title">MEMORIES</h1>
            <img src="memoriesImage.jpg" alt="">
        </div>

    </div>

    <a class="logout" href="index.php">Logout</a>

    <div class="page-nation">

        <?php 
$fetch = "SELECT * from momories ORDER by id DESC";
// results per page;
$results_per_page = 4;
$resu = mysqli_query($conn, $fetch);
// no of results
$number_of_results = mysqli_num_rows($resu);
// no of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// which page number visitor is currently on
if(!isset($_GET['page'])) {
    // pass this to the url
    $pages = 1;
} else {
    $pages = $_GET['page'];
}

// Determine the sql limit;
$this_page_first_result = ($pages - 1) * $results_per_page;
$sql = "SELECT * FROM momories LIMIT $this_page_first_result, $results_per_page";
$result = mysqli_query($conn, $sql);


// Display links to the page
for($page = 1;$page<=$number_of_pages;$page++) {?>

        <a href="memories.php?page=<?php echo $page ?>" class="pages"><?php echo $page ?></a>

        <?php }
    ?>
    </div>

    <div class="container">

        <div class="posts-c">

            <?php 



if(mysqli_num_rows($resu) > 0) {
    while($row = mysqli_fetch_assoc($result)) { 
    include("posts.php");
 }
 }
?>


            <?php



if(isset($_POST['create'])) {
$creator = mysqli_real_escape_string($conn, $_POST['creator']);
$title = mysqli_real_escape_string( $conn,$_POST['title']);
$message = mysqli_real_escape_string($conn,$_POST['message']);
$tags = mysqli_real_escape_string($conn,$_POST['tags']);

$image = $_FILES['image'];
// echo "<pre>";
// echo print_r($image);
// echo "</pre>";

$imageName = $_FILES['image']['name'];
$imageTemName = $_FILES['image']['tmp_name'];
$imageSize = $_FILES['image']['size'];
$imageError = $_FILES['image']['error'];
$imageType = $_FILES['image']['type'];

$imageExt = explode(".", $imageName);
$imageNewExt = strtolower(end($imageExt));

$allowed = array('jpg', 'jpeg', 'png');
if(in_array($imageNewExt,$allowed)) {
    if($imageError === 0) {
        if($imageSize < 1000000) {
            // change name of the file before uploading it to the root folder;
            $imageNewName = uniqid('', true) . '.'. $imageNewExt;
            $imageDestination = 'uploads/'.$imageNewName;
            move_uploaded_file($imageTemName, $imageDestination);
            $insertingMemories = "INSERT INTO momories (creator,title,messagee,tags,imageUrl) VALUES ('$creator', '$title', '$message', '$tags', '$imageNewName')";
            mysqli_query($conn, $insertingMemories);
            $fetch = "SELECT * from momories ORDER by id DESC limit 1";
            $resu = mysqli_query($conn, $fetch);
            if(mysqli_num_rows($resu) > 0) {
                while($row = mysqli_fetch_assoc($resu)) { ?>
            <!-- Posts -->
            <?php include("posts.php") ?>
            <?php }
             }
        } else {
            echo "<script>alert('The image is too large')</script>";
        }
    } else {
        echo "<script>alert('something went wrong')</script>";
    }
} else {
    echo "<script>alert('This image format is not allowed')</script>";
}
}
    ?>

        </div>
        <!-- Form -->
        <div class="memo-form-c">
            <form action="" class="memories-form" method="POST" enctype="multipart/form-data">
                <?php
            if($updateBtn == true) {
                echo "<h4>Editing <span class='edit-name'>$_SESSION[creator]</span></h4>";
            } else {
                echo "<h4>Create a memory</h4>";
            }
            ?>
                <input type="hidden" name="updateId" value="<?php echo '$updateId' ?>">
                <div class="form-control">
                    <p>Creator</p>
                    <input type="text" name="creator" id="creator" value="<?php echo $editCreator ?>" required>
                </div>
                <div class="form-control">
                    <label for="">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo $editTitle ?>" required>
                </div>
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5"
                        required><?php echo $editMessage ?></textarea>
                </div>
                <div class="form-control">
                    <label for="tags">Tags(comma sperated)</label>
                    <input type="text" name="tags" id="tags" value="<?php echo $editTags ?>" required>
                </div>
                <div class="form-control">
                    <input type="file" name="image" class="image">
                </div>
                <div class=" form-control">
                    <?php 
                    if($updateBtn == true) {
                        echo "<script>
                                const imageEl = document.querySelector('.image');
                                imageEl.classList.add('hidden');
                        </script>";
                        echo "<button type='submit' name='update' class='update'>Update</button>";
                    } else {
                        echo "<button type='submit' name='create' class='create'>Submit</button>";
                    }
                ?>
                </div>
                <div class="form-control">
                    <button name="clear" class="clear">Clear</button>
                </div>
            </form>
        </div>


    </div>



    <script>
    const container = document.querySelector('.container')
    const posts = container.querySelector('.posts-c');
    const likeBtn = posts.querySelectorAll('.fa-heart')

    likeBtn.forEach(btn => {

        btn.addEventListener('click', (e) => {
            e.target.classList.toggle('active')
        })
    })
    </script>
</body>

</html>