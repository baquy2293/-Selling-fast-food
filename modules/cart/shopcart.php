<?php 

?>
  <link rel="stylesheet"
        href="<?php echo _WEB_HOST_CORE_TEMPLATE.'/assets/css/style_shopcart.css?ver='. rand();?>" />

 <div class="container">
    <header>
      <?php 
        if(isset($_SESSION['user'])) {
          global $idCustomer;
          $idCustomer = $_SESSION['user']['id'];
          $row =  firstRaw("SELECT user.fullname,user.image,information.logo FROM `cart` JOIN user on user.id= cart.id_user RIGHT JOIN information on information.id = 1  WHERE cart.id_user= ".$idCustomer."");
          echo'
            <img src="'._WEB_HOST_TEMPLATE.'/images/avata/'.$row['image'].'" alt="" />
            <div class="admin__cart">
              <span class="user_name"><img class="img_user" src="'._WEB_HOST_TEMPLATE.'/images/avata/'.$row['image'].'">'.$row['fullname'].'</span>
              <span class="title_cart">Giỏ Hàng Của Bạn</span>
            </div>
            <a href="?module=client&action=product"><i class="fas fa-angle-double-right"></i> Tiếp tục mua hàng</a>
          ';
        }
      ?>
    </header>
    <!-- end header -->
    <main>
      <div class="main-top">
        <hr />
      </div>
      <!-- end main top -->
      <div class="content">
        <h1><i class="fas fa-shopping-cart"></i>Thông Tin Giỏ Hàng</h1>
        <div class="showCart">
          <form action="" method="post">
            <table>
              <tr>
                <th class="mobl1">STT</th>
                <th>Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Size</th>
                <th>Đơn Giá</th>
                <th class="mobl2">Tổng Tiền</th>
                <th>Tác Vụ</th>
              </tr>
              <?php 
                if(isset($_SESSION['user'])) {
                  $totalPrice = 0;
                  $conn = connectDB();
                  $result = $conn -> query("SELECT * FROM cart C INNER JOIN cartdetail CD INNER JOIN user U INNER JOIN product P ON C.id_user = U.id AND C.idCartDetail = CD.id_cartDetail AND CD.id_product = P.id_product AND U.id =".$idCustomer."");
                  if ($result->num_rows > 0) {
                    $count = 0;
                    while($row = $result -> fetch_assoc()){
                      ++$count;
                      $price = $row['price']-($row['price']*$row['discount'])/100;
                        echo '
                          <tr>
                            <td class="mobl1">'.$count.'</td>  
                            <td><img class="imgProduct" style = "width: 80px;" src="'._WEB_HOST_TEMPLATE.'/images/'.$row['image'].'"></img></td>
                            <td>'.$row['nameProduct'].'</td>
                            <td class="mobl3"><input class="amount" min="1" max="99" type="number" value="'.$row['qty'].'"/></td>
                            <td>'.$row['size'].'</td>
                            <td class="productCash">'.number_format($price).' đ</td>
                            <td class="totalCash mobl2">'.number_format($price*$row['qty']).' đ</td>
                            <td><button name="deleteCart" value = "'.$row['id_cartDetail'].'">Xóa</button></td>
                          </tr>
                          ';
                        $totalPrice += ($price*$row['qty']);
                    }
                  }
                }
              ?>
              <tr class="totalCash">
                <td>Tổng Tiền:</td>
                <?php 
                  if(isset($_SESSION['user'])) {
                    if ($totalPrice > 0) {
                      echo '<td colspan="7" class="showTotalCash">'.number_format($totalPrice).' đ</td>';
                    } else {
                      echo '<td colspan="7" class="showTotalCash">Giỏ Hàng Trống</td>';
                    }
                    
                  } else {
                    echo '
                      <td colspan="7" class="showTotalCash">Giỏ Hàng Trống</td>
                    ';
                  }
                ?>
              </tr>
            </table>
            <div class="form-submit">
              <a href="./insertOrder1.php" id="linkInsertOrder">Đặt Hàng Ngay</a>
            </div>
          </form>
          <?php 
            if (isset($_SESSION['user'])) {
              if (isset($_POST['deleteCart'])) {
                $conn = connectDB();
                $idCartDetail = $_POST['deleteCart'];
                $sql1 = "DELETE FROM cart WHERE cart.idCartDetail =".$idCartDetail.""; // xóa giỏi hàng có mã hàng chi tiết đấy
                $conn -> query($sql1);

                $sql2= "DELETE FROM cartdetail WHERE cartdetail.id_cartDetail =".$idCartDetail.""; // xóa giỏ hàng chi tiết
                $conn -> query($sql2);
                header("location: ./giohang.php");
              }
              
            }
          ?>
          </div>
        <!-- end showcart -->
      </div>
      <!-- end content -->
    </main>
    <!-- end main -->
    

    <!-- end footer -->
  </div>

  <script>
   var valCash = document.querySelector('.showTotalCash').innerHTML
   if (valCash == "0 VND") {
     document.querySelector('.error').style.display = "flex";
   } else{
    document.querySelector('.error').style.display = "none";
   }
  
  </script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'/>
<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'/>
<script src= './JsCart.js'></script>
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

