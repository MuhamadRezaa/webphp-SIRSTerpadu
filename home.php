<div class="row mt-3 text-dark mb-3">
    <h2>Selamat Datang, <?= $_SESSION['username'] ?></h2>
</div>

<h2 class="text-dark text-center">Berita RS Terpadu</h2>
<div class="row">
    <?php
            $page=isset($_GET['page']) ? $_GET['page'] : 'home';
            switch ($page) {
                case 'detail':
                    $sql=mysqli_query($db,"SELECT * FROM berita where id_berita='$_GET[id]'");
                    $data=mysqli_fetch_array($sql); 
                    $img=!empty($data['gambar']) ? $data['gambar'] : 'default.png';
        ?>
    <div class="col-10">
        <div class="card">
            <img src="admin/img/gambarBerita/<?= $img ?>" class="img-fluid" height="300">
            <div class="card-body">
                <h5 class="card-title"><a href=""><?= $data['judul']?></a></h5>
                <p class="card-text" style="text-align: justify"><?= $data['isi_berita']?></p>
                <a href="index.php" class="btn btn-success">..Back</a>
            </div>
        </div>

    </div>
    <?php
                break;
            
            default:
    
            $sql=mysqli_query($db,"SELECT * FROM berita");
                while ($data=mysqli_fetch_array($sql)) { 
                    $img=!empty($data['gambar']) ? $data['gambar'] : 'default.png';
            ?>
    <div class="col-4 mb-3">
        <div class="card">
            <img src="admin/img/gambarBerita/<?= $img ?>" class="card-img-top" width="200" height="200">
            <div class="card-body">
                <h5 class="card-title"><a
                        href="index.php?page=detail&id=<?= $data['id_berita'] ?>"><?= $data['judul']?></a></h5>
                <p class="card-text" style="text-align: justify"><?= substr($data['isi_berita'], 0,200)?></p>
                <a href="index.php?page=detail&id=<?= $data['id_berita'] ?>" class="btn btn-success">Read
                    more...</a>
            </div>
        </div>

    </div>
    <?php
            }
        ?>
    <?php
            break;
            }
        ?>

</div>