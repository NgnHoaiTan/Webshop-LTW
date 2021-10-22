<?php
include "../connectDb.php";
    $result_fetch=false;

    $orderlist=array();
    $orderlist = getAllOrder();
?>

<?php  if(!$result_fetch || empty($orderlist)) { ?>
            <tr class="table-row table-top-header">
                        <th>Mã Đơn</th>
                        <th>Khách hàng</th>
                        <th>Nhân viên</th>
                        <th>Ngày đặt</th>
                        <th>Ngày giao</th>
                        <th>Trạng Thái</th>
                        <th>Tùy chọn</th>    
            </tr>
            <tr class="table-row">
                        <td colspan="7" rowspan="10" class="table-data-empty">
                            <div id="img-notfound-data">
                                <h3>Hiện bạn chưa có đơn hàng nào</h3>
                                <img src="../../image/background/finding.jpg" alt="">
                            </div>
                        </td> 
            </tr>

<?php  }else if(!empty($orderlist)){ ?>
            <tr class="table-row table-top-header">
            <th>Mã Đơn</th>
                        <th>Khách hàng</th>
                        <th>Nhân viên</th>
                        <th>Ngày đặt</th>
                        <th>Ngày giao</th>
                        <th>Trạng Thái</th>
                        <th>Tùy chọn</th>    
            </tr>
            <?php foreach($orderlist as $item){ ?>
            <tr>
                <td><?php echo $item['SoDonDH'] ?></td>
                <td><?php echo $item['MSKH'] ?></td>
                <td><?php echo $item['MSNV'] ?></td>
                <td><?php echo $item['NgayDH'] ?></td>
                <td><?php echo $item['NgayGH'] ?></td>
                <td><?php echo $item['TrangThaiDH'] ?></td>
                <td>option</td>
            </tr>
            <?php  } ?>



<?php } ?>
<p>123</p>