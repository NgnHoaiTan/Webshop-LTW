<?php
    include "../connectDb.php";
    session_start();
    $result;
    if(!empty($_POST['checkoutsubmit'])){
              
        if(empty($_SESSION['customer'])){
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
            InsertOrderDetail($sodondh,$mshh,$quantity,$sumprice,$giamgia, $phonenumber,$address);
            // if(isset($_SESSION['cart'])){
            //     for($i=0;$i<count($_SESSION['cart']);$i++){
            //         if($_SESSION['cart'][$i]['id_product'] == $mshh){
            //             //$_SESSION['cart'][$i]['id_product'] =null;
            //             unset($_SESSION['cart'][$i]['id_product']);
            //         }
            //     }
            // }

        }    
    }
?>  

    <div>
        <h1 class="result-checkout-title">Bạn đã thanh toán thành công</h1>
        <button class="continue-shopping"><a href="./product.php">Tiếp tục mua sắm</a></button>
        <img src="./image/background/checkoutSuccess.jpg" />
    </div>