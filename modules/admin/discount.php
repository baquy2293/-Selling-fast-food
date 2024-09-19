<?php
$data = [
    'pageTitle' => 'Cài đặt',
    'title' => "Cài đặt",
    'content' => 'Cài đặt thông tin website',
    'select' => 2
];
layout('header', 'admin', $data);

?>
<div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="inp__codeDiscount">
                                    <div class="title__silder">
                                            <h3>Tạo mã giảm giá</h3>
                                        </div>
                                        <form action="" method="post">
                                            <div class="form__group">
                                                <label for="">Giá Trị: </label>
                                                <input type="number"  name="valueDiscount" class="value__discount" min="10" max="100" step="10" placeholder="Nhập Giá Trị" required>
                                            </div>
                                            <div class="form__group">
                                                <label for="">Ngày Hết Hạn: </label>
                                                <input type="date" name="dateDiscount" class="date__discount"  required>
                                            </div>
                                            <div class="form__submit" name="idCodeDiscount">
                                                <button name="bntSubmit" class="bnt__newCodeDiscount" value="addNew" >Thêm Mới</button>
                                                <input style = "display: none;" type="text" name="idDiscount" class="id__discount">
                                            </div>
                                        </form>
                                    </div>
                                    <?php 
                                    // thêm mới
                                        if (isset($_POST['bntSubmit']) and $_POST['bntSubmit'] == 'addNew') {
                                            insertCodeDiscount($_POST['dateDiscount'], $_POST['valueDiscount']);
                                        }
                                    // cập nhật
                                        if (isset($_POST['bntSubmit']) and $_POST['bntSubmit'] == 'update') {
                                           updateCodeDiscount($_POST['dateDiscount'], $_POST['valueDiscount'], $_POST['idDiscount']);
                                        }
                                    // Xóa
                                        if (isset($_POST['bntDelete'])) {
                                            deleteCodeDiscount($_POST['bntDelete']);
                                        }
                                    ?>
                                    <div class="showListDiscountCode">
                                        <div class="title__silder">
                                            <h3><i class="fas fa-list"></i>Danh sách mã</h3>
                                        </div>
                                        <form action="" method="post">
                                            <table>
                                                <tr>
                                                    <th></th>
                                                    <th>Mã Code</th>
                                                    <th>Giá Trị</th>
                                                    <th>Đã Dùng</th>
                                                    <th>Ngày Hết Hạn</th>
                                                    <th>Tình Trạng</th>
                                                    <th>Chức Năng</th>
                                                </tr>
                                                <?php showCodeDiscount(); ?>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($_POST['bntEdit'])) {
                                showDateEdit($_POST['bntEdit']);
                                global $idCode;
                                $idCode = $_POST['bntEdit'];
                            } ?>
                            <!-- Main-body start -->
                        </div>
                        <?php
layout('footer', 'admin', $data);
?>
