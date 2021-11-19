<?php
    include "./controller/connectDb.php";
    session_start();
    $error='';
    $admin;
    if(isset($_SESSION['admin'])){
        header("location:index.php");
    }
    else{
        if(isset($_POST['submitlogin'])){
            if(!empty($_POST['adminname']) && !empty($_POST['password'])){
                $adminname = $_POST['adminname'];
                $password = $_POST['password'];
                $admin = verifyAccountAdmin($adminname,$password);
                
                if(!empty($admin)){
                    $_SESSION['admin'] = $adminname;
                    header("location:index.php");
                }
                else{
                    $error='Admin doesn\'t exist, please check again';
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
        <img src="./image/background/bg_login.jpg" alt="" id="bglogin">
        
        <div class="form-wrapper">
            <div class="bg-form">
                <img src="./image/background/5147268.jpg" alt="" id="bgform">
            </div>
            <form action="" method="POST" id="form-login">
                <h1>Login</h1>
                <div class="row-form">
                    <label for="">Administrator name</label><br>
                    <input type="text" name="adminname" id="adminname" placeholder="type here" autocomplete = "off">
                </div>
                <br>
                <div class="row-form">
                    <label for="">Password</label><br>
                    <input type="password" name="password" id="adminpassword" autocomplete = "off">
                </div>
                <div class="submit-login">
                    <input type="submit" name="submitlogin" id="submitlogin" value="Login">
                </div>
                <div class="error-login">
                    <p><?php echo $error  ?></p>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>