<?php 
$data = [
    'pageTitle'=>'Chi tiết',
    'style'=> 'detail',
];
layout('header','core',$data);
?>
<main>
    <div class="box_information_product">
        <div class="title_information_product">
            <h1>Thông Tin Sản Phẩm</h1>
        </div>
        <form action="" method="post">
            <div class="show_product">
                <?php 
              if(isset($_GET['id'])) {
                global $idProduct;
                $idProduct = $_GET['id'];
                $conn = connectDB();
                $result = $conn -> query("SELECT product.image, product.nameProduct, product.price, product.discount,size.* FROM product INNER JOIN size INNER JOIN category ON product.id_category = category.id AND category.id_size = size.id_size WHERE id_product = ".$idProduct."");
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                  echo '
                    <div class="img_product">
                      <img src="'._WEB_HOST_TEMPLATE.'/images/'.$row['image'].'" alt="" />
                    </div>
                    <!-- end img_product -->
                    <div class="information_product">
                      <div class="title_product_item">
                        <h2>'.$row['nameProduct'].'</h2>
                      </div>
                      <div class="content_product_item">
                        <p class="price">Giá: <span>'.number_format(ceil(($row['price']-($row['price']*$row['discount'])/100))).' đ</span></p>
                        <p class="sale">'.number_format($row['price']).' đ</p>
                        <div class="size">
                          <label for="">Lựa Chọn Size: </label>
                          <select name="listChooseSize" id="">';
                          if (!empty($row['size1'])) {
                            echo '<option value="'.$row['size1'].'">'.$row['size1'].'</option>';
                          }
                          if (!empty($row['size2'])) {
                            echo '<option value="'.$row['size2'].'">'.$row['size2'].'</option>';
                          }
                          if (!empty($row['size3'])) {
                            echo '<option value="'.$row['size3'].'">'.$row['size3'].'</option>';
                          }
                            echo '
                            </select>
                          </div>
                            <div class="quantity">
                              <label for="">Số Lượng: </label>
                              <input
                                type="number"
                                placeholder="Số Lượng"
                                name="valQty"
                                min="1"
                                max="99"
                                value="1"
                              />
                            </div>
                            <div class="buy_roduct">
                              <button class="bnt_buyNow" name="bnt_buyNow">Mua Ngay</button>
                              <button class="bnt_add_cart" name="bnt_add_cart">Thêm Vào Giỏ Hàng</button>
                            </div>
                        </div>
                        <!-- end content_product_item -->
                      </div>
                      <!-- end information_product -->
                      ';
                }
              }
              } else {
              }
                  ?>
            </div>
        </form>
        <?php buyProduct()?>
        <!-- end show_product -->
        <div class="details_product">
            <?php productInF($_GET['id']);?>
        </div>
    </div>
    <!-- end box_information_product -->
    <div class="comment_product">
        <div class="title_comment_product">
            <div class="title-item active">
                <i class="fas fa-comments"></i>
                <h2>Bình Luận</h2>
            </div>
            <div class="title-item ">
                <i class="fas fa-calendar-check"></i>
                <h2>Đánh Giá</h2>
            </div>
            <div class="title-item ">
                <i class="fas fa-share-alt"></i>
                <h2>Chia Sẻ</h2>
            </div>
            <div class="line"></div>
        </div>
        <!-- end title_comment_product -->
        <div class="tab__content__comment">
            <div class="tab__group tab__comment active">
                <div class="show_comment">
                    <?php showCommentProduct()?>
                </div>
                <!-- end show_comment -->
                <div class="input_comment">
                    <form action="" method="post" onsubmit="return checkLogin()">
                        <?php disAvata(); ?>
                        <input type="text" placeholder="Viết Bình Luận" name="content_comment" required />
                        <button name="bnt_sent_comment">Bình Luận</button>
                    </form>
                </div>
            </div>
            <div class="tab__group tab__feedback ">
                <h1>Đánh Giá Chất Lượng</h1>
                <div class="tab__feedback-main">
                    <?php 
                  $idProduct = $_GET['id'];
                  $conn = connectDB();
                  $result = $conn -> query("SELECT * FROM feedback INNER JOIN user ON feedback.idFeeback = user.id WHERE feedback.idProduct = ".$idProduct."");
                  if ($result -> num_rows > 0) {
                    while($row = $result -> fetch_assoc()) {
                ?>
                    <div class="tab__feedback-content-item">
                        <div class="tab__feedback-user">
                            <img src="<?php echo _WEB_HOST_TEMPLATE ?>/images/avata/<?php echo $row['image']; ?>"
                                alt="">
                            <div class="tab__feedback-user-star">
                                <span class=userName><?php echo $row['userName']; ?></span>
                                <div class="feedBack__star">
                                    <?php showStar($row['starPoint']);
                            echo '<span>('.$row['starPoint'].'/5)</span>';
                           ?>
                                </div>
                            </div>
                            <span class="date__feedBack"><?php echo $row['dateFeedback']; ?></span>
                        </div>
                        <div class="tab__feedback-content">
                            <p><?php echo $row['content']; ?></p>
                        </div>
                        <!-- end tab__feedback-content -->
                    </div>
                    <!-- end tab__feedback-content-item -->
                    <?php
                    }
                  } else {
                    echo '<p class="feedBackEmpty">Hiện tại chữa có đánh giá nào cho sản phẩm này !</p>';
                  }
                ?>

                </div>
            </div>
            <div class="tab__group tab__share">
                <h1>Chia Sẻ Sản Phẩm</h1>
                <div class="tab__share-input">
                    <label for="">Link: </label>
                    <input type="text" value="<?php echo getCurURL(); ?>" id="txtLink">
                    <button onclick="copyTxt()"><i class="far fa-copy"></i></button>
                </div>
                <div class="socialNetwork">
                    <h3>Hoặc</h3>
                    <div class="show__socialNetwork">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://ci4.googleusercontent.com/proxy/c9vD3EDrtcK7-avr0CLxFI9Z4t3ptY1lDYnGJYIQXiIqVukR6Qjqc5nV7lKd93zbIo7hTnS6O9CovNjFdG1Hf4frRKZieO69pKaOgT8=s0-d-e1-ft#<?php echo getCurURL(); ?>&display=popup&ref=plugin&src=like&kid_directed_site=0&app_id=113869198637480"
                            target="_blank"><img src="../images/logo_fb.png"></i></a>
                        <div class="zalo-share-button" data-href="<?php echo getCurURL(); ?>"
                            data-oaid="579745863508352884" data-layout="4" data-color="blue" data-customize=false></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end tab__content__comment -->
        <?php 
            if (isset($_GET['id'])) {
              if (isset($_POST['bnt_sent_comment'])) {
                if (isset($_SESSION['user'])) {
                  if (!empty($_POST['content_comment'])) {
                    $idProduct;
                    $idCustomer;
                    $contentComment = $_POST['content_comment'];
                    $conn = connectDB();
                    $sql = "INSERT INTO comment VALUES (null,'$contentComment','$idCustomer',null,'$idProduct',b'0')";
                    if($conn ->query($sql)) {
                      header("location: ./sanpham.php?id=".$idProduct."");
                    } 
                  } else {
                    echo "<span style='color: red;'> Vui Lòng Nhập Bình Luận</span>";
                  }
                }
              }
            }
          ?>
    </div>
    <!-- end comment_product -->
    <div class="similar_product">
        <div class="title_similar_product">
            <h2>Các Sản Phẩm Tương Tự</h2>
        </div>
        <div class="box_product_similar">
            <?php showProductSimilar($_GET['id']);?>
        </div>
    </div>

    <?php 
    layout('footer','core',$data);