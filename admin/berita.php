<?php
include("../koneksi.php");

$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-0">List Berita</h2>
                        <a href="index.php?p=berita&aksi=input"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Daftar Berita</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel-berita">
                        <thead>
                            <tr class="table-success">
                                <th>No</th>
                                <th>Kategori Poli</th>
                                <th>Judul</th>
                                <th>Tanggal dibuat</th>
                                <th>User</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tampil=mysqli_query($db, "SELECT * FROM berita a JOIN poli b ON a.poli_id=b.id_poli 
                                                                                    JOIN user c ON a.user_id=c.id_user");
                                if ($data=mysqli_num_rows($tampil) != 0) {
                                $no=1;
                                while ($data=mysqli_fetch_array($tampil)) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama_poli']; ?></td>
                                <td><?php echo $data['judul']; ?></td>
                                <td><?php echo $data['tgl_dibuat']; ?></td>
                                <td><?php echo $data['username']; ?></td>

                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="berita_proses.php?proses=delete&id_berita_hapus=<?= $data['id_berita'] ?>"
                                        id="hapusLink<?= $data['id_berita'] ?>" class="btn btn-danger">Hapus</a>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const hapusLink = document.getElementById(
                                            'hapusLink<?= $data['id_berita'] ?>');

                                        hapusLink.addEventListener('click', function(event) {
                                            event.preventDefault();

                                            Swal.fire({
                                                title: 'Yakin ingin menghapus data?',
                                                text: "Data yang dihapus akan hilang!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya',
                                                cancelButtonText: 'Tidak'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = hapusLink.href;
                                                }
                                            });
                                        });
                                    });
                                    </script>
                                    <?php } ?>
                                    <a href="index.php?p=berita&aksi=edit&id_berita_edit=<?= $data['id_berita'] ?>"
                                        class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
        break;
    case 'input' :
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=berita&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Form Berita</h2>
                </div>
                <div class="card-body">
                    <form action="berita_proses.php?proses=insert" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Poli</label>
                            <select name="poli_id" id="" class="form-select">
                                <option value="">--Pilih Poli--</option>
                                <?php
                                $poli=mysqli_query($db,"SELECT * FROM poli");
                                while ($data_poli=mysqli_fetch_array($poli)) {
                                    echo "<option value=".$data_poli['id_poli'].">".$data_poli['nama_poli']."</option>";
                                }
                            ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Berita</label>
                            <textarea class="form-control" rows="10" name="isi_berita"></textarea>
                        </div>
                        <div class="mb-3">
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                            <input class="btn btn-warning" type="reset" name="reset" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
        break;
        case 'edit' :

            $edit=mysqli_query($db, "SELECT * FROM berita WHERE id_berita='$_GET[id_berita_edit]'");
            $data=mysqli_fetch_array($edit);
            
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=berita&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Edit Form Berita</h2>
                </div>
                <div class="card-body">
                    <form action="berita_proses.php?proses=update" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Id</label>
                            <input type="text" class="form-control" name="id" disabled
                                value="<?= $data['id_berita']; ?>">
                            <input type="hidden" class="form-control" name="id_berita_edit"
                                value="<?=$data['id_berita']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Poli</label>
                            <select name="poli_id" class="form-select">
                                <option value="">--Pilih Poli--</option>
                                <?php
                                    $poli = mysqli_query($db, "SELECT * FROM poli");
                                    while ($data_poli = mysqli_fetch_array($poli)) {
                                        $selected = ($data_poli['id_poli'] == $data['poli_id']) ? 'selected' : '';
                                        echo "<option value=".$data_poli['id_poli']." $selected>".$data_poli['nama_poli']."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?=$data['judul']?>">
                        </div>

                        <div class="d-flex flex-column mb-3">
                            <label class="form-label">Gambar Saat Ini</label>
                            <img height="200px" width="200px" src="img/gambarBerita/<?=$data['gambar']?>"
                                alt="Gambar Default" class="img-thumbnail">
                            <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Berita</label>
                            <textarea class="form-control" rows="10"
                                name="isi_berita"><?=$data['isi_berita']?></textarea>
                        </div>

                        <div class="mb-3">
                            <input class="btn btn-primary" type="submit" name="submit" value="Update">
                            <input class="btn btn-warning" type="reset" name="reset" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
            break;
}
?>