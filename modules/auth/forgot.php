<?php
$data = [
    'pageTitle' => 'Quên mật khẩu'
];
layout('header_login', 'core', $data);

if (isPost()) {
    $body = getBody();

    if (!empty(trim($body['email']))) {
        $email = $body['email'];
        $queryUser = firstRaw("SELECT id FROM user WHERE email='$email'");
        if (!empty($queryUser)) {
            $userId = $queryUser['id'];
            $forgotToken = sha1(uniqid() . time());
            $dataUpdate = [
                'forgotToken' => $forgotToken
            ];
            $updateStatus = update('user', $dataUpdate, "id=$userId");
            if ($updateStatus) {

                //Tạo link khôi phục
                $linkReset = _WEB_HOST_ROOT . '?module=auth&action=reset&token=' . $forgotToken;
                //Thiết lập gửi email
                $subject = 'Yêu cầu khôi phục mật khẩu';
                $content = 'Chào bạn: ' . $email . '<br/>';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để khôi phục: <br/>';
                $content .= $linkReset . '<br/>';
                $content .= 'Trân trọng!';
                //Tiến hành gửi email
                $sendStatus = sendMail($email, $subject, $content);
                if ($sendStatus) {
                    setFlashData('msg', 'Vui lòng kiểm tra email để xem hướng dẫn đặt lại mật khẩu');
                    setFlashData('msg_type', 'success');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Lỗi hệ thống! Bạn không thể sử dụng chức năng này');
            }
        } else {
            setFlashData("msg", "Không tồn tại email ");
        }
    } else {
        setFlashData("msg", "Nhập đầy đủ email");
    }
    redirect("?module=auth&action=forgot");
}
$msg = getFlashData('msg');
?>
<body>
<div class="container">
    <header>
        <div class="logo">
            <?php logo(0); ?>
        </div>
    </header>
    <main>
        <form action="" name="mf" id="formLG" method="post" onsubmit="return checkLogin()">
            <h1>Quên mật khẩu</h1>
            <div class="email">
                <label for=""><i class="fas fa-envelope"></i></label>
                <input type="text" id="email" name="email" placeholder="Nhập Email ">
            </div>
            <br>
            <div class="register">
                <span>Bạn Chưa Có Tài Khoản ?</span>
                <br>
                <span><a href="?module=auth&action=register" style="color: #0af9d7">Tạo Tài Khoản</a></span>
            </div>
            <div class="forgot">
                <span>Bạn đã có tài khoản?</span>
                <br>
                <span><a href="?module=auth&action=login" style="color: #0af9d7">Đăng nhập</a></span>
            </div>
            <div class="submit">
                <input type="submit" name="bnt-submit" value="Xác nhận">
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
