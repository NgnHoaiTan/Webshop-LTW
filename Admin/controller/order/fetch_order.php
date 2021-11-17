<?php
include "../connectDb.php";

    //get admin
    session_start();
    $error='';
    $admin=array();
    if(!empty($_SESSION['admin'])){
        $adminname = $_SESSION['admin'];
        $admin = getFullInfoAdmin($adminname);
    }

    $result_fetch=false;
    $approve=false;

    if(!empty($_POST['btnApprove'])){
        $id_order = isset($_POST['id-order']) ? $_POST['id-order'] :"";
        $state = 1;
        $staff = isset($_POST['staff']) ? $_POST['staff'] :"";
        $approve = ApproveOrder($id_order,$state,$staff);
        
    }

    $orderlist=array();
    $orderlist = getAllOrder();

    
?>

<?php  if(empty($orderlist)) { ?>
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
                                <img src="../../image/background/findimg.jpg" alt="">
                            </div>
                        </td> 
            </tr>

<?php  }else if(!empty($orderlist) || $approve){ ?>
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
            <tr class="row-order">
                <td><?php echo $item['SoDonDH'] ?></td>
                <td><?php echo $item['MSKH'] ?></td>
                <td><?php echo $item['MSNV'] ?></td>
                <td><?php echo $item['NgayDH'] ?></td>
                <td><?php echo $item['NgayGH'] ?></td>
                <td><?php echo $item['TrangThaiDH'] ?></td>
                <td>
                    <?php if($item['TrangThaiDH']==0) {?>
                        <button class="approve-order approvebtn" id="<?php echo $item['SoDonDH'] ?>" staff="<?php echo $admin['MSNV'] ?>">Duyệt đơn</button>
                    <?php }else {?>
                        <button class="approved-order approvebtn" id="<?php echo $item['SoDonDH'] ?>" staff="<?php echo $admin['MSNV'] ?>">Đã duyệt</button>
                    <?php } ?>
                </td>
            </tr>
            <?php  } ?>



<?php } ?>
