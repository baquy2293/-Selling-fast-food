<?php
$data = [
    'pageTitle'=>'Tài khoản người dùng',
    'style'=> 'user',
];
layout('header','core',$data);
?>
      <main>
        <div class="title_name">
          <h1><i class="fas fa-history"></i>Lịch Sử Mua Hàng</h1>
        </div>
        <div class="box__oder__content">
          <table>
            <tr>
              <th>Thời Gian</th>
              <th>Mã Đơn</th>
              <th>Sản Phẩm</th>
              <th>Tổng Tiền</th>
              <th>Trạng Thái</th>
            </tr>
            <?php
              $conn = connectDB();
              $result = $conn -> query("SELECT DISTINCT orderr.id, orderr.freeship, orderr.date_order, orderr.code_order, status.statusName, orderr.status, orderr.id_user
                                                FROM orderr
                                                INNER JOIN status ON orderr.status = status.id
                                                WHERE orderr.id_user = ".$_SESSION['user']['id']." AND orderr.status NOT IN (1,2,3,4)
                                                ORDER BY orderr.id_user DESC");
              if ($result -> num_rows > 0) {
                while($row = $result -> fetch_assoc()) {
                  ?>
                  <tr>
                    <td><?php echo $row['date_order']; ?></td>
                    <td><?php echo $row['date_order']; ?></td>
                    <td class="OrderNamePro"><?php showHistoryOrderProduct($row['code_order'], $_SESSION['user']['id']); ?></td>
                    <td class="price"><?php echo number_format($totalHistoryItemPrice); ?> đ</td>
                    <td><?php if ($row['status'] == 5) {
                          echo "<span class='succeed'>".$row['statusName']."</span>";
                    } else {
                        echo "<span class='failed'>".$row['statusName']."</span>";
                    } ?></td>
                  </tr>
                <?php
                }
              } else {
                echo '<tr><td colspan="5">Bạn Chưa Có Lịch Sử Mua Hàng Nào!</td></tr>';
              }
            ?>
          </table>
        </div>
      </main>

      <script src="<?php echo _WEB_HOST_CORE_TEMPLATE; ?>/assets/js/style_js.js"></script>