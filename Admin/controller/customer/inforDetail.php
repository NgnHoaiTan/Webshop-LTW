<?php
    include "../connectDb.php";
    $accountadmin;
    $admininfo;
    $customer;
    $addressfetch;
    session_start();
    if(isset($_SESSION['admin'])){
        $adminname = $_SESSION['admin'];
        $admininfo = getFullInfoAdmin($adminname);
        
    }
    else{
        header("location:login.php");
    }
    if(!empty($_GET['id-customer']) || isset($_GET['id-customer'])){
        $customer = getCustomerById($_GET['id-customer']);
        $addressfetch = getAddressByUser($_GET['id-customer']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết khách hàng</title>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- FONT ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- STYLES -->
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
                        <a href="../../index.php" class="nav-items-link"><i class="fas fa-tshirt product-logo"></i>Trang chủ</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../product/listProduct.php?page=1&per_page=20" class="nav-items-link"><i class="fas fa-tshirt product-logo"></i>Quản lí sản phẩm</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../order/listOrder.php"class="nav-items-link"><i class='bx bx-shopping-bag'></i>Quản lí đơn đặt hàng</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../category/category.php"class="nav-items-link"><i class="fas fa-tasks"></i>Danh mục thể loại</a>
                    </li>
                    <li class="navbar--items">
                        <a href=""class="nav-items-link"><i class='bx bx-group'></i>Khách hàng</a>
                    </li>
                    <?php if(!empty($_SESSION['admin']) && isset($_SESSION['admin'])) {?>
                    <li class="navbar--items">
                        <a href="../../logout.php"class="nav-items-link"><i class='bx bx-group'></i>Logout</a>
                    </li>
                    <?php }else { ?>
                    <li class="navbar--items">
                        <a href="../../login.php"class="nav-items-link"><i class='bx bx-group'></i>Login</a>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
    
        <div class="wrapper">
            <div class="top--wrapper">
                <div class="navbar--top">
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
            <div class="container-customer-detail">
                <div class="wrapper-customer-detail">
                    <?php if(!empty($customer)) { ?>
                    <div class="avatar-customer">
                        <div class="avatar-wrapper">
                            <?php if(!empty($customer['Avatar'])){ ?>
                                <img src="../../../../B1805914_NguyenHoaiTan/Banhang/image/user/<?php echo $customer['Avatar'] ?>" alt="">
                            <?php }else{ ?>
                                <img src="../../../../B1805914_NguyenHoaiTan/Banhang/image/user/user1.jpg" alt="">
                            <?php } ?>
                        </div>
                        <p class="name-customer-info"><?php echo $customer['HoTenKH'] ?></p>    
                    </div>
                    <div class="wrapper-list-info">
                        <div class="list-info">
                            <div class="list-info-row">
                                <p class="list-info-title">Số điện thoại: </p>
                                <p class="content-info"><?php echo $customer['SoDienThoai'] ?></p>
                            </div>
                            <div class="list-info-row">
                                <p class="list-info-title">Địa chỉ: </p>
                                
                                <div class="dropdown">
                                    <div class="dropdown-list-address">
                                        <?php if(!empty($addressfetch)){
                                            foreach($addressfetch as $item){
                                            ?>
                                        <div class="dropdown-item-address">
                                            <p><?php echo $item['DiaChi'] ?></p>
                                            <hr>
                                        </div>
                                        <?php }}
                                        else{ ?>
                                            <div class="dropdown-item-address">
                                                <p>Người dùng chưa có địa chỉ nào</p>
                                            </div>
                                        <?php } ?>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="list-info-row">
                                <p class="list-info-title">Công ty: </p>
                                <p class="content-info"><?php echo $customer['TenCongTy'] ?></p>
                            </div>
                            <div class="list-info-row">
                                <p class="list-info-title">Số Fax: </p>
                                <p class="content-info"><?php echo $customer['SoFax'] ?></p>
                            </div>
                            
                            
                        </div> 
                    </div>
                            
                    <?php } ?>
                </div>
            </div>
            
        
        </div>
    </div>
</body>
</html>