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
                    <a href="https://www.linkedin.com/in/qu%C3%BD-b%C3%A1-06189b2b9/" target="_blank"><i
                                class="fab fa-linkedin"></i></a>
                    <a href="" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
                <?php disAdmin(0) ?>
                <div class="account">
            <span class="notification">
              <i class="fas fa-bell" onclick="showNotification()"></i>
                <sub><?php
                    if (isset($_SESSION['user'])) {
                        showCountNotification($_SESSION['user']['id']);
                    } else {
                        echo 0;
                    }
                    ?></sub>
            <div class="show_Notification">
              <ul>
                <?php if (isset($_SESSION['user'])) {
                    showNotification($_SESSION['user']['id']);
                } else {
                    echo "<h4>Không có thông báo nào !</h4>";
                } ?>
              </ul>
            </div>
            </span>
                    <?php disLogin(1) ?>
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
                                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/policy_images_1.png" alt="">
                            </div>
                            <div class="policy_item_content">
                                <h4>Bảo đảm chất lượng</h4>
                                <p>Sản phẩm bảo đảm chất lượng.</p>
                            </div>
                        </div>
                        <!-- end policy item -->
                        <div class="policy_item">
                            <div class="policy_item_icon">
                                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/policy_images_2.png" alt="">
                            </div>
                            <div class="policy_item_content">
                                <h4>Miễn phí giao hàng</h4>
                                <p>Cho đơn hàng đầu tiên.</p>
                            </div>
                        </div>
                        <!-- end policy item -->
                        <div class="policy_item">
                            <div class="policy_item_icon">
                                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/policy_images_3.png" alt="">
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
                        <input type="text" oninput="errorLog()" placeholder="Tìm Kiếm Sản Phẩm" name="txtSearch"
                               required/>
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
                                    showCartMini($_SESSION['user']['id'], 1);
                                    if (isset($_POST['deleteCart'])) {

                                        $body = getBody();
                                        $idCartDetail = $body['deleteCart'];

//                                        $conn = connectDB();
//                                        $idCartDetail = $_POST['deleteCart'];
                                        delete('cart', 'cart.idCartDetail =' . $idCartDetail);
//                                        $sql1 = "DELETE FROM cart WHERE cart.idCartDetail =" . $idCartDetail . ""; // xóa giỏi hàng có mã hàng chi tiết đấy
//                                        $conn->query($sql1);

//                                        $sql2 = "DELETE FROM cartdetail WHERE cartdetail.id_cartDetail =" . $idCartDetail . ""; // xóa giỏ hàng chi tiết
//                                        $conn->query($sql2);
                                        delete('cartdetail', "cartdetail.id_cartDetail =" . $idCartDetail);
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
        <main>
            <div class="banner">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $i = 1;
                        $conn = connectDB();
                        $result = $conn->query("SELECT * FROM slide ");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($i++ == 1) {
                                    echo '
                        <div class="carousel-item active">
                         
                          <img class="bannerImg" src="' . _WEB_HOST_TEMPLATE . '/images/' .$row['image'] . '" class="d-block w-100" alt="...">
                          </a>
                        </div>
                      ';
                                } else {
                                    echo '
                        <div class="carousel-item">
                          <a href="' . $row['link'] . '">
                          <img class="bannerImg" src="' . _WEB_HOST_TEMPLATE . './images/' . $row['image'] . '" class="d-block w-100" alt="...">
                          </a>
                        </div>
                      ';
                                }
                            }
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- end banner -->
            <div class="product_hot">
                <div class="title-product_hot">
                    <h1 id="title_deal">Commbo</h1>
                </div>
                <!-- end title-product_hot -->
                <div class="box-product_Hot">
                    <div class="owl-carousel owl-theme">
                        <?php showProductHot(); ?>
                    </div>
                </div>
            </div>
            <!-- end product-hot -->
            <div class="product_lemonTea">
                <div class="title-product_hot">
                    <h1 id="title_deal">Đồ Ăn Nhanh</h1>
                </div>
                <!-- end title-product_hot -->
                <div class="box-product_Hot">
                    <?php showProductCategory(30) ?>
                </div>
            </div>
            <!-- end product_lemonTea -->
            <div class="product_drinkTea">
                <div class="title-product_hot">
                    <h1 id="title_deal">Đồ Uống</h1>
                </div>
                <!-- end title-product_hot -->
                <div class="box-product_Hot">
                    <?php showProductCategory(31) ?>
                </div>
                <!-- end box-product_Hot -->
            </div>
            <!-- end product_drinkTea -->
            <div class="list-category">
                <div class="title-list-category">
                    <h1>Danh Mục Sản Phẩm</h1>
                </div>
                <div class="slide-category">
                    <div class="owl-carousel owl-theme">
                        <?php
                        $conn = connectDB();
                        $result = $conn->query("SELECT * FROM category");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<a href="?module=product&action=&idML=' . $row['id'] . '" class="linkCategory">
                          <div class="item list-category-item">
                            <img src="' . _WEB_HOST_TEMPLATE . './images/' . $row['image'] . '" alt="" />
                            <span>' . $row['nameCategory'] . '</span>
                          </div>
                        </a>
                  ';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- end list category-->
            <div class="quisle">
                <div class="title_quisle">
                    <h1>Các Thương Hiệu Đã Liên Kết</h1>
                </div>
                <div class="item_quisle">
                    <a href="https://www.grab.com" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE?>/images/logo_grap.png" alt="Grap"/></a>
                    <a href="https://www.now.vn" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE?>/images/logo_now.png" alt="Now"/></a>
                    <a href="https://momo.vn" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE?>/images/logo_momo.png" alt="MoMo"/></a>
                </div>
            </div>
        </main>

    </div>


<?php
layout('footer', 'core');
