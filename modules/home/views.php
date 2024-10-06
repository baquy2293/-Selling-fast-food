<?php
$data = [
    'pageTitle' => 'Trang chủ',
    'style' => 'home',
];
layout('header', 'core', $data);
?>
<main>
    <div class="banner">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $i = 1;
                $conn = connectDB();
                $result = $conn->query("SELECT * FROM slide ");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($i++ == 1) {
                            echo '
                        <div class="carousel-item active">                     
                      <img class="bannerImg" src="' . _WEB_HOST_TEMPLATE . '/images/slide/' . $row['image'] . '" class="d-block w-100" alt="...">
                        </div>
                      ';
                        } else {
                            echo '
                        <div class="carousel-item">                
                          <img class="bannerImg" src="' . _WEB_HOST_TEMPLATE . './images/slide/' . $row['image'] . '" class="d-block w-100" alt="...">

                        </div>
                      ';
                        }
                    }
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- end banner -->
    <div class="product_hot">
        <div class="title-product_hot">
            <h1 id="title_deal">Commbo</h1>
        </div>
        <!-- end title-product_hot -->
        <div class="box-product_Hot">
            <div class="owl-carousel owl-theme">
                <?php showProductHot(); ?>
            </div>
        </div>
    </div>
    <?php 
// $category = getRaw('select * from category');
// foreach ($category as $key => $value) {
// var_dump($value);
// }

?>

    <!-- end product-hot -->
    <div class="product_lemonTea">
        <div class="title-product_hot">
            <h1 id="title_deal">Đồ Ăn Nhanh</h1>
        </div>
        <!-- end title-product_hot -->
        <div class="box-product_Hot">
            <?php showProductCategory(30) ?>
        </div>
    </div>
    <!-- end product_lemonTea -->
    <div class="product_drinkTea">
        <div class="title-product_hot">
            <h1 id="title_deal">Đồ Uống</h1>
        </div>
        <!-- end title-product_hot -->
        <div class="box-product_Hot">
            <?php showProductCategory(31) ?>
        </div>
        <!-- end box-product_Hot -->
    </div>
    <!-- end product_drinkTea -->
    <div class="list-category">
        <div class="title-list-category">
            <h1>Danh Mục Sản Phẩm</h1>
        </div>
        <div class="slide-category">
            <div class="owl-carousel owl-theme">
                <?php
                $conn = connectDB();
                $result = $conn->query("SELECT * FROM category");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                          <div class="item list-category-item">
                            <img src="' . _WEB_HOST_TEMPLATE . '/images/' . $row['image'] . '" alt="" />
                            <span>' . $row['nameCategory'] . '</span>
                          </div>
                        
                  ';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- end list category-->
</main>

</div>


<?php
layout('footer', 'core');