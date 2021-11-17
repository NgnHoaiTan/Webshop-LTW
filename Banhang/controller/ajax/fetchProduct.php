<?php
    include "../connectDb.php";
    $listproducts = getListAllProduct();
    if(!empty($_POST['sort-by-all'])){
        $listproducts = getListAllProduct();
    }
    
    if(!empty($_POST['sort-by-price'])){
        $listproducts = getListAllProductOrderByPrice();
    }
    if(!empty($_POST['sort-by-new']) || !empty($_POST['newarrival'])){
        $listproducts = getListAllProductOrderByNewest();
    }
    if(!empty($_POST['searchStr'])){
        $listproducts = getListAllProductBySearching($_POST['searchStr']);
    }

?>
            
            <div class="products--list grid-product" >
             <?php if(!empty($listproducts)){
                    foreach($listproducts as $item){
                     ?>
                <div class="product--info">
                    <div class="img-product-review">
                        <a href="./productDetail.php?id=<?php echo $item['MSHH']?>">
                            <img src="../../../b1805914_NguyenHoaiTan/Admin/image/upload/<?php echo $item['TenHinh'] ?>" alt="image"> 
                        </a>
                        
                                                     
                        <button class="btn_buy-product">Mua hàng</button>
                        <button class="btn_add-to-cart add-cart" onclick="ShowSuccessToast()" id-product="<?php echo $item['MSHH'] ?>"><i class="fas fa-cart-plus"></i></button> 
                    </div>
                        
                    <p class="name-product"><?php echo $item['TenHH'] ?></p>
                    <p>Giá: <span class="price-product-review"><?php echo $item['Gia'] ?> vnđ</span></p>
                </div>
            <?php  }} ?>
                
            </div>