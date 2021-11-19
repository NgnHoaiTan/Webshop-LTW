<?php
    include "./controller/connectDb.php";
    session_start();
    $error='';
    $user;
    if(!empty($_POST['submitsignup'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phonenumber = $_POST['phonenumber'];
        $fullname = $_POST['fullname'];
        $mskh = uniqid('customer-',false);
        $checkExistUsername = CheckExistusername($username);
        if(!$checkExistUsername){
            $successSignup = Register($username,$password);
            echo $successSignup;
            if($successSignup){
                $successSignup = CreateCustomer($mskh,$username,$fullname,$phonenumber);
                if($successSignup){
                    $_SESSION['user'] = $username; 
                    header("location:index.php");
                    
                }
            }
        }
        else{
            $error="Tài khoản đã tồn tại, xin vui lòng chọn tên đăng nhập khác";
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
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
        <!-- <img src="./image/background/background_login.jpg" alt="" id="bglogin"> -->
        
        <div class="signup-form-wrapper">
            <form action="register.php" method="POST" id="form-signup" name="signupform" onsubmit="return validateSignup()">
                <h1>Register</h1>
                <div class="error-login">
                    <p><?php echo $error  ?></p>
                </div>
                
                <div class="row-form-signup">
                    <input type="text" name="username" id="username"autocomplete = "off">    
                    <span></span>
                    <label for="">Username</label><br>
                    
                </div>
                
                <div class="row-form-signup">

                    <input type="password" name="password" id="userpassword" autocomplete = "off">
                    <span></span>
                    <label for="">Password</label><br>
                    
                </div>
                
                <div class="row-form-signup">

                    <input type="password" name="verifypassword" id="verifypassword" autocomplete = "off">
                    <span></span>
                    <label for="">Verify Password</label><br>
                    
                </div>
                <div class="row-form-signup">
                    <input type="text" name="fullname" id="fullname"autocomplete = "off">    
                    <span></span>
                    <label for="">Full name</label><br>    
                </div>
                <div class="row-form-signup">
                    <input type="text" name="phonenumber" id="phonenumber"autocomplete = "off">    
                    <span></span>
                    <label for="">Phonenumber</label><br>
                    
                </div>
                
                <div class="submit-signup">
                    <input type="submit" name="submitsignup" id="submitsignup" value="Signup">
                </div>  
                <!-- <br> -->
                <!-- <div class="login-guest">
                    <button name="login-guest" id="login-guest"><a href="index.php">Access with guest user</a></button>
                </div> 
                <br> -->
                <div class="signup_link">
                    <a href="login.php">Login</a>
                </div>
            
                
                
            </form>
        </div>
        <div id="toast"></div>
    </div>
    <script>
        function validateSignup(){
            
            var username = document.forms["signupform"]['username'].value;
            var password = document.forms["signupform"]['password'].value;
            var verifypassword = document.forms["signupform"]['verifypassword'].value;
            var phonenumber = document.forms["signupform"]['phonenumber'].value;
            console.log(phonenumber);
            if(verifypassword !== password){
                var msg = 'Mật khẩu lặp lại không đúng với mật khẩu đã nhập!';
                ShowWarningToast(msg);
                
                return false;
            }
            if(username.trim()==""||password.trim()==""||phonenumber.trim()==""){
                var msg = 'Vui lòng nhập đầy đủ các thông tin yêu cầu!';
                ShowWarningToast(msg);
                return false;
            }
            return true;
        }


        const Toast=({Title, Message, type, duration=3000})=>{
                const main = document.getElementById('toast');
                const icons ={  
                    warning: "fas fa-exclamation-circle"
                }
                if(main){
                    const icon = icons[type];
                    const toast = document.createElement('div')

                    const timer = setTimeout(function(){
                        main.removeChild(toast)
                    }, duration + 1000)
                   
                    toast.classList.add('toast',`toast--${type}`);
                    toast.style.animation = `slideInLeft ease .35s, fadeOut linear 0.7s ${duration/1000}s forwards`;
                    toast.innerHTML =`
                    <div class="toast__icon"><i class='${icon}'></i></div>
                    <div class="toast__body">
                    <div class="toast__title"><h3>${Title}</h3></div>
                    <div class="toast__messg"><p>${Message}</p></div>
                    </div>
                    <div class="toast_exit"><i class="fas fa-times"></i></div>
                    `
                    toast.onclick = (function(e){
                        if(e.target.closest('.toast_exit')) {
                            main.removeChild(toast);
                            clearTimeout(timer);
                        }
                    })
                    main.appendChild(toast);
                
                    
                    
                }
            }
            function ShowWarningToast(msg){
                Toast(
                    {
                        Title: 'Warning',
                        Message: msg,
                        type: 'warning',
                        duration: 3000
                    }
                )
            }
    </script>
</body>
</html>