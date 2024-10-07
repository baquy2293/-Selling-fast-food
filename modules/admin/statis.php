<?php
$data = [
    'pageTitle' => 'Thống kê',
    'title' => "Thống kê",
    'content' => 'Thống kê dữ liệu website',
    'select' => 4,
    'style' => 'static'
];
layout('header', 'admin', $data);
?>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <!-- Area Chart start -->
                    <div class="chart_item">
                        <h2>Thống Kê Số Lượng Hàng Hóa Của Từng Loại Sản Phẩm</h2>
                        <div id="myChart_category" style="width:100%; max-width:600px; height:600px; margin: auto;">
                        </div>
                    </div>
                    <!-- chart_item -->
                    <div class="chart_item">
                        <h2>Thống Kê Doanh Thu Theo Tháng</h2>
                        <div id="myCharRevenue" style="width:100%; max-width:600px; height:600px; margin: 0 200px;">
                        </div>
                    </div>
                    <!-- chart_item -->
                    <div class="chart_item">
                        <h2>Thống Kê Các Sản Phẩm Bán CHạy</h2>
                        <div id="myPlot" style="width:100%;max-width:700px"></div>
                    </div>
                    <!-- chart_item -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
layout('footer', 'admin', $data);

?>
<?php
$conn = connectDB();

// Lấy dữ liệu thống kê số lượng sản phẩm theo loại
$result_category = $conn->query("SELECT COUNT(id) AS 'SL', category.nameCategory 
                                 FROM category 
                                 INNER JOIN product ON category.id = product.id_category 
                                 GROUP BY category.nameCategory");

// Lấy dữ liệu thống kê doanh thu theo tháng
$result_revenue = $conn->query("SELECT (SUM(price_receiver *qty) + SUM(freeship)) AS 'tongtien', 
           MONTH(date_order) AS 'thang', 
           YEAR(date_order) AS 'nam' 
    FROM orderr
    WHERE status = 5 
    GROUP BY MONTH(date_order), YEAR(date_order)");

// Lấy dữ liệu thống kê sản phẩm bán chạy
$result_top_products = $conn->query("SELECT COUNT(orderr.id_product) AS 'SLSP', product.nameProduct 
                                     FROM orderr
                                     INNER JOIN product ON product.id_product = orderr.id_product 
                                     GROUP BY orderr.id_product 
                                     LIMIT 10");

$conn->close();
?>

<script>
    // Load Google Charts cho cả hai biểu đồ
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        drawChartCategory();
        drawChartRevenue();
    }

    // Biểu đồ số lượng sản phẩm theo loại
    function drawChartCategory() {
        var data = google.visualization.arrayToDataTable([
            ['Đồ Uống', 'Số Sản Phẩm'],
            <?php
            while ($row = $result_category->fetch_assoc()) {
                echo "['" . $row['nameCategory'] . "', " . $row['SL'] . "],";
            }
            ?>
        ]);

        var options = {
            title: 'Biểu Đồ Quy Mô Các Loại Hàng Hóa',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('myChart_category'));
        chart.draw(data, options);
    }

    // Biểu đồ doanh thu theo tháng
    function drawChartRevenue() {
        var data = google.visualization.arrayToDataTable([
            ['Tháng', 'Doanh Thu'],
            <?php
            while ($row = $result_revenue->fetch_assoc()) {
                echo "['Tháng " . $row['thang'] . "', " . $row['tongtien'] . "],";
            }
            ?>
        ]);

        var options = {
            title: 'Biểu Đồ Doanh Thu Từng Tháng'
        };

        var chart = new google.visualization.BarChart(document.getElementById('myCharRevenue'));
        chart.draw(data, options);
    }
</script>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>
    // Dữ liệu cho biểu đồ sản phẩm bán chạy
    var xArray = [
        <?php
        while ($row = $result_top_products->fetch_assoc()) {
            echo '"' . $row['nameProduct'] . '",';
        }
        ?>
    ];
    var yArray = [
        <?php
        $result_top_products->data_seek(0);  // Quay lại từ đầu kết quả
        while ($row = $result_top_products->fetch_assoc()) {
            echo $row['SLSP'] . ',';
        }
        ?>
    ];

    // Vẽ biểu đồ sản phẩm bán chạy bằng Plotly
    var data = [{
        x: xArray,
        y: yArray,
        type: "bar"
    }];

    var layout = {
        title: 'Biểu Đồ Sản Phẩm Bán Chạy'
    };

    Plotly.newPlot("myPlot", data, layout);
</script>