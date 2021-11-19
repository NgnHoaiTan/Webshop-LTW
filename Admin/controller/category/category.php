
<?php
    require ("../connectDb.php");
    $data=array();
    $errors = array();
    $categories=getAllCategories();
     $accountadmin;
     $admininfo;
     session_start();
     if(isset($_SESSION['admin'])){
         $adminname = $_SESSION['admin'];
         $admininfo = getFullInfoAdmin($adminname);
         
     }
     else{
         header("location:login.php");
     }
    //Thêm category
    if(!empty($_GET['submit_add_category'])){
        $data['id_category_add'] = isset($_GET['id_category_add']) ? $_GET['id_category_add'] :"";
        $data['name_category_add'] = isset($_GET['name_category_add']) ? $_GET['name_category_add'] :"";
        if(empty($data['id_category_add'])){
            $errors['id_category_add']='Vui lòng nhập Mã loại hàng';
            echo'a';
        }
        
        if(empty($data['name_category_add'])){
            $errors['name_category_add']='Vui lòng nhập Tên loại hàng';
        }
        if(empty($errors)){
            insertCategory($data['id_category_add'], $data['name_category_add']);
            header("location:category.php");
        }
        disconnect_db();
    }
    //Sửa category
    if(!empty($_GET['submit_edit_category'])){
            
        $data['id_category_edit'] = isset($_GET['id_category_edit']) ? $_GET['id_category_edit'] :"";
        $data['name_category_edit'] = isset($_GET['name_category_edit']) ? $_GET['name_category_edit'] :"";
        if(empty($data['id_category_edit'])){
            $errors['id_category_edit']='Vui lòng nhập Mã loại hàng';
            echo'a';
        }
        
        if(empty($data['name_category_edit'])){
            $errors['name_category_edit']='Vui lòng nhập Tên loại hàng';
            echo'a';
        }
        if(empty($errors)){
            updateCategory($data['id_category_edit'], $data['name_category_edit']);
            header("location:category.php");
        }
        disconnect_db();
    }
    
    //Xóa category
    if(!empty($_GET['delCategory'])){
        deleteCategory($_GET['maloai']);
        disconnect_db();
        header("location:category.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách loại hàng</title>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- FONT ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- STYLE -->
    <link rel="stylesheet" href="../../assets/base.css">
    <link rel="stylesheet" href="../../assets/styles.css">
    <!-- Js -->
    
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
                        <a href="../customer/listCustomer.php"class="nav-items-link"><i class='bx bx-group'></i>Khách hàng</a>
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
        <div class="main-wrapper">
            <h1 class="title--category title-style">Danh mục thể loại sản phẩm</h1>
            <button class="btn btn__add add-category modal-open" data-modal="modal-add">Thêm loại hàng</button>
            <div class="main-wrapper__category grid grid-category row-justify-start">
                <?php foreach($categories as $item) { ?>
                <div class="category--content">
                    <div class="id-category"><?php echo $item['MaLoaiHang'] ?></div>
                    <div class="name-category"><p><?php echo $item['TenLoaiHang'] ?></p></div>
                    <div class="function-category">
                    <div class="row-justify-between">
                        <button class="btn btn__edit edit_category modal-open" data-modal="modal-edit" 
                                id-item='<?php echo $item['MaLoaiHang'] ?>' name-item='<?php echo $item['TenLoaiHang'] ?>'>Sửa</button>
                        <form action="category.php" method="GET">
                             <input type="hidden" name="maloai" value="<?php echo $item['MaLoaiHang']; ?>">
                            <input type="submit" name="delCategory" value="Xóa" class="btn btn__delete">
                        </form>
                    </div>
                        
                        
                    </div>
                </div>
                <?php } ?>    
            </div>
        </div>
        
        
    </div>
        <div class="modal-category" id="modal-add">
            <form action="category.php" method="GET" class="form-modal" id="form-add-category">
                <i class="fas fa-times close-form-icon close-modal"></i>
                <p class="title-form category-title">Thêm loại hàng</p>
                <label for="id_category_add">Mã Loại</label> <br>
                <input type="text" name="id_category_add" id="id_category_add"> <br>
                <label for="name_category_add">Tên Loại</label> <br>
                <input type="text" name="name_category_add" id="name_category_add">  
                <p class="cancel-add--category close-modal">Hủy</p>
                <input type="submit" name="submit_add_category" id="submit_add_category" value="Thêm">
            </form>
        </div>
        <div class="modal-category" id="modal-edit">
            <form action="category.php" method="GET" class="form-modal" id="form-edit-category">
                <i class="fas fa-times close-form-icon close-modal"></i>
                <p class="title-form category-title">Sửa loại hàng</p>
                <label for="id_category_edit">Mã Loại</label> <br>
                <input type="text" name="id_category_edit" id="id_category_edit" readonly="readonly"> <br>
                <label for="name_category_edit">Tên Loại</label> <br>
                <input type="text" name="name_category_edit" id="name_category_edit">  
                <p class="cancel-edit--category close-modal">Hủy</p>
                <input type="submit" name="submit_edit_category" id="submit_edit_category" value="Lưu">
            </form>
        </div>
        <script src="../../src/main.js"></script>
    </div>
    
</body>

</html>