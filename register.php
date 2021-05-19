<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <title>Register Form</title>
</head>

<style>
/* Db */
.error-uname {
    background-color: red;
    color: #eee;
    padding: 5px;
}

.success-register {
    background-color: green;
    color: #eee;
    padding: 5px;
}

.form-control input:focus {
    border: 2px solid #333;
}
</style>

<body>

    <?php 

include("header.php");
include("dbCon.php");

?>

    <form action="" class="loginForm registerForm" method="POST">
        <div class="container">
            <h1>Registration Form</h1>
        </div>
        <div class="form-control-c">
            <div class="form-control">
                <i class="fas fa-signature"></i>
                <input type="text" name="username" id="username" placeholder="User name" required>
            </div>
            <div class="form-control">
                <i class="fas fa-envelope"></i>
                <input type="email" name="registerEmail" id="email" placeholder="Email" required>
            </div>
            <div class="form-control">
                <i class="fas fa-key"></i>
                <input type="password" name="registerPassword" id="password" placeholder="Password" required>
            </div>
            <div class="form-control">
                <i class="fas fa-key"></i>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </div>
        <p>Already have an account? <a href="index.php">Login!</a></p>
    </form>

    <?php

include_once('registerTable.php');

        if(isset($_POST['register'])) {
            $username = $_POST['username'];
            $registerEmail = $_POST['registerEmail'];
            $password = $_POST['registerPassword'];
            $cPassword = $_POST['cpassword'];

            if($password == $cPassword) {
                $query = "SELECT * FROM createprofile";
                $results = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($results)) {
                    if($row['username'] == $username || $row['email'] == $registerEmail) {
                        echo "<h3 class='error-uname'>Username or emailId is already exists!!</h3>";
                        break;
                    } else {
                        $sql = "INSERT INTO createprofile (username, email, registerPassword, cpassword) VALUES ('$username', '$registerEmail', '$password', '$cPassword' )";
                        $result = mysqli_query($conn,$sql);
                        echo "<h3 class='success-register'>Successfully Registered!! Click On Login to login</h3>";;
                        break;
                    }
                }
                // if($result) {
                //     echo "Registed";
                // } else {
                //     echo "Something went wrong";
                // }
            } else {
                echo "<script>alert('Passwords doesnt match')</script>";
            }
        }

    ?>


</body>

</html>