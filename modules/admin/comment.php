<?php
$data = [
    'pageTitle' => 'Cài đặt',
    'title' => "Cài đặt",
    'content' => 'Cài đặt thông tin website',
    'select' => 2,
    'style'=>'comment'
];
layout('header', 'admin', $data);

?>
 <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- <form id="form__show__list" action=""> -->
                                        <div class="show__list">
                                        <div class="show__list__content">
                                            <table>
                                            <tr>
                                                <th>Hàng Hóa</th>
                                                <th>Số Bình Luận</th>
                                                <th>Mới Nhất</th>
                                                <th>Cũ Nhất</th>
                                                <th>Chức Năng</th>
                                            </tr>
                                            <?php 
                                                showComment();
                                            ?>
                                            </table>
                                        </div>
                                        </div>
                                        <!-- show list -->
                                    <!-- </form> -->
                                </div>
                                <!-- end page-wrapper -->
                            </div>
                            <!-- Main-body start -->
                        </div>

<?php
layout('footer', 'admin', $data);
?>