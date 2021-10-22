<?php
include "../connectDb.php";
    $result_fetch=false;

    $customers=array();
    $customers = getAllCustomer();
    
?>

<?php  if(empty($customers)) { ?>
            <tr class="table-row table-top-header">
                        <th>Mã khách hàng</th>
                        <th>Username</th>
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Số Fax</th>
                        <th>Địa chỉ</th>
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
                        <th>Username</th>
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Số Fax</th>
                        <th>Địa chỉ</th>
                        <th>Tùy chọn</th>   
            </tr>
            <?php foreach($customers as $item){ ?>
            <tr class="table-row">
                <td><?php echo $item['MSKH'] ?></td>
                <td><?php echo $item['TK'] ?></td>
                <td><?php echo $item['HoTenKH'] ?></td>
                <td><?php echo $item['SoDienThoai'] ?></td>
                <td><?php echo $item['SoFax'] ?></td>
                <td>Địa chỉ</td>
                <td>option</td>
            </tr>
            <?php  } ?>



<?php } ?>
<p>123</p>