<?php
$data = [
    'pageTitle'=>'Thực đơn',
    'style'=>'product'
];
layout('header','core',$data);
?>
<main>
    <div class="content ">
        <div class="filter-product ">
            <form action="" method="post">
                <div class="category-product ">
                    <div class="category-prdTop ">
                        <span class="DanhMuc ">DANH MỤC</span>
                        <span class="icon-dropDownDM " onclick="showCategory() ">▼</span>
                    </div>
                    <div class="inp-category">
                        <ul class="list-choose">
                            <?php
                                        if (isset($_POST['bntSreachCategory'])) {
                                            showCategory(-1);
                                        } else {
                                            if(isset($_GET['idML'])){
                                                showCategory($_GET['idML']);
                                            } else {
                                                showCategory(0);
                                            } 
                                        }      
                                    ?>
                        </ul>
                    </div>
                </div>
                <button class="bnt_sea_carte" name="bntSreachCategory">Tìm Kiếm</button>
            </form>
            <!-- end category-product -->
        </div>
        <!-- end filter product -->
        <div class="show-product">
            <!-- <div class="sort-product">
                <form action="" method="post">
                    <label>Sắp xếp theo: </label>
                    <select>
                        <option> --- Sắp Xếp Theo --- </option>
                        <button>
                            <option>Giá rẻ nhất</option>
                        </button>
                        <option><button>Giá cao nhất</button></option>
                        <option><button>Mẫu mới nhất</button></option>
                        <option><button>Mẫu hot nhất</button></option>
                    </select>
                    <?php 
                                // if (isset($_POST['bntSearch'])){
                                //     disTxtSearch($_POST['txtSearch']);
                                // }
                                ?>
                </form>
            </div> -->
            <!--end sort-product -->
            <hr class="hr-btSort">
            <div class="box-product_Hot">
                <?php if (isset($_POST['bntSearch'])) {
                            $conn = connectDB();
                            $key = $_POST['txtSearch'];
                            $result = $conn->query("SELECT * FROM product where product.nameProduct like '%".$key."%'" );
                            if ($result -> num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '
                                        <div class="item-product-hot">
                                            <div class="item-product-hot-img">
                                                <img src="'._WEB_HOST_TEMPLATE.'/images/'.$row['image'].'" alt="" />
                                                <a href="?module=client&action=detail&id='.$row["id_product"].'">Mua Ngay</a>
                                                <span class="discount">- '.$row['discount'].'%</span>
                                            </div>
                                            <div class="item-product-information">
                                                <p class="name-product">'.$row['nameProduct'].'</p>
                                                <span class="priceSaled-product">'.number_format(ceil(($row['price']-($row['price']*$row['discount'])/100))).' đ</span>
                                                <span class="price-product">'.number_format($row['price']).' đ</span>
                                            </div>
                                        </div>
                                        <!-- end  item-product-hot-->';
                                }
                            } else {
                                echo "<span>Không tìm được sản phẩm !</span>";
                            }
                        } else {
                                if (isset($_POST['bntSreachCategory'])) {
                                    showListCategory($_POST['valCheckbox']);
                                } else {
                                    if (isset($_GET['idML'])) {
                                    showProductCategory2($_GET['idML']);
                                    } else {
                                        showProductCategory2(0);
                                    }

                                }
                            }
                        ?>
            </div>
            <!-- end show-item-product -->
        </div>
        <!-- end show product -->
    </div>
    <!-- enn content -->
    <?php 
layout('footer','core',$data);