<?php
    require ("../connectDb.php");
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
    
    $data = array();
    $product;
    $categories = getAllCategories();
    $Main_Images;
    $Images;
    if(!empty($_GET['edit_product'])){
        $data['id_product'] = isset($_GET['id_product']) ? $_GET['id_product'] : "";
        $product = getProductById($data['id_product']);
        $Images = getAnotherImage($data['id_product']);
        $Main_Images = getImageMain($data['id_product']);
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- FONT ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- STYLE -->
    <link rel="stylesheet" href="../../assets/base.css">
    <link rel="stylesheet" href="../../assets/styles.css">
    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- <script src="../src/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
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
                        <a href="" class="nav-items-link"><i class="fas fa-tshirt product-logo"></i>Quản lí sản phẩm</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../product/listProduct.php"class="nav-items-link"><i class='bx bx-shopping-bag'></i>Quản lí đơn đặt hàng</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../category/category.php"class="nav-items-link"><i class="fas fa-tasks"></i>Danh mục thể loại</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../customer/listCustomer.php"class="nav-items-link"><i class='bx bx-group'></i>Khách hàng</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../../logout.php"class="nav-items-link"><i class='bx bx-group'></i>Logout</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../../login.php"class="nav-items-link"><i class='bx bx-group'></i>Login</a>
                    </li>
                </ul>
            </div>
    </div>
    <div class="wrapper">
        <!-- <div class="top--wrapper">
            <div class="navbar--top">
                 <div class="navbar--top__search">
                    <input type="text" name="search" id="search">
                    <button class="btn btn--search">Tìm tên sản phẩm</button>
                </div> -->
                <!-- <div class="navbar--top__admin">
                    <p>Nguyen Hoai Tan</p>     
                    <i class="fas fa-user-tie logo-admin"></i>
                </div>
            </div>
        </div> -->
        <div class="main--wrapper__editproduct">
            <div id="result-edit-product">
            <form action="editProduct.php" method="POST" class="form--addproduct" id="form-edit-product" enctype="multipart/form-data">
                <h2>Cập nhật sản phẩm</h2>
                
                <div class="row-spacing">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" name="idproduct" id="idproduct" value="<?php echo $product['MSHH'] ?>" class="input--addproduct" readonly>
                </div>
                <div class="row-spacing">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="nameproduct" value="<?php echo $product['TenHH'] ?>" id="nameproduct" class="input--addproduct" >
                </div>
                <div class="row-spacing">
                    <label for="">Thể loại</label>             
                    <select name="category" id="category">
                        <?php foreach($categories as $category) { ?>
                            <option value="<?php echo $category['MaLoaiHang'] ?>"><?php echo $category['TenLoaiHang'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- <div class="row-spacing">
                    <label for="">Hãng sản xuất</label>                
                    <select name="brand" id="brand">
                        <option value="Hãng 1">Hãng 1</option>
                        <option value="Hãng 2">Hãng 2</option>
                        <option value="Hãng 3">Hãng 3</option>
                        <option value="Hãng Khác">Khác</option>
                    </select>
                </div> -->
                <div class="row-spacing">
                    <label for="">Giá</label>
                    <input type="text" name="price" id="price"value="<?php echo $product['Gia'] ?>"  class="input--addproduct" >
                </div>
                <div class="row-spacing">
                    <label for="">Giảm giá</label>
                    <input type="text" name="discount" id="discount" class="input--addproduct" >
                </div>
                <div class="row-spacing">
                    <label for="">Số lượng hàng</label>
                    <input type="text" name="quantity" id="quantity"value="<?php echo $product['SoLuongHang'] ?>" >
                </div>
                
                <div class="row-spacing">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" id="description" cols="30" rows="10"><?php echo $product['QuyCach'] ?></textarea>
                </div>
                <div class="row-spacing ">
                    <label for="">Ảnh đại diện sản phẩm</label>
                    <div class="main-img-product ">
                        <?php foreach($Main_Images as $img){ ?>
                            <div class="show-main-img">
                                <img src="../../image/upload/<?php echo $img['TenHinh'] ?>" Mahinh="<?php echo $img['MaHinh'] ?>" class="img-product-review">
                                <button class="btn-deleteimg" name="deleteimg">Xóa</button>
                            </div>
                            
                        <?php } ?>
                    </div>
                </div>


                <div class="row-spacing img-product-bgcolor">
                    <label for="">Một số ảnh sản phẩm khác</label>
                    <div class="img-product grid-container ">
                        <?php foreach($Images as $img){ ?>
                            <div class="show-img">
                                <img src="../../image/upload/<?php echo $img['TenHinh'] ?>" Mahinh="<?php echo $img['MaHinh'] ?>" class="img-product-review">
                                <button class="btn-deleteimg" name="deleteimg" trigger="Xóa">Xóa</button>
                
                            </div>
                            
                            
                        <?php } ?>
                    </div>
                </div>

                
                <div class="row-spacing img-product-bgcolor">
                    <label for="updatefileavt">Thêm ảnh đại diện</label>
                    <input type="file" name="updatefileavt" id="editMImage" >
                    
                </div>
                <div class="row-spacing img-product-bgcolor">
                    <label for="updatefileimg[]">Thêm ảnh sản phẩm</label>
                    <input type="file" name="updatefileimg[]" id="editImage" multiple>
                </div>
                <br>  
                <button class="goback-btn" onclick="goBack()">Trở về</button>
                <input type="submit" class="submit-edit-product" name='submit-edit-product'value="Lưu">
                 
            </form>
            </div>
            <script>
                function goBack(){
                    window.history.back();
                }
            </script>
           
            
        </div>
        <script>
                ClassicEditor
                    .create( document.querySelector( '#description' )
                    , {
					
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'outdent',
                            'indent',
                            '|',
                            'imageUpload',
                            'blockQuote',
                            'insertTable',
                            'mediaEmbed',
                            'undo',
                            'redo'
                        ]
                    },
                    language: 'vi',
                    image: {
                        toolbar: [
                            'imageTextAlternative',
                            'imageStyle:inline',
                            'imageStyle:block',
                            'imageStyle:side'
                        ]
                    },
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    },
                        licenseKey: '',
                        
                        
                        
                    } )
                    .then( editor => {
                        window.editor = editor;
                
                        
                        
                        
                    }
                    )
                    
                    .catch( error => {
                        console.error( error );
                } );
               
            </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click','.submit-edit-product',function(e){
                    e.preventDefault();
                    var formData = new FormData($('#form-edit-product')[0])
                    // for(var pair of formData.entries()) {
                    //     console.log(pair[0]+ ', '+ pair[1]); 
                    //     }

                    $.ajax({
                        url:"./ajaxHandle/ajax_edit.php",
                        type:"POST",                       
                        data: formData,
                        contentType:false,
                        processData:false,
                        success: function(result){    
                            $('#result-edit-product').html(result);
                            console.log('success edit');                           
                        }
                    })
                })
                $(document).on('click','.btn-deleteimg',function(e){
                    e.preventDefault();
                    var mahinh = $('.img-product-review').attr('Mahinh');
                    console.log('delete image:'.$('#idproduct').val());
                    $.ajax({
                        url:'./ajaxHandle/ajax_edit.php',
                        type:'post',
                        data:{
                            'mahinh':mahinh,
                            'idproduct':$('#idproduct').val(),
                        },
                        success:function(result){
                            $('#result-edit-product').html(result);
                        }
                    })
                })

            })
        </script>
        
    </div>
    </div>
</body>

</html>