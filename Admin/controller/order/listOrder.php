<?php
   include "../connectDb.php";
   $accountadmin;
   $admininfo;
   session_start();
   if(isset($_SESSION['admin'])){
       $adminname = $_SESSION['admin'];
       $admininfo = getFullInfoAdmin($adminname);
       
   }
   else{
       header("location:../../login.php");
   }
      

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- FONT ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="../../assets/base.css">
    <link rel="stylesheet" href="../../assets/styles.css">
</head>
<body>
    <div class="container row">
        <div class="navbar--side">
            <div class="navbar-side-container">
                <h2>Admin</h2>
                <ul class="navbar--list">
                    <li class="navbar--items">
                        <a href="../../index.php" class="nav-items-link"><i class="fas fa-home"></i>Trang chủ</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../product/listProduct.php" class="nav-items-link"><i class="fas fa-tshirt product-logo"></i>Quản lí sản phẩm</a>
                    </li>
                    <li class="navbar--items">
                        <a href=""class="nav-items-link"><i class='bx bx-shopping-bag'></i>Quản lí đơn đặt hàng</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../category/category.php"class="nav-items-link"><i class="fas fa-tasks"></i>Danh mục thể loại</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../customer/listCustomer.php"class="nav-items-link"><i class='bx bx-group'></i>Khách hàng</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../../logout.php"class="nav-items-link"><i class='bx bx-group'></i>Logout temp</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../../login.php"class="nav-items-link"><i class='bx bx-group'></i>Login temp</a>
                    </li>
                    
                </ul>
            </div>
    </div>
    
    <div class="wrapper">
        <div class="top--wrapper">
            <div class="navbar--top">
                <div class="navbar--top__search">
                    <input type="text" name="search" id="search">
                    <button class="btn btn--search">Tìm đơn hàng</button>
                </div>
                <div class="navbar--top__admin">
                    <?php if(!empty($admininfo)) { ?>
                        <p><?php echo $admininfo['HoTenNV'] ?></p>    
                    <?php  } else{ ?> 
                        <p>Nguyen Hoai Tan</p>    
                    <?php  } ?> 
                    <div class="wrapper_avtadmin">
                        <img src="../../image/background/admin.png" class="avtadmin"alt="">
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="main-wrapper">
            <h2>Danh sách đơn hàng</h2>
            <div class="main--wrapper__product" >
                <table cellspacing=0 class="table--listproduct" id="list-fetch-order">
                    <tr class="table-row table-top-header">
                        <th>Mã Đơn</th>
                        <th>MSHH</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Giảm giá</th>
                        <th>Trạng Thái</th>
                        <th>Tùy chọn</th>    
                    </tr>
                </table>
            </div>
        </div>
        
    </div>
    </div>
    <script type="text/javascript"> 
        $(window).on('load',function(){
            
            $.ajax({
                url:'fetch_order.php',
                type:"post",
                success:function(fetch_result){
                    $('#list-fetch-order').html(fetch_result);
                    console.log('fetch order success');
                },
                
            });
            
                      
        })
    </script>
</body>

</html>