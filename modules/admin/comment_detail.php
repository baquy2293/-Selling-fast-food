<?php
$data = [
    'pageTitle' => 'Cài đặt',
    'title' => "Cài đặt",
    'content' => 'Cài đặt thông tin website',
    'select' => 2,
    'style'=>'comment'
];
layout('header', 'admin', $data);

?>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <?php if (isset($_GET['id'])) {?>
            <form action="" method="post">
                <div class="title_product">
                    <?php showProductName($_GET['id']); ?>
                    <a href="?module=admin&action=comment"><i class="fas fa-angle-double-left"></i> Quay lại trang quản lý bình luận</a>
                </div>
                <div class="replyComment">
                    <label for="">Trả lời: </label>
                    <input type="text" name="valComment">
                    <button name="bntSentComment">Gửi</button>
                </div>
                <div class="title_comment">
                    <h1>Bình Luận: </h1>
                </div>
                <div class="box_content_comment">
                    <?php showCommentDetail($_GET['id'])?>
                </div>
            </form>
            <?php 
                                            if (isset($_POST['bntSentComment'])) {
                                                sentComment($_POST['valComment'],$_GET['id'],$idCustomer);
                                            }
                                            if (isset($_POST['bntDelete'])) {
                                                deleteComment($_POST['bntDelete']);
                                            }
                                    
                                        }?>
        </div>
        <!-- end page-wrapper -->
    </div>
    <!-- Main-body start -->
</div>

<?php
layout('footer', 'admin', $data);
?>