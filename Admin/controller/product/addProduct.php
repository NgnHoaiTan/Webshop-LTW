<?php
include '../connectDb.php';
session_start();
$categories = getAllCategories();
if(isset($_SESSION['admin'])){
    $adminname = $_SESSION['admin'];
    $admininfo = getFullInfoAdmin($adminname);
    
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
                        <a href="../../index.php" class="nav-items-link"><i class="fas fa-tshirt product-logo"></i>Trang chủ</a>
                    </li>
                    <li class="navbar--items">
                        <a href="../product/listProduct.php" class="nav-items-link"><i class="fas fa-tshirt product-logo"></i>Quản lí sản phẩm</a>
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
        <div class="main--wrapper__addproduct" id="result-add-product">
            <form action="" method="POST" class="form--addproduct" enctype="multipart/form-data" id="form-add-product">
                    <h2>Thêm sản phẩm</h2>
                    <div class="row-spacing">
                        <label for="">Mã sản phẩm</label>
                        <input type="text" name="idproduct" id="idproduct" class="input--addproduct" value="<?php echo uniqid('SP-',false); ?>" required readonly>
                    </div>
                    <div class="row-spacing">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="nameproduct" id="nameproduct" class="input--addproduct"  required>
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
                        <input type="text" name="price" id="price"  class="input--addproduct" required>
                    </div>
                    <!-- <div class="row-spacing">
                        <label for="">Giảm giá</label>
                        <input type="text" name="discount" id="discount" class="input--addproduct"  required>
                    </div> -->
                    <div class="row-spacing">
                        <label for="">Số lượng hàng</label>
                        <input type="text" name="quantity" id="quantity" required>
                    </div>
                    <div class="row-spacing">
                        <label for="description">Mô tả sản phẩm</label>
                        <textarea name="description" id="description" cols="30" rows="10"><?php echo "nhập mô tả sản phẩm" ?></textarea>
                    </div>
                    <div class="row-spacing">
                        <label for="">Ảnh đại diện sản phẩm</label>
                        <input type="file" name="avtImgProduct" id="fileImgProduct" required>
                        
                    </div>
                    <div class="row-spacing">
                        <label for="">Ảnh khác</label>
                        <input type="file" name="fileImgProduct[]" id="fileImgProduct" multiple>
                    </div>

                    
                    <br>
                    <script>
                        function goBack(){
                            window.history.back();
                        }
                    </script>
                    <button class="goback-btn" onclick="goBack()">Trở về</button>
                    <input type="submit" name="submit-add-product" id="submit-add-product" value="Thêm" />
                </form>
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
            
        </div>
        
    </div>
    <script type="text/javascript">
         $(document).ready(function(){
            $('#form-add-product').on('submit',function(e){
            e.preventDefault();
            
            var submit = $('#submit-add-product').val();      
            var id_product=$('#idproduct').attr('value');
            var name_product=$('#nameproduct').val();
            var category=$('#category').val();
            var price=$('#price').val();
            var quantity=$('#quantity').val();
            var description=$("#description").val();
            var form_data = new FormData($('#form-add-product')[0]);
           
            $.ajax({
                url:'./ajaxHandle/ajax_add.php',
                type:"post",
                data: form_data,
                contentType:false,
                processData:false,
                success:function(result){
                    $('#result-add-product').html(result);
                }
            })
        })
        })
    </script>
    </div>
</body>
</html>