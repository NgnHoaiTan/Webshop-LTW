<?php
    include "../connectDb.php";
    $item_per_page = !empty($_POST['per_page'])? $_POST['per_page'] : 24;
    $current_page = !empty($_POST['page']) ? $_POST['page'] : 1;
    $offset = ($current_page - 1)*$item_per_page;

    $totalRecords = getNumberOfProduct();
    $numberofpage = ceil($totalRecords/$item_per_page);
   
    $listproducts = getListAllProductWithPagination($item_per_page,$offset);
    $pagination = true;
    $type='';
    if(!empty($_POST['sort-by-all'])){
        $listproducts = getListAllProductWithPagination($item_per_page,$offset);
    }
    
    if(!empty($_POST['sort-by-price'])){
        $pagination = false;
        $listproducts = getListAllProductOrderByPrice();
    }
    if(!empty($_POST['sort-by-new']) || !empty($_POST['newarrival'])){
        $pagination = false;
        $listproducts = getListAllProductOrderByNewest();
    }
    if(!empty($_POST['searchStr'])){
        $pagination = false;
        $listproducts = getListAllProductBySearching($_POST['searchStr']);
    }
    if(!empty($_POST['type']) && $_POST['type']=='sneaker'){
        $pagination = true;
        $type='sneaker';  
        $totalRecords = getNumberOfSneaker();
        $numberofpage = ceil($totalRecords/$item_per_page);
        $listproducts = getListAllProductBySneaker($item_per_page,$offset);
        
        
    }
    if(!empty($_POST['type']) && $_POST['type']=='giaydanam'){
        $pagination = true;
        $type='giaydanam';
        $totalRecords = getNumberOfLeatherMan();
        $numberofpage = ceil($totalRecords/$item_per_page);
        $listproducts = getListAllProductByLeatherMan($item_per_page,$offset);

        
    }
    if(!empty($_POST['type']) && $_POST['type']=='giaydanu'){
        $pagination = true;
        $type='giaydanu';
        $totalRecords = getNumberOfLeatherWoman();
        $numberofpage = ceil($totalRecords/$item_per_page);
        $listproducts = getListAllProductByLeatherWoman($item_per_page,$offset);
        
       
        
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
            
            <?php if($pagination==true){ ?>
                <div class="row">
                    <?php if(!empty($numberofpage)){ ?>
                    <div class="nextpage-product">
                        <?php for($i=0;$i<$numberofpage;$i++){ ?>
                            <?php if($type=='sneaker'){ ?>
                                <?php if($i+1==$current_page){ ?>
                                    <button class="btn btn-nextpage active-page"><a href="product.php?type=sneaker&page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button> 
                                <?php }else{ ?>
                                    <button class="btn btn-nextpage"><a href="product.php?type=sneaker&page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button> 
                                <?php } ?>
                            <?php }else if($type=='giaydanam'){ ?>
                                <?php if($i+1==$current_page){ ?>
                                    <button class="btn btn-nextpage active-page"><a href="product.php?type=giaydanam&page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button>
                                <?php }else{ ?>
                                    <button class="btn btn-nextpage"><a href="product.php?type=giaydanam&page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button>
                                <?php } ?>
                            <?php }else if($type=='giaydanu') { ?>
                                <?php if($i+1==$current_page){ ?>
                                    <button class="btn btn-nextpage active-page"><a href="product.php?type=giaydanu&page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button>
                                <?php }else{ ?>
                                    <button class="btn btn-nextpage"><a href="product.php?type=giaydanu&page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php if($i+1==$current_page){ ?>
                                    <button class="btn btn-nextpage active-page"><a href="product.php?page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button>
                                <?php }else{ ?>
                                    <button class="btn btn-nextpage"><a href="product.php?page=<?php echo $i+1 ?>&per_page=24"><?php echo $i+1 ?></a></button>   
                                <?php } ?>
                            <?php } ?>
                        
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>