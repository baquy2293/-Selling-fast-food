<?php 
ob_start();
if (isset($_SESSION['user'])) {
  if(count($_POST)>1){
    setSession('order',$_POST);
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet" />
    <style>
    :root {
        --bg-color: #1ea2bf;
        --textName-color: #157332;
        --textPrice-color: #fb492c;
    }
    </style>
    <link rel="stylesheet"
        href="<?php echo _WEB_HOST_CORE_TEMPLATE . '/assets/css/style_shopcart.css?ver=' . rand(); ?>" />
    <title>Đặt Hàng</title>
</head>

<body>
    <div class="notification__modal">
        <div class="notification__modal-content">
            <!-- <div class="bntClose"><i class="fas fa-times-circle"></i></div> -->
            <h4>Bạn Đã Đặt Hàng Thành Công !</h4>
            <p>Sẽ quay lại trang chủ sau <b id="countTime" style="color: red;"></b></p>
            <a href="../index.php">Trang Chủ</a>
        </div>
    </div>
    <div class="container">
        <header>
            <?php
                if (isset($_SESSION['user'])) {
                    global $idCustomer;
                    $idCustomer = $_SESSION['user']['id'];
                    $conn = connectDB();
                    $result = $conn->query("SELECT * FROM user LEFT JOIN information ON information.id = 1 WHERE user.id = " . $idCustomer);
                    $row = $result->fetch_assoc();
                    echo '
              <img src="' . _WEB_HOST_TEMPLATE . '/images/' . $row['logo'] . '" alt="" />
              <div class="admin__cart">
                <span class="user_name"><img class="img_user" src="' . _WEB_HOST_TEMPLATE . '/images/avata/' . $row['image'] . '">' . $row['fullname'] . '</span>
                <span class="title_cart">Thông Tin Đặt Hàng</span>
              </div>
              <a href="../index.php"><i class="fas fa-angle-double-right"></i> Tiếp tục mua hàng</a>
            ';
                }
                ?>
        </header>
        <!-- end header -->
        <main>
            <div class="orderStep">
                <div class="orderStep__item active">
                    <div class="number__title">
                        <span>1</span>
                    </div>
                    <div class="content__title">
                        <h3>Thông Tin Người Nhận</h3>
                    </div>
                    <i class="fas fa-angle-double-right"></i>
                </div>
                <!-- end orderStep__item -->

                <!-- end orderStep__item -->
                <div class="orderStep__item active">
                    <div class="number__title">
                        <span>2</span>
                    </div>
                    <div class="content__title">
                        <h3 class="">Xác Nhận</h3>
                    </div>
                </div>
                <!-- end orderStep__item -->
            </div>
            <div class="pay">
                <div class="pay__confirm">
                    <div class="title__shipFee">
                        <h2>Xác Nhận Đặt Hàng</h2>
                    </div>
                    <div class="content__order">
                        <div class="showCart">
                            <table>
                                <tr>
                                    <th class="mobl1">STT</th>
                                    <th>Sản Phẩm</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Size</th>
                                    <th>Đơn Giá</th>
                                </tr>
                                <?php 
                  if(isset($_SESSION['user'])) {
                    $totalPrice = 0;
                    $conn = connectDB();
                    $result = $conn -> query("SELECT * FROM cart C INNER JOIN user U INNER JOIN product P ON C.id_user = U.id  AND C.id_product = P.id_product AND U.id =".$idCustomer."");
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
                              <td class="mobl3"><input class="amount" min="1" max="99" type="number" value="'.$row['qty'].'" disabled/></td>
                              <td>'.$row['size'].'</td>
                              <td class="productCash">'.number_format($price).' đ</td>
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
                        </div>
                        <!-- SHOW CART -->
                    </div>
                    <!-- content__order -->
                </div>
                <!-- END PAY CONFIRM -->
                <div class="orderDetail__information">
                    <div class="orderDetail__information-item">
                        <label for="">Địa chỉ: </label>
                        <span
                            class="adress"><?php echo $_SESSION['order']['adress'] ." ". $_SESSION['order']['addressDistrict'] ." ".$_SESSION['order']['addressProvinces'] ?></span>
                    </div>
                    <div class="orderDetail__information-item">
                        <label for="">Tiền Hàng: </label>
                        <span class="price__sale"><?php echo number_format($totalPrice); ?> đ</span>
                    </div>
                    <div class="orderDetail__information-item">
                        <label for="">Phí Ship: </label>
                        <span class="price__sale"><?php echo number_format(35000); ?>
                            đ</span>
                    </div>
                    <?php
                          $codeContent = mysqli_real_escape_string($conn, $_SESSION['order']['inpCode']);
                            $sql = "SELECT * FROM codediscount WHERE codeContent = '$codeContent'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            $discount  = $result->fetch_assoc()['discount'];} else {$discount=0;}
                    ?>
                    <div class="orderDetail__information-item">
                        <label for="">Giảm giá: </label>
                        <span class="price__sale"><?php
                        $sumdiscount = ( ( $totalPrice+ 35000)* $discount/100) ;
                       echo number_format( $sumdiscount);
                        ?>
                            đ</span>
                    </div>
                </div>
                <div class="total__cash">
                    <label for="">Tổng Tiền:</label>

                    <span><?php echo number_format($totalPrice - $sumdiscount );?> đ</span>
                </div>
                <div class="bnt__submit">
                    <form action="" method="post">
                        <button name="submitOrder">Đặt Hàng</button>
                    </form>
                    <?php 
          if (isset($_POST['submitOrder'])) {
            insertNotification("Đặt Hàng Thành Công","Chúc mừng bạn đã đặt hàng thành công","",$_SESSION['user']['id']);
            insertOrder();
          }
            
          ?>
                </div>
            </div>
            <!-- END PAY -->
        </main>
        <footer>
        </footer>

        <!-- end footer -->
    </div>
    <!-- end container -->

    <?php 
    if (isset($_POST['submitOrder'])) {
      echo '<script>
              document.querySelector(".notification__modal").style.display = "flex";
              var dem=6;
              function xuly(){
                dem--;
                document.getElementById("countTime").innerHTML=dem;
                if (dem>0) setTimeout("xuly()",1000);
              }
                xuly();
              setTimeout(function(){
                window.location.assign("?module=home&action=views");
              }, 6000);
            </script>';

    }
  ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js' />
    <script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js' />
    <script src='./JsCart.js'></script>
</body>

</html>
<?php } else { ?>
<script>
if (confirm('Vui Lòng Đăng Nhập Để Tiếp Tục Chức Năng')) {
    window.location.assign("?module=auth&action=login");
} else {
    history.back();
}
</script>
<?php } ?>