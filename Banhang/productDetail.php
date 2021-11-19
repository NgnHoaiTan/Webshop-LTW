<?php
    session_start();
    include "./controller/connectDb.php";
    $count=0;
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
    }
    else{
        $count = 0;
    }
    $user = array();
    if(isset($_SESSION['user'])||!empty($_SESSION['user'])){
        $user = GetFullInfoUser($_SESSION['user']);
    }

    $product;
    // $productMImg;
    // $productAnotherImg;
    $productImg;
    if(!empty($_GET['id'])) {
        $id_product = $_GET['id'];
        $product = getProductById($id_product);     
        $productImg = getAllImageByIdProduct($id_product);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/base.css">
    <link rel="stylesheet" href="./assets/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font text -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- font icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div id="heading-nav">
            <div class="navbar-top row-justify-between" id="navbar-top">
                <div class="row">
                    <h1 id="brand-shop">GLAMOROUS</h1>
                    <ul class="navbar-list">
                        <li class="navbar-list-item">
                            <a href="index.php">Homepage</a>
                        </li>
                        <li class="navbar-list-item">
                            <a href="product.php?page=1&per_page=24">Shop</a>
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
                                    <li><a href="profile.php">Profile</a></li>
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
    <div id="product-list">
        <p class="title-product-list">THÔNG TIN SẢN PHẨM</p>
        <img src="./image/background/banner-v6-img1.jpg" alt="">
    </div>
    <div class="main">
        <div class="container-product-detail">
            <?php if(!empty($product)){  ?>
            <div class="row-justify-around product-detail">
                <div class="slider  image-product_review">
                    <?php if(!empty($productImg)){
                        foreach($productImg as $image){ ?>
                            <div class="slides">
                                <img src="../../../b1805914_NguyenHoaiTan/Admin/image/upload/<?php echo $image['TenHinh'] ?>" alt="image product" />
                            </div>
                    <?php }}else{ ?>


                    <?php } ?>
                </div>
                    
                <div class="option-product_buy">
                    <p class="name-product-detail"><?php echo $product['TenHH'] ?></p> 
                    <div class="row">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="price-product"><span class="price-span">Giá: </span><span id="price-detail"><?php echo $product['Gia'] ?></span><span class="price-span"> vnđ</span></p>
                    <div class="description-detail">
                        <p class="desciption-detail-title">Mô tả sản phẩm:</p>
                        <?php echo $product['QuyCach'] ?>
                    </div>
                    <!-- <div class="quantity-option-buy">
                        <p>Số lượng</p>
                        <div class="row">
                            <div class="minus-quantity" id="minus-quantity">
                                <i class="fas fa-minus"></i>
                            </div>
                            <p type="number" name="quantity" id="quantity-detail-buy" class="input-quantity">1</p>
                            <div class="plus-quantity" id="plus-quantity">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row row-justify-between subtotal-option-buy">
                        <p class="subtotal-option-title">Tạm tính:</p>
                        <p id="subtotal-detail-buy"><?php echo $product['Gia'] ?></p>
                        <p> vnđ</p>
                    </div> -->
                    <div class="row row-justify-between button-option">
                        <button class="button-buy"><a href="./checkout.php?id=<?php echo $product['MSHH'] ?>" class="link_to_checkout">Mua sản phẩm</a></button>
                        <?php if(isset($_SESSION['cart'])){

                            $item_array_col = array_column($_SESSION['cart'],"id_product");
                            if(!in_array($product['MSHH'],$item_array_col)){                        
                            ?>
                           
                            <button class="button-add-cart add-cart" onclick="ShowSuccessToast()" id-product="<?php echo $product['MSHH'] ?>">Thêm vào giỏ</button>
                        <?php  }
                            else{ ?>
                            <button class="button-add-cart add-cart" onclick="ShowInfoToast()" id-product="<?php echo $product['MSHH'] ?>">Thêm vào giỏ</button>                   
                        <?php }
                            }else if(!isset($_SESSION['cart'])){ ?>
                            <button class="button-add-cart add-cart refresh" onclick="ShowSuccessToast()" id-product="<?php echo $product['MSHH'] ?>">Thêm vào giỏ</button>
                            
                            <?php } ?>
                        
                    </div>
                </div>
                
            </div>
            <div class="feedback-container">
                <p class="feedback-title">Phản hồi</p>
                <hr>
                <div class="feedback-list">
                    <?php if(!empty($_GET['feedback'])){ ?>
                    <div class="enter-feedback">                  
                        
                        <div class="image-user-sendfb">
                            <img src="./image/user/<?php echo $user['Avatar'] ?>" alt="avt-user">
                        </div>
                        <textarea name="feedback" id="enterfeedback"></textarea>
                        <button class="feedback-btn" id="feedback-btn" id-customer="<?php echo $_GET['user'] ?>" id-product-fb="<?php echo $product['MSHH'] ?>">Gửi <i class="fas fa-paper-plane"></i></button>
                    </div>
                    <?php } ?>
                        
                    <br>
                    <div class="feedback-list-wrapper" id="fetch-list-feedback">
                        <!-- <div class="feedback-wrapper">
                            <div class="avt-user-feedback">
                                <div class="border-image">
                                    <img src="./image/user1.be89a16.png" alt="avt-user">
                                </div>
                            </div>
                            <div class="feedback-detail">
                                <div class="name-user">
                                    <p>Sara Anela</p>
                                </div>
                                <div class="feedback-rating">
                                <div class="row">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                </div>
                                <div class="feedback-content">
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feedback-wrapper">
                            <div class="avt-user-feedback">
                                <div class="border-image">
                                    <img src="./image/user1.be89a16.png" alt="avt-user">
                                </div>
                            </div>
                            <div class="feedback-detail">
                                <div class="name-user">
                                    <p>Sara Anela</p>
                                </div>
                                <div class="feedback-rating">
                                <div class="row">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                </div>
                                <div class="feedback-content">
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feedback-wrapper">
                            <div class="avt-user-feedback">
                                <div class="border-image">
                                    <img src="./image/user1.be89a16.png" alt="avt-user">
                                </div>
                            </div>
                            <div class="feedback-detail">
                                <div class="name-user">
                                    <p>Sara Anela</p>
                                </div>
                                <div class="feedback-rating">
                                <div class="row">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                </div>
                                <div class="feedback-content">
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo.</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    
                </div>
            </div> 
            <div class="follow-with-sliderImage">
                <div class="ig-follow">
                    <p class="title-ig-follow">FOLLOW US ON INSTAGRAM</p>
                    <p class="icon-ig"><a href="https://www.instagram.com/ng.hoaitan/"><i class="fab fa-instagram"></i></a></p>
                </div>
                
                <div class="slider-slicker">
                <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick2.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick3.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick4.jpg" alt="">
                            </div>
                            
                            <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick6.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick7.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick1.jpg" alt="">
                            </div> 
                            <div class="slicker-item-arrival">
                                <img src="./image/sliderSlicker/slick2.jpg" alt="">
                            </div>   
                                        
                            
                </div> 
                <div class="arrow">
                    <div class="next-arrow">
                        <i class="fas fa-caret-square-right"></i>
                    </div>
                    <div class="prev-arrow">
                        <i class="fas fa-caret-square-left"></i>
                    </div>
                </div>
            </div>
            <div id="toast"></div>      

            <?php } ?>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">       
    </script>
    <script type="text/javascript">
       
        $(document).ready(function(){
           
           setInterval(function(){
               $('.slick-next').click();
           },3000);
            
        });

        $('.slider-slicker').slick({
            autoplay: true,
            autoplaySpeed: 1000,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            arrows: true,
            prevArrow: $('.prev-arrow'),
            nextArrow: $('.next-arrow')
        });

        // add cart trigger
        $(document).on('click','.add-cart',function(){
            var idProductAddcart = $(this).attr('id-product');
            $.ajax({
                url:'./controller/ajax/addCart.php',
                type:"post",
                data:{
                    'id-productAddCart' : idProductAddcart,
                },
                success:function(fetch_result){
                    $('#addcart-nav').html(fetch_result);   
                          
                },
            })
           
        });
        // feedback ajax
        $(document).on('click','.feedback-btn',function(){
            var feedback = document.getElementById('enterfeedback').value;
            var id_customer = document.getElementById('feedback-btn').getAttribute('id-customer');
            var id_product = document.getElementById('feedback-btn').getAttribute('id-product-fb');
            var feedbackbtn ='feedback';
            var dateFeedback = new Date();
            document.getElementById('enterfeedback').value = ""
            dateFeedback =dateFeedback.getDate()+'-'+(dateFeedback.getMonth()+1)+'-'+ dateFeedback.getFullYear();
            if(feedback.trim()!=""){
                console.log(dateFeedback);
                $.ajax({
                    url:'./controller/ajax/ajaxFeedback.php',
                    type:"post",
                    data:{
                        'feedback-content':feedback,
                        'id_customer':id_customer,
                        'feedbackBtn':feedbackbtn,
                        'id_product': id_product,
                        'dateupfb':dateFeedback
                    },
                    success:function(fetch_result){
                        if(fetch_result!=null){
                            
                            $('#fetch-list-feedback').html(fetch_result);   
                        }
                        else{
                            alert(fetch_result)
                        }
                        
                            
                    },
                })
            }
            
        });
        $(window).on('load',function(){
            // var id_product = document.getElementById('feedback-btn').getAttribute('id-product-fb');
            var searchParams = new URLSearchParams(window.location.search); 
            var id_product = searchParams.get('id');
            $.ajax({
                    url:'./controller/ajax/ajaxFeedback.php',
                    type:"post",
                    data:{
                        'id_product':id_product
                    },
                    success:function(fetch_result){                          
                        $('#fetch-list-feedback').html(fetch_result);     
                    },
                })
        })
        




        $(document).on('click','.refresh',function(){
            setTimeout(()=>{
                window.location.reload(); 
            },3200)
        })
        

      
    </script>
    <script>
        var slideIndex = 0;
        showSlides();
        function showSlides(){
            var i;
            var slides = document.getElementsByClassName("slides");
            for(i=0;i<slides.length;i++){
                slides[i].style.display = "none";
            }
            slideIndex++;
            if(slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex-1].style.display="block";
            setTimeout(showSlides,2500);
        }

        const Toast=({Title, Message, type, duration=3000})=>{
                const main = document.getElementById('toast');
                const icons ={
                    success: "fas fa-check-circle",
                    info: "fas fa-info-circle",
                    // warning: "fas fa-exclamation-circle"
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
            function ShowSuccessToast(){
                Toast(
                    {
                        Title: 'Success',
                        Message: 'Đã thêm vào giỏ hàng thành công ^^',
                        type: 'success',
                        duration: 3000
                    }
                )
            }
            function ShowInfoToast(){
                Toast(
                    {
                        Title: 'Info',
                        Message: 'Sản phẩm đã có trong giỏ hàng',
                        type: 'info',
                        duration: 3000
                    }
                )
            }
    </script>
</body>
</html>