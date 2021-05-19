<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
    <title>Header</title>
</head>

<style>
nav {
    display: flex;
    justify-content: space-around;
    align-items: center;
}
</style>

<body>

    <nav>
        <h1>Memories</h1>
        <ul>
            <li><a href="index.php" class="home">Home</a></li>
            <li><a href="about.php" class="about">About</a></li>
            <li><a href="#" class="contact">Contact</a></li>
            <li><a href="register.php" class="register">Register</a></li>
        </ul>
    </nav>
</body>

</html>