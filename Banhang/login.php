<?php
    include "./controller/connectDb.php";
    session_start();
    $error='';
    $user;
    $admin;
    if(isset($_SESSION['user'])){
        header("location:index.php");
    }
    else{
        if(isset($_POST['submitlogin'])){
            if(!empty($_POST['username']) && !empty($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $user = verifyAccountUser($username,$password);
                $admin = verifyAccountAdmin($username,$password);
                if(!empty($user)){
                    $_SESSION['user'] = $username;
                    header("location:index.php");
                }
                else if(!empty($admin)){
                    $_SESSION['admin'] = $username;
                    header("location:index.php");
                }
                else{
                    $error='User doesn\'t exist, please check again';
                }
            }
            else{
                $error='Username or Password is invalid';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- FONT ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- STYLE -->
    <link rel="stylesheet" href="./assets/base.css">
    <link rel="stylesheet" href="./assets/styles.css">
</head>
<body>
    <div class="container login-container">
        <img src="./image/background/background_login.jpg" alt="" id="bglogin">
        
        <div class="login-form-wrapper">
            <form action="login.php" method="POST" id="form-login">
                <h1>Login</h1>
                <br>
                <div class="row-form-login">
                    <input type="text" name="username" id="username"autocomplete = "off">    
                    <span></span>
                    <label for="">Username</label><br>
                    
                </div>
                <br>
                <div class="row-form-login">

                    <input type="password" name="password" id="userpassword" autocomplete = "off">
                    <span></span>
                    <label for="">Password</label><br>
                    
                </div>
                <div class="row row-justify-around">
                    <div class="forgot-password"><a href="forgotPassword.php">Forgot Password?</a></div>
                    <div class="forgot-password"><a href="changePassword.php">Change password</a></div>
                </div>
                
                <div class="submit-login">
                    <input type="submit" name="submitlogin" id="submitlogin" value="Login">
                </div>  
                <div class="login-guest">
                    <button name="login-guest" id="login-guest"><a href="index.php">Access with guest user</a></button>
                </div> 
                <br>
                <br>
                <div class="signup_link">
                    <a href="register.php">Signup</a>
                </div>
                
                <div class="error-login">
                    <p><?php echo $error  ?></p>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>