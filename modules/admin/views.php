<?php

$data = [
    'pageTitle' => 'Quản lí cửa hàng QNT',
    'title' => "Tổng quát",
    'content' => 'Chào mừng bạn đến với QNT',
    'select' => 1,
    'style'=>'views'
];
layout('header', 'admin', $data);
?>
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <!-- Material statustic card start -->
                        <div class="col-xl-4 col-md-12">
                            <div class="card mat-stat-card">
                                <div class="card-block">
                                    <div class="row align-items-center b-b-default">
                                        <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="far fa-user text-c-purple f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <!--                                                                    --><?php
                                                    $conn = connectDB();
                                                    $result = $conn->query("SELECT COUNT(id) AS 'SL' FROM user");
                                                    $row = $result->fetch_assoc();
                                                    echo '
                                                                                <h5>' . $row["SL"] . '</h5>
                                                                                <p class="text-muted m-b-0">Người Dùng</p>
                                                                            ';
                                                    //                                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="far fa-images text-c-green f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <?php
                                                    echo '
                                                                                <h5>6</h5>
                                                                                <p class="text-muted m-b-0">images</p>
                                                                            ';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">

                                                    <i class="far fa-pallet text-c-red f-24"><img
                                                                src="<?php echo _WEB_HOST_TEMPLATE ?>/images/iconDrink.png"
                                                                alt=""
                                                                width="50px"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <?php
                                                    $conn = connectDB();
                                                    $result = $conn->query("SELECT COUNT(id_product) AS 'SL' FROM product");
                                                    $row = $result->fetch_assoc();
                                                    echo '
                                                                                <h5>' . $row['SL'] . '</h5>
                                                                                <p class="text-muted m-b-0">Sản Phẩm</p>
                                                                            ';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-b-20 p-t-20">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="far fa-comments text-c-blue f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <?php
                                                    $conn = connectDB();
                                                    $result = $conn->query("SELECT COUNT(id) AS 'SL' FROM comment");
                                                    $row = $result->fetch_assoc();
                                                    echo '
                                                                                <h5>' . $row['SL'] . '</h5>
                                                                                <p class="text-muted m-b-0">Bình Luận</p>
                                                                            ';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <div class="card table-card">
                                <div class="card-header">
                                    <h5>Sản Phẩm Thịnh Hành</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa fa-wrench open-card-option"></i>
                                            </li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover m-b-0 without-header">
                                            <tbody>
                                            <?php
                                            $conn = connectDB();
                                            $result = $conn->query("SELECT * FROM product WHERE view > 0 ORDER BY view DESC LIMIT 0, 4");
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="d-inline-block align-middle">
                                                                                                <img src="' . _WEB_HOST_TEMPLATE . '/images/' . $row['image'] . '" alt="user image" class="img-radius img-40 align-top m-r-15">
                                                                                                <div class="d-inline-block">
                                                                                                    <h6>' . substr($row['nameProduct'], 0, 24) . '</h6>
                                                                                                    <p class="text-muted m-b-0">Lượt Xem ' . $row['view'] . '</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>';
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Project statustic start -->
                        <div class="col-xl-4 col-md-12">
                            <div class="card mat-clr-stat-card text-white green ">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-green">
                                            <i class="fas fa-star mat-icon f-24"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h5>4000+</h5>
                                            <p class="m-b-0">Xếp Hạng</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mat-clr-stat-card text-white blue">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-blue">
                                            <i class="fas fa-trophy mat-icon f-24"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h5>17</h5>
                                            <p class="m-b-0">Thành Tích</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Material statustic card end -->

                        <div class="col-xl-12">
                            <div class="card proj-progress-card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6">
                                            <h6>Tốc Độ Tăng Trưởng</h6>
                                            <h5 class="m-b-30 f-w-700">70%<span
                                                        class="text-c-green m-l-10">+1.69%</span>
                                            </h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-red"
                                                     style="width:25%"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <h6>Số Lượng Đơn Hàng</h6>
                                            <h5 class="m-b-30 f-w-700">4,569<span
                                                        class="text-c-red m-l-10">-0.5%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-blue"
                                                     style="width:65%"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <h6>Tỷ lệ Phản Hồi</h6>
                                            <h5 class="m-b-30 f-w-700">20%<span
                                                        class="text-c-green m-l-10">+0.99%</span>
                                            </h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-green"
                                                     style="width:85%"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <h6>Doanh Thu</h6>
                                            <h5 class="m-b-30 f-w-700">20.00.000 VND<span
                                                        class="text-c-green m-l-10">+0.35%</span>
                                            </h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-yellow"
                                                     style="width:45%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Project statustic end -->
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"></div>
        </div>
    </div>
<?php
layout('footer','admin',$data);
