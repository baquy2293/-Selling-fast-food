<?php
$data = [
    'pageTitle' => 'Cài đặt',
    'title' => "Cài đặt",
    'content' => 'Cài đặt thông tin website',
    'select' => 5
];
layout('header', 'admin', $data);
if (isPost()) {
    if (isset($_POST['bntEditLogo'])) {
        $nameImg = upFile('Upfile', _WEB_PATH_TEMPLATE . '/images/');
        updateLogoSetting($nameImg);
    }
    if (isset($_POST['txtAdress']) == 'update') {
        updateAddress($_POST['txtAdress']);

    }
    if (isset($_POST['bntEditContact']) == 'update') {
        updateContact($_POST['txtNumber'], $_POST['txtEmail']);
    }

}
?>


<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="content_main">
                <div class="setting_logo">
                    <div class="title_setting">
                        <h2>Logo</h2>
                    </div>
                    <!-- end title_setting -->
                    <div class="edit_logo">
                        <form action="" method="post" method="post" enctype="multipart/form-data">
                            <!-- <img src="../../images/logoToc.jfif" alt=""> -->
                            <?php logo(1); ?>
                            <input type="file" name="Upfile" id="Upfile" required>
                            <?php nameImgLogo(); ?>
                            <button class="bnt_submit" id="bnt_UpdateLogo" name="bntEditLogo"
                                    onclick="return showInpfile()" value="edit">Thay đổi
                            </button>
                        </form>
                    </div>
                </div>
                <!-- end setting item -->
                <div class="setting_adress">
                    <div class="title_setting">
                        <h2>Địa Chỉ</h2>
                    </div>
                    <!-- end title_setting -->
                    <div class="edit_adress">
                        <form action="" method="post" method="post">
                            <div class="form_group">
                                <?php showAdress(); ?>
                            </div>
                            <button class="bnt_submit" name="bntEditAdress" id="bnt_UpdateAdress"
                                    onclick="return showInpAdress()" value="edit">Thay đổi
                            </button>
                        </form>
                    </div>
                </div>
                <!-- end setting item -->
                <div class="setting_contact">
                    <div class="title_setting">
                        <h2>Liên Hệ</h2>
                    </div>
                    <!-- end title_setting -->
                    <div class="edit_contact">
                        <form action="" method="post" method="post">
                            <div class="form_group">
                                <?php showContact(); ?>
                            </div>
                            <button class="bnt_submit" name="bntEditContact" id="bnt_Updatecontact"
                                    onclick="return showInpContact()" value="edit">Thay đổi
                            </button>
                        </form>
                    </div>
                </div>
                <!-- end setting item -->
            </div>

            <!-- Page-body end -->
        </div>
        <div id="styleSelector"></div>
    </div>
</div>
<?php
layout('footer', 'admin', $data);
?>
