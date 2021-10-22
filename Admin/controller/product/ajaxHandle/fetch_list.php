<?php
    include '../../connectDb.php';
    
    $query1="";
    $query2="";
    if(!empty($_POST['id_product_del'])){
        
        $id_product_delete = isset($_POST['id_product_del']) ? $_POST['id_product_del'] : '';
        $query1=deleteImageByProduct($id_product_delete);
        $query2=deleteProduct($id_product_delete);
        
    }
    $products=getAllProductsWithAssociation();
?>



                
                    <tr class="table-row table-top-header">
                        <th></th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Thể loại</th>
                        <!-- <th>Hãng sản xuất</th> -->
                        <th>Giá</th>
                        <!-- <th>Giảm giá</th> -->
                        <th>Số lượng</th>
                        <th>Tùy chọn</th>    
                    </tr>
                    <?php  foreach($products as $item) { ?>
                    <tr class="table-row">
                        <td><input type="checkbox" name="checkproduct"></td>
                        <td><?php echo $item['MSHH'] ?></td>
                        <td><?php echo $item['TenHH'] ?></td>
                        <td><?php 
                            $name_category_arr = getNameCategoryById($item['MaLoaiHang']);
                                foreach($name_category_arr as $name_category){
                                    echo $name_category;
                            } ?>
                        </td>
                        <!-- <td><?php //echo $item['MSHH'] ?></td> -->
                        <td><?php echo $item['Gia'] ?></td>
                        <td><?php echo $item['SoLuongHang'] ?></td>
                        <td class="row justify-around" >
                            <form action="editProduct.php" method="GET">
                                <input type="hidden" name="id_product" value="<?php echo $item['MSHH'] ?>">
                                <input type="submit" class="btn btn__edit edit-product" name="edit_product"  value="Sửa"/>
                            </form>
                            
                            <button type="button" class="btn btn__delete delete-product" id="<?php echo $item['MSHH'] ?>" name="delete_product"  value="xóa">Xóa</button>
                            <script>
                               
                            </script>
                        </td>
                    </tr>
                    <?php  } ?>
                