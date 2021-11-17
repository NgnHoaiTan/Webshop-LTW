<?php
    global $conn;
    header("Content-type: text/html; charset=utf-8");
    
    function connect_db(){
        $localhost='localhost';
        $username='root';
        $password='';
        $dbname='webshop';
        global $conn;
        $conn = mysqli_connect($localhost,$username,$password,$dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        
            mysqli_set_charset($conn,'utf8');
        
    }
    function disconnect_db(){
        global $conn;
        if($conn){
            mysqli_close($conn);
        }
    }
    function getListAllProduct(){
        global $conn;
        connect_db();
        $sql = "SELECT a.MSHH,a.TenHH,a.Gia,b.MaHinh,b.TenHinh FROM hanghoa a inner join hinhhanghoa b where b.MSHH = a.MSHH and b.MaHinh LIKE 'MImg%'";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data){
            while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    function getListAllProductOrderByPrice(){
        global $conn;
        connect_db();
        $sql = "SELECT a.MSHH,a.TenHH,a.Gia,b.MaHinh,b.TenHinh FROM hanghoa a inner join hinhhanghoa b where b.MSHH = a.MSHH and b.MaHinh LIKE 'MImg%'
        ORDER BY a.Gia ASC
        ";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data){
            while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    function getListAllProductOrderByNewest(){
        global $conn;
        connect_db();
        $sql = "SELECT a.MSHH,a.TenHH,a.Gia,b.MaHinh,b.TenHinh FROM hanghoa a inner join hinhhanghoa b where b.MSHH = a.MSHH and b.MaHinh LIKE 'MImg%'
        ORDER BY a.DateCreated ASC
        ";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data){
            while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    function getListAllProductBySearching($searchStr){
        global $conn;
        connect_db();
        $sql = "SELECT a.MSHH,a.TenHH,a.Gia,b.MaHinh,b.TenHinh FROM hanghoa a inner join hinhhanghoa b where b.MSHH = a.MSHH and b.MaHinh LIKE 'MImg%'
        and a.TenHH LIKE '%$searchStr%'
        ";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data){
            while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    
    function getProductToFetchCart($id_product){
        global $conn;
        connect_db();
        $sql="SELECT * FROM hanghoa a inner join hinhhanghoa b WHERE a.MSHH = '$id_product'
            and b.MSHH = a.MSHH
            and b.MaHinh LIKE 'MImg%'
            ";
        
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            while($row = mysqli_fetch_assoc($data)){
                $result[] = $row;
            }
        };
        return $result;
    }

    // ------------------Checkout-----------------//
    // Tạo thông tin khách hàng vãng lai
    function createGuestUser($MSKH,$hotenkh, $phonenumber,$sofax,$tencongty){
        global $conn;
        connect_db();
        $sql="INSERT INTO khachhang(MSKH,HoTenKH,SoDienThoai,SoFax,TenCongTy) 
            values(
                '$MSKH',
                '$hotenkh',
                '$phonenumber',
                '$sofax',
                '$tencongty'
            )";
        
        $quey = mysqli_query($conn, $sql);
       
        return $quey;
    }
    // Tạo thông tin địa chỉ
    function createAddress($MaDC,$DiaChi, $MSKH){
        global $conn;
        connect_db();
        $sql="INSERT INTO diachikh(MaDC,DiaChi,MSKH) 
            values(
                '$MaDC',
                '$DiaChi',
                '$MSKH'
            )";
        
        $quey = mysqli_query($conn, $sql);
       
        return $quey;
    }
    function InsertOrder($sodondh,$mskh,$ngaydh,$ngaygh,$trangthai){
        global $conn;
        connect_db();
        $sql="INSERT INTO DatHang(SoDonDH,MSKH,NgayDH,NgayGH,TrangThaiDH) 
            values(
                '$sodondh',
                '$mskh',
                '$ngaydh',
                '$ngaygh',
                '$trangthai'
            )";
        
        $quey = mysqli_query($conn, $sql);
       
        return $quey;
    }
    function InsertOrderDetail($sodondh,$mshh,$soluong,$giadathang,$giamgia,$phonenumber,$id_address){
        global $conn;
        connect_db();
        $sql="INSERT INTO ChiTietDatHang(SoDonDH,MSHH,SoLuong,GiaDatHang,GiamGia,SoDienThoai,MaDC) 
            values(
                '$sodondh',
                '$mshh',
                '$soluong',
                '$giadathang',
                '$giamgia',
                '$phonenumber',
                '$id_address'
                
            )";
        
        $quey = mysqli_query($conn, $sql);
       
        return $quey;
    }

    // -------------------------------Product detail ------------------------------
    function getProductById($id_product){
        global $conn;
        connect_db();
        
        $sql = "SELECT * FROM hanghoa WHERE 
            MSHH='$id_product'
            ";
        $data = mysqli_query($conn, $sql);
        $result = array();
        
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        else{
            echo "error fetch";
        }
        return $result;
    }
    function getAllImageByIdProduct($id_product){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hinhhanghoa WHERE MSHH='$id_product' ";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    function getMImagebyIdproduct($id_product){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hinhhanghoa WHERE MSHH='$id_product' and MaHinh LIKE 'MImg%'";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    function getAnotherImagebyIdproduct($id_product){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hinhhanghoa WHERE MSHH='$id_product' and MaHinh NOT LIKE 'MImg%'";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    // --------------------Login site --------------------
    function verifyAccountAdmin($adminname,$password)
    {
        global $conn;
        connect_db();
        $sql = "SELECT * FROM accountnv WHERE TKhoan='$adminname' and MKhau='$password'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        
        return $result;
    }
    function verifyAccountUser($username,$password)
    {
        global $conn;
        connect_db();
        $sql = "SELECT * FROM accountkh WHERE TK='$username' and MK='$password'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        
        return $result;
    }
    function getAccountUserByTK($username){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM accountkh WHERE TKhoan='$username'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        
        return $result;
    }
    function GetFullInfoUser($username){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM khachhang WHERE TK='$username'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        
        return $result;
    }
    function GetFullInfoUserById($id_customer){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM khachhang WHERE MSKH='$id_customer'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        
        return $result;
    }
    // ------------------------ PROFILE ------------------------------
    function getAddressByUser($MSKH)
    {
        global $conn;
        connect_db();
        $sql = "SELECT * FROM diachikh WHERE MSKH='$MSKH'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        
        return $result;
    }
    function updateInfoUser($iduser, $fullname, $phonenumber,$company, $fax){
        global $conn;
        connect_db();
        $sql = "UPDATE khachhang SET
        HoTenKH = '$fullname',
        SoDienThoai ='$phonenumber',
        TenCongTy ='$company',
        SoFax ='$fax'     
        WHERE MSKH = '$iduser'
        ";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    function uploadAvatar($avtname, $iduser){
        global $conn;
        connect_db();
        $sql = "UPDATE khachhang SET
        Avatar ='$avtname'  
        WHERE TK = '$iduser'
        ";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    function getListOrderByCustomer($iduser){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM dathang a inner join chitietdathang b WHERE a.MSKH = '$iduser'
        and b.SoDonDH = a.SoDonDH
        ";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        
        return $result;
    }
    function getListFeedbackByProduct($id_product){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM feedback where MSHH = '$id_product'
        ";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        
        return $result;
    }
    function insertFeedback($id_feedback, $iduser, $id_product, $dateupfb, $content)
    {
        global $conn;
        connect_db();
        $sql="INSERT INTO feedback(Id_feedback,MSKH,MSHH,NgayFB,Noidung) 
            values(
                '$id_feedback',
                '$iduser',
                '$id_product',
                '$dateupfb',
                '$content'
            )";
        
        $quey = mysqli_query($conn, $sql);
       
        return $quey;
    }
    // -------------------------Register-----------------------------------
    function Register($username, $password){
        global $conn;
        connect_db();
        $sql="INSERT INTO accountkh(TK,MK) 
            values(
                '$username',
                '$password'   
            )";
        
        $quey = mysqli_query($conn, $sql);
       
        return $quey;
    }
    function CheckExistusername($username){
        global $conn;
        connect_db();
        $sql="SELECT * FROM accountkh
            WHERE TK='$username'
            ";
       $data = mysqli_query($conn,$sql);
       $result = array();
       if($data && mysqli_num_rows($data)>0){
           $row = mysqli_fetch_assoc($data);
           $result = $row;
       }
       
       return $result;
    }
    function CheckExistAccount($username,$password){
        global $conn;
        connect_db();
        $sql="SELECT * FROM accountkh
            WHERE TK='$username' and 
            MK='$password'
            ";
       $data = mysqli_query($conn,$sql);
       $result = array();
       if($data && mysqli_num_rows($data)>0){
           $row = mysqli_fetch_assoc($data);
           $result = $row;
       }
       
       return $result;
    }
    function CheckExistCustomer($username, $phonenumber){
        global $conn;
        connect_db();
        $sql="SELECT * FROM accountkh a inner join khachhang b
            WHERE a.TK='$username' and
            b.TK = a.TK and
            b.SoDienThoai ='$phonenumber'
            ";
       $data = mysqli_query($conn,$sql);
       $result = array();
       if($data && mysqli_num_rows($data)>0){
           $row = mysqli_fetch_assoc($data);
           $result = $row;
       }
       return $result;
    }
    function UpdatePassword($username,$password){
        global $conn;
        connect_db();
        $sql = "UPDATE accountkh SET
        MK = '$password'
        WHERE TK='$username'
        ";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    function CreateCustomer($iduser, $username, $fullname, $phonenumber){
        global $conn;
        connect_db();
        $sql="INSERT INTO khachhang(MSKH,TK,HoTenKH, SoDienThoai) 
            values(
                '$iduser',
                '$username',
                '$fullname',
                '$phonenumber'   
            )";
        
        $quey = mysqli_query($conn, $sql);
       
        return $quey;
    }

?>