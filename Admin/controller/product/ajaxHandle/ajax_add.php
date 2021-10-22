<?php
     require ("../../connectDb.php");
     $uploadsDir = '../../../image/upload/';
     $allowedFileType = array('jpg','png','jpeg');
     $returnvalue='';

        $id_product = isset($_POST['idproduct']) ? $_POST['idproduct'] : "";
        $name_product = isset($_POST['nameproduct']) ? $_POST['nameproduct'] : "";
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $price= isset($_POST['price']) ? $_POST['price'] : '';
        $quantity= isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] :''; 
        $avt = $_FILES['avtImgProduct']['name'] ;
        $img = $_FILES['fileImgProduct']['name'];

     if(!empty($id_product)||!empty($name_product)||!empty($category)||!empty($price)||!empty($quantity)||!empty($$description)){
        
        $returnvalue = insertProduct($id_product,$name_product,$description,$price, $quantity,$category);
         //Ảnh đại diện sản phẩm
         if(!empty($_FILES['avtImgProduct']['name'])){
             //foreach($_FILES['avtImgProduct']['name'] as $key => $value){
                 $filename = $_FILES['avtImgProduct']['name']; // luu ten file
                 $templocation = $_FILES['avtImgProduct']['tmp_name']; //luu ten file tam thoi, tai C:\xampp\tmp\
                 
                 $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                 $filename = str_replace('/','0',$filename);
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
                 else{
                     $returnvalue = 0;
                 }
             //}
         }
        //  // các ảnh liên quan khác
        //  if(!empty($_FILES['fileImgProduct']['name']))
        //  {
        //      foreach($_FILES['fileImgProduct']['name'] as $key => $value){
        //          $filename = $_FILES['fileImgProduct']['name'][$key]; // luu ten file
        //          $templocation = $_FILES['fileImgProduct']['tmp_name'][$key]; //luu ten file tam thoi, tai C:\xampp\tmp\
        //          $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        //          $fileTargetPath = $uploadsDir.$filename;
        //          $finalfilename='';
                 
        //          if(in_array($ext, $allowedFileType)){
                     
        //              if(!file_exists($fileTargetPath)){
                         
        //                  move_uploaded_file($templocation,$fileTargetPath);
        //                  $finalfilename = $fileTargetPath;
        //              }
        //              else{
                         
        //                  $filename = str_replace('.','-',basename($filename,$ext));
        //                  $newfilename = $filename.time().".".$ext;
        //                  $fileTargetPath = $uploadsDir.$newfilename;
        //                  move_uploaded_file($templocation,$fileTargetPath);
        //                  $finalfilename = $fileTargetPath;
        //              }
        //              $id_image = uniqid('ImG-',false);
        //              insertImageProduct($id_image,$finalfilename,$data['idproduct']);
                     
        //          }
        //          else{
        //              $response = array(
        //                  "status" => "alert-danger",
        //                  "message" => "Only .jpg, .jpeg and .png file formats allowed."
        //              );
        //          }
        //      }
        //  }
         disconnect_db();
        }

?>
        <?php if($returnvalue) {?>
                <h2>add product success <?php echo $returnvalue ?></h2>
        <?php }else{ ?>
                <h2>add product failed<?php echo $returnvalue ?></h2>
        <?php  } ?>
                