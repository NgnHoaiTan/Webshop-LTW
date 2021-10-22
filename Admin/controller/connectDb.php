<?php
    global $conn;
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



    // ==========================================CATEGORY====================================//


    function getCategoryById($category_id){
        global $conn;
        connect_db();
        $sql="SELECT FROM loaihanghoa WHERE MaLoaiHang='$category_id' ";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        return $result;
    }
    function getAllCategories(){
        global $conn;
        connect_db();
        $sql="SELECT *FROM loaihanghoa";
        $data = mysqli_query($conn,$sql);
        $result=array();
        if($data && $data->num_rows>0){
            while($row = mysqli_fetch_assoc($data)){
                $result[] = $row;
            }
        }
        return $result;
    }
    function insertCategory($category_id, $category_name){
        global $conn;
        connect_db();
        $sql = "INSERT INTO loaihanghoa(MaLoaiHang,TenLoaiHang) VALUES (
            '$category_id',
            '$category_name'
            )";
        $query = mysqli_query($conn,$sql);
        return $query;
    }
    function updateCategory($category_id, $category_name){
        global $conn;
        connect_db();
        $sql = "UPDATE loaihanghoa SET
        TenLoaiHang = '$category_name'
        WHERE MaLoaiHang = '$category_id'
        ";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    function deleteCategory($category_id){
        global $conn;
        connect_db();
        $sql = "DELETE FROM loaihanghoa  WHERE MaLoaiHang='$category_id' ";
        $query = mysqli_query($conn,$sql);
        return $query;
    }
    function getNameCategoryById($category_id){
        global $conn;
        connect_db();
        $sql = "SELECT TenLoaiHang FROM loaihanghoa WHERE MaLoaiHang='$category_id'";
        $data = mysqli_query($conn, $sql);
        $result=array();
        if($data && mysqli_num_rows($data)>0){
            $result = mysqli_fetch_assoc($data);
        }
        return $result;
    }




    // =================================QUERY PRODUCT ==================================//
    


    function getAllProducts(){
        global $conn;
        connect_db();
        $sql = "SELECT *FROM hanghoa" ; 
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)){
                $result[] = $row;
            }
        }
        disconnect_db();
        return $result;
    }
    function getAllProductsWithAssociation(){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hanghoa a INNER JOIN loaihanghoa b WHERE
         b.MaLoaiHang = a.MaLoaiHang
        " ; 
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)){
                $result[] = $row;
            }
        }
        disconnect_db();
        return $result;
    }
    function getProductByIdWithImage($product_id){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hanghoa a INNER JOIN loaihanghoa b,hinhhanghoa c WHERE 
            a.MSHH='$product_id'
            and b.MaLoaiHang = a.MaLoaiHang 
            or c.MSHH = a.MSHH 
            ";
        echo $sql;
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        return $result;
    }
    function getProductById($product_id){
        global $conn;
        connect_db();
        
        $sql = "SELECT * FROM hanghoa WHERE 
            MSHH='$product_id'
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
    function insertProduct($product_id,$product_name, $description, $price, $quantity, $category_id){
        global $conn;
        connect_db();
        $sql = "INSERT INTO hanghoa(MSHH,TenHH, QuyCach, Gia, SoLuongHang,MaLoaiHang) VALUES (
            '$product_id',
            '$product_name', 
            '$description', 
             $price, 
             $quantity, 
            '$category_id'
            )";
        $query = mysqli_query($conn,$sql);
        
        return $query;
    }
    function updateProduct($product_id, $product_name, $description, $price, $quantity, $category_id){
        global $conn;
        connect_db();
        $sql = "UPDATE hanghoa SET
        TenHH = '$product_name',
        QuyCach = '$description',
        Gia = $price,
        SoLuongHang = $quantity,
        MaLoaiHang = '$category_id'
        WHERE MSHH = '$product_id'
        ";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    function deleteProduct($product_id){
        global $conn;
        connect_db();
        $sql = "DELETE FROM hanghoa  WHERE MSHH='$product_id' ";
        $query = mysqli_query($conn,$sql);

        return $query;
    }




    //========================QUERY IMAGE PRODUCT==========================//





    function getImagesByProduct($product_id){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hinhhanghoa WHERE MSHH='$product_id'";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    } 
    function getAnotherImage($product_id){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hinhhanghoa WHERE MaHinh NOT LIKE 'MImg%' and MSHH ='$product_id'";
        $data = mysqli_query($conn, $sql);
        
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    function getImageMain($product_id){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM hinhhanghoa WHERE MaHinh LIKE 'MImg%' and MSHH ='$product_id'";
        $data = mysqli_query($conn, $sql);
        
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
    function insertImageProduct($image_id,$image_name, $product_id){
        global $conn;
        connect_db();
        $sql = "INSERT INTO hinhhanghoa(MaHinh,TenHinh, MSHH) VALUES (
            '$image_id',
            '$image_name',
            '$product_id'
            )";
        $query = mysqli_query($conn,$sql);
        return $query;
    }
    function updateImageProduct($image_id,$image_name, $product_id){
        global $conn;
        connect_db();
        $sql = "UPDATE hinhhanghoa SET
        TenHinh = '$image_name',
        MSHH = $product_id'
        WHERE MaHinh = '$image_id'
        ";
        $query = mysqli_query($conn, $sql);
        return $query;
    }
    function deleteImageByProduct($product_id){
        global $conn;
        connect_db();
        $sql = "DELETE FROM hinhhanghoa  WHERE MSHH='$product_id' ";
        $query = mysqli_query($conn,$sql);
        return $query;
    }
    function deleteImageByIdImg($image_id){
        global $conn;
        connect_db();
        $sql = "DELETE FROM hinhhanghoa  WHERE MaHinh='$image_id' ";
        $query = mysqli_query($conn,$sql);
        
        return $query;
    }

    // =========================== DISCOUNT QUERY ======================//

    //============================ Admin query account ================== //

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
    function getAccountAdminByTK($adminname){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM accountnv WHERE TKhoan='$adminname'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        
        return $result;
    }
    function GetFullInfoAdmin($adminname){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM nhanvien WHERE TKhoan='$adminname'";
        $data = mysqli_query($conn,$sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            $result = $row;
        }
        
        return $result;
    }
    // <!------------------- Đơn hàng ---------------------->

    function getAllOrder(){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM dathang";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }

    // ----------------- Khách hàng --------------------
    function getAllCustomer(){
        global $conn;
        connect_db();
        $sql = "SELECT * FROM khachhang";
        $data = mysqli_query($conn, $sql);
        $result = array();
        if($data && mysqli_num_rows($data)>0){
           while($row = mysqli_fetch_assoc($data))
            $result[] = $row;
        }
        return $result;
    }
?>


