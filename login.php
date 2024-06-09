<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">

    <style>
    body {
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        height: 100vh;
        justify-content: center;
    }

    .card {
        width: 450px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card-header {
        text-align: center;
        background-color: #F8FFF6;
    }

    img {
        width: 100px;
        height: 100px;
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-control {
        border: 1px solid #ced4da;
    }
    </style>
</head>

<body>
    <div class="card shadow">
        <div class="card-header">
            <img src="admin/img/logoKesehatan.jpg" alt="">
            <h2>Sistem Informasi</h2>
            <h2>Rumah Sakit Terpadu</h2>
        </div>
        <div class="card-body">
            <h4>Login</h4>
            <form action="login_proses.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="admin/css/datatables/jquery-3.7.0.js"></script>

    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="admin/js/sweetalert2.all.min.js"></script>

</body>

</html>