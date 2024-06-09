<?php
session_start();
if($_SESSION['login'] == FALSE) {
	header('location:../login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Rumah Sakit Terpadu</title>
    <link rel="icon" href="img/logoKesehatan.jpg" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/datatables/dataTables.bootstrap5.min.css">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon ">
                    <div style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%;">
                        <img src="img/logoKesehatan.jpg" width="40px" height="40px" alt="">
                    </div>
                </div>
                <div class="sidebar-brand-text mx">Sistem Rumah Sakit Terpadu</div>
            </a>

            <?php 
    			$active=isset($_GET['p']) ? $_GET['p'] : 'active'; 
  
  			?>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= $active ?>">
                <a class="nav-link " href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pasien -->
            <li class="nav-item <?php if ($active=='pasien') echo 'active' ?>">
                <a class="nav-link" href="index.php?p=pasien">
                    <i class="fas fa-fw fa-bed"></i>
                    <span>Pasien</span>
                </a>
            </li>

            <!-- Nav Item - Dokter -->
            <li class="nav-item <?php if ($active=='dokter') echo 'active' ?>">
                <a class="nav-link" href="index.php?p=dokter">
                    <i class="fas fa-fw fa-user-doctor"></i>
                    <span>Dokter</span>
                </a>
            </li>

            <!-- Nav Item - Poli -->
            <li class="nav-item <?php if ($active=='poli') echo 'active' ?>">
                <a class="nav-link" href="index.php?p=poli">
                    <i class="fas fa-fw fa-solid fa-house-medical"></i>
                    <span>Poli</span>
                </a>
            </li>

            <!-- Nav Item - Obat -->
            <li class="nav-item <?php if ($active=='obat') echo 'active' ?>">
                <a class="nav-link" href="index.php?p=obat">
                    <i class="fas fa-fw fa-solid fa-pills"></i>
                    <span>Obat</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Layanan
            </div>

            <!-- Nav Item - Jadwal Dokter -->
            <li class="nav-item <?php if ($active=='jdw_dokter') echo 'active' ?>">
                <a class="nav-link" href="index.php?p=jdw_dokter">
                    <i class="fas fa-fw fa-solid fa-calendar-days"></i>
                    <span>Jadwal Dokter</span>
                </a>
            </li>

            <!-- Nav Item - Kunjungan -->
            <li class="nav-item <?php if ($active=='kunjungan') echo 'active' ?>">
                <a class="nav-link" href="index.php?p=kunjungan">
                    <i class="fas fa-fw fa-solid fa-notes-medical"></i>
                    <span>Kunjungan</span>
                </a>
            </li>

            <!-- Nav Item - Berita -->
            <li class="nav-item <?php if ($active=='berita') echo 'active' ?>">
                <a class="nav-link" href="index.php?p=berita">
                    <i class="fas fa-fw fa-solid fa-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <main>
                    <?php
                        $p=isset($_GET['p']) ? $_GET['p'] : 'dashboard';
                        if ($p=='dashboard') include 'dashboard.php';
                        if ($p=='pasien') include 'pasien.php';
                        if ($p=='poli') include 'poli.php';
                        if ($p=='dokter') include 'dokter.php';
                        if ($p=='obat') include 'obat.php';
                        if ($p=='jdw_dokter') include 'jadwal_dokter.php';
                        if ($p=='kunjungan') include 'kunjungan.php';
                        if ($p=='berita') include 'berita.php';
                    ?>
                </main>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?= date("Y");?>. Rumah Sakit Terpadu </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" di bawah jika ingin mengakhiri sesi ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="../css/datatables/jquery-3.7.0.js"></script>

    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="../js/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script src="../css/datatables/jquery.dataTables.min.js"></script>

    <!-- jQuery Easing (Core plugin) -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- SB Admin 2 -->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Chart.js (Page level plugin) -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>


    <script>
    $(document).ready(function() {
        $('#tabel-pasien').DataTable();
        $('#tabel-poli').DataTable();
        $('#tabel-dokter').DataTable();
        $('#tabel-obat').DataTable();
        $('#tabel-jdw_dokter').DataTable();
    });
    </script>
</body>

</html>