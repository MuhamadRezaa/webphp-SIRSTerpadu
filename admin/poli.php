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
        <h1 class="h3 mb-0 text-gray-800">Poli</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-0">List Poli</h2>
                        <a href="index.php?p=poli&aksi=input"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Tambah Daftar Poli</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel-poli">
                        <thead>
                            <tr class="table-success">
                                <th>No</th>
                                <th>Id Poli</th>
                                <th>Nama Poli</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $tampil=mysqli_query($db, "SELECT * FROM poli");
                        $no=1;
                        while ($data=mysqli_fetch_array($tampil)) {
                    ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['id_poli']; ?></td>
                                <td><?php echo $data['nama_poli']; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>
                                <td><?php echo $data['status_poli']; ?></td>

                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="poli_proses.php?proses=delete&id_poli_hapus=<?= $data['id_poli'] ?>"
                                        id="hapusLink<?= $data['id_poli'] ?>" class="btn btn-danger">Hapus</a>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const hapusLink = document.getElementById(
                                            'hapusLink<?= $data['id_poli'] ?>');

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
                                    <a href="index.php?p=poli&aksi=edit&id_poli_edit=<?= $data['id_poli'] ?>"
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
        <h1 class="h3 mb-0 text-gray-800">Poli</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=poli&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Form Poli</h2>
                </div>
                <div class="card-body">
                    <form action="poli_proses.php?proses=insert" method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Poli</label>
                            <input type="text" class="form-control" name="nama_poli">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" rows="3" name="keterangan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_poli">
                                <option value="">- Pilih Status -</option>
                                <?php
                                $statusOptions = array("Aktif", "Non-Aktif");

                                foreach ($statusOptions as $option) {
                                    $selected = ($option == $data['status_poli']) ? 'selected' : '';
                                    echo "<option value='$option' $selected>$option</option>";
                                }
                            ?>
                            </select>
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

            $edit=mysqli_query($db, "SELECT * FROM poli WHERE id_poli='$_GET[id_poli_edit]'");
            $data=mysqli_fetch_array($edit);
            
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Poli</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=poli&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Edit Data Poli</h2>
                </div>
                <div class="card-body">
                    <form action="poli_proses.php?proses=update" method="post">
                        <div class="mb-3">
                            <label class="form-label">Id Poli</label>
                            <input type="text" class="form-control" name="id_poli" disabled
                                value="<?php echo $data['id_poli']; ?>">
                            <input type="hidden" class="form-control" name="id_poli_edit"
                                value="<?php echo $data['id_poli']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Poli</label>
                            <input type="text" class="form-control" name="nama_poli" value="<?=$data['nama_poli'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" rows="3"
                                name="keterangan"><?=$data['keterangan'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_poli">
                                <?php
                                $statusOptions = array("Aktif", "Non-Aktif");

                                foreach ($statusOptions as $option) {
                                    $selected = ($option == $data['status']) ? 'selected' : '';
                                    echo "<option value='$option' $selected>$option</option>";
                                }
                            ?>
                            </select>
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