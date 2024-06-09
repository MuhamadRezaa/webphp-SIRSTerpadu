<?php
include("koneksi.php");
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Dokter</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-0">List Jadwal Dokter</h2>
                        <?php if ($_SESSION['level'] == 'admin') { ?>
                        <a href="index.php?p=jdw_dokter&aksi=input"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Jadwal Dokter</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel-jdw_dokter">
                        <thead>
                            <tr class="table-success">
                                <th class="text-center">No</th>
                                <th class="text-center">Poli</th>
                                <th class="text-center">Dokter</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Jam Pelayanan</th>
                                <th class="text-center">Status</th>
                                <?php if ($_SESSION['level'] == 'admin') { ?>
                                <th class="text-center">Aksi</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysqli_query($db, "SELECT * FROM jadwal_dokter a JOIN poli b ON a.poli_id=b.id_poli 
                                                                                        JOIN dokter c ON a.dokter_id=c.id_dokter ORDER BY hari, dokter_id");
                            $no = 1;
                            $hari = [1=>'Senin','Selasa','Rabu','Kamis','Jumat'];
                            while ($data = mysqli_fetch_array($tampil)) {
                                ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $data['nama_poli']; ?></td>
                                <td><?php echo $data['nama_dokter']; ?></td>
                                <td><?php echo $hari[$data['hari']]; ?></td>
                                <td><?php echo $data['jam_awal'] . ' - ' . $data['jam_selesai'];?></td>
                                <td><?php echo $data['status_layanan']; ?></td>
                                <?php if ($_SESSION['level'] == 'admin') { ?>
                                <td>
                                    <?php if ($_SESSION['level'] == 'admin') { ?>
                                    <a href="jadwal_dokter_proses.php?proses=delete&id_jadwal_hapus=<?= $data['id_jadwal'] ?>"
                                        id="hapusLink<?= $data['id_jadwal'] ?>" class="btn btn-danger">Hapus</a>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const hapusLink = document.getElementById(
                                            'hapusLink<?= $data['id_jadwal'] ?>');

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
                                    <a href="index.php?p=jdw_dokter&aksi=edit&id_jadwal_edit=<?= $data['id_jadwal'] ?>"
                                        class="btn btn-warning">Edit</a>
                                </td>
                                <?php } ?>
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
<div class="container-fluid mx auto">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Dokter</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=jdw_dokter&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Form Jadwal Dokter</h2>
                </div>
                <div class="card-body">
                    <form action="jadwal_dokter_proses.php?proses=insert" method="post">
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Poli</label>
                                <select name="poli_id" id="" class="form-select">
                                    <option value="">-- Pilih Poli --</option>
                                    <?php
                                        $poli=mysqli_query($db,"SELECT * FROM poli");
                                        while ($data_poli=mysqli_fetch_array($poli)) {
                                            echo "<option value=".$data_poli['id_poli'].">".$data_poli['nama_poli']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dokter</label>
                                <select name="dokter_id" id="" class="form-select">
                                    <option value="">-- Pilih Dokter --</option>
                                    <?php
                                        $dokter=mysqli_query($db,"SELECT * FROM dokter a JOIN poli b ON a.poli_id=b.id_poli ORDER BY poli_id");
                                        while ($data_dokter=mysqli_fetch_array($dokter)) {
                                            echo "<option value=".$data_dokter['id_dokter']."> dr.".$data_dokter['nama_dokter']." ==> ".$data_dokter['nama_poli']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hari</label>
                                <select name="hari" class="form-select">
                                    <option value="">-- Pilih Hari --</option>
                                    <?php
                                        $hari = [1=>'Senin','Selasa','Rabu','Kamis','Jumat'];
                                        foreach ($hari as $key => $namaHari) {
                                            echo "<option value=".$key.">".$namaHari."</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jam Layanan :</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Jam Awal</label>
                                        <input type="time" class="form-control" name="jam_awal">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jam Selesai</label>
                                        <input type="time" class="form-control" name="jam_selesai">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status_layanan">
                                    <option value="">- Pilih Status -</option>
                                    <?php
                                        $statusOptions = array("Aktif", "Non-Aktif");

                                        foreach ($statusOptions as $option) {
                                            $selected = ($option == $data['status_layanan']) ? 'selected' : '';
                                            echo "<option value='$option' $selected>$option</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input class="btn btn-primary" type="submit" name="submit" value="Proses">
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

            $edit=mysqli_query($db, "SELECT * FROM jadwal_dokter WHERE id_jadwal='$_GET[id_jadwal_edit]'");
            $data=mysqli_fetch_array($edit);
    ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Poli</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <a href="index.php?p=jdw_dokter&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Edit Jadwal Dokter</h2>
                </div>
                <div class="card-body">
                    <form action="jadwal_dokter_proses.php?proses=update" method="post">
                        <div class="mb-3">
                            <label class="form-label">Id Jadwal</label>
                            <input type="text" class="form-control" name="id_jadwal" disabled
                                value="<?php echo $data['id_jadwal']; ?>">
                            <input type="hidden" class="form-control" name="id_jadwal_edit"
                                value="<?php echo $data['id_jadwal']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Poli</label>
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
                            <label class="form-label">Dokter</label>
                            <select name="dokter_id" id="" class="form-select">
                                <option value="">-- Pilih Dokter --</option>
                                <?php
                                    $dokter=mysqli_query($db, "SELECT * FROM dokter a JOIN poli b ON a.poli_id=b.id_poli");
                                    while ($data_dokter=mysqli_fetch_array($dokter)) {
                                        $selected = ($data_dokter['id_dokter'] == $data['dokter_id']) ? 'selected' : '';
                                        echo "<option value=".$data_dokter['id_dokter']." $selected>".$data_dokter['nama_dokter']." ==> ".$data_dokter['nama_poli']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hari</label>
                            <select name="hari" class="form-select">
                                <option value="">-- Pilih Hari --</option>
                                <?php
                                    $hari = [1=>'Senin','Selasa','Rabu','Kamis','Jumat'];
                                    foreach ($hari as $key => $namaHari) {
                                        $selected = ($key == $data['hari']) ? 'selected' : '';
                                        echo "<option value=".$key." $selected>".$namaHari."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jam Layanan :</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Jam Awal</label>
                                    <input type="time" class="form-control" name="jam_awal"
                                        value="<?php echo $data['jam_awal']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" name="jam_selesai"
                                        value="<?php echo $data['jam_selesai']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_layanan">
                                <option value="">- Pilih Status -</option>
                                <?php
                                    $statusOptions = array("Aktif", "Non-Aktif");

                                    foreach ($statusOptions as $option) {
                                        $selected = ($option == $data['status_layanan']) ? 'selected' : '';
                                        echo "<option value='$option' $selected>$option</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input class="btn btn-primary" type="submit" name="submit" value="Proses">
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