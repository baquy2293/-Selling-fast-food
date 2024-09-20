<script type="text/javascript">
    function checkLogin() {
        var valUser = document.querySelector('#valuserName');
        var valPassword = document.querySelector('#valpassWord');
        var disError = document.querySelector('#disError');

        if (valUser.value == "") {
            disError.style.display = "block";
            disError.innerHTML = "Bạn Chưa Nhập User Name !";
            document.querySelector('#formLG').style.border = "1px solid red";
            document.querySelector('form').style.animationName  = "error";
            document.querySelector('form').style.animationDuration   = "0.3s";
            return false;
        } else if (valPassword.value == "") {
            disError.style.display = "block";
            disError.innerHTML = "Bạn Chưa Nhập PassWord !";
            document.querySelector('#formLG').style.border = "1px solid red";
            document.querySelector('form').style.animationName  = "error";
            document.querySelector('form').style.animationDuration   = "0.3s";
            return false;
        } else {
            return true;
        }
    }
</script>
<script src="<?php echo _WEB_HOST_CORE_TEMPLATE;?>/assets/jsLogin.js"></script>