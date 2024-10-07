<?php 
$data = [
    'pageTitle'=>'Tài khoản người dùng',
    'style'=> 'user',
];
layout('header','core',$data);

?>
<main>
        <div class="title_name">
          <h1><i class="fas fa-user-cog"></i>Tài Khoản</h1>
        </div>
        <div class="manager__user">
          <div class="content_main">
            <div class="setting_logo">
                <div class="title_setting">
                    <h2>Ảnh Đại Diện</h2>
                </div>
                <!-- end title_setting -->
                <div class="edit_logo">
                    <form action="" method="post" method="post" enctype="multipart/form-data">
                        <!-- <img src="../images/avata/avatar d" alt=""> -->
                        <?php disAvata();?>
                        <input type="file" name="Upfile" id="Upfile" required>
                        
                        <?php 
                        nameimg($_SESSION['user']['id']);?>

                        <button class="bnt_submit" id="bnt_UpdateLogo" name="bntEditLogo" onclick="return showInpfile()" value="edit">Thay đổi</button>
                    </form>
                    <?php
                        if (isset($_POST['bntEditLogo']) == 'update') {
                            $nameImg = upFile('Upfile',_WEB_HOST_TEMPLATE.'/images/avata/');
                            updateAvatar($nameImg, $_SESSION['user']['idr']);
                        }
                    ?>
                </div>
            </div>
            <!-- end setting item -->
            <div class="setting_adress">
                <div class="title_setting">
                    <h2>Thông tin cá nhân</h2>
                </div>
                <!-- end title_setting -->
                <div class="edit_adress">
                    <form action="" method="post" method="post">
                        <div class="form_group">
                            
                            <?php
                             personalInformation($_SESSION['user']['id']);?>
                        </div>
                        <button class="bnt_submit" name="bntEditAdress" id="bnt_UpdateAdress" onclick="return showInpAdress()" value="edit">Thay đổi</button>
                    </form>
                    <?php 
                        if (isset($_POST['bntEditAdress']) == 'update') {
                          updatePersonalInformation($_POST['txtFullName'], $_POST['txtEmail'], $_POST['txtPhone'], $_POST['txtadress'], $_SESSION['user']['id']);
                        }
                    ?>
                </div>
            </div>
            <!-- end setting item -->
            <div class="setting_contact">
                <div class="title_setting">
                    <h2>Bảo Mật</h2>
                </div>
                <!-- end title_setting -->
                <div class="edit_contact">
                    <form action="" method="post" method="post">
                        <div class="input__password">
                          <div class="form_group">
                            <label for="">Mật Khẩu Cũ</label>
                            <input type="password" name="passOld" required>
                          </div>
                          <div class="form_group">
                            <label for="">Mật Khẩu Mới</label>
                            <input type="password" name="passNew" id="passNew" required>
                          </div>
                          <div class="form_group">
                            <label for="">Nhập Lại Mật Khẩu Mới</label>
                            <input type="password" id="erpass" required >
                          </div>
                        </div>
                        <div class="submit_group">
                          <button name="bntEditPass" onclick="return checkPass()">Thay Đổi</button>
                        </div>
                    </form>
                    <p class="errorPass"><?php
                      if (isset($_POST['bntEditPass'])) {
                        editPassWord($_SESSION['user']['idUser'],$_SESSION['user']['passWord'],$_POST['passOld'],$_POST['passNew']);
                      }
                    ?></p>
                </div>
                <button class="bnt_submit showInpPass" onclick="showInpContact()">Đổi Mật Khẩu</button>
                
              </div>
              <!-- end setting item -->
          </div>
        </div>
      </main>

      <script src="<?php echo _WEB_HOST_CORE_TEMPLATE; ?>/assets/js/style_js.js"></script>