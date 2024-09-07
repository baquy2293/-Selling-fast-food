<script type="text/javascript">
    function checkLogin() {
        var valUser = document.querySelector('#valuserName');
        var valPassword = document.querySelector('#valpassWord');
        var valPassword2 = document.querySelector('.pass2');
        var valEmail = document.querySelector('#valemail');
        var disError = document.querySelector('#disError');
        if (valUser.value == "") {
            disError.style.display = "block";
            disError.innerHTML = "Bạn Chưa Nhập User Name !";
            return false;
        } else if (valPassword.value == "") {
            disError.style.display = "block";
            disError.innerHTML = "Bạn Chưa Nhập PassWord !";
            return false;
        } else if (valPassword.value != valPassword2.value) {
            disError.style.display = "block";
            disError.innerHTML = "PassWord phải trùng nhau !";
            return false;
        } else if (valemail.value == "") {
            disError.style.display = "block";
            disError.innerHTML = "Bạn Chưa Nhập Email !";
            return false;
        } else {
            return true;
        }
    }
</script>