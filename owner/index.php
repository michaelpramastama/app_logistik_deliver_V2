<?php
include '../koneksi.php';
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>OWNER PORTAL</title>
    <link rel="shortcut icon" href="assets/images/truck.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
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
                    <a href="index.php"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">

                            <li>
                                <a href="index.php" aria-expanded="true"><i class="fa fa-home"></i><span>Home
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="keuangan" aria-expanded="true"><i class="fa fa-usd"><i class="fa fa-long-arrow-up"></i></i><span>Uang Keluar
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="uang_masuk" aria-expanded="true"><i class="fa fa-usd"></i><i class="fa fa-long-arrow-down"></i><span>Uang Masuk
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
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <!-- <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form> -->
                            <?php
                                $date = '';
                                $time = '';
                                $date = '<h3>'.date('d-m-Y').'</h3>'; 
                                $time = '<div id="time" style="font-size: 30px;"></div>'; 
                                echo $date; echo " " ; echo $time;                               
                            ?>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="../logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-home"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Total Agent</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h2>
                                            <?php
                                                $query = "SELECT COUNT(*) as Jumlah FROM agent";
                                                $result = mysqli_query($koneksi, $query);
                                                $hasil = mysqli_fetch_assoc($result);
                                                echo $hasil['Jumlah'];
                                            ?>
                                        </h2>
                                        <!-- <span>- 45.87</span> -->
                                    </div>
                                </div>
                                <!-- <canvas id="" height="100"></canvas> -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-usd"></i></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Total Transaksi / hari</h4>
                                        
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h2>
                                             <?php
                                                $tanggal = date("d-m-Y");
                                                $query = "SELECT COUNT(*) as Jumlah FROM barang_masuk where tanggal = '$tanggal'";
                                                $result = mysqli_query($koneksi, $query);
                                                $hasil = mysqli_fetch_assoc($result);
                                                echo $hasil['Jumlah'];
                                            ?>
                                        </h2>
                                       
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-usd"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Pendapatan Bersih / hari</h4>
                                       
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h2>$ 4567809,987</h2>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sales report area end -->
                <!-- row area start -->
                <div class="row">
                    <!-- Live Crypto Price area start -->
                    <div class="col-lg-4" style=" height: 400px; overflow-y: scroll;">
                        <div class="card" >
                            <div class="card-body">
                                <h4 class="header-title">Uang Di Agent (Rp)</h4>
                                <div class="cripto-live mt-5" >
                                    <ul>
                                        <?php
                                            $query = "SELECT * FROM pendapatan_agent INNER JOIN agent ON pendapatan_agent.id_agent = agent.id";
                                            $result = mysqli_query($koneksi, $query);
                                            while($row = mysqli_fetch_array($result)){
                                                $output = '';
                                                $output = '
                                                <li>
                                                     <div class="icon b">Rp</div>'.$row['nama_agent'].'<span><i class="fa fa-long-arrow-down"></i>'.$row['saldo'].'</span>
                                                </li>';
                                                echo $output;
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style=" height: 400px; overflow-y: scroll;">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Komisi Agent (Rp)</h4>
                                <div class="cripto-live mt-5">
                                    <ul>
                                       <?php
                                            $query = "SELECT * FROM agent";
                                            $result = mysqli_query($koneksi, $query);
                                            while($row = mysqli_fetch_array($result)){
                                                $output = '';
                                                $output = '
                                                <li>
                                                     <div class="icon b">Rp</div>'.$row['nama_agent'].'<span><i class="fa fa-long-arrow-up"></i>'.$row['pendapatan'].'</span>
                                                </li>';
                                                echo $output;
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4" style=" height: 400px; overflow-y: scroll;">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Transaksi Agent / hari</h4>
                                <div class="cripto-live mt-5">
                                    <ul>
                                        <?php
                                            $tanggal = date("d-m-Y");
                                            $query = "SELECT nama_agent, COUNT(*) as jumlah FROM agent INNER JOIN barang_masuk ON agent.id = barang_masuk.agent where tanggal = '$tanggal'";
                                            $result = mysqli_query($koneksi, $query);
                                            while($row = mysqli_fetch_array($result)){
                                                $output = '';
                                                $output = '
                                                <li>
                                                     <div class="icon b">Rp</div>'.$row['nama_agent'].'<span>'.$row['jumlah'].'</span>
                                                </li>';
                                                echo $output;
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Live Crypto Price area end -->
                </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright <?php echo date('Y');?>. All right reserved.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        function Timer() {
        var dt=new Date()
        document.getElementById('time').innerHTML=dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
        setTimeout("Timer()",1000);
        }
        Timer();
    </script>
</body>

</html>
