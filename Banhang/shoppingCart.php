<?php
    include "./controller/connectDb.php";
    session_start();

    $user = array();
    $addressfetch = array();
    if(isset($_SESSION['user'])||!empty($_SESSION['user'])){
        $user = GetFullInfoUser($_SESSION['user']);
        $addressfetch = getAddressByUser($user['MSKH']);
    }

    function DeleteFormCart($position){
        for($i=$position;$i<count($_SESSION['cart'])-1;$i++){
            $_SESSION['cart'][$i] = $_SESSION['cart'][$i+1];
        }
        unset($_SESSION['cart'][count($_SESSION['cart'])-1]);
    }
    if(!empty($_POST['checkout-btn']) && isset($_SESSION['cart'])){
        $sumofCountCart = count($_SESSION['cart']);     
        if(empty($user) && !empty($_SESSION['list_cart_checkout'])){
            $list_cart_product = $_SESSION['list_cart_checkout'];
            $mskh = uniqid('guest-',false);
            $madc = uniqid('guestDC-',false);
            
            for($i=0;$i< count($list_cart_product);$i++){
                var_dump($list_cart_product[$i]) ;
                //tao thong tin khach hang 
                    $fax = isset($_POST['fax']) ? $_POST['fax'] : null;
                    $company = isset($_POST['company']) ? $_POST['company'] : null;                
                    $hotenkh = $_POST['namecustomer'];
                    $phonenumber = $_POST['phonenumber'];
                    $address = $_POST['address'];
                    createGuestUser($mskh,$hotenkh,$phonenumber,$fax,$company);

                //tao dia chi khach hang
                   
                    createAddress($madc,$address,$mskh);
                //them vao table dat hang
                    $sodondh = uniqid('DH-',false);
                    $ngaydh=date("Y-m-d");
                    $ngaygh=date('Y-m-d', strtotime($ngaydh. ' + 5 days'));
                    $trangthaidh = 0;
                    InsertOrder($sodondh,$mskh,$ngaydh,$ngaygh,$trangthaidh);

                //lay sodondh tu dat hang them vao chi tiet dat hang
                    $quantity =$list_cart_product[$i]['quantity'];
                    $sumprice = $list_cart_product[$i]['subtotal'];
                    $giamgia =  isset($_POST['giamgia']) ? $_POST['giamgia'] : 0;
                    $mshh = $list_cart_product[$i]['id_product'];
                    InsertOrderDetail($sodondh,$mshh,$quantity,$sumprice,$giamgia,$phonenumber,$madc);
                    $product = getProductById($mshh);
                    $newquantity = $product['SoLuongHang'] - $quantity;
                    UpdateQuantity($newquantity,$mshh);
                if(!empty($_SESSION['cart'])){
                    for($j=0;$j<count($_SESSION['cart']);$j++){
                        if($_SESSION['cart'][$j]['id_product'] == $mshh)
                        {
                            DeleteFormCart($j);
                            break;
                        }
                    }
                }
            }    
            unset($_SESSION['list_cart_checkout']);
        } 

        else if(!empty($user) && !empty($_SESSION['list_cart_checkout'])){
            $list_cart_product = $_SESSION['list_cart_checkout'];
            $mskh = $user['MSKH'];
            $madc = $_POST['address'];
            
            for($i=0;$i< count($list_cart_product);$i++){
                var_dump($list_cart_product[$i]) ;
                //tao thong tin khach hang 
                    $fax = isset($_POST['fax']) ? $_POST['fax'] : null;
                    $company = isset($_POST['company']) ? $_POST['company'] : null;                
                    $hotenkh = $_POST['namecustomer'];
                    $phonenumber = $_POST['phonenumber'];
                    $address = $_POST['address'];
                    // createGuestUser($mskh,$hotenkh,$phonenumber,$fax,$company);

                //them vao table dat hang
                    $sodondh = uniqid('DH-',false);
                    $ngaydh=date("Y-m-d");
                    $ngaygh=date('Y-m-d', strtotime($ngaydh. ' + 5 days'));
                    $trangthaidh = 0;
                    InsertOrder($sodondh,$mskh,$ngaydh,$ngaygh,$trangthaidh);

                //lay sodondh tu dat hang them vao chi tiet dat hang
                    $quantity =$list_cart_product[$i]['quantity'];
                    $sumprice = $list_cart_product[$i]['subtotal'];
                    $giamgia =  isset($_POST['giamgia']) ? $_POST['giamgia'] : 0;
                    $mshh = $list_cart_product[$i]['id_product'];
                    InsertOrderDetail($sodondh,$mshh,$quantity,$sumprice,$giamgia,$phonenumber,$madc);
                    $product = getProductById($mshh);
                    $newquantity = $product['SoLuongHang'] - $quantity;
                    UpdateQuantity($newquantity,$mshh);
                // update quantity of product

                if(!empty($_SESSION['cart'])){
                    for($j=0;$j<count($_SESSION['cart']);$j++){
                        if($_SESSION['cart'][$j]['id_product'] == $mshh)
                        {
                            DeleteFormCart($j);
                            break;
                        }
                    }
                }
            }    
            unset($_SESSION['list_cart_checkout']);
        }   

    }

   
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>

    <!-- style -->
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
                        <p>><i class="fas fa-shopping-bag icon-bag"></i><span style="font-size: 18px;">Cart</span></p>
                        
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
    <h1 class="shopping-cart-title">SHOPPING CART</h1>
    <div class="container--cart row row-justify-evenly"  id="result-fetch-cart">
    
       
          
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
    </div>
    <script type="text/javascript">
        $(window).on('load',function(){
            $.ajax({
                url:'./controller/ajax/fetchCart.php',
                type:"post",
                success:function(fetch_result){
            
                   $('#result-fetch-cart').html(fetch_result);
                   
                },
                
            });
        });
        $(document).on('click','.checkout-all-in-cart',function(){
            var listCheck = document.getElementsByClassName('check-cart');
            //console.log(listCheck);
            var sumSubtotal = 0;
            var listitem = [];
            for (var i = 0; i < listCheck.length; i++){
                    if (listCheck[i].checked === true){
                        var id_product = listCheck[i].getAttribute('id-product-check');
                        var quantity = document.getElementById('quantity-'+id_product).value;
                        var subtotal = parseInt(document.getElementById('subtotal-'+id_product).innerText);
                        var sumSubtotal = sumSubtotal + parseInt(document.getElementById('subtotal-'+id_product).innerText);
                        console.log('add to localstorage');
                        var item = {
                                'id_product':id_product,
                                'quantity':quantity,
                                'subtotal':subtotal
                            }
                        listitem.push(item);      
                        }
                    
                }
            localStorage.setItem('checked-in-car',JSON.stringify(listitem));

            // Chuyển hướng thanh toán
            var listproduct = JSON.parse(localStorage.getItem('checked-in-car'))
            
            console.log(listproduct);
            listproduct.map(item=>{
                console.log(item.id_product)
            })
            var triggerbtn = $(this).val();
            
            if(listproduct.length>0){
                $.ajax({
                url:'./controller/ajax/fetchCart.php',
                type:"post",
                data:{
                    'list_product':listproduct,
                    'CheckoutTrigger': triggerbtn,
                    'sumSubtotal':sumSubtotal
                },
                success:function(result){
                    $('#fetch-checkout-result').html(result);
                }
                })
            }
           

        })

        // Thao tác dom cập nhật subtotal khi tăng số lượng sản phẩm
        $(document).on('change','.quantity-product-cart',function(){
            const quantity = parseInt($(this).val());
            const maxquantity = parseInt($(this).attr('max'));
            console.log(quantity <= maxquantity);
            
            if(quantity<=maxquantity){
                var product_id = $(this).attr('id-product-number');
                var price_Value= document.getElementById('price-'+product_id).innerText;
                var Subtotal_Value = price_Value * quantity;
                
                document.getElementById('subtotal-'+product_id).innerText = Subtotal_Value;
                console.log(document.getElementById('subtotal-'+product_id).innerText);
            }
            else{
                alert('Số lượng vượt mức tối đa');
                $(this).val('1');
            }
           

            
        })
        
        //remove product out of cart
        $(document).on('click','.remove-from-cart',function(){
            console.log($(this).attr('id-product'));
            $product_remove = $(this).attr('id-product');
            $removeBtn = $(this).attr('trigger-remove');
            console.log($removeBtn);
            $.ajax({
                url:'./controller/ajax/fetchCart.php',
                type:"get",
                data:{
                    'product_remove' : $product_remove,
                    'removeBtn' : $removeBtn
                },
                success:function(result){
                    $('#result-fetch-cart').html(result);
                }
            })
        })
        
    </script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">       
    </script>
    <script type="text/javascript">
       
        $(document).ready(function(){
           
           setInterval(function(){
               $('.slick-next').click();
           },3000);
            
        });

        $('.slider-slicker').slick({
            infinite: true,
            autoplay:true,
            autoplaySpeed:3000,
            slidesToShow: 6,
            slidesToScroll: 6,
            prevArrow:$('.prev-item-arrival'),
            nextArrow:$('.next-item-arrival')
        });
    </script>
   
</body>
</html>