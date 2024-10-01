<?php
$checklogin = isLogin();

if ($checklogin != 'admin') {
    redirect('?module=auth&action=login');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'TRINH BA QUY'; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
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
    <!-- <link rel="stylesheet" type="text/css"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/t.css?ver=<?php echo rand(); ?>"> -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/css/style.css?ver=<?php echo rand(); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo _WEB_HOST_ADMIN_TEMPLATE . '/assets/css/style_' . $data['style'] . '.css?ver=' . rand(); ?>">


</head>

<body>
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i
                                                class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i
                                                class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="?module=admin&action=views">
                            <?php logo(0) ?>
                            <span>Quản Lý QNT</span>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <?php avatar($_SESSION['user']['id'], 0) ?>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="?module=auth&action=logout">
                                            <i class="ti-layout-sidebar-left"></i> Đăng Xuất
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <?php avatar($_SESSION['user']['id'], 1) ?>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="?module=auth&action=logout"><i
                                                    class="ti-layout-sidebar-left"></i>Đăng
                                                Xuất</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pcoded-navigation-label">Chức Năng</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class=" <?php echo $data['select'] == 1 ? "active" : null; ?>">
                                    <a href="?module=admin&action=views" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Tổng Quát</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <?php
                            if ($_SESSION['user']['is_admin'] == 1) { ?>

                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu  ">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                                            <span class="pcoded-mtext">Quản Lý Hệ Thống</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class=" <?php echo $data['select'] == 2 ? "active" : null; ?>">
                                                <a href="?module=admin&action=product" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Quản Lý Sản Phẩm</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="?module=admin&action=category" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Quản Lý Loại Sản Phẩm</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="?module=admin&action=customer" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Quản Lý Khách Hàng</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="?module=admin&action=comment" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Quản Lý Bình Luận</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="?module=admin&action=slider" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Quản Trị Slider</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="?module=admin&action=discount" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Quản trị mã giảm giá</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="pcoded-item pcoded-left-item">
                                    <li class=" <?php echo $data['select'] == 3 ? "active" : null; ?>">
                                        <a href="?module=admin&action=oder" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fas fa-truck"></i><b>C</b></span>
                                            <span class="pcoded-mtext">Đơn Hàng</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="pcoded-item pcoded-left-item">
                                    <li class=" <?php echo $data['select'] == 4 ? "active" : null; ?>">
                                        <a href="?module=admin&action=statis" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-bar-chart-alt"></i><b>C</b></span>
                                            <span class="pcoded-mtext">Thống Kê</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class=" <?php echo $data['select'] == 5 ? "active" : null; ?>">
                                        <a href="?module=admin&action=setting" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fas fa-cogs"></i><b>FC</b></span>
                                            <span class="pcoded-mtext">Cài Đặt</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">
                                                <?php echo !empty($data['title']) ? $data['title'] : 'Tổng Quát'; ?>
                                            </h5>
                                            <p class="m-b-0">
                                                <?php echo !empty($data['content']) ? $data['content'] : ''; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>