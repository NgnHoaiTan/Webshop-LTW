<?php
    include "./controller/connectDb.php";
    session_start();
    $count=0;
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
    }
    else{
        $count = 0;
    }
    $user = array();
    $addressfetch = array();
    $listOrder = array();
    if(isset($_SESSION['user'])||!empty($_SESSION['user'])){
        $user = GetFullInfoUser($_SESSION['user']);
        $addressfetch = getAddressByUser($user['MSKH']);
        $listOrder = getListOrderByCustomer($user['MSKH']);
    }
    else{
        header("location:index.php");
    }

    
    
    

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Trang cá nhân</title>
   <!-- FONTICON -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- STYLE -->
    <link rel="stylesheet" href="./assets/base.css">
    <link rel="stylesheet" href="./assets/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<header>
        <div class="hero-image">
        <div class="navbar-top row-justify-between" id="navbar-top">
                <div class="row">
                    <h1 id="brand-shop">GLAMOROUS</h1>
                    <ul class="navbar-list">
                        <li class="navbar-list-item">
                            <a href="index.php">Homepage</a>
                        </li>
                        <li class="navbar-list-item">
                            <a href="product.php">Shop</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="right-navbar">
                    <a id="addcart-nav" href="shoppingCart.php">
                        <p><i class="fas fa-shopping-bag icon-bag"></i><span style="font-size: 18px;">Cart</span></p>
                        <div id="notification-add-cart">
                            <p><?php echo $count ?></p>
                        </div>
                    </a>
                    <div class="user-navbar">
                        <?php if(!empty($user)){ ?>
                            <div class="avartar-user">
                                
                                <div class="wrapper-avt">
                                    <img src="./image/user/<?php echo $user['Avatar'] ?>" alt="">
                                </div>
                                <i class="fas fa-sort-down"></i>
                                <ul class="list-option-user">
                                    <li><a href="">Profile</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </div>

                        <?php }else{ ?>
                            <a href="login.php" class="logout-option">Login</a>
                        <?php  }?>
                    </div>
                </div>    
            </div> 
        </div>
    </header>
    <div class="main-profile">
        <div class="hero-avatar">
            <div class="user-introduce">              
                <div class="avatar-introduce">                 
                    <img src="./image/user/<?php echo $user['Avatar'] ?>" alt="" id="avatar">
                    
                    <input type="file" name="avatar" id="avatar-file">
                    <label for="avatar-file" id="uploadbtn">Choose Avatar</label>
                 
                    
                </div>        

                <div class="user-info">
                    <div class="user-fullname">
                            <p><?php echo $user['HoTenKH'] ?></p>

                    </div>
                    <div class="user-phonenumber">
                            <p><?php echo $user['SoDienThoai'] ?></p>
                    </div>
                    <div class="user-company">
                            
                            <p>Company: <?php echo (!empty($user['TenCongTy']) ? $user['TenCongTy'] :"Trống") ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="toast"></div>
        <div class="main-content-user">
            <div class="slider-option-user">
                <?php if(!empty($user)){  ?>
                <div class="update-info option-profile slides-option">
                    <h2>Cập nhật thông tin người dùng</h2>
                    <form action="profile.php" class="form-user-info" method="POST" name="update_user" onsubmit="return validateForm()">
                        <div class="row-form-user">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname-user" value="<?php echo $user['HoTenKH'] ?>" autocomplete="off">
                        </div>
                        <div class="row-form-user">
                            <label for="phonenumber">Số điện thoại</label>
                            <input type="text" name="phonenumber" id="phonenumber-user" value="<?php echo $user['SoDienThoai'] ?>" autocomplete="off">
                        </div>
                        <div class="row-form-user">
                            <label for="address">Địa chỉ người dùng</label>
                            
                            <div class="dropdown">
                                <div class="dropdown-address">
                                    <span class="list-address">Danh sách địa chỉ</span>
                                    <i class="fa fa-caret-down"></i>
                                </div>
                                
                                <div class="dropdown-list-address">
                                    <?php if(!empty($addressfetch)){
                                        foreach($addressfetch as $item){
                                        ?>
                                    <div class="dropdown-item-address">
                                        <p><?php echo $item['DiaChi'] ?></p>
                                    </div>
                                    <?php }}
                                    else{ ?>
                                        <div class="dropdown-item-address">
                                            <p>Bạn chưa có địa chỉ nào</p>
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                                
                            </div>
                            
                            
                        </div>
                        
                        <div class="row-form-user">
                            <label for="address-add">Địa chị khác</label>
                            <input type="text" name="address-add" id="address-add" autocomplete="off">
                        </div>
                        <div class="row-form-user">
                            <label for="company-user">Công ty</label>
                            <input type="text" name="company-user" id="company-user-add" value="<?php echo $user['TenCongTy'] ?>" autocomplete="off">
                        </div>
                        <div class="row-form-user">
                            <label for="fax-user">Số fax</label>
                            <input type="text" name="fax-user" id="fax-user-add" value="<?php echo $user['SoFax'] ?>" autocomplete="off">
                        </div>
                        <br>
                        <input type="hidden" name="id-user" id="id-user" value="<?php echo $user['MSKH'] ?>">
                        <input type="submit" name="update-user" class="update-user" id="update-user" value="Cập nhật">
                        <br>
                    </form>
                </div>
                <?php } ?>
                <div class="list-user-order option-profile slides-option">
                    <h2>Danh sách đơn hàng</h2>
                    
                    <div class="list-order-wrapper">
                        <?php if(!empty($listOrder)){ ?>
                        <ul class="list-order">
                            <?php foreach($listOrder as $order){ ?>
                            <li class="list-order-item">
                                <div class="order-item-content">
                                    <div class="image-order-item">
                                        <?php 
                                            $productInOrder = getMImagebyIdproduct($order['MSHH']);
                                            if(!empty($productInOrder)){  ?>
                                            <img src="../../../b1805914_NguyenHoaiTan/Admin/image/upload/<?php echo $productInOrder[0]['TenHinh'] ?>" alt="">
                                        
                                        <?php } ?>
                                    </div>
                                    <div class="order-item-col-2">
                                        <p class="name-order"><?php $product_order = getProductById($order['MSHH']);
                                        echo $product_order['TenHH'] ?></p>
                                        <p>Mã đơn hàng: <?php echo $order['SoDonDH'] ?></p>
                                        <p>Số lượng: <?php echo $order['SoLuong'] ?></p>
                                        <p>Tống tiền: <?php echo $order['GiaDatHang'] ?></p>
                                        <p>Ngày giao hàng dự kiến: <?php echo $order['NgayGH'] ?></p>
                                        <p>Địa chỉ: <?php 
                                                        $id_address = $order['MaDC'];
                                                        $address = getAddressByIdAddress($id_address);
                                                        echo $address[0]['DiaChi'] 
                                                    ?></p>
                                    </div>

                                    <div class="order-item-col-3 status-order">
                                        <p><?php if($order['TrangThaiDH']) echo "Đã duyệt đơn"; else echo "Đang chờ duyệt"  ?></p>
                                    </div>
                                    <div class="order-item-col-4 feedback-redirect">
                                        <button><a href="productDetail.php?id=<?php echo $order['MSHH']?>&feedback=true&user=<?php echo $user['MSKH'] ?>">FeedBack</a></button>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php }else{ ?>
                        <div class="empty-order-wrapper">
                            <img src="./image/background/emptycart.jpg" alt="empty order image" id="empty-order">    
                            <div class="emptyorder-option">
                                <h3>Bạn chưa có đơn hàng nào</h3>
                                <button><a href="product.php">Shopping now!</a></button>
                            </div>
                        </div>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="arrow-slider-user">
                <button class="next-slider" onclick="plusSlides(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="prev-slider" onclick="plusSlides(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
            </div>
        </div>
    </div>
    <div id="upload-result"></div>
    <script type="text/javascript">
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("slides-option");
        //var dots = document.getElementsByClassName("dot");
        if (n > slides.length) 
            {
                slideIndex = 1
            }    
        if (n < 1) 
            {
                slideIndex = slides.length
            }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        // for (i = 0; i < dots.length; i++) {
        //     dots[i].className = dots[i].className.replace(" active", "");
        // }
        slides[slideIndex-1].style.display = "block";  
        //dots[slideIndex-1].className += " active";
        }
    </script>
    <!-- validate form -->
    <script>
        function validateForm(){
            let fullname = document.forms["update_user"]["fullname"].value;
            let phonenumber = document.forms["update_user"]["phonenumber"].value;
            if(fullname.trim()==""||phonenumber.trim()==""){
                ShowWarningToast();
                return false
            }
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
            function ShowWarningToast(){
                Toast(
                    {
                        Title: 'Warning',
                        Message: 'Vui lòng cung cấp thông tin họ tên và số điện thoại',
                        type: 'warning',
                        duration: 4000
                    }
                )
            }
    </script>

    <!-- upload image -->

    <script type="text/javascript">
        const imgDiv = document.querySelector('.avatar-introduce');
        const img = document.querySelector('#avatar');
        const file = document.querySelector('#avatar-file');
        const uploadBtn = document.querySelector('#uploadbtn');

        // hover img div
        imgDiv.addEventListener('mouseenter',function(){
            uploadBtn.style.display = "block";
        })
        // if hover out img div
        imgDiv.addEventListener('mouseleave',function(){
            uploadBtn.style.display ="none";
        })
        // choose photo 
        file.addEventListener('change',function(){
            const choosedfile = this.files[0];
            var formData = new FormData();
            formData.append("file",choosedfile);
            console.log(choosedfile);
            $.ajax({
                url:'./controller/ajax/ajaxProfile.php',
                type:"post",
                contentType: false,
                processData: false,
                data:formData,
                success:function(result){
                    location.reload();
                }
               
            })
        })

        // cập nhật thông tin
        $(document).on('click','.update-user',function(e){
            e.preventDefault();
            var fullname = document.getElementById('fullname-user').value;
            var phonenumber = document.getElementById('phonenumber-user').value;
            var address = document.getElementById('address-add').value;
            var company = document.getElementById('company-user-add').value;
            var fax = document.getElementById('fax-user-add').value;
            var id_user = document.getElementById('id-user').value;
            var updateInfo = $(this).val();
            $.ajax({
                url:'./controller/ajax/ajaxProfile.php',
                type:"post",
                data:{
                    'update-user':updateInfo,
                    'fullname':fullname,
                    'phonenumber':phonenumber,
                    'address-add':address,
                    'company-user':company,
                    'fax-user':fax,
                    'id-user':id_user
                },
                success:function(result){
                    location.reload();
                }
            })
        })
    </script>
</body>
</html>