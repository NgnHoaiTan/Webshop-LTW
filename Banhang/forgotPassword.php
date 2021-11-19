<?php
    include "./controller/connectDb.php";
    session_start();
    $error='';
    $user;
    $admin;
    $result="";
    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    
    }
    if(!empty($_POST['submitretrieve'])){
        $username = $_POST['username'];
        $phonenumber = $_POST['phonenumber'];
        $checkExistUser = CheckExistCustomer($username,$phonenumber);
        if($checkExistUser){
            $password = rand_string(8);
            $updateSuccess=0;
            $updateSuccess = UpdatePassword($username,$password);
            if($updateSuccess){
                $result ="Tài khoản: ".$username."-Mật khẩu: ".$password.". Xin vui lòng thay đổi mật khẩu để tăng bảo mật";
            }
        }
        else{
            $error = "Người dùng không tồn tại, xin kiểm tra lại thông tin";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
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
            <form action="forgotPassword.php" method="POST" id="form-login">
                    
                <div class="error-login">
                    <p><?php echo $error  ?></p>
                </div>
                <div class="error-login">
                    <p><?php echo $result  ?></p>
                </div>
                <h1>Retrieve Password</h1>
                <br>
                <div class="row-form-login">
                    <input type="text" name="username" id="username"autocomplete = "off">    
                    <span></span>
                    <label for="">Username</label><br>
                    
                </div>
                <br>
                <div class="row-form-signup">
                    <input type="text" name="phonenumber" id="phonenumber"autocomplete = "off">    
                    <span></span>
                    <label for="">Phonenumber</label><br>
                    
                </div>
                <div class="forgot-password"><a href="changePassword.php">Change password</a></div>
                <div class="submit-login">
                    <input type="submit" name="submitretrieve" id="submitlogin" value="Retrieve">
                </div>  
                <div class="login-guest">
                    <button name="login-guest" id="login-guest"><a href="index.php">Access with guest user</a></button>
                </div> 
                <br>
                <br>
                <div class="signup_link">
                    <a href="login.php">Login</a>
                </div>
                <br>
            
                
            </form>
        </div>
    </div>
</body>
</html>