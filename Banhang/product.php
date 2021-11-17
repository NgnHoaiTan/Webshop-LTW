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
    if(isset($_SESSION['user'])||!empty($_SESSION['user'])){
        $user = GetFullInfoUser($_SESSION['user']);
    }
    $newarrival = isset($_GET['newarrival']) ? $_GET['newarrival'] : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- style -->
    <link rel="stylesheet" href="./assets/base.css">
    <link rel="stylesheet" href="./assets/styles.css">

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
        <p class="title-product-list">SHOPPING</p>
    </div>
    <main class="main-product-site">
        <div class="top--listproduct row row-justify-around">
            <div class="serch-product">
                  <input type="text" name="search-product" id="input-search-product" placeholder="Nhập thông tin tìm kiếm">
                  <button id="btn-search-product">Tìm</button>          
            </div>
            <div class="sort-product">
                    <div class="dropdown">
                        <div class="select">
                            <span>Sắp xếp theo</span>
                            <i class="fa fa-chevron-left"></i>
                        </div>
                        <input type="hidden" name="gender">
                        <ul class="dropdown-menu">
                            <li class="sort-by" option="all">Tất cả</li>
                            <li class="sort-by" option="price">Giá</li>
                            <li class="sort-by" option="new">Mới nhất</li>
                        </ul>
                        
                    </div>
            </div>
        </div>
        <div class="container--listproduct" id="list-fetch-product">
                
                    <!-- <div class="product--info">
                        <div class="img-product-review">
                            <img src="./image/product/sp3.jpg" alt="">
                                
                                <button class="btn_buy-product">Mua hàng</button>
                                <button class="btn_add-to-cart"><i class="fas fa-cart-plus"></i></button> 
                        </div>
                        
                        <p class="name-product">Shirt in Stretch Cotton</p>
                        <p>300$</p>
                    </div>

                    <div class="product--info">
                        <div class="img-product-review">
                            <img src="./image/product/sp4.jpg" alt="">
                            <button class="btn_buy-product">Mua hàng</button>
                            <button class="btn_add-to-cart"><i class="fas fa-cart-plus"></i></button>
                        </div>
                        
                        <p class="name-product">Front Pocket Jumper</p>
                        <p>309$</p>
                    </div>
                    <div class="product--info">
                        <div class="img-product-review">
                            <img src="./image/product/sp5.jpg" alt="" >
                            <button class="btn_buy-product">Mua hàng</button>
                            <button class="btn_add-to-cart"><i class="fas fa-cart-plus"></i></button>
                        </div>
                        
                        <p class="name-product">intage Inspired Classic</p>
                        <p>278$</p>
                    </div>
                    <div class="product--info">
                        <div class="img-product-review">
                            <img src="./image/product/sp6.jpg" alt="">
                            <button class="btn_buy-product">Mua hàng</button>
                            <button class="btn_add-to-cart"><i class="fas fa-cart-plus"></i></button>
                        </div>
                        
                        <p class="name-product">jacket suit new feminity concept</p>
                        <p>380$</p>
                    </div>
                    <div class="product--info">
                        <div class="img-product-review">
                            <img src="./image/product/sp7.jpg" alt="">
                            <button class="btn_buy-product">Mua hàng</button>
                            <button class="btn_add-to-cart"><i class="fas fa-cart-plus"></i></button>
                        </div>
                        
                        <p class="name-product">T-Shirt with Sleeve</p>
                        <p>190$</p>
                    </div>
                    <div class="product--info">
                        <div class="img-product-review">
                            <img src="./image/product/sp7.jpg" alt="">
                            <button class="btn_buy-product">Mua hàng</button>
                            <button class="btn_add-to-cart"><i class="fas fa-cart-plus"></i></button>
                        </div>
                        
                        <p class="name-product">T-Shirt with Sleeve</p>
                        <p>190$</p>
                    </div> -->

        </div>
        <div class="row">
            <div class="nextpage-product">
                <button class="btn btn-nextpage">1</button>
                <button class="btn btn-nextpage">2</button>
                <button class="btn btn-nextpage">3</button>
                <button class="btn btn-nextpage">4</button>
            </div>
        </div>
        <div id="toast"></div>
        
    </main>
    <script type="text/javascript">
         $(window).on('load',function(){
            searchParams = new URLSearchParams(window.location.search)
            var newarrival = searchParams.get('newarrival');
            
            $.ajax({
                url:'./controller/ajax/fetchProduct.php',
                type:"post",
                data:{
                    'newarrival':newarrival!=null?newarrival : "",
                },
                success:function(fetch_result){
            
                   $('#list-fetch-product').html(fetch_result);
                   
                },
                
            });
            
                      
        })
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
        $(document).on('click','#btn-search-product',function(){
            var searchStr = $('#input-search-product').val();
            
            $.ajax({
                    url:'./controller/ajax/fetchProduct.php',
                    type:"post",
                    data:{
                        'searchStr':searchStr
                    },
                    success:function(fetch_result){
                        $('#list-fetch-product').html(fetch_result);           
                    },
            })
            
        })
        $(document).on('click','.sort-by',function(){
            var option = $(this).attr('option');
            if(option=='price'){
                $.ajax({
                    url:'./controller/ajax/fetchProduct.php',
                    type:"post",
                    data:{
                        'sort-by-price':option
                    },
                    success:function(fetch_result){
                        $('#list-fetch-product').html(fetch_result);           
                    },
                })
            }
            else if(option=='all'){
                $.ajax({
                    url:'./controller/ajax/fetchProduct.php',
                    type:"post",
                    data:{
                        'sort-by-all':option
                    },
                    success:function(fetch_result){
                        $('#list-fetch-product').html(fetch_result);           
                    },
                })
            }
            else if(option=='new'){
                $.ajax({
                    url:'./controller/ajax/fetchProduct.php',
                    type:"post",
                    data:{
                        'sort-by-new':option
                    },
                    success:function(fetch_result){
                        $('#list-fetch-product').html(fetch_result);           
                    },
                })
            }
        })
        
    </script>
    <script>
        $(document).on('click','.dropdown',function () {
            $(this).attr('tabindex', 1).focus();
            $(this).toggleClass('active');
            $(this).find('.dropdown-menu').slideToggle(300);
            });
            $(document).on('focusout','.dropdown',(function () {
                $(this).removeClass('active');
                $(this).find('.dropdown-menu').slideUp(300);
            }));
            $(document).on('click','.dropdown .dropdown-menu li',function () {
                $(this).parents('.dropdown').find('span').text($(this).text());
                $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
            });
            /*End Dropdown Menu*/


            // $(document).on('click','.dropdown-menu li',function () {
            // var input = '<strong>' + $(this).parents('.dropdown').find('input').val() + '</strong>',
               
            // }); 

        
    </script>
    <script>
        const Toast=({Title, Message, type, duration=3000})=>{
                const main = document.getElementById('toast');
                console.log(main)
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