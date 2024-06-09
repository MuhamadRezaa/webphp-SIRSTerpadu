<?php
    session_start();
    if($_SESSION['login'] == False) {
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sakit Terpadu</title>
    <link rel="icon" href="img/logoKesehatan.jpg" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/datatables/dataTables.bootstrap5.min.css">

    <!-- Custom styles for the navbar -->
    <style>
    .navbar {
        padding: 20px;
        /* Adjust the padding as needed */
        height: 80px;
        /* Adjust the height as needed */
    }

    .navbar-nav .nav-link {
        font-size: 18px;
        /* Adjust the font size as needed */
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
        <div class="container">
            <div class="navbar-brand-icon ">
                <div style="width: 40px; height: 40px; overflow: hidden; border-radius: 50%;">
                    <img src="img/logoKesehatan.jpg" width="40px" height="40px" alt="">
                </div>
            </div>
            <a class="navbar-brand mx-2" href="index.php"> Rumah Sakit Terpadu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php 
                    $active=isset($_GET['p']) ? $_GET['p'] : 'active';  
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $active ?>" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active=='pasien') echo 'active' ?>"
                            href="index.php?p=pasien">Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active=='dokter') echo 'active' ?>"
                            href="index.php?p=dokter">Dokter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active=='jdw_dokter') echo 'active' ?>"
                            href="index.php?p=jdw_dokter">Jadwal Dokter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active=='kunjungan') echo 'active' ?>"
                            href="index.php?p=kunjungan">Kunjungan</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <?php
                        if ($_SESSION['login'] == TRUE): 
                    ?>
                    <a class="btn btn-danger me-2" href="logout.php">Logout</a>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mt-3">
            <?php
            include 'koneksi.php';
            $p=isset($_GET['p']) ? $_GET['p'] : 'home';
            if ($p=='home') include 'home.php';
            if ($p=='pasien') include 'pasien.php';
            if ($p=='dokter') include 'dokter.php';
            if ($p=='jdw_dokter') include 'jadwal_dokter.php';
            if ($p=='kunjungan') include 'kunjungan.php';
            ?>
        </div>
    </main>

    <style>
    ul li {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 13px;
    }

    h3 {
        color: black;
    }

    h6 {
        color: white;
    }
    </style>
    <footer>
        <div class="footer-grids" style="background-color:#52be80;background-image:linear-gradient(#a2d9ce, #45b39d);">
            <div class="container align-items-center">
                <div class="row mt-3 ">
                    <div class="col-md-4 mt-3">
                        <h3>Kontak RS Terpadu</h3>
                        <h6><i class="fas fa-location-dot fa-sm fa-fw mr-2 text-light-400"></i>
                            Jl. Rs Terpadu No. 12
                        </h6>
                        <h6><i class="fas fa-phone fa-sm fa-fw mr-2 text-light-400"></i>
                            0274-321123
                        </h6>
                        <h6><i class="fas fa-envelope fa-sm fa-fw mr-2 text-light-400"></i>
                            csrsterpadu@rstu.com
                        </h6>
                    </div>
                    <div class="col-md-4 mt-3">
                        <h3>Pendaftaran</h3>
                        <h6>Senin - Kamis : 07.15 - 11.00</h6>
                        <h6>Jum'at - Sabtu : 07.15 - 10.00</h6>
                        <h6>NB : Jadwal dapat berubah sewaktu-waktu</h6>
                        <div class="clear"></div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <h3>Kunjung Pasien</h3>
                        <h6 style="text-align: justify">Mulai hari Senin, 10 Juli 2023, RS Terpadu memberlakukan aturan
                            jam kunjung pasien
                            sebagai berikut:
                            Senin-Sabtu pukul 16.00-18.00 WIB
                            Minggu & Hari Libur Nasional pukul 10.00-12.00 WIB & 16.00-18.00 WIB, dengan ketentuan:
                        </h6>
                        <ul class="text-light">
                            <li>Pengunjung dalam kondisi sehat</li>
                            <li>Tetap menerapkan protokol kesehatan (menggunakan masker dan cuci tangan)</li>
                            <li>Pengunjung masuk ke ruang pasien secara terbatas dan bergantian</li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="sticky-footer bg-success">
            <div class="container my-auto">
                <div class="copyright text-center text-light my-auto">
                    <span>Copyright &copy; <?= date("Y");?>. Rumah Sakit Terpadu </span>
                </div>
            </div>
        </footer>

    </footer>
    <!-- //footer -->
    <!-- jQuery -->
    <script src="css/datatables/jquery-3.7.0.js"></script>

    <!-- Bootstrap JS -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="js/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script src="css/datatables/jquery.dataTables.min.js"></script>

    <!-- jQuery Easing (Core plugin) -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- SB Admin 2 -->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Chart.js (Page level plugin) -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
    new DataTable('#tabel-pasien');
    new DataTable('#tabel-jdw_dokter');
    new DataTable('#tabel-kunjungan');
    new DataTable('#tabel-dokter');
    </script>
</body>

</html>