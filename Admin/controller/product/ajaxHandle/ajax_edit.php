<?php
require ("../../connectDb.php");
$uploadsDir = '../../../image/upload/';
$allowedFileType = array('jpg','png','jpeg');
$categories = getAllCategories();
$Main_Images;
$Images;
$result_return;
    $id_product = isset($_POST['idproduct']) ? $_POST['idproduct'] : "";
    $name_product = isset($_POST['nameproduct']) ? $_POST['nameproduct'] : "";
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $price= isset($_POST['price']) ? $_POST['price'] : '';
    $quantity= isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] :''; 
    $avt = isset($_FILES['updatefileavt']['name'])?$_FILES['updatefileavt']['name']:"" ;
    $img = isset($_FILES['updatefileimg']['name']) ? $_FILES['updatefileimg']['name'] : "";
    if(!empty($id_product)||!empty($name_product)||!empty($category)||!empty($price)||!empty($quantity)||!empty($$description)){
        
        //update san pham
        $result_return = updateProduct($id_product,$name_product,$description,$price,$quantity,$category);
        
        //update image
        if(!empty($_FILES['updatefileimg']['name'])){
            foreach($_FILES['updatefileimg']['name'] as $key => $value){
                $filename = $_FILES['updatefileimg']['name'][$key]; // luu ten file
                $templocation = $_FILES['updatefileimg']['tmp_name'][$key]; //luu ten file tam thoi, tai C:\xampp\tmp\
                $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                $fileTargetPath = $uploadsDir.$filename;
                
                if(in_array($ext, $allowedFileType)){
                    
                    if(!file_exists($fileTargetPath)){
                        move_uploaded_file($templocation,$fileTargetPath);
                        $id_image = uniqid('MImG-',false);
                        insertImageProduct($id_image,$filename,$id_product);
                    }
                    else{                        
                        $filename = str_replace('.','-',basename($filename,$ext));
                        $newfilename = $filename.time().".".$ext;
                        $fileTargetPath = $uploadsDir.$newfilename;
                        move_uploaded_file($templocation,$fileTargetPath);
                    
                        $id_image = uniqid('MImG-',false);
                        insertImageProduct($id_image,$newfilename,$id_product);
                    }    
                }
            }
        }



}
//xoa img
    if(!empty($_POST['mahinh'])){
        $mahinh = $_POST['mahinh'];
        deleteImageByIdImg($mahinh);
    }

    $Images = getAnotherImage($id_product);
    $Main_Images = getImageMain($id_product);
    $product = getProductById($id_product)
?>
        <h2><?php $result_return  ?></h2>
 
    <form action="editProduct.php" method="POST" class="form--addproduct" id="form-edit-product" enctype="multipart/form-data">
                <h2>Cập nhật sản phẩm</h2>
                
                <div class="row-spacing">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" name="idproduct" id="idproduct" value="<?php echo $id_product ?>" class="input--addproduct" readonly>
                </div>
                <div class="row-spacing">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="nameproduct" value="<?php echo $product['TenHH']?>" id="nameproduct" class="input--addproduct" >
                </div>
                <div class="row-spacing">
                    <label for="">Thể loại</label>             
                    <select name="category" id="category">
                        <?php foreach($categories as $category) { ?>
                            <option value="<?php echo $category['MaLoaiHang'] ?>"><?php echo $category['TenLoaiHang'] ?></option>
                        <?php } ?>
                    </select>
                </div>

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
                        <?php foreach($Main_Images as $mimg){ ?>
                            <div class="show-main-img">
                                <img src="../../image/upload/<?php echo $mimg['TenHinh'] ?>" alt="<?php echo $mimg['MaHinh'] ?>" class="img-product-review">
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
                                <img src="../../image/upload/<?php echo $img['TenHinh'] ?>" alt="<?php echo $img['MaHinh'] ?>" class="img-product-review">
                                <button class="btn-deleteimg" name="deleteimg">Xóa</button>
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
                <input type="submit" class="submit-edit-product" value="Lưu">   
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