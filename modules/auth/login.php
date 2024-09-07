<?php
$data = [
    'pageTitle' => 'Đăng nhập hệ thống'
];
layout('header_login', 'core', $data);

if (isPost()) {
    $body = getBody();

    if (!empty(trim($body['email'])) && !empty(trim($body['password']))) {
        $email = $body['email'];
        $password = $body['password'];
        $userQuery = firstRaw("SELECT * FROM user WHERE email='$email' ");

        if (!empty($userQuery)) {
            $passWordHash = $userQuery['password'];
            if (password_verify($password, $passWordHash)) {
                if ($userQuery['disabled'] == 0) {
                    if ($userQuery['is_admin'] == 0) {
                        redirect("?module=client&action=views");
                    } elseif ($userQuery['isAdmin'] == 1) {
                        redirect("?module=admin&action=views");
                    } else {
                        redirect("?module=staff&action=views");
                    }
                } else {
                    setFlashData("msg", "Tài khoản của bạn đang bị đình chỉ hãy liên hệ với quản trị viên để mở khóa");
                }

            } else {
                setFlashData("msg", "Không đúng mật khẩu");
            }
        } else {
            setFlashData("msg", "Email không tồn tại trong hệ thống");
        }
    } else {
        setFlashData("msg", "Nhập đầy đủ email và mật khẩu");
    }

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
            <h1>Đăng Nhập</h1>
            <div class="username">
                <label for=""><i class="fas fa-envelope"></i></label>
                <input type="text" id="email" name="email" placeholder="Nhập Email">
            </div>
            <div class="password">
                <label for=""><i class="fas fa-lock"></i></label>
                <input type="passWord" id="valpassWord" name="password" placeholder="Nhập Mật Khẩu">
            </div>
            <br>
            <div class="register">
                <span>Bạn Chưa Có Tài Khoản ?</span>
                <br>
                <span><a href="?module=auth&action=register" style="color: #0af9d7">Tạo Tài Khoản</a></span>
            </div>

            <div class="forgot">
                <span>Bạn Quên Mật Khẩu Tài Khoản ?</span>
                <span><a href="?module=auth&action=forgot" style="color: #0af9d7">Quên mật khẩu</a></span>
            </div>
            <div class="submit">
                <input type="submit" name="bnt-submit" value="Đăng Nhập">
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
