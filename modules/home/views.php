<?php
layout('header', 'core');

?>
    <div class="containerr">
        <header style="  background-image: url('./templates/images/banner_top0007.jpg') ">
            <div class="subsystem">
                <div class="social_network">
                    <a href="https://www.facebook.com/tbq.2293/?locale=vi_VN" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                    <a href="" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/qu%C3%BD-b%C3%A1-06189b2b9/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
                <?php disAdmin(0) ?>
                <div class="account">
            <span class="notification">
              <i class="fas fa-bell" onclick="showNotification()"></i>
                <sub><?php
                    if (isset($_SESSION['user'])) {
                        showCountNotification($_SESSION['user']['idUser']);
                    } else {
                        echo 0;
                    }
                    ?></sub>
            <div class="show_Notification">
              <ul>
                <?php if (isset($_SESSION['user'])) {
                    showNotification($_SESSION['user']['idUser']);
                } else {
                    echo "<h4>Không có thông báo nào !</h4>";
                } ?>
              </ul>
            </div>
            </span>
                    <?php disLogin(0) ?>
                </div>
            </div>
            <div class="header_top">
                <div class="logo">
                    <?php logo(2); ?>
                </div>
                <div class="box-header_content">
                    <div class="slogan">
                        <h1>Yêu Là Phải Nói - Cũng Như Đói Là Phải Ăn</h1>
                    </div>
                    <!-- end slogan -->
                    <div class="section_policy">
                        <div class="policy_item">
                            <div class="policy_item_icon">
                                <img src="<?php echo _WEB_HOST_TEMPLATE ;?>/images/policy_images_1.png" alt="">
                            </div>
                            <div class="policy_item_content">
                                <h4>Bảo đảm chất lượng</h4>
                                <p>Sản phẩm bảo đảm chất lượng.</p>
                            </div>
                        </div>
                        <!-- end policy item -->
                        <div class="policy_item">
                            <div class="policy_item_icon">
                                <img src="<?php echo _WEB_HOST_TEMPLATE ;?>/images/policy_images_2.png" alt="">
                            </div>
                            <div class="policy_item_content">
                                <h4>Miễn phí giao hàng</h4>
                                <p>Cho đơn hàng đầu tiên.</p>
                            </div>
                        </div>
                        <!-- end policy item -->
                        <div class="policy_item">
                            <div class="policy_item_icon">
                                <img src="<?php echo _WEB_HOST_TEMPLATE ;?>/images/policy_images_3.png" alt="">
                            </div>
                            <div class="policy_item_content">
                                <h4>Hỗ trợ 24/7</h4>
                                <p>Hotline: <?php showPhoneWeb(); ?></p>
                            </div>
                        </div>
                        <!-- end policy item -->
                    </div>
                    <!-- end  section_policy-->
                </div>

            </div>
            <!-- end header_top -->
            <div class="header_bottom">
                <nav class="nav_top">
                    <button class="bnt-bars">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul>
                        <li><a href="">Trang Chủ</a></li>
                        <li><a href="./Product/index.php">Thực Đơn</a></li>
                        <li><a href="">Giảm Giá</a></li>
                        <li><a href="./introduce/index.php">Thông Tin</a></li>
                        <button class="bnt-close">
                            <i class="fas fa-times"></i>
                        </button>
                        <!-- end logo -->
                    </ul>

                </nav>
                <!-- end nav_top -->
                <div class="search">
                    <form action="./Product/index.php" method="post">
                        <input type="text" oninput="errorLog()" placeholder="Tìm Kiếm Sản Phẩm" name="txtSearch" required/>
                        <button name="bntSearch" onclick="return checkForm()"><i class="fas fa-search"></i></button>
                    </form>
                    <div class="error_log">
                        <span>Không được để trống !</span>
                    </div>
                </div>
                <!-- end search-->
                <div class="cart">
                    <?php
                    if (isset($_SESSION['user'])) {
                        cart(0);
                    } else {
                        echo '
                <div class="cart_icon">
                  <i class="fas fa-shopping-cart"></i>
                  <sub>0</sub>
                </div>';
                    }
                    ?>
                    <div class="showCart">
                        <h4>Sản Phẩm Đã thêm</h4>
                        <ul class="list_cart">
                            <form action="" method="post">
                                <?php
                                if (isset($_SESSION['user'])) {
                                    showCartMini($_SESSION['user']['idUser'], 1);
                                    if (isset($_POST['deleteCart'])) {

                                        $body = getBody();
                                        $idCartDetail = $body['deleteCart'];

//                                        $conn = connectDB();
//                                        $idCartDetail = $_POST['deleteCart'];
                                        delete('cart','cart.idCartDetail ='.$idCartDetail);
//                                        $sql1 = "DELETE FROM cart WHERE cart.idCartDetail =" . $idCartDetail . ""; // xóa giỏi hàng có mã hàng chi tiết đấy
//                                        $conn->query($sql1);

//                                        $sql2 = "DELETE FROM cartdetail WHERE cartdetail.id_cartDetail =" . $idCartDetail . ""; // xóa giỏ hàng chi tiết
//                                        $conn->query($sql2);
                                        delete('cartdetail',"cartdetail.id_cartDetail =".$idCartDetail);
                                        header("Refresh:0");
                                    }
                                } else {
                                    echo '<li class="cartEmpty">Giỏ Hàng Trống !</li>';
                                }
                                ?>
                            </form>
                        </ul>
                        <a class="linkCart" href="./Cart/giohang.php">Xem giỏ hàng</a>
                    </div>
                    <!-- end showCart -->
                </div>
                <!-- end cart -->

            </div>
            <!-- end header_bottom -->
        </header>

    </div>


<?php
layout('footer', 'core');