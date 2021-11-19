<?php
    include "../connectDb.php";
    session_start();
    $result;
    $user = array();
    $addressfetch = array();
    if(isset($_SESSION['user'])||!empty($_SESSION['user'])){
        $user = GetFullInfoUser($_SESSION['user']);
        $addressfetch = getAddressByUser($user['MSKH']);
    }
    if(!empty($_POST['checkoutsubmit'])){
              
        if(empty($_SESSION['user'])){
            $result= 1;
            // tao thong tin khach hang 
            $fax = isset($_POST['fax']) ? $_POST['fax'] : null;
            $company = isset($_POST['company']) ? $_POST['company'] : null;
            $mskh = uniqid('guest-',false);
            $hotenkh = $_POST['namecustomer'];
            $phonenumber = $_POST['phonenumber'];
            $address = $_POST['address'];
            createGuestUser($mskh,$hotenkh,$phonenumber,$fax,$company);

            //tao dia chi khach hang
            $madc = uniqid('guestDC-',false);
            createAddress($madc,$address,$mskh);
            //them vao table dat hang
            $sodondh = uniqid('DH-',false);
            $ngaydh=date("Y-m-d");
            $ngaygh=date('Y-m-d', strtotime($ngaydh. ' + 5 days'));
            $trangthaidh = 0;
            InsertOrder($sodondh,$mskh,$ngaydh,$ngaygh,$trangthaidh);

            //lay sodondh tu dat hang them vao chi tiet dat hang
            $quantity =$_POST['quantity'];
            $sumprice = $_POST['sumcheckout'];
            $giamgia =  isset($_POST['giamgia']) ? $_POST['giamgia'] : 0;
            $mshh = $_POST['id_product'];
            InsertOrderDetail($sodondh,$mshh,$quantity,$sumprice,$giamgia, $phonenumber,$madc);
            $product = getProductById($mshh);
            $newquantity = $product['SoLuongHang'] - $quantity;
            UpdateQuantity($newquantity,$mshh);

        }
        else{
            $result= 1;
            // tao thong tin khach hang 
            
            $mskh = $user['MSKH'];
            $madc = $_POST['address'];

            $fax = isset($_POST['fax']) ? $_POST['fax'] : null;
            $company = isset($_POST['company']) ? $_POST['company'] : null;
            $hotenkh = $_POST['namecustomer'];
            $phonenumber = $_POST['phonenumber'];
           

            //them vao table dat hang
            $sodondh = uniqid('DH-',false);
            $ngaydh=date("Y-m-d");
            $ngaygh=date('Y-m-d', strtotime($ngaydh. ' + 5 days'));
            $trangthaidh = 0;
            InsertOrder($sodondh,$mskh,$ngaydh,$ngaygh,$trangthaidh);

            //lay sodondh tu dat hang them vao chi tiet dat hang
            $quantity =$_POST['quantity'];
            $sumprice = $_POST['sumcheckout'];
            $giamgia =  isset($_POST['giamgia']) ? $_POST['giamgia'] : 0;
            $mshh = $_POST['id_product'];
            InsertOrderDetail($sodondh,$mshh,$quantity,$sumprice,$giamgia, $phonenumber,$madc);
            $product = getProductById($mshh);
            $newquantity = $product['SoLuongHang'] - $quantity;
            UpdateQuantity($newquantity,$mshh);
            
        }    
    }
?>  

    <div>
        <h1 class="result-checkout-title">Bạn đã thanh toán thành công</h1>
        <button class="continue-shopping"><a href="./product.php">Tiếp tục mua sắm</a></button>
        <img src="./image/background/checkoutSuccess.jpg" />
    </div>