<?php
include("../koneksi.php");
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Obat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-0">List Obat</h2>
                        <a href="index.php?p=obat&aksi=input"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Tambah Daftar Obat</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel-obat">
                        <thead>
                            <tr class="table-success">
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $tampil=mysqli_query($db, "SELECT * FROM obat");
                        $no=1;
                        while ($data=mysqli_fetch_array($tampil)) {
                    ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama_obat']; ?></td>
                                <td><?php echo $data['deskripsi']; ?></td>
                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="obat_proses.php?proses=delete&id_obat_hapus=<?= $data['id_obat'] ?>"
                                        id="hapusLink<?= $data['id_obat'] ?>" class="btn btn-danger">Hapus</a>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const hapusLink = document.getElementById(
                                            'hapusLink<?= $data['id_obat'] ?>');

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
                                    <a href="index.php?p=obat&aksi=edit&id_obat_edit=<?= $data['id_obat'] ?>"
                                        class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
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
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Obat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=obat&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Form Obat</h2>
                </div>
                <div class="card-body">
                    <form action="obat_proses.php?proses=insert" method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="3" name="deskripsi"></textarea>
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

            $edit=mysqli_query($db, "SELECT * FROM obat WHERE id_obat='$_GET[id_obat_edit]'");
            $data=mysqli_fetch_array($edit);
            
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Obat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=obat&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Edit Data Obat</h2>
                </div>
                <div class="card-body">
                    <form action="obat_proses.php?proses=update" method="post">
                        <div class="mb-3">
                            <label class="form-label">Id Obat</label>
                            <input type="text" class="form-control" name="id_obat" disabled
                                value="<?php echo $data['id_obat']; ?>">
                            <input type="hidden" class="form-control" name="id_obat_edit"
                                value="<?php echo $data['id_obat']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat" value="<?=$data['nama_obat'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="3" name="deskripsi"><?=$data['deskripsi'] ?></textarea>
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