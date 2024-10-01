    <!-- end list category-->
    <div class="quisle">
        <div class="title_quisle">
            <h1>Các Thương Hiệu Đã Liên Kết</h1>
        </div>
        <div class="item_quisle">
            <a href="https://www.grab.com" target="_blank"><img
                    src="<?php echo _WEB_HOST_TEMPLATE ?>/images/logo_grap.png" alt="Grap" /></a>
            <a href="https://www.now.vn" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE ?>/images/logo_now.png"
                    alt="Now" /></a>
            <a href="https://momo.vn" target="_blank"><img src="<?php echo _WEB_HOST_TEMPLATE ?>/images/logo_momo.png"
                    alt="MoMo" /></a>
        </div>
    </div>
</main>

</div>

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
    <script src="<?php echo _WEB_HOST_CORE_TEMPLATE; ?>/assets/js/style_js.js"></script>
    <script src="<?php echo _WEB_HOST_CORE_TEMPLATE.'/assets/js/js'.$data['style'].'.js'; ?>"></script>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo _WEB_HOST_CORE_TEMPLATE; ?>/assets/js/owl.carousel.min.js"></script>
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
      var countShow = 1;
      function showNotification() {
        countShow+=1;
          if (countShow % 2 == 0 ) {
              document.getElementsByClassName('show_Notification')[0].style.display = "block"
          } else {
              document.getElementsByClassName('show_Notification')[0].style.display = "none"
          }
          console.log(countShow);
      }
    </script>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "106683535040589");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

