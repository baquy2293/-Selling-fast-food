<?php 

?>
<link rel="stylesheet" href="<?php echo _WEB_HOST_CORE_TEMPLATE.'/assets/css/style_shopcart.css?ver='. rand();?>" />
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
                <span class="title_cart">Giỏ hàng</span>
              </div>
              <a href="?module=home&action=views"><i class="fas fa-angle-double-right"></i> Tiếp tục mua hàng</a>
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
                  $result = $conn -> query("SELECT * FROM cart C  INNER JOIN user U INNER JOIN product P ON C.id_user = U.id  AND C.id_product = P.id_product AND U.id =".$idCustomer."");
                  if ($result->num_rows > 0) {
                    $count = 0;
                    while($row = $result -> fetch_assoc()){
                      ++$count;
                      $price = $row['price']-($row['price']*$row['discount'])/100;
                     $qty= $row['qty'];
                        echo '
                          <tr>
                            <td class="mobl1">'.$count.'</td>  
                            <td><img class="imgProduct" style = "width: 80px;" src="'._WEB_HOST_TEMPLATE.'/images/'.$row['image'].'"></img></td>
                            <td>'.$row['nameProduct'].'</td>
                            <td class="mobl3"><input class="amount" min="1" max="99" type="number" value="'.$qty.'"/></td>
                            <td>'.$row['size'].'</td>
                            <td class="productCash">'.number_format($price).' đ</td>
                            <td class="totalCash mobl2">'.number_format($price*$row['qty']).' đ</td>
                            <td><button name="deleteCart" value = "'.$row['id_product'].'">Xóa</button></td>
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
                        <a href="?module=cart&action=order" id="linkInsertOrder">Đặt Hàng Ngay</a>
                    </div>
                </form>
                <?php 
            if (isset($_SESSION['user'])) {
              if (isset($_POST['deleteCart'])) {
                $conn = connectDB();
                $idCartDetail = $_POST['deleteCart'];
                $sql1 = "DELETE FROM cart WHERE cart.id_product =".$idCartDetail.""; // xóa giỏi hàng có mã hàng chi tiết đấy
                $conn -> query($sql1);
                redirect("?module=cart&action=shopcart");
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
} else {
    document.querySelector('.error').style.display = "none";
}
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'> </script>
<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'> </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các input có class 'amount'
    document.querySelectorAll('.amount').forEach(input => {
        // Thiết lập giá trị mới cho input nếu cần
        input.value = parseInt(input.value) || 1; // Nếu giá trị hiện tại không phải là số, đặt là 1
        
        // Thêm sự kiện input để xử lý khi giá trị thay đổi
        input.addEventListener('input', function () {
            // Kiểm tra giá trị nhập vào có nằm trong giới hạn không
            if (this.value < 1) {
                this.value = 1; // Giới hạn tối thiểu
            } else if (this.value > 99) {
                this.value = 99; // Giới hạn tối đa
            }
            // Cập nhật lại giá trị trong trường hợp có thay đổi
           input.value = this.value;
        });
    });
});
</script>