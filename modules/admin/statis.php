<?php
$data = [
    'pageTitle' => 'Thống kê',
    'title' => "Thống kê",
    'content' => 'Thống kê dữ liệu website',
    'select' => 4
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
                        <div id="myChart_category" style="width:100%; max-width:600px; height:600px; margin: auto;"></div>
                    </div>
                    <!-- chart_item -->
                    <div class="chart_item">
                        <h2>Thống Kê Doanh Thu Theo Tháng</h2>
                        <div id="myCharRevenue" style="width:100%; max-width:600px; height:600px; margin: 0 200px;"></div>
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
layout('footer', 'admin');

?>
<script>
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Đồ Uống', 'Số Sản Phẩm'],
                <?php 
                    $conn = connectDB();
                    $result = $conn -> query("SELECT COUNT(id) AS 'SL', category.nameCategory FROM category INNER JOIN product ON category.id = product.id_category GROUP BY category.nameCategory") ;
                    while ($row = $result -> fetch_assoc()) {
                        echo "['".$row['nameCategory']."', ".$row['SL']."],";
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
    </script>

    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartComment);

        function drawChartComment() {
            var data = google.visualization.arrayToDataTable([
                ['Tháng', 'Doanh Thu'],
                <?php 
                    $conn = connectDB();
                    $result = $conn -> query('SELECT (SUM(OD.price * OD.qty) + O.feeShip) AS "tongtien", MONTH(O.dateOrder) AS "thang", YEAR(O.dateOrder) AS "nam" FROM orderr O INNER JOIN oderdetail OD INNER JOIN product P INNER JOIN status S ON O.id_oderDetail = OD.id_oderDetail AND O.status = S.id AND OD.id_product = P.id_product WHERE O.status = 5 AND YEAR(O.dateOrder) = 2021 GROUP BY MONTH(O.dateOrder)') ;
                    while ($row = $result -> fetch_assoc()) {
                        echo "['Tháng ".$row['thang']."', ".$row['tongtien']."],";
                    }   
                ?>
            ]);

            var options = {
                title: 'Biểu Đồ Doanh Thu Từng Tháng',
            };
            var chart = new google.visualization.BarChart(document.getElementById('myCharRevenue'));
            chart.draw(data, options);
        }
    </script>
    
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>
    var xArray = [
        <?php 
            $conn = connectDB();
            $result = $conn -> query('SELECT COUNT(oderdetail.id_product) AS "SLSP", product.nameProduct FROM oderdetail INNER JOIN product ON product.id_product = oderdetail.id_product GROUP BY oderdetail.id_product LIMIT 10') ;
            while ($row = $result -> fetch_assoc()) {
                echo '"'.$row['nameProduct'].'",';
            }   
        ?>
    ];
    var yArray = [
        <?php 
            $conn = connectDB();
            $result = $conn -> query('SELECT COUNT(oderdetail.id_product) AS "SLSP", product.nameProduct FROM oderdetail INNER JOIN product ON product.id_product = oderdetail.id_product GROUP BY oderdetail.id_product LIMIT 10') ;
            while ($row = $result -> fetch_assoc()) {
                echo $row['SLSP'].' ,';
            }   
        ?>
    ];

    var data = [{
    x:xArray,
    y:yArray,
    type:"bar"
    }];


    Plotly.newPlot("myPlot", data);
    </script>
