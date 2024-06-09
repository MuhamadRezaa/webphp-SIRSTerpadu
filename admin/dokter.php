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
        <h1 class="h3 mb-0 text-gray-800">Dokter</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-0">List Dokter</h2>
                        <a href="index.php?p=dokter&aksi=input"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Data Dokter</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel-dokter">
                        <thead>
                            <tr class="table-success">
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Poli</th>
                                <th>Jenis Kelamin</th>
                                <th>No Telepon</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tampil=mysqli_query($db, "SELECT * FROM dokter INNER JOIN poli WHERE dokter.poli_id = poli.id_poli");
                                $no=1;
                                while ($data=mysqli_fetch_array($tampil)) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo "dr. ".$data['nama_dokter']; ?></td>
                                <td><?php echo $data['nama_poli']; ?></td>
                                <td><?php echo ($data['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
                                <td><?php echo $data['telp_doc']; ?></td>
                                <td><?php echo $data['status_dokter']; ?></td>
                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="dokter_proses.php?proses=delete&id_dokter_hapus=<?= $data['id_dokter'] ?>"
                                        id="hapusLink<?= $data['id_dokter'] ?>" class="btn btn-danger">Hapus</a>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const hapusLink = document.getElementById(
                                            'hapusLink<?= $data['id_dokter'] ?>');

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
                                    <a href="index.php?p=dokter&aksi=edit&id_dokter_edit=<?= $data['id_dokter'] ?>"
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
        <h1 class="h3 mb-0 text-gray-800">Dokter</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=dokter&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Form Dokter</h2>
                </div>
                <div class="card-body">
                    <form action="dokter_proses.php?proses=insert" method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" name="nama_dokter">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Poli</label>
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
                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label class="form-label">Jenis Kelamin</label>
                            </div>
                            <div class=" ">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="jekel" value="L" checked>
                                    <label class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="jekel" value="P">
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="telp_dokter">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_dokter">
                                <option value="">- Pilih Status -</option>
                                <?php
                                $statusOptions = array("Aktif", "Non-Aktif");

                                foreach ($statusOptions as $option) {
                                    $selected = ($option == $data['status_dokter']) ? 'selected' : '';
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

            $edit=mysqli_query($db, "SELECT * FROM dokter WHERE id_dokter='$_GET[id_dokter_edit]'");
            $data=mysqli_fetch_array($edit);
            
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dokter</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=dokter&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Edit Data Dokter</h2>
                </div>
                <div class="card-body">
                    <form action="dokter_proses.php?proses=update" method="post">
                        <div class="mb-3">
                            <label class="form-label">Id Dokter</label>
                            <input type="text" class="form-control" name="id_dokter" disabled
                                value="<?php echo $data['id_dokter']; ?>">
                            <input type="hidden" class="form-control" name="id_dokter_edit"
                                value="<?php echo $data['id_dokter']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Poli</label>
                            <select name="poli_id" id="" class="form-select">
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
                            <label class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" name="nama_dokter"
                                value="<?=$data['nama_dokter'] ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="">
                                <label class="form-label">Jenis Kelamin</label>
                            </div>
                            <div class=" ">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="jekel" value="L"
                                        <?php echo ($data['jenis_kelamin'] == 'L') ? 'checked' : ''; ?>>
                                    Laki-laki
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="jekel" value="P"
                                        <?php echo ($data['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>>
                                    Perempuan
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="telp_dokter" value="<?=$data['telp_doc'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_dokter">
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