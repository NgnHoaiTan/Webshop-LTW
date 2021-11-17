<?php
include "../connectDb.php";
    $result_fetch=false;

    $customers=array();
    $customers = getAllCustomer();
    
?>

<?php  if(empty($customers)) { ?>
            <tr class="table-row table-top-header">
                        <th>Mã khách hàng</th>                     
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Công ty</th>
                        <th>Số fax</th>
                        <th>Tùy chọn</th>    
            </tr>
            <tr class="table-row">
                        <td colspan="7" rowspan="10" class="table-data-empty">
                            <div id="img-notfound-data">
                                <img src="../../image/background/finding.jpg" alt="">
                            </div>
                        </td> 
            </tr>

<?php  }else if(!empty($customers)){ ?>
            <tr class="table-row table-top-header">
                        
                        <th>Mã khách hàng</th>
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Công ty</th>
                        <th>Số fax</th>
                        <th>Tùy chọn</th>   
            </tr>
            <?php foreach($customers as $item){ ?>
            <tr class="table-row table-row-customer">
                <td><?php echo $item['MSKH'] ?></td>
                <td><?php echo $item['HoTenKH'] ?></td>
                <td><?php echo $item['SoDienThoai'] ?></td>
                <td><?php echo !empty($item['TenCongTy']) ? $item['TenCongTy'] :"N/A" ?></td>
                <td><?php echo !empty($item['SoFax']) ? $item['SoFax'] :"N/A"?></td>
                <td  class="td-center-customer">
                    <button class="view-customer view-cus-btn" id-customer="<?php echo $item['MSKH'] ?>"><a href="inforDetail.php?id-customer=<?php echo $item['MSKH'] ?>">Chi tiết</a></button>
                </td>
            </tr>
            <?php  } ?>



<?php } ?>
<p>123</p>