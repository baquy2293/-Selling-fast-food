<?php
$data = [
    'pageTitle' => 'Đổi mật khẩu'
];
layout('header_login', 'core', $data);

$token = $_GET['token'];

if (!empty($token)) {
    $tokenQuery = firstRaw("SELECT id, email FROM user WHERE forgotToken='$token'");
    if (!empty($tokenQuery)) {

        $userId = $tokenQuery['id'];
        $email = $tokenQuery['email'];
        if (isPost()) {
            $body = getBody();
            if (empty(trim($body['password']))) {
                setFlashData('msg', 'Mật khẩu bắt buộc phải nhập');
            } else {
                if (strlen(trim($body['password'])) < 8) {
                    setFlashData('msg', 'Mật khẩu không được nhỏ hơn 8 ký tự');
                }
            }
            if (empty(trim($body['confirm_password']))) {
                setFlashData('msg', 'Xác nhận mật khẩu không được để trống');
            } else {
                if (trim($body['password']) != trim($body['confirm_password'])) {
                    setFlashData('msg', 'Hai mật khẩu không khớp nhau');
                }
            }

            if (empty($body['password']) || empty($body['confirm_password'])) {
                setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
            }

            $errors = getFlashData('msg');
            setFlashData('msg', $errors);
            if (empty($errors)) {
                $passwordHash = password_hash($body['password'], PASSWORD_DEFAULT);
                $dateUpdate = [
                    'password' => $passwordHash,
                    'forgotToken' => null,
                ];
                $updateStatus = update('user', $dateUpdate, "id=$userId");
                if ($updateStatus) {
                    setFlashData('msg', 'Thay đổi mật khẩu thành công');
                    $subject = 'Bạn vừa đổi mật khẩu';
                    $content = 'Chúc mừng bạn đã đổi mật khẩu thành công!';
                    sendMail($email, $subject, $content);
                    redirect('?module=auth&action=login');
                } else {
                    setFlashData('msg', 'Lỗi hệ thống! Bạn không thể đổi mật khẩu');
                }
            } else {
                redirect('?module=auth&action=reset&token=' . $token);
            }
        }

    } else {
        setFlashData('msg', 'Link không tồn tại hoặc đã hết hạn');
    }
} else {
    setFlashData('msg', 'Link không tồn tại hoặc đã hết hạn');
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
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
            <h1>Đổi mật khẩu</h1>
            <div class="password">
                <label for=""><i class="fas fa-lock"></i></label>
                <input type="password" id="email" name="password" placeholder="Nhập mật khẩu ">
            </div>

            <div class="password">
                <label for=""><i class="fas fa-lock"></i></label>
                <input type="password" id="email" name="confirm_password" placeholder="Nhập lại mật khẩu ">
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
