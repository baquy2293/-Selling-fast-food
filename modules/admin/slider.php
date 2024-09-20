<?php
$data = [
    'pageTitle' => 'Cài đặt',
    'title' => "Cài đặt",
    'content' => 'Cài đặt thông tin website',
    'select' => 2,
    'style'=>'slider'
];
layout('header', 'admin', $data);

?>
 <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="inp__category">
                                        <form id="form__input__category" action="" method="post" enctype="multipart/form-data">
                                          <div class="form__group code__category">
                                            <label for="">Mã Slide: </label>
                                            <input type="text" value="auto" id="valCategory" name = "valCategory"/> <!-- disabled-->
                                          </div>
                                          <!-- end code__category -->
                                          <div class="form__group name__category">
                                            <label for="">Đường Dẫn: </label>
                                            <input type="text" id="nameCategory" class="valInp" name="nameCategory" required />
                                          </div>
                                          <!-- end name__category -->
                                          <div class="form__group img__category">
                                            <label for="">Hình ảnh: </label>
                                            <input type="file" id="imgCategory" class="valInp" name="fileCategory" accept=".jpg, .jpeg, .png, .jfif" required/>
                                          </div>
                                          <!-- end img__category -->
                                          
                                          <div class="bnt_category">
                                            <button id="bnt_add" class="bnt_add" name="bnt_add"" value="Thêm Mới">Thêm mới</button>
                                            <button class="bnt_retype" onclick="reInput()">Nhập lại</button>
                                            <button class="bnt_showList" onclick="showListCategory()">Danh sách</button>
                                          </div>
                                          <!-- end bnt_category -->
                                        </form>
                                      </div>
                                      <?php 
                                      // them du lieu 
                                        $conn = connectDB();
                                        if (isset($_POST['bnt_add']) and $_POST['bnt_add'] == 'Thêm Mới') {
                                            $nameCategory = $_POST['nameCategory'];
                                            $nameIMG = $_FILES['fileCategory']['name'];
                                            $tmp_name = $_FILES['fileCategory']['tmp_name'];
                                            move_uploaded_file($tmp_name, "../../images/". $nameIMG);
                                            $sql = "INSERT INTO slide VALUES ('null','$nameIMG','$nameCategory')";
                                            if ($conn->query($sql)) {
                                                echo "Bạn Đã Thêm Thành Công !";
                                            } else {
                                                echo "Không Thể Trùng Mã Sản Phẩm !";
                                            }
                                        }
                                        // update dữ liệu
                                        else if (isset($_POST['bnt_add']) and $_POST['bnt_add'] == 'Cập Nhật') {
                                            $idCategory = $_POST['valCategory'];
                                            $nameCategory = $_POST['nameCategory'];
                                            $urlImage = $_POST['fileCategory'];
                                            $result = $conn->query("UPDATE slide SET link ='".$nameCategory ."',image='".$urlImage."' WHERE id_silde = '".$idCategory."'");
                                            if (!$result) {
                                                echo "<span class = 'alertErr'>Sửa Thất Bại !</span>";
                                            } else {
                                                echo "<span class = 'alertErr'>Sửa Thành Công !</span>";
                                                header("location: ./index.php");
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
                                                <th>Mã Banner</th>
                                                <th>Hình Ảnh</th>
                                                <th>Đường Dẫn</th>
                                                <th colspan="2">Chức Năng</th>
                                              </tr>
                                              <?php 
                                              $conn = connectDB();
                                              $result = $conn -> query("SELECT * FROM slide");
                                              if ($result->num_rows > 0) {
                                                  while($row = $result-> fetch_assoc()) {
                                                    echo '
                                                        <tr>
                                                            <td><input type="checkbox" name="checkbox[]" value = "'.$row['id_silde'].'"/></td>
                                                            <td>'.$row['id_silde'].'</td>
                                                            <td class="show__list__img" ><img src="'._WEB_HOST_TEMPLATE.'/images/'.$row['image'].'"></td>
                                                            <td>'.$row['link'].'</td>
                                                            <td class="box__bnt">
                                                            <button class="bnt__category category__edit" name ="editSilde" value="'.$row['id_silde'].'">Sửa</button>
                                                            </td>
                                                            <td class="box__bnt">
                                                            <button class="bnt__category category__delete" name ="delete" value="'.$row['id_silde'].'">Xóa</button>
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
                                              <button class="bnt__category" name="bntDeletechoose">Xóa Các Mục Đã Chọn</button>
                                            </div>
                                            <div class="bnt__chooseAll">
                                              <button class="bnt__category" onclick="return showAddCategory()">Nhập Thêm</button>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- show list -->
                                        <!-- edit data -->
                                        <?php 
                                        // hiển thị dữ liệu để sửa
                                            if (isset($_POST['editSilde'])) {
                                                $valSP = $_POST['editSilde'];
                                                $result = $conn->query("SELECT * FROM slide WHERE id_silde = '".$valSP."'");
                                                if ($result->num_rows > 0) {
                                                    // hiện thị dữ liệu
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "
                                                            <script type='text/javascript'>
                                                            document.getElementById('bnt_add').innerHTML = 'Cập Nhật';
                                                            document.getElementById('bnt_add').value = 'Cập Nhật';
                                                            document.getElementById('valCategory').value = '".$row['id_silde'] . "';
                                                            document.getElementById('nameCategory').value = '".$row['link'] . "';
                                                            document.querySelector('#imgCategory').type = 'text';
                                                            document.querySelector('#imgCategory').value = '".$row['image']."';
                                                        </script>
                                                        ";
                                                    }
                                                }
                                            }
                                        // Xóa dữ liệu 
                                            if(isset($_POST['delete'])) {
                                                $valML = $_POST['delete'];
                                                $conn = connectDB();
                                                $result = $conn -> query("DELETE FROM slide WHERE slide.id_silde = '".$valML."'");
                                                header("location: ./index.php");
                                            }
                                        ?>
                                    </form>
                                    <?php 
                                        if (isset($_POST['bntDeletechoose'])) {
                                            $conn = connectDB();
                                            if (isset($_POST['checkbox'])) {
                                                $valCheckbox = $_POST['checkbox'];
                                                foreach ($valCheckbox as $value) {
                                                    $result = $conn -> query("DELETE FROM slide WHERE slide.id_silde = ".$value."");
                                                }
                                                header("location: ./index.php");
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