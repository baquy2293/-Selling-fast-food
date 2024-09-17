<?php
//var_dump($_SESSION['user']['id_role']);

if ($_SESSION['user']['id_role'] != 0) {
    redirect("?module=auth&action=login");
} else {
    global $idCustomer;
    $idCustomer = $_SESSION['user']['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'TRINH BA QUY'; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="keywords"
          content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive"/>
    <meta name="author" content="Codedthemes"/>
    <!-- Favicon icon -->
    <!-- <link rel="icon" href="../images/logoToc.jfif" type="image/x-icon"> -->
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/pages/waves/css/waves.min.css"
          type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/pages/waves/css/waves.min.css"
          type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
          integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/t.css?ver=<?php echo rand(); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/stylea.min.css?ver=<?php echo rand(); ?>">

</head>