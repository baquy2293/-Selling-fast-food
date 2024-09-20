<?php
$data = [
    'pageTitle' => 'Đơn hàng',
    'title' => "Đơn hàng",
    'content' => 'Đơn hàng của  website',
    'select' => 3
];

layout('header', 'admin', $data);

?>
    <div class="pcoded-content">
        <!-- Page-header end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="order_title">
                            <h1>Danh Sách Đơn Hàng</h1>
                        </div>
                        <hr>
                        <div class="order__content-list">
                            <?php
                            $conn = connectDB();
                            $result = $conn->query("SELECT DISTINCT orderr.codeOrder,orderr.dateOrder,orderr.idUser , status.statusName, status.id FROM orderr INNER JOIN status ON orderr.status = status.id WHERE orderr.status NOT IN (5,6) ORDER BY orderr.idOder DESC");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="list-item">
                                        <div class="list-item-title">
                                            <span>Mã Đơn Hàng: <b><?php echo $row['codeOrder']; ?></b></span>
                                            <span>Trạng Thái: <b><?php echo $row['statusName']; ?></b></span>
                                            <span>Ngày Đặt: <?php echo $row['dateOrder']; ?></span>
                                        </div>
                                        <!-- end list-item-title -->
                                        <div class="list-item-main">
                                            <?php showProductOrderItem($row['idUser'], $row['codeOrder']); ?>
                                        </div>
                                        <!-- end list-item-main -->
                                        <div class="list-item-function">
                                            <form action="" method="post">
                                                <div class="form__group-function">
                                                    <button name="bntCancelOrder"
                                                            value="<?php echo $row['codeOrder']; ?>"
                                                            class="bnt_cancel">Hủy Đơn Hàng
                                                    </button>
                                                </div>
                                                <div class="form__group-function">
                                                    <label for="">Trạng Thái: </label>
                                                    <select name="valStatus">
                                                        <?php showStatus($row['id']); ?>
                                                    </select>
                                                    <button name="bntUpdateStatus"
                                                            value="<?php echo $row['codeOrder']; ?>"
                                                            class="bnt__update">Cập Nhật
                                                    </button>
                                                </div>
                                                <a href="./order_detail.php?idDH=<?php echo $row['codeOrder']; ?>"
                                                   id="linkOrderDetai"><i class="fas fa-angle-double-right"></i> Xem Chi
                                                    Tiết</a>
                                            </form>
                                        </div>
                                        <!-- end list-item-function -->
                                    </div>
                                    <!-- end list-item -->
                                    <?php
                                    // cập nhật trạng thái đơn hàng
                                    if (isset($_POST['bntUpdateStatus'])) {
                                        updateStatus($row['idUser'], $_POST['bntUpdateStatus'], $_POST['valStatus']);
                                        // thông báo tới người dùng đã thay đổi trạng thái
                                        $resultS = $conn->query("SELECT * FROM status WHERE status.id = " . $_POST['valStatus'] . "");
                                        $rowS = $resultS->fetch_assoc();
                                        insertNotification("Đơn Hàng Đã Chuyển Trạng Thái", "Đơn hàng " . $row['codeOrder'] . " đã chuyển trạng thái thành ", $rowS['statusName'], $row['idUser']);
                                        header('Refresh:0');
                                    }

                                    // Hủy đơn hàng
                                    if (isset($_POST['bntCancelOrder'])) {
                                        updateStatus($row['idUser'], $_POST['bntCancelOrder'], 6);

                                        // thông báo tới người dùng đã thay đổi trạng thái
                                        $resultS = $conn->query("SELECT * FROM status WHERE status.id = " . $_POST['valStatus'] . "");
                                        $rowS = $resultS->fetch_assoc();
                                        insertNotification("Thông Báo Hủy Đơn", "Đơn hàng " . $row['codeOrder'] . " đã được hủy bởi hệ thống", "", $row['idUser']);
                                        header('Refresh:0');
                                    }
                                }
                            } else {
                                echo "<h2 class='emty__order-title' style='color: var(--text-color-red);'>Hiện Không Có Đơn Hàng Nào !</h2>
                                                                <img class='emty__order-img' src="._WEB_HOST_TEMPLATE."/images/empty-cart.png>
                                                            ";

                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">

            </div>
        </div>
    </div>
<?php
layout('footer', 'admin');