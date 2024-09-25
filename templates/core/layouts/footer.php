<footer>
    <div class="section_information">
        <div class="section_information_address">
            <div class="logo-footer">
                <img class="img-fluid" src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/logoqnt.png" alt="Theme-Logo"/>
            </div>
            <div class="information_address">
                <h2>Cửa Hàng QNT</h2>
                <ul>
                    <?php
                    $conn = connectDB();
                    $result = $conn->query("SELECT * FROM information");
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '
                      <li>' . $row['address'] . '</li>
                    ';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- end section_information_address -->
        <div class="contact_information">
            <h2>Chính sách và quy định chung</h2>
            <div class="contact_information_content">
                <p class="contact_information_content_sub">
                    Các chính sách và quy định chung này liên quan đến việc Khách hàng sử dụng website của QNT
                </p>
                <img src="<?php echo _WEB_HOST_TEMPLATE; ?>/images/hostline.png" alt="">
            </div>
        </div>
        <!-- end contact_information -->
        <div class="list_product_footer">
            <h2>Danh mục thông tin</h2>
            <ul>
                <li><a href="">Đồ Uống</a></li>
                <li><a href="">Sữa Chua</a></li>
                <li><a href="">Đồ Ăn Vặt</a></li>
                <li><a href="">Điều Khoản Và Trách Nhiệm</a></li>
            </ul>
        </div>
    </div>
    <div class="copy_right">
        <p>CNPM - Nhom 9 © QNT. KMA</p>
    </div>
    <script src="<?php echo _WEB_HOST_CORE_TEMPLATE; ?>/assets/style_js.js"></script>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./Home/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
<script>
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 100,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 5,
            },
        },
    });
</script>
<script>
    function viewport() {
        var e = window,
            a = 'inner';
        if (!('innerWidth' in window)) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        if (e[a + 'Width'] <= 768) {
            bannerMobile[0].src = "<?php echo _WEB_HOST_TEMPLATE ?>/images/banner-mobile001.jpg"
            bannerMobile[1].src = "<?php echo _WEB_HOST_TEMPLATE ?>/images/banner-mobile002.jpg"
            bannerMobile[2].src = "<?php echo _WEB_HOST_TEMPLATE ?>/images/banner-mobile001.jpg"
        }
        if (e[a + 'Width'] > 768) {
            <?php
            $conn = connectDB();
            $result = $conn->query("SELECT * FROM slide ");
            $i = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo 'bannerMobile[' . $i++ . '].src = "'._WEB_HOST_TEMPLATE.'/images/' . $row['image'] . '";';
                }
            }
            ?>
        }
    }
</script>