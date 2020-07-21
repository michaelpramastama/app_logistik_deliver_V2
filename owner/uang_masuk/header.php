<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>OWNER PORTAL</title>
    <link rel="shortcut icon" href="../assets/images/truck.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
     <link href="file/datatable/datatables.min.css" rel="stylesheet">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<?php 
    	session_start();
     
    	// cek apakah yang mengakses halaman ini sudah login
    	if($_SESSION['level']==""){
    		header("location:../index.php?pesan=gagal");
    	}
     
?>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
  
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="../index.php"><img src="../assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="../" aria-expanded="true"><i class="fa fa-home"></i><span>Home
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="../keuangan" aria-expanded="true"><i class="fa fa-usd"></i><i class="fa fa-long-arrow-up"></i><span>Uang Keluar
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php" aria-expanded="true"><i class="fa fa-usd"></i><i class="fa fa-long-arrow-down"></i></i><span>Uang Masuk
                                    </span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Charts</span></a>
                                <ul class="collapse">
                                    <li><a href="barchart.html">bar chart</a></li>
                                    <li><a href="linechart.html">line Chart</a></li>
                                    <li><a href="piechart.html">pie chart</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->