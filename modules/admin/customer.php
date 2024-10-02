<?php
$data = [
    'pageTitle' => 'Quản lí khách hàng',
    'title' => "Quản lí khách hàng",
    'content' => 'Quản lí khách hàng có trên hệ thống',
    'select' => 2,
    'style'=>'customer'
];
layout('header', 'admin', $data);
$msg = getFlashData('msg');
?>

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">

            <div class="inp__customer">
                <form id="form__input__customer" action="" method="post" enctype="multipart/form-data">
                    <h1 class="title__customer__add">Thêm Mới Thành Viên</h1>
                    <div class="inp__customer__content">
                        <div class="form__group code__customer">
                            <label for="">Mã Khách Hàng</label>
                            <input type="text" name="idCustomer" id="code__customer" value="auto code" />
                        </div>
                        <!-- end code__customer -->
                        <div class="form__group name__customer">
                            <label for="">Tên Đăng Nhập</label>
                            <input type="text" name="nameCustomer" id="name__customer" required />
                        </div>
                        <!-- end name__customer -->
                        <div class="form__group email__customer">
                            <label for="">Email</label>
                            <input type="email" id="email__customer" name="emailCustomer" required />
                        </div>
                        <!-- end email -->
                        <div class="form__group pass__customer">
                            <label for="">Mật Khẩu</label>
                            <input type="password" name="passCustomer" id="pass__customer" required />
                        </div>
                        <!-- end pass__customer -->
                        <div class="form__group pass__customer">
                            <label for="">Xác Nhận Mật Khẩu</label>
                            <input type="password" id="en__pass__customer" name="enPassCustomer" required />
                        </div>
                        <!-- end pass__customer -->
                        <div class="form__group img__product">
                            <label for="">Avata</label>
                            <input type="file" name="upFile" id="inp__img" class="valInp"
                                accept=".jpg, .jpeg, .png, .jfif" required />
                        </div>
                        <!-- end img -->
                        <div class="form__group category__customer">
                            <label for="">Vai Trò</label>
                            <select name="role" id="role" required>
                                <option value="">-- Chọn Loại Vai Trò --</option>
                                <?php role();?>
                            </select>
                        </div>
                        <!-- end category__customer -->
                        <div class="form__group special__product">
                            <label for="">Quyền Truy Cập Quản Trị Viên ?</label>
                            <div class="inp__choose__special">
                                <div class="inp__special__item">
                                    <input type="radio" value="0" name="inpSpecial">
                                    <label for="">Không</label>
                                </div>
                                <div class="inp__special__item">
                                    <input type="radio" value="1" name="inpSpecial">
                                    <label for="">Có</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bnt_customer">
                        <button class="bnt_add" name="bntInsertData" id="bnt_add_data" onclick="return checkPass()"
                            value="Thêm Mới">Thêm mới</button>
                        <button class="bnt_retype" onclick="return reInput()">Nhập lại</button>
                        <button class="bnt_showList" onclick="return showAddcustomer()">Danh sách</button>
                    </div>
                    <!-- end bnt_customer -->
                </form>
                <?php 
                if(!empty($msg)) {
echo '<p class="btn btn-success btn-block ">'.$msg.'</p>';
                }

                ?>

                <?php 
                                            if (isset($_POST['bntInsertData'])) {
                                                $data = [
                                                    'fullname'=> $_POST['nameCustomer'],
                                                    'email'=> $_POST['emailCustomer'],        
                                                    'is_admin'=>    $_POST['inpSpecial'],
                                                    'id_role'=> $_POST['role'],  
                                                ];

                                                if ($_POST['bntInsertData'] == 'Thêm Mới') {
                                                    $nameUrlImgae =  upFile('upFile','D:/laragon/btl/Sellingfastfood/templates/images/avata/'); // img
                                                    $data['image']=$_FILES['upFile']['name'];
                                                    $data['password'] = $_POST['passCustomer'];
                                                    insert('user', $data);

                                                }else if ($_POST['bntInsertData'] == 'Cập Nhật'){

                                                }
                                              

                                                // if ($_POST['bntInsertData'] == 'Thêm Mới') {
                                                //     insertCustomer($userName,$passWord,$emailCustomer,$isAdmin,$role,$nameUrlImgae); 
                                                // } else if($_POST['bntInsertData'] == 'Cập Nhật') {
                                                //     $nameUrlImgae = $_POST['upFile'];
                                                //     updateCustomer($idCustomer,$userName,$emailCustomer,$isAdmin,$role,$nameUrlImgae);
                                                // }

                                            }
                                        ?>
            </div>
            <!-- end input__customer -->
            <form id="form__show__list" method="post" action="">
                <div class="show__list">
                    <div class="show__list__content">
                        <table>
                            <tr>
                                <th class="checkbox"></th>
                                <th>Avatar</th>
                                <th>Tên Đăng Nhập</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Vai Trò</th>
                                <th colspan="2">Chức Năng</th>
                            </tr>
                            <?php
                                              $conn = connectDB();
                                              $result = $conn -> query("SELECT * FROM user U INNER JOIN role RL ON U.id_role = RL.id_role");
                                              if ($result -> num_rows > 0) {
                                                  while($row = $result -> fetch_assoc()) {
                                                      if ($row['disabled'] !=1) {
                                                        $disabled = "Chặn";
                                                        $color = "customer__delete";
                                                      } else {
                                                        $disabled = "Bỏ Chặn";
                                                        $color = "bg__blue";
                                                      }
                                                    echo '
                                                        <tr>
                                                            <td><input type="checkbox" name ="checkbox[]" value="'.$row['id'].'"/></td>
                                                            <td class="img__avatar"><img src="'._WEB_HOST_TEMPLATE.'/images/avata/'.$row['image'].'" alt=""></td>
                                                            <td>'.$row['fullname'].'</td>
                                                            <td>'.$row['email'].'</td>
                                                            <td>'.$row['phone'].'</td>
                                                            <td>'.$row['nameRole'].'</td>
                                                            <td>
                                                            <button class="bnt__customer customer__edit" name="editCustomer" value="'.$row['id'].'">Sửa</button>
                                                            </td>
                                                            <td class="box__bnt ">
                                                            <button class="bnt__customer '.$color.'" name="deleteInTurn" value="'.$row['id'].'">'.$disabled.'</button>
                                                            </td>
                                                        </tr>
                                                    ';
                                                  }
                                                } else {
                                                    echo "Danh sách trống !";
                                                }
                                              ?>
                        </table>
                    </div>
                    <!-- end show__list__conten -->
                    <div class="manage__customer">
                        <div class="bnt__chooseAll">
                            <button class="bnt__customer" onclick="return selectChekboxAll()">
                                Chọn Tất Cả
                            </button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__customer" onclick="return closeChekboxAll()">
                                Bỏ Chọn Tất Cả
                            </button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__customer" name="bntDeleteSelect">
                                Bỏ Chặn Các Mục Đã Chọn
                            </button>
                        </div>
                        <div class="bnt__chooseAll">
                            <button class="bnt__customer" onclick="return true">
                                <!-- //showListcustomer() -->
                                Nhập Thêm
                            </button>
                        </div>
                    </div>
                </div>
                <!-- show list -->
            </form>
            <?php 
                                        //   block select customer
                                            if (isset($_POST['bntDeleteSelect'])) {
                                                if (isset($_POST['checkbox'])) {
                                                    $valCheckbox = $_POST['checkbox'];
                                                    deleteCustomer($valCheckbox);
                                                }
                                            }
                                        // block customer in turn    
                                        if (isset($_POST['deleteInTurn'])) {
                                            deleteInTurn($_POST['deleteInTurn']);
                                        }
                                        showData();
                                    ?>

        </div>
        <!-- end page-wrapper -->
    </div>
    <!-- Main-body start -->
</div>
<?php
layout('footer','admin',$data)
?>