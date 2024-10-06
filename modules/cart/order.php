<?php
if (isset($_SESSION['user'])) {
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet" />
        <style>
            :root {
                --bg-color: #1ea2bf;
                --textName-color: #157332;
                --textPrice-color: #fb492c;
            }
        </style>
        <link rel="stylesheet" href="<?php echo _WEB_HOST_CORE_TEMPLATE . '/assets/css/style_shopcart.css?ver=' . rand(); ?>" />
        <title>Đặt Hàng</title>
    </head>

    <body>
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
              <a href="?module=home&action=views"><i class="fas fa-angle-double-right"></i> Tiếp tục mua hàng</a>
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
                            <h3>Thông Tin  đơn hàng</h3>
                        </div>
                        <i class="fas fa-angle-double-right"></i>
                    </div>
                    <!-- end orderStep__item -->
                    <div class="orderStep__item">
                        <div class="number__title">
                            <span>2</span>
                        </div>
                        <div class="content__title">
                            <h3 class="">Xác nhận</h3>
                        </div>
                        
                        
                    </div>
                    <!-- end orderStep__item -->
                
                    <!-- end orderStep__item -->
                </div>
                <div class="pay">
                    <div class="information">
                        <h2>Thông Tin Người Nhận</h2>
                        <form action="?module=cart&action=confirm" method="post">
                            <div class="form-group float-lert">
                                <label for="">Họ Và Tên <span class="unique">*</span></label>
                                <input type="text" name="fullName" placeholder="Nhập họ và tên"
                                    value="<?php if (isset($_SESSION['user']['fullname'])) {
                                        echo ($_SESSION['user']['fullname']);
                                    } ?>"
                                    required />
                            </div>
                            <div class="form-group float-lert">
                                <label for="">Email <span class="unique">*</span></label>
                                <input type="email" name="mail"
                                    value="<?php if (isset($_SESSION['user']['email'])) {
                                        echo ($_SESSION['user']['email']);
                                    } ?>"
                                    placeholder="Nhập email" required />
                            </div>
                            <div class="form-group float-lert">
                                <label for="">Số Điện Thoại <span class="unique">*</span></label>
                                <input type="text" name="phone"
                                    value="<?php if (isset($_SESSION['user']['phone'])) {
                                        echo ($_SESSION['user']['phone']);
                                    } ?>"
                                    placeholder="Nhập số điện thoại" required />
                            </div>
                            <div class="form-group float-lert">
                                <label for="">Địa Chỉ Chi Tiết <span class="unique">*</span></label>
                                <input type="text" name="adress"
                                    value="<?php if (isset($_SESSION['user']['adress'])) {
                                        echo ($_SESSION['user']['adress']);
                                    } ?>"
                                    placeholder="Địa Chỉ" required />
                            </div>
                            <div class="select-group">
                                <div class="select-address">
                                    <label for="">Thành Phố <span class="unique">*</span></label>
                                    <select name="addressProvinces" id="" required>
                                        <option value="Hà Nội">Hà Nội</option>
                                    </select>
                                </div>
                                <div class="select-address">
                                    <label for="">Quận / Huyện <span class="unique">*</span></label>
                                    <select name="addressDistrict" class="address_district" id="district" required>
                                        <option value="">Chọn Quận / Huyện</option>
                                        <?php showDistrict(); ?>
                                    </select>
                                </div>
                                                 <!-- <div class="select-address">
                                                   <label for="">Phường / Xã <span class="unique">*</span></label>
                                                   <select name="addressWard" class="address_ward" required>
                                                     <option value="">Chọn Phường / Xã</option>
                                                   </select>
                                                 </div> -->
                            </div>
                            <div class="note">
                                <label for="">Ghi Chú</label>
                                <textarea type="" cols="50" name="txtNote" placeholder="Ghi chú đơn hàng"></textarea>
                            </div>
                            <div class="pay__main-left">
                                <div class="title__shipFee">
                                    <h2>Phí Vận Chuyển</h2>
                                </div>
                                <div class="choose__ship">
                                    <input type="radio" name="payment_method" id="payment_cod" checked="checked">
                                    <label for="payment_cod">Thanh Toán Khi Nhận hàng</label>
                                </div>
                                <div class="choose__ship">
                                    <input type="radio" name="payment_method" id="payment_transfer">
                                    <label for="payment_transfer">Chuyển khoản</label>
                                </div>
                                <div class="shipfee__cash">
                                    <label for="">Phí Ship:</label>
                                    <span class="price__sale">35.000 đ</span>
                                    <span class="price">35.000 đ</span>
                                </div>
                            </div>
                            <!-- end pay main left -->
                            <div class="codeDiscount">
                                    <label for="" >Mã Giảm Giá:</label>
                                    <input type="text" name="inpCode" required>
                                <div class="show__discount">
                                    <?php
                                    apllyDiscount();
                                    ?>
                                </div>
                                <div class="list__discount">
                                    <?php if (countCodeDiscount($_SESSION['user']['id']) > 0) {
                                        $count = countCodeDiscount($_SESSION['user']['id']);
                                        echo '<h4>Bạn có <b>' . $count . '</b> mã chưa dùng</h4>';
                                    } ?>
                                    <ul>
                                        <?php showListCodeDiscount($_SESSION['user']['id']); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="bnt-pay" >
                                <button name="bntContinue" type="submit">Tiếp Tục</button>
                            </div>
                        </form>
                    </div>
                    <!-- end information -->
                </div>
            </main>
            <!-- end footer -->
        </div>
    </body>
    </html>
    <?php 
  echo '<script>
          var dataDiscount = document.querySelector(".show__discount i").innerHTML;
          if(dataDiscount) {
            const formatter = new Intl.NumberFormat("vn", {
              style: "currency",
              currency: "VND",
              minimumFractionDigits: 0
            })
            const totalP = (100 - Number(dataDiscount))/100*35000
            document.querySelector(".price__sale").innerHTML =  formatter.format(totalP);
          } else {
            document.querySelector(".price").style.display = "none";
          }
        </script>';
?>
  <script>
  function applyCode() {
    document.querySelector('.codeDiscount input').value = this.children[1].innerHTML;
  }

  const bntAddCodes = document.querySelectorAll('.listCode');
  for (const bntAddCode of bntAddCodes) {
      bntAddCode.addEventListener('click', applyCode)
  }
  </script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'/>
<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'/>
<script src= './JsCart.js'></script>

<-- Messenger Plugin chat Code -->
    <?php
} else { ?>
    <script>
        if (confirm('Vui Lòng Đăng Nhập Để Tiếp Tục Chức Năng')) {
            var path = <?php echo _WEB_HOST_ROOT . "?module=auth&action=login" ?>
            window.location.assign(path);
        } else {
            history.back();
        }
    </script>


<?php } ?>