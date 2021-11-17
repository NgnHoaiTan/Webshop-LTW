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
    $productMImg;
    // $productAnotherImg;
    $productImg;
    if(!empty($_GET['id'])) {
        $id_product = $_GET['id'];
        $product = getProductById($id_product);     
        $productImg = getAllImageByIdProduct($id_product);
        $productMImg = getMImagebyIdproduct($id_product);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- font icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/base.css">
    <link rel="stylesheet" href="./assets/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div id="checkout-result">
        <div id="product-list">
            <p class="title-product-list">HOÀN TẤT THANH TOÁN</p>
        </div>
        <div class="container background-container_checkout" >
            <div class="body-checkout">
                <div class="grid-checkout-form container-checkout">
                    <?php if(!empty($product)){ ?>
                    <div class="container-info-checkout">              
                        <div class="checkout-product">
                        <div class="img-review_checkout">
                            <img src="../../../b1805914_NguyenHoaiTan/Admin/image/upload/<?php echo $productMImg[0]['TenHinh'] ?>" alt="">
                        </div>
                        <div class="">
                                <p class="name-product_checkout"><?php echo $product['TenHH'] ?></p>
                                <div class="row">
                                    <p>Đơn giá: </p>
                                    <p id="price-detail"><?php echo $product['Gia'] ?></p>
                                </div>
                                
                        </div>
                        
                            
                        </div>
                        <div class="quantity-option-buy">
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
                            
                        <div class="subtotal">
                            <div class="row row-justify-between subtotal-option-buy">
                                <p class="subtotal-option-title">Tạm tính:</p>
                                <p id="subtotal-detail-buy"><?php echo $product['Gia'] ?></p>
                                <p> vnđ</p>
                            </div>
                        </div>
                        <div class="option-voucher">
                            <div class="slider">
                                <div class="slider-item">
                                    <img src="../../B1805914_NguyenHoaiTan/Banhang/image/voucher/freeship.JPG" alt="">
                                </div>
                                <div class="slider-item">
                                    <img src="../../B1805914_NguyenHoaiTan/Banhang/image/voucher/freeship.JPG" alt="">
                                </div>
                                <div class="slider-item">
                                    <img src="../../B1805914_NguyenHoaiTan/Banhang/image/voucher/freeship.JPG" alt="">
                                </div>
                                <div class="slider-item">
                                    <img src="../../B1805914_NguyenHoaiTan/Banhang/image/voucher/freeship.JPG" alt="">
                                </div>
                                <div class="slider-item">
                                    <img src="../../B1805914_NguyenHoaiTan/Banhang/image/voucher/freeship.JPG" alt="">
                                </div>
                            </div>
                            <div class="arrow">
                                
                                <button type="button" class="slide-arrow prev-arrow"><i class="fas fa-caret-square-right"></i></button>
                                
                                <button type="button" class="slide-arrow next-arrow"><i class="fas fa-caret-square-left"></i></button>
                            </div>
                        </div>
                        <div class="sumtotal-checkout row">
                            <p>Tổng số tiền thanh toán:   </p>
                            <p id="total-checkout"><?php echo $product['Gia'] ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="container-info-customer">
                        <h2 style="text-align: center;color: white;">Thông tin khách hàng</h2>
                        <span class="circle one"></span>
                        <span class="circle two"></span>
                        <form action="" class="infor-form" autocomplete="off">
                            
                            
                            <div class="input-container row-input">
                                <label for="namecustomer" class="label-checkout">Họ tên</label>
                                <input type="text" name="namecustomer" id="namecustomer" class="form-info-input w-input-9" required autocomplete="off">
                            </div>
                            <br>
                            <div class="input-container row-input">
                                <label for="phonenumber" class="label-checkout">Số điện thoại</label required>
                                <input type="text" name="phonenumber" id="phonenumber" class="form-info-input w-input-9">
                            </div>
                            <br>
                            <div class="input-container row-input">
                                <label for="company" class="label-checkout">Công ty</label>
                                <input type="text" name="company" id="company" class="form-info-input w-input-9">
                            </div>
                            <br>
                            <div class="input-container row-input">
                                <label for="fax" class="label-checkout">số Fax</label>
                                <input type="text" name="fax" id="fax" class="form-info-input w-input-9">
                            </div>
                            <br>
                            <div class="input-container row-input">
                                <label for="address" class="label-checkout">Địa chỉ</label>
                                <!-- <select name="address" id="address">
                                    <option value="An Giang" class="option-address">An Giang</option>
                                </select> -->
                                <textarea name="address" id="address" cols="30" rows="5" class="form-info-input w-input-9"></textarea>
                                
                            </div>
                            <br>
                            <input type="hidden" name="quantity-input" value= "1" id="quantity-input" />
                            <input type="hidden" name="MSHH-input" id="id_product-input" value="<?php echo $product['MSHH'] ?>" />
                            <input type="hidden" name="sumcheckout-input" id="sumcheckout-input" value="" />
                            <input type="submit" name="buy-submit" value="Mua hàng" class="buy-submit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">       
    </script>
    <script type="text/javascript">
        $('#plus-quantity').click(function(){
            var prevquantity = document.getElementById('quantity-detail-buy').innerText;
            var nextquantity = parseInt(prevquantity) + 1;
            
            document.getElementById('quantity-detail-buy').innerText = nextquantity;
            
            var price = document.getElementById('price-detail').innerText;   
                  
            var subtotalVal = parseInt(price)*nextquantity;
            document.getElementById('subtotal-detail-buy').innerText = subtotalVal;
            document.getElementById('total-checkout').innerText = subtotalVal;
            document.getElementById('quantity-input').value = nextquantity;
            document.getElementById('sumcheckout-input').value = subtotalVal;
            
            
            
        })
        $('#minus-quantity').click(function(){
            var prevquantity = document.getElementById('quantity-detail-buy').innerText;
            var nextquantity = parseInt(prevquantity) - 1;
            if(nextquantity >=1){
                document.getElementById('quantity-detail-buy').innerText = nextquantity;
                var price = document.getElementById('price-detail').innerText;          
                var subtotalVal = parseInt(price)*nextquantity;
                document.getElementById('subtotal-detail-buy').innerText = subtotalVal;
                document.getElementById('total-checkout').innerText = subtotalVal;
                document.getElementById('quantity-input').value = nextquantity;
                document.getElementById('sumcheckout-input').value = subtotalVal;
            }

          
           
        })
        $(document).on('click','.buy-submit',function(e){
            e.preventDefault();
            var namecustomer = document.getElementById('namecustomer').value;
            var phonenumber = document.getElementById('phonenumber').value;
            var company = document.getElementById('company').value;
            var fax = document.getElementById('fax').value;
            var address = document.getElementById('address').value;
            var id_product = document.getElementById('id_product-input').value;
            var quantity  = document.getElementById('quantity-input').value;
            var sumcheckout = document.getElementById('sumcheckout-input').value;
            var checkoutsubmit = $(this).val();
            console.log(checkoutsubmit);
            $.ajax({
                url:'./controller/ajax/ajaxCheckout.php',
                type:"post",
                data:{
                    'checkoutsubmit':checkoutsubmit,
                    'namecustomer': namecustomer,
                    'phonenumber' : phonenumber,
                    'company':company,
                    'fax' : fax,
                    'address' : address,
                    'id_product' : id_product,
                    'quantity':quantity,
                    'sumcheckout':sumcheckout
                },
                success:function(fetch_result){
                    $('#checkout-result').html(fetch_result);           
                },
            })
        })
      
    </script>
    <script type="text/javascript">
        $('.slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
       

        });
    </script>
</body>
</html>