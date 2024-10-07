<?php
$data = [
    'pageTitle' => 'Tài khoản người dùng',
    'style' => 'user',
];
layout('header', 'core', $data);

  cancelOrder();
  successOrder();

?>
<main>
    <div class="title_name">
        <h1><i class="fas fa-shipping-fast"></i>Đơn Hàng</h1>
    </div>
    <div class="box__oder__content">
        <!--   -->
        <?php
        $conn = connectDB();
        $result = $conn->query("SELECT DISTINCT orderr.freeship, orderr.date_order, orderr.code_order, status.statusName, orderr.id, codediscount.discount,orderr.name_receiver,orderr.adress_receiver
        FROM orderr 
        INNER JOIN status ON orderr.status = status.id 
        INNER JOIN codediscount ON codediscount.codeContent = orderr.freeship
        WHERE orderr.id_user = 90
        AND orderr.status NOT IN (5, 6) 
        ORDER BY orderr.id DESC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="show__oder__item">
                    <div class="show__oder__item-head">
                        <span class="book__date">Ngày Đặt: <?php echo $row['date_order']; ?></span>
                        <span class="code_order">Mã Đơn: <i><?php echo $row['code_order']; ?></i></span>
                        <span class="status_oder">Trạng Thái: <i><?php echo $row['statusName']; ?></i></span>
                    </div>
                    <!-- end show__oder__item-head -->
                    <div class="show__oder__item-main">
                        <?php showOdered($_SESSION['user']['id'], $row['code_order']);
                        $discount = isset($row['discount']) ? intval($row['discount']) : 0;
                        $result = (intval($totalCashPro) + 35000) * $discount / 100;
                        ?>
                        <div class="product_oder-infomation">
                            <h3>Thông tin người nhận</h3>
                            <span>Người nhận: <?php echo $row['name_receiver']; ?></span>
                            <span>Địa chỉ: <?php echo $row['adress_receiver']; ?></span>
                            <span>Tiền hàng: <b><?php echo number_format($totalCashPro); ?> đ</b></span>
                            <span>Phí Ship: <b><?php echo number_format(35000); ?> đ</b></span>
                        </div>
                    </div>
                    <!-- end show__oder__item-main -->
                    .
                    <div class="show__oder__item-footer">
                        <div class="totalCash">
                            <span class="totalCash__title">Tổng Số Tiền:</span>
                            <span class="totalCash__price"><?php echo number_format($result); ?> đ</span>
                        </div>
                        <div class="bnt__group">
                            <form action="" method="post">
                                <?php
                                if ($row['statusName'] == "Đã giao hàng") {
                                    echo '<button class="bnt__finish bntSuccess" name="bntSuccess" value="' . $row['code_order'] . '">Đã Nhận Hàng</button>';
                                } else {
                                    echo '<button class="bnt__finish bnt__hide" onclick="return false">Đã Nhận Hàng</button>';
                                }
                                if ($row['statusName'] == "Đang xử lý") {
                                    echo '<button class="bnt__cancel" name="bntCancel" value="' . $row['code_order'] . '" onclick="return confirmCancel()">Hủy Đơn Hàng</button>';
                                } else {
                                    echo '<button class="bnt__cancel" onclick="return cancelSubmit()">Hủy Đơn Hàng</button>';
                                }

                                ?>
                            </form>
                        
                        </div>
                    </div>

                </div>
                <!-- end show__oder__item -->
            <?php }
        } else {
            echo '<p class="alert__empty">Hiện tại không có đơn hàng nào !</p>';
        } ?>
    </div>
</main>

<script src="<?php echo _WEB_HOST_CORE_TEMPLATE; ?>/assets/js/style_js.js"></script>