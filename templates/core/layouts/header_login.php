<?php 

if(isLogin()!=false){
redirect('?module=home&action=views');}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'TRINH BA QUY'; ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #B38B60;
            --text-color: #157332;
        }
    </style>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_CORE_TEMPLATE ?>/assets/css/styleNem.css?ver=<?php echo rand()?>">
    <script src="https://kit.fontawesome.com/9238eff31b.js" crossorigin="anonymous"></script>

</head>