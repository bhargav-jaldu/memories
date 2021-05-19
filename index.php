<!DOCTYPE html>
<?php
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
    <title>Login</title>
</head>
<style>
.successLogin {
    background-color: green;
    color: #eee;
    padding: 10px;
    margin: 20px 0;
}

.errorLogin {
    background-color: red;
    color: #eee;
    padding: 10px;
    margin: 20px 0;
}
</style>

<body>

    <?php 

include("header.php");
include("dbCon.php");

?>

    <div class="loginform-c">
        <form action="" class="loginForm" method="POST">
            <div class="container">
                <h1>Login Form</h1>
            </div>
            <div class="form-control-c">
                <div class="form-control">
                    <i class="fas fa-envelope bgcolor"></i>
                    <input type="email" name="LoginEmail" id="email" placeholder="Email" required>
                </div>
                <div class="form-control password-c">
                    <i class="fas fa-key bgcolor"></i>
                    <input type="password" name="LoginPassword" id="password" class="LoginPassword"
                        placeholder="Password" required>
                    <i class="fas fa-eye-slash hidden"></i>
                    <i class="fas fa-eye"></i>
                </div>
                <button type="submit" name="login">Login</button>
            </div>
            <p>Don't have an account? <a href="register.php">register now!</a></p>
        </form>
    </div>

    <?php

if(isset($_POST['login'])) {
    $loginEmail = $_POST['LoginEmail'];
    $LoginPassword = $_POST['LoginPassword'];

    $fetchQuery = "SELECT * FROM createprofile";
    $fetchResults = mysqli_query($conn, $fetchQuery);


    $ro = mysqli_fetch_all($fetchResults, MYSQLI_ASSOC);


    if(array_search($loginEmail, array_column($ro, 'email')) !== false && array_search($LoginPassword, array_column($ro, 'registerPassword')) !==false ) {
        echo "<h3 class='successLogin'>SuccesFully Logged in</h3>";
        header("Location: memories.php");
    } else {
        echo "<h3 class='errorLogin'>Invalid Username or password</h3>";
    }
    
}

// https://getsourcecodes.com/php-tutorials/php-check-if-value-exists-in-multidimensional-array-or-not/

?>

    <script>
    const passwordIconEl = document.querySelector('.fa-eye-slash')
    const passwordEl = document.querySelector('.fa-eye')
    const LoginPasswordEl = document.querySelector('.LoginPassword')
    passwordEl.addEventListener('click', () => {
        showPassword();
    })

    function showPassword() {
        if (LoginPasswordEl.type === 'password') {
            LoginPasswordEl.setAttribute('type', 'text');
            passwordEl.classList.add('hidden');
            passwordIconEl.classList.remove('hidden');
        } else {
            LoginPasswordEl.setAttribute('type', 'password')
        }
    }

    passwordIconEl.addEventListener('click', () => {
        hidePassword();
    })

    function hidePassword() {
        if (LoginPasswordEl.type === 'password') {
            LoginPasswordEl.setAttribute('type', 'text');

        } else {
            LoginPasswordEl.setAttribute('type', 'password')
            passwordEl.classList.remove('hidden');
            passwordIconEl.classList.add('hidden');
        }
    }
    </script>

</body>

</html>