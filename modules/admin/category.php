<?php
$data = [
    'pageTitle' => 'Cài đặt',
    'title' => "Cài đặt",
    'content' => 'Cài đặt thông tin website',
    'select' => 2,
    'style'=>'category'
];
layout('header', 'admin', $data);


?>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="inp__category">
                <form id="form__input__category" action="" method="post" enctype="multipart/form-data">
                    <h1 class="title__category">Thêm Loại Hàng Mới</h1>
                    </h1>
                    <div class="form__group name__category">
                        <label for="">Tên Loại: </label>
                        <input type="text" id="nameCategory" class="valInp" name="nameCategory" required />
                    </div>
                    <!-- end name__category -->
                    <div class="form__group size__category">
                        <label for="">Chọn Loại Size: </label>
                        <select name="idSize" id="sizeID" class="valInp">
                            <?php showSizeOption(); ?>

                        </select>
                    </div>
                    <!-- end name__category -->
                    <div class="form__group img__category">
                        <label for="">Hình ảnh: </label>
                        <input type="file" id="imgCategory" class="valInp" name="fileCategory"
                            accept=".jpg, .jpeg, .png, .jfif" />
                    </div>
                    <!-- end img__category -->

                    <div class="bnt_category">
                        <button id="bnt_add" class="bnt_add" name="bnt_add" value="add">Thêm mới</button>
                        <button class="bnt_retype" onclick="reInput()">Nhập lại</button>
                        <button class="bnt_showList" onclick="showListCategory()">Danh sách</button>
                    </div>
                    <!-- end bnt_category -->
                </form>
            </div>
            <?php
                // them du lieu

               if (isset($_POST['bnt_add']) and $_POST['bnt_add'] == 'Thêm Mới') {
                   $nameCategory = $_POST['nameCategory'];
                   $idSize = $_POST['idSize'];
                   $nameIMG = $_FILES['fileCategory']['name'];
                   $tmp_name = $_FILES['fileCategory']['tmp_name'];
                   move_uploaded_file($tmp_name, _WEB_PATH_TEMPLATE . "/images/" . $nameIMG);
                   $sql = "INSERT INTO category VALUES (null,'$nameCategory','$nameIMG', " . $idSize . ")";
                   if ($conn->query($sql)) {
                       echo '<span class="notification__success">Bạn Đã Thêm Thành Công !</span>';
                   } else {
                       echo '<span class="notification__fail">Thêm Thất Bại. Vui Lòng Thử Lại !</span>';
                   }
               } // update dữ liệu
                if (isset($_POST['bnt_add']) and $_POST['bnt_add'] == 'Cập Nhật') {

                   $idCategory =  $_POST['id'];
                   $nameCategory = $_POST['nameCategory'];
                   $idSize = $_POST['idSize'];
                   $nameIMG = $_FILES['fileCategory']['name'];
                   $tmp_name = $_FILES['fileCategory']['tmp_name'];
                   if (isset($nameIMG)) {
                       $sql = "UPDATE category SET nameCategory='" . $nameCategory . "',image='" . $nameIMG . "', id_size = " . $idSize . " WHERE id = '" . $idCategory . "'";
//                        $result = $conn->query();
//                        move_uploaded_file($tmp_name, _WEB_PATH_TEMPLATE . "/images/" . $nameIMG);
                       echo $sql;
                   } else {
                       $sql = "UPDATE category SET nameCategory='" . $nameCategory . "', id_size = " . $idSize . " WHERE id = '" . $idCategory . "'";
//                        $result = $conn->query("UPDATE category SET nameCategory='" . $nameCategory . "', id_size = " . $idSize . " WHERE id = '" . $idCategory . "'");
                       echo $sql;
                   }
                   if (!$result) {
                       echo '<span class="notification__fail">Sửa Thất Bại. Vui Lòng Thử Lại !</span>';
                   } else {
                       echo '<span class="notification__success">Bạn Sửa Thành Công !</span>';
                   }
                }

                ?>
            <!-- end input__category -->
            <form id="form__show__list" action="" method="post">
                <div class="show__list">
                    <div class="show__list__content">
                        <table>
                            <tr>
                                <th class="checkbox"></th>
                                <th>Tên Loại</th>
                                <th>Loại Size</th>
                                <th>Hình Ảnh</th>
                                <th colspan="2">Chức Năng</th>
                            </tr>
                            <?php
                                $conn = connectDB();
                                $result = $conn->query("SELECT * FROM category INNER JOIN size ON category.id_size = size.id_size");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // lưu ý name của checkbox thì để kiểu mảng để có thể lấy data đc nhiều phần tử
                                        // hiển thị tên size
                                        $valueX = "";
                                        if (!empty($row['size1'])) {
                                            $valueX = $row['size1'];
                                        }
                                        if (!empty($row['size2'])) {
                                            $valueX .= " ," . $row['size2'];
                                        }
                                        if (!empty($row['size3'])) {
                                            $valueX .= " ," . $row['size3'];
                                        }
                                        echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="checkbox[]" value = "' . $row['id'] . '"/></td>
                                                            <td>' . $row['nameCategory'] . '</td>
                                                            <td>' . $valueX . '</td>
                                                            <td class="show__list__img" ><img src="' . _WEB_HOST_TEMPLATE . '/images/' . $row['image'] . '"></td>
                                                            <td class="box__bnt">
                                                            <button class="bnt__category category__edit" name ="edit" value="' . $row['id'] . '">Sửa</button>
                                                            </td>
                                                            <td class="box__bnt">
                                                            <button class="bnt__category category__delete" onclick="return confirmDelete()" name ="delete" value="' . $row['id'] . '">Xóa</button>
                                                            </td>
                                                        </tr>';
                                    }
                                }
                                ?>
                        </table>
                    </div>
                    <!-- end show__list__conten -->
                    <div class="manage__category">
                        <div class="bnt__chooseAll">
                            <button class="bnt__category" onclick="return selectChekboxAll()">Chọn Tất Cả</button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__category" onclick="return closeChekboxAll()">Bỏ Chọn Tất Cả</button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__category" name="bntDeletechoose" onclick="return confirmDelete()">
                                Xóa
                                Các Mục Đã Chọn
                            </button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__category" onclick="showAddCategory()">Nhập Thêm</button>
                        </div>
                    </div>
                </div>
                <!-- show list -->
                <!-- edit data -->
                <?php
                    // hiển thị dữ liệu để sửa
                    if (isset($_POST['edit'])) {
                        $valSP = $_POST['edit'];

                        $result = $conn->query("SELECT * FROM category WHERE id = '" . $valSP . "'");
                        if ($result->num_rows > 0) {
                            // hiện thị dữ liệu
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                                        <script type='text/javascript'>
                                                            // Cập nhật giá trị của nút
                                                            document.getElementById('bnt_add').innerHTML = 'Cập Nhật';
                                                            document.getElementById('bnt_add').value = 'Cập Nhật';
                                                            
                                                            // Cập nhật giá trị của các trường input
                                                            document.getElementById('sizeID').value = '" . $row['id_size'] . "';
                                                            document.getElementById('nameCategory').value = '" . $row['nameCategory'] . "';
                                                            
                                                            // Cập nhật tiêu đề
                                                            document.querySelector('.title__category').innerText = 'Sửa Loại Sản Phẩm';
                                                        
                                                            // Lưu ý: Không thể gán giá trị cho trường input type 'file' từ JavaScript
                                                            // document.querySelector('#imgCategory').value = '" . $row['image'] . "';
                                                             document.getElementById('hiddenField').value = '" . $row['id'] . "';
                                                        </script>
                                                        ";
                            }
                        }
                    }
                    ?>
            </form>
            <?php

                // Xóa dữ liệu lần lượt
                if (isset($_POST['delete'])) {
                    $valML = $_POST['delete'];
                    $conn = connectDB();
                    // $conn -> query("DELETE FROM product WHERE id_product = ".$valML."");
                    $resultCC = $conn->query("DELETE FROM category WHERE id = " . $valML . "");
                    if ($resultCC) {
                        setFlashData('msg', "'<span class='notification__success'>Xóa Thành Công !</span>'");
                        echo '<script>
                                                        setTimeout(function(){
                                                             window.location.href = "?module=admin&action=category";
                                                        }, 2);
                                                        </script>';
                    } else {
                        setFlashData('msg', "'<span class='notification__fail'>Xóa Thất Bại ! !</span>'");
                    }

                }

                //  xóa nhiều dữ liệu
                if (isset($_POST['bntDeletechoose'])) {
                    $conn = connectDB();
                    if (isset($_POST['checkbox'])) {
                        $valCheckbox = $_POST['checkbox'];
                        // lặp các loại sản phẩm vừa chọn
                        foreach ($valCheckbox as $value) {

                            //  lặp các sản phẩm có mã loại vừa chọn
                            $resultAA = $conn->query("SELECT * FROM product WHERE id_category = " . $value . "");
                            if ($resultAA->num_rows > 0) {
                                while ($rowAA = $result->fetch_assoc()) {
                                    // xóa bảng order
                                    $resultA = $conn->query("SELECT * FROM oderdetail WHERE oderdetail.id_product = " . $rowAA['id_product'] . "");
                                    if ($resultA->num_rows > 0) {
                                        while ($rowA = $resultA->fetch_assoc()) {
                                            $conn->query("DELETE FROM orderr WHERE orderr.id_oderDetail = " . $rowA['id_oderDetail'] . "");
                                        }
                                    }

                                    //  xóa bảng order detail
                                    $conn->query("DELETE FROM oderdetail WHERE oderdetail.id_product = " . $rowAA['id_product'] . "");

                                    // xóa bảng cart
                                    $resultB = $conn->query("SELECT * FROM  cartdetail WHERE cartdetail.id_product = " . $rowAA['id_product'] . "");
                                    if ($resultB->num_rows > 0) {
                                        while ($rowB = $resultB->fetch_assoc()) {
                                            $conn->query("DELETE FROM cart WHERE cart.idCartDetail = " . $rowB['id_cartDetail'] . "");
                                        }
                                    }

                                    // xóa bảng cartdetail
                                    $conn->query("DELETE FROM cartdetail WHERE cartdetail.id_product = " . $rowAA['id_product'] . "");


                                    // xóa bảng comment
                                    $conn->query("DELETE FROM comment WHERE comment.id_product = " . $rowAA['id_product'] . "");

                                    // xóa bảng feedback
                                    $conn->query("DELETE FROM feedback WHERE feedback.idProduct = " . $rowAA['id_product'] . "");

                                    // xóa sản phẩm
                                    $conn->query("DELETE FROM product WHERE product.id_product = " . $rowAA['id_product'] . "");

                                }


                            }


                            // xóa loại hàng
                            $resultFinal = $conn->query("DELETE FROM category WHERE category.id_category = " . $value . "");
                        }
                        if ($resultFinal) {
                            echo '<span class="notification__success">Xóa Thành Công !</span>';
                        
                        } else {
                            echo '<span class="notification__fail">Xóa Thất Bại !</span>';
                        }
                    }
                }
                ?>
        </div>
        <!-- end page-wrapper -->
    </div>
    <!-- Main-body start -->
</div>

<?php
layout('footer', 'admin', $data);
?>