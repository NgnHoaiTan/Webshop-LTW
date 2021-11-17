<?php
    include "../connectDb.php";
    session_start();
    $result_feedback = 0;
    $listFeedback = array();
    $id_product;
    if(!empty($_POST['feedbackBtn'])){
        $feedback = $_POST['feedback-content'];
        $id_customer = $_POST['id_customer'];
        $id_feedback = uniqid('Feedback-',false);
        $id_product = $_POST['id_product'];
        $dateupfb = $_POST['dateupfb'];
        $result_feedback = insertFeedback($id_feedback,$id_customer,$id_product,$dateupfb,$feedback);

    }
    else{
        $id_product = isset($_POST['id_product']) ? $_POST['id_product'] :"";
        
    }
    $listFeedback = getListFeedbackByProduct($id_product);
    
?>
    <?php if(!empty($listFeedback)) {
        foreach($listFeedback as $feedback){
        ?>
        <div class="feedback-wrapper">
            <div class="avt-user-feedback">
                <div class="border-image">
                    <?php if(!empty($feedback)){
                        $user = GetFullInfoUserById($feedback['MSKH']);
                       
                        ?>
                        
                        <img src="./image/user/<?php echo $user['Avatar'] ?>" alt="avt-user">
                    <?php } ?>
                </div>
            </div>
            <div class="feedback-detail">
                <?php if(!empty($feedback)){
                        $user = GetFullInfoUserById($feedback['MSKH'])
                        ?>
                    <div class="name-user">
                        <p><?php echo $user['HoTenKH'] ?></p>
                    </div>
                <?php } ?>
                <div class="feedback-rating">
                    <div class="row">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="feedback-content">
                        <p><?php echo $feedback['Noidung']  ?></p>
                </div>
            </div>
        </div>
    <?php }}else{ ?> 
        <p>Chưa có phản hồi nào</p>
    <?php } ?>