<?php
$data = [
    'pageTitle' => 'Đăng kí',
];
layout('header_login', 'core', $data);
if (isPost()) {
    $body = getBody();
    $error = [];
    if (empty(trim($body['fullname']))) {
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập';
    } elseif (strlen(trim($body['fullname'])) < 5) {
        $errors['fullname']['min'] = 'Họ tên phải >= 5 ký tự';
    }

    if (empty(trim($body['email']))) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập';
    } else {
        //Kiểm tra email hợp lệ
        if (!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        } else {
            //            Kiểm tra email có tồn tại trong DB
            $email = trim($body['email']);
            $sql = "SELECT id FROM user WHERE email='$email'";
            if (getRows($sql) > 0) {
                $errors['email']['unique'] = 'Địa chỉ email đã tồn tại';
            }
        }
    }
    if (empty(trim($body['password']))) {
        $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập';
    } else {
        if (strlen(trim($body['password'])) < 8) {
            $errors['password']['min'] = 'Mật khẩu không được nhỏ hơn 8 ký tự';
        }
    }

    if (empty(trim($body['confirm_password']))) {
        $errors['confirm_password']['required'] = 'Xác nhận mật khẩu không được để trống';
    } else {
        if (trim($body['password']) != trim($body['confirm_password'])) {
            $errors['confirm_password']['match'] = 'Hai mật khẩu không khớp nhau';
        }
    }


    if (empty($errors)) {
        $dataInsert = [
            'email' => $body['email'],
            'fullname' => $body['fullname'],
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'id_role' => 2,
        ];
        $insertStatus = insert('user', $dataInsert);
        if ($insertStatus) {
            $codeDiscount = "HR" . str_rand(6);
            $subject = "Chào Mừng Bạn Đến Với QNT";
            $message = '
                                            <html>                                                
                                                <img src="' . _WEB_HOST_TEMPLATE . '/images/logoqnt.png " width="200px" alt="">
                                                <h2>Chào Mừng Bạn Đến Với QNT</h2>
                                                <div class="content">
                                                    <p>Bạn Đã Đăng Ký Thành Công Tài Khoản QNT.<br>
                                                        Bây giờ bạn có thể thỏa sức đăt mua những món ăn ngon trên hệ thống đồ ăn nhanh QNT</p>
                                                    <i><p>Tài Khoản: <b>' . $body['fullname'] . '</b></p></i>                                               
                                                    <p><b>Free Ship</b><br>Tặng bạn một mã free ship khi mua hàng lần đầu</p>
                                                    <span><b>CODE: <i>' . $codeDiscount . '</i></b></span>
                                                    <br>
                                                    <br>
                                                </div>
                                            </html>';
                                           
            $sendStatus = sendMail($email, $subject, $message);
            if ($sendStatus) {
                setFlashData('msg', 'Đăng ký tài khoản thành công');
                $date = new DateTime();
                $date->modify('+30 days');
                $id_user = firstRaw("SELECT * from user where email='".$body['email']."'");
                $data = [
                    'codeContent'=>$codeDiscount,
                    'discount'=> 10,
                    'endDate'=>$date->format('Y-m-d'),
                    'id_user'=>$id_user['id'],
                ];
                insert('codediscount', $data);

            } else {
                setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            }
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
        }
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('errors', $errors);
        setFlashData('old', $body);
        redirect('?module=auth&action=register');
    }
}
$msg = getFlashData("msg");
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

?>

<div class="container">
    <header>
        <div class="logo">
            <?php logo(0); ?>
        </div>
    </header>
    <main>
        <form action="" name="mf" method="post" onsubmit="return checkLogin()">
            <h1>Đăng Ký</h1>
            <div class="fullname">
                <label for=""><i class="fas fa-user"></i></label>
                <input type="text" id="fullname" name="fullname" placeholder="Họ và tên"
                    value="<?php echo old("fullname", $old); ?>">
            </div>
            <?php echo form_error('fullname', $errors, '<span id="error">', '</span>'); ?>
            <div class="email">
                <label for=""><i class="fas fa-envelope"></i></label>
                <input type="email" id="valemail" name="email" placeholder="Email"
                    value="<?php echo old("email", $old); ?>">
            </div>
            <?php echo form_error('email', $errors, '<span id="error">', '</span>'); ?>
            <div class="password">
                <label for=""><i class="fas fa-lock"></i></label>
                <input type="password" id="valpassWord" name="password" placeholder="Mật Khẩu">
            </div>
            <?php echo form_error('password', $errors, '<span id="error">', '</span>'); ?>
            <div class="password">
                <label for=""><i class="fas fa-lock"></i></label>
                <input type="password" id="" class="" name="confirm_password" placeholder="Nhập Lại Mật Khẩu">
            </div>
            <?php echo form_error('confirm_password', $errors, '<span id="error">', '</span>'); ?>
            <div class="creatAcc">
                <span>Bạn Đã Có Tài Khoản ?</span>
                <span><a href="?module=auth&action=login">Đăng Nhập</a></span>
            </div>
            <div class="submit">
                <input type="submit" name="bnt-submit" value="Đăng Ký">
            </div>
            <span id="disError">
                <?php echo $msg ?>
            </span>
        </form>
    </main>
</div>
<?php
layout('footer_login', 'core');

?>