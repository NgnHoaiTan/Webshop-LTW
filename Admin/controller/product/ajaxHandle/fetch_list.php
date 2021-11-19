<?php
    include '../../connectDb.php';
    
    $query1="";
    $query2="";
    if(!empty($_POST['id_product_del'])){
        
        $id_product_delete = isset($_POST['id_product_del']) ? $_POST['id_product_del'] : '';
        $query1=deleteImageByProduct($id_product_delete);
        $query2=deleteProduct($id_product_delete);
        
    }
    $item_per_page = !empty($_POST['per_page'])? $_POST['per_page'] : 20;
    $current_page = !empty($_POST['page']) ? $_POST['page'] : 1;
    $offset = ($current_page - 1)*$item_per_page;

    $products=getListProductWithPagination($item_per_page,$offset);
    $totalRecords = getNumberOfProduct();
    $numberofpage = ceil($totalRecords/$item_per_page);
?>


                
                <table  cellspacing="2" class="table--listproduct">
                    <tr class="table-row table-top-header">
                        
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Thể loại</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tùy chọn</th>
                           
                    </tr>
                    <?php if(!empty($products)){ ?>
                    <?php  foreach($products as $item) { ?>
                    <tr class="table-row table-row-product">
                        
                        <td><?php echo $item['MSHH'] ?></td>
                        <td class="name-product-row"><?php echo $item['TenHH'] ?><br><a href="productDetail.php?masp=<?php echo $item['MSHH'] ?>" class="btn-view-product">Xem chi tiết</a></td>
                        <td><?php 
                            $name_category_arr = getNameCategoryById($item['MaLoaiHang']);
                                foreach($name_category_arr as $name_category){
                                    echo $name_category;
                            } ?>
                        </td>
                        <!-- <td><?php //echo $item['MSHH'] ?></td> -->
                        <td><?php echo $item['Gia'] ?></td>
                        <td><?php echo $item['SoLuongHang'] ?></td>
                        <td class="row justify-around option-list-product" >
                            <form action="editProduct.php" method="GET">
                                <input type="hidden" name="id_product" value="<?php echo $item['MSHH'] ?>">
                                <input type="submit" class="btn btn__edit edit-product" name="edit_product"  value="Sửa"/>
                            </form>
                            
                            <button type="button" class="btn btn__delete delete-product" id="<?php echo $item['MSHH'] ?>" name="delete_product"  value="xóa">Xóa</button>
                            <script>
                               
                            </script>
                        </td>
                        
                    </tr>
                    <?php  }}else if(empty($products)){ ?>
                        <tr class="table-row">
                            <td colspan="7" rowspan="10" class="table-data-empty">
                                <div id="img-notfound-data">
                                    <h3>Hiện bạn chưa có sản phẩm nào</h3>
                                    <img src="../../image/background/findimg.jpg" alt="">
                                </div>
                            </td> 
                        </tr>
                        

                    <?php } ?>
                </table>
                <?php if(!empty($products)) { ?>
                    <div class="wrapper-pagenumber">
                        <?php for($i=0;$i<$numberofpage;$i++){ ?>
                            <?php if($i+1!=$current_page){ ?>
                                <button><a href="listProduct.php?page=<?php echo $i+1 ?>&per_page=20"><?php echo $i+1 ?></a></button>
                            <?php }else{ ?>
                                <button class="page-active"><a href="listProduct.php?page=<?php echo $i+1 ?>&per_page=20"><?php echo $i+1 ?></a></button>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    
                <?php } ?>
                    
                