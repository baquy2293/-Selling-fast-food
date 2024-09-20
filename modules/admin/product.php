<?php
$data = [
    'pageTitle' => 'Cài đặt',
    'title' => "Cài đặt",
    'content' => 'Cài đặt thông tin website',
    'select' => 2,
    'style'=>'product'
];
layout('header', 'admin', $data);
?>

<!-- Page-header end -->
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="inp__product">
                <h1 class="title_product_list">Danh Sách Sản Phẩm</h1>
                <form id="form__input__product" action="" method="post" enctype="multipart/form-data">
                    <h1 class="title_product_add">Thêm Sản Phẩm Mới</h1>
                    <div class="inp__product__content">
                        <div class="form__group code__product">
                            <label for="">Mã Sản Phẩm</label>
                            <input type="text" id="inp__code__product" name="idProduct" value="auto code" />
                        </div>
                        <!-- end code__product -->
                        <div class="form__group view__product">
                            <label for="">Số Lượt Xem</label>
                            <input type="text" id="view__product" value="0" disabled />
                        </div>
                        <!-- end view__product -->
                        <div class="form__group name__product">
                            <label for="">Tên Sản Phẩm</label>
                            <input type="text" id="inp__name__product" name="inpNameProduct" class="valInp" required />
                        </div>
                        <!-- end name__product -->
                        <div class="form__group price__product">
                            <label for="">Đơn Giá</label>
                            <input type="text" id="inp__price__product" name="inpPriceProduct" class="valInp"
                                required />
                        </div>
                        <!-- end price__product -->
                        <div class="form__group discount__product">
                            <label for="">Giảm Giá</label>
                            <input type="text" id="inp__discount__product" name="inpDiscount" class="valInp" required />
                        </div>
                        <!-- end discount__product -->
                        <div class="form__group img__product">
                            <label for="">Hình Ảnh</label>
                            <input type="file" name="upFile" id="inp__img" class="valInp"
                                accept=".jpg, .jpeg, .png, .jfif" required />
                        </div>
                        <!-- end img__product -->
                        <div class="form__group category__product">
                            <label for="">Loại Sản Phẩm</label>
                            <select name="inpSelectCategory" id="inp__category" required>
                                <option value="">-- Chọn Loại SP --</option>
                                <?php
                                $conn = connectDB();
                                $result = $conn->query("SELECT * FROM category");
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '
                                                                <option value="' . $row['id'] . '">' . $row['nameCategory'] . '</option>
                                                            ';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- end category__product -->
                        <div class="form__group dateAdd__product">
                            <label for="">Ngày Nhập</label>
                            <input type="date" name="inpDate" id="inp__date" class="valInp" required />
                        </div>
                        <!-- end dateAdd__product -->

                        <div class="form__group dateAdd__product">
                            <label for="">Thông Tin Sản Phẩm</label>
                            <textarea rows="10" cols="100" name="product_desc" id="product_desc"
                                placeholder="Nhập Thông Tin Sản Phẩm"></textarea>
                        </div>
                        <!-- end dateAdd__product -->

                    </div>
                    <div class="bnt_product">
                        <button class="bnt_add" id="bnt__add__data" name="bnt_insert_data" value="Thêm Mới">Thêm mới
                        </button>
                        <button class="bnt_retype" onclick="return reInput()">Nhập lại</button>
                        <button class="bnt_showList" onclick="return showListproduct()">Danh
                            sách
                        </button>
                    </div>
                    <!-- end bnt_product -->
                </form>
                <?php
                // insert data
                $conn = connectDB();
                if (isset($_POST['bnt_insert_data']) and $_POST['bnt_insert_data'] == 'Thêm Mới') {
                    $valNameProduct = $_POST['inpNameProduct']; // nameProduct
                    $valPriceProduct = $_POST['inpPriceProduct']; // price product
                    $valDiscount = $_POST['inpDiscount']; // Discount
                    // img product
                    $nameIMG = $_FILES['upFile']['name'];
                    $tmp_name = $_FILES['upFile']['tmp_name'];
                    move_uploaded_file($tmp_name, ""._WEB_PATH_TEMPLATE."/images/" . $nameIMG);
                    // end img product
                    $valSelectCategory = $_POST['inpSelectCategory']; // category
                    $valDate = $_POST['inpDate']; //date
                    $informationProduct = $_POST['product_desc']; // information product

                    $sql = "INSERT INTO product VALUES (null,'$valNameProduct','$valPriceProduct','$valDiscount','$nameIMG','$informationProduct','$valSelectCategory',0,'$valDate')";
                    if ($conn->query($sql)) {
                        echo '<span class="notification__success">Bạn Đã Thêm Thành Công !</span>';
                    } else {
                        echo '<span class="notification__fail">Không Thể Thêm Sản Phẩm Này. Vui lòng thử lại !</span>';
                    }
                    
                } // update dữ liệu
                else if (isset($_POST['bnt_insert_data']) and $_POST['bnt_insert_data'] == 'Cập Nhật') {
                    $valIdProduct = $_POST['idProduct'];
                    $valNameProduct = $_POST['inpNameProduct']; // nameProduct
                    $valPriceProduct = $_POST['inpPriceProduct']; // price product
                    $valDiscount = $_POST['inpDiscount']; // Discount
                    $urlImage = $_POST['upFile']; //img
                    $valSelectCategory = $_POST['inpSelectCategory']; // category
                    $valDate = $_POST['inpDate']; //date
                    $informationProduct = $_POST['product_desc']; // information product

                    $result = $conn->query("UPDATE product SET nameProduct = '" . $valNameProduct . "', price = '" . $valPriceProduct . "', discount = '" . $valDiscount . "', image = '" . $urlImage . "', product.describe='" . $informationProduct . "',id_category = '" . $valSelectCategory . "', date ='" . $valDate . "' WHERE product.id_product = " . $valIdProduct . "");
                    if (!$result) {
                        echo '<span class="notification__fail">Sửa Thất Bại !</span>';
                    } else {
                        echo '<span class="notification__success">Sửa Thành Công !</span>';     
                    }
                                                           
                                                                      
                }

                ?>


            </div>
            <!-- end input__product -->
            <form id="form__show__list" action="" method="post">
                <div class="show__list">
                    <div class="show__list__content">
                        <table>
                            <tr>
                                <th class="checkbox"></th>
                                <th>Hình Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Giảm Giá</th>
                                <th>Thông Tin</th>
                                <th>Loại Hàng</th>
                                <th colspan="2">Chức Năng</th>
                            </tr>
                            <?php
                            $conn = connectDB();
                            $result = $conn->query("SELECT P.image, P.nameProduct,P.price, P.discount, P.describe, C.nameCategory, P.id_product  FROM product P INNER JOIN category C ON P.id_category = C.id");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                                                <tr>
                                                                    <td><input type="checkbox" name="checkbox[]" value="' . $row['id_product'] . '"/></td>
                                                                    <td class="show__list__img" ><img src="'._WEB_HOST_TEMPLATE.'/images/' . $row['image'] . '"></td>
                                                                    <td>' . $row['nameProduct'] . '</td>
                                                                    <td>' . number_format($row['price']) . 'đ</td>
                                                                    <td>' . $row['discount'] . '%</td>
                                                                    <td>' . substr($row['describe'], 0, 100) . '...</td>
                                                                    <td>' . $row['nameCategory'] . '</td>
                                                                    <td class="box__bnt">
                                                                    <button class="bnt__product product__edit" name="edit" value="' . $row['id_product'] . '">Sửa</button>
                                                                    </td>
                                                                    <td class="box__bnt">
                                                                    <button class="bnt__product product__delete" onclick="return confirmDelete()" name="delete" value="' . $row['id_product'] . '">Xóa</button>
                                                                    </td>
                                                                </tr>
                                                            ';
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <!-- end show__list__conten -->
                    <div class="manage__product">
                        <div class="bnt__chooseAll">
                            <button class="bnt__product" onclick="return selectChekboxAll()">
                                Chọn Tất Cả
                            </button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__product" onclick="return closeChekboxAll()">
                                Bỏ Chọn Tất Cả
                            </button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__product" name="bntSelectChoose" onclick="return confirmDelete()">
                                Xóa Các Mục Đã Chọn
                            </button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__product" onclick="showAddproduct()">
                                Nhập Thêm
                            </button>
                        </div>
                    </div>
                </div>
                <!-- show list -->
            </form>
            <?php
            // xóa nhiều dữ liệu
            if (isset($_POST['bntSelectChoose'])) {
                $conn = connectDB();
                if (isset($_POST['checkbox'])) {
                    $valCheckbox = $_POST['checkbox'];
                    foreach ($valCheckbox as $value) {
                        // xóa bảng order
                        $resultA = $conn->query("SELECT * FROM oderdetail WHERE oderdetail.id_product = " . $value . "");
                        if ($resultA->num_rows > 0) {
                            while ($rowA = $resultA->fetch_assoc()) {
                                $conn->query("DELETE FROM orderr WHERE orderr.id_oderDetail = " . $rowA['id_oderDetail'] . "");
                            }
                        }

                        //  xóa bảng order detail
                        $conn->query("DELETE FROM oderdetail WHERE oderdetail.id_product = " . $value . "");

                        // xóa bảng cart
                        $resultB = $conn->query("SELECT * FROM  cartdetail WHERE cartdetail.id_product = " . $value . "");
                        if ($resultB->num_rows > 0) {
                            while ($rowB = $resultB->fetch_assoc()) {
                                $conn->query("DELETE FROM cart WHERE cart.idCartDetail = " . $rowB['id_cartDetail'] . "");
                            }
                        }

                        // xóa bảng cartdetail
                        $conn->query("DELETE FROM cartdetail WHERE cartdetail.id_product = " . $value . "");


                        // xóa bảng comment
                        $conn->query("DELETE FROM comment WHERE comment.id_product = " . $value . "");

                        // xóa bảng feedback
                        $conn->query("DELETE FROM feedback WHERE feedback.idProduct = " . $value . "");

                        // xóa sản phẩm
                        $resultFinal = $conn->query("DELETE FROM product WHERE product.id_product = " . $value . "");
                    }
                    if ($resultFinal) {
                        echo '<span class="notification__success">Xóa Thành Công !</span>';
                    } else {
                        echo '<span class="notification__fail">Xóa Thất Bại !</span>';
                    }
                    '<script>
                                                        setTimeout(function(){
                                                             window.location.href = "?module=admin&action=product";
                                                        }, 2);
                                                        </script>';
                }
            }
            // xóa lần lượt
            if (isset($_POST['delete'])) {
                $valSP = $_POST['delete'];
                $conn = connectDB();
                // xóa bảng order
                $resultA = $conn->query("SELECT * FROM oderdetail WHERE oderdetail.id_product = " . $valSP . "");
                if ($resultA->num_rows > 0) {
                    while ($rowA = $resultA->fetch_assoc()) {
                        $conn->query("DELETE FROM orderr WHERE orderr.id_oderDetail = " . $rowA['id_oderDetail'] . "");
                    }
                }

                //  xóa bảng order detail
                $conn->query("DELETE FROM oderdetail WHERE oderdetail.id_product = " . $valSP . "");

                // xóa bảng cart
                $resultB = $conn->query("SELECT * FROM  cartdetail WHERE cartdetail.id_product = " . $valSP . "");
                if ($resultB->num_rows > 0) {
                    while ($rowB = $resultB->fetch_assoc()) {
                        $conn->query("DELETE FROM cart WHERE cart.idCartDetail = " . $rowB['id_cartDetail'] . "");
                    }
                }

                // xóa bảng cartdetail
                $conn->query("DELETE FROM cartdetail WHERE cartdetail.id_product = " . $valSP . "");


                // xóa bảng comment
                $conn->query("DELETE FROM comment WHERE comment.id_product = " . $valSP . "");

                // xóa bảng feedback
                $conn->query("DELETE FROM feedback WHERE feedback.idProduct = " . $valSP . "");

                // xóa sản phẩm
                $resultFinal = $conn->query("DELETE FROM product WHERE product.id_product = " . $valSP . "");
                if ($resultFinal) {
                    echo '<span class="notification__success">Xóa Thành Công !</span>';
                } else {
                    echo '<span class="notification__fail">Xóa Thất Bại !</span>';
                }
                '<script>
                                                        setTimeout(function(){
                                                             window.location.href = "?module=admin&action=product";
                                                        }, 2);
                                                        </script>';

            }

            // hiển thị dữ liệu để sửa
            if (isset($_POST['edit'])) {
                $valSP = $_POST['edit'];
                $result = $conn->query("SELECT * FROM product WHERE id_product = '" . $valSP . "'");
                if ($result->num_rows > 0) {
                    // hiện thị dữ liệu
                    $row = $result->fetch_assoc();
                    echo "
                                                    <script type='text/javascript'>
                                                    document.getElementById('bnt__add__data').innerHTML = 'Cập Nhật';
                                                    document.getElementById('bnt__add__data').value = 'Cập Nhật';
                                                
                                                    document.getElementById('inp__code__product').value = '" . $row['id_product'] . "';
                                                    document.getElementById('view__product').value = '" . $row['view'] . "';
                                                    document.getElementById('inp__name__product').value = '" . $row['nameProduct'] . "';
                                                    document.getElementById('inp__price__product').value = '" . $row['price'] . "';
                                                    document.getElementById('inp__discount__product').value = '" . $row['discount'] . "';
                                                    document.getElementById('inp__category').value = '" . $row['id_category'] . "';
                                                    document.getElementById('inp__date').value = '" . $row['date'] . "';
                                                    document.getElementById('product_desc').value = '" . $row['describe'] . "';
                                                    document.querySelector('.title_product_add').innerText = 'Sửa Sản Phẩm';
                                                    document.querySelector('#inp__img').type = 'text';
                                                    document.querySelector('#inp__img').value = '" . $row['image'] . "';
                                                </script>
                                                ";

                }
            }

            ?>
        </div>
    </div>
</div>
</div>
<?php
layout('footer', 'admin', $data);
?>