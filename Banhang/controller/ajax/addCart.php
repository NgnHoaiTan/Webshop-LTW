<?php
    include "../connectDb.php";
    session_start();
    $count=0;
    
    if(!empty($_POST['id-productAddCart'])){
        if(isset($_SESSION['cart'])){
            $item_array_col = array_column($_SESSION['cart'],"id_product");
            if(in_array($_POST['id-productAddCart'],$item_array_col)){
                $count = count($_SESSION['cart']);
            }
            else{
                $count = count($_SESSION['cart']);
                $item = array(
                    'id_product'=>$_POST['id-productAddCart']
                );
                $_SESSION['cart'][$count] = $item;
                $count ++;
            }
         
        }
        else{
            $item = array(
                'id_product'=>$_POST['id-productAddCart']
            );
            $_SESSION['cart'][0] = $item;
            $count = 1;
        }
    }

?>


               
                    <p><i class="fas fa-shopping-bag icon-bag"></i><span style="font-size: 18px;">Cart</span></p>
                    <div id="notification-add-cart">
                        <p><?php echo $count ?></p>
                    </div>
                