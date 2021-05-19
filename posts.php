<div class="posts">
    <div class="image-overlay">
        <img src="uploads/<?php echo "$row[imageUrl]" ?>" alt="">
    </div>
    <div class="post">
        <div>
            <h3><?php echo "$row[creator]" ?></h3>
            <p class="time"><?php echo "$row[registerDate]" ?></p>
        </div>
        <div>
            <button class="editBtn"><a href="memories.php?page=<?php echo $pages ?>&edit=<?php echo $row['id'] ?>"><i
                        class="fas fa-ellipsis-h"></i></a></button>
        </div>
    </div>
    <div class="details">
        <h4 class="tags"><?php $array = explode(",", $row['tags']); 
                               for($i = 0;$i<count($array);$i++) {
                                   echo "#" . $array[$i] . " ";
                               }
        ?></h4>
        <h3 class="title-card"><?php echo "$row[title]" ?></h3>
        <p class="message"><?php echo "$row[messagee]" ?></p>
    </div>
    <div class="like-delete">
        <button class="like" name="like"><i class="fas fa-heart"></i></button>
        <button class="delete"><a href="deleteMemories.php?id=<?php echo $row['id']; ?>"><i
                    class="fas fa-trash"></i>&nbsp;Delete</a></button>
    </div>
</div>