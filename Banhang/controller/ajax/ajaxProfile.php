<?php
    include "../connectDb.php";
    session_start();
    $result=0;
    if(!empty($_SESSION['user'])){
        
        $id_user = $_SESSION['user'];
        $result = $id_user;
        if(!empty($_FILES['file']['name'])){
            
            $uploadsDir = '../../image/user/';
            $allowedFileType = array('jpg','png','jpeg');
    
            $filename = $_FILES['file']['name']; // luu ten file
            $templocation = $_FILES['file']['tmp_name']; //luu ten file tam thoi, tai C:\xampp\tmp\
            
            $ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
            $filename = str_replace('/','0',$filename);
            $fileTargetPath = $uploadsDir.$filename;
            
            if(in_array($ext, $allowedFileType)){
                if(!file_exists($fileTargetPath)){
                    
                    move_uploaded_file($templocation,$fileTargetPath);
                    uploadAvatar($filename,$id_user);
                }
                else{
                    $filename = str_replace('.','-',basename($filename,$ext));
                    $newfilename = $filename.time().".".$ext;
                    $fileTargetPath = $uploadsDir.$newfilename;
                    move_uploaded_file($templocation,$fileTargetPath);
                   
                    $id_image = uniqid('MImG-',false);
                    uploadAvatar($filename,$id_user);
                }
                
                   
            }
        }
        
    }
    else{
        header("location:index.php");
    }
    // người dùng cập nhật thông tin
    if(isset($_POST['update-user'])){
        $fullname = $_POST['fullname'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address-add'];
        $company = $_POST['company-user'];
        $fax = $_POST['fax-user'];
        $id_user = $_POST['id-user'];  
        updateInfoUser($id_user,$fullname,$phonenumber,$company,$fax);
        if(!empty($address)){
            $madc = uniqid('DC-',false);
            createAddress($madc, $address,$id_user);
        }
        
    }
?>