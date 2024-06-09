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
        <h1 class="h3 mb-0 text-gray-800">Kunjungan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-0">List kunjungan</h2>
                        <a href="index.php?p=kunjungan&aksi=input"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Data kunjungan</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel-kunjungan">
                        <thead>
                            <tr class="table-success">
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Jam Kunjungan</th>
                                <th>Keluhan</th>
                                <th>Diagnosa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tampil=mysqli_query($db, "SELECT * FROM kunjungan a
                                                JOIN poli b ON a.poli_id = b.id_poli
                                                JOIN dokter c ON a.dokter_id = c.id_dokter
                                                JOIN pasien d ON a.pasien_id = d.id_pasien;");
                                $no=1;
                                while ($data=mysqli_fetch_array($tampil)) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama_pasien']; ?></td>
                                <td><?php echo $data['nama_poli']; ?></td>
                                <td><?php echo "dr.".$data['nama_dokter']; ?></td>
                                <td><?php echo $data['tgl_kunjungan']; ?></td>
                                <td><?php echo $data['jam_kunjungan']; ?></td>
                                <td><?php echo $data['keluhan_pasien']; ?></td>
                                <td><?php echo $data['diagnosa']; ?></td>
                                <td><?php echo $data['status_kunjungan']; ?></td>
                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="kunjungan_proses.php?proses=delete&id_kunjungan_hapus=<?= $data['id_kunjungan'] ?>"
                                        id="hapusLink<?= $data['id_kunjungan'] ?>" class="btn btn-danger">Hapus</a>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const hapusLink = document.getElementById(
                                            'hapusLink<?= $data['id_kunjungan'] ?>');

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
                                    <a href="index.php?p=kunjungan&aksi=edit&id_kunjungan_edit=<?= $data['id_kunjungan'] ?>"
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
        <h1 class="h3 mb-0 text-gray-800">Kunjungan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=kunjungan&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Form Kunjungan</h2>
                </div>
                <div class="card-body">
                    <form action="kunjungan_proses.php?proses=insert" method="post">
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
                            <label class="form-label">Pasien</label>
                            <select name="pasien_id" id="" class="form-select">
                                <option value="">--Pilih Pasien--</option>
                                <?php
                                    $query_pasien = "SELECT * FROM pasien a JOIN poli b ON a.poli_id=b.id_poli ORDER BY poli_id";
                                    $pasien = mysqli_query($db, $query_pasien);
                                    while ($data_pasien=mysqli_fetch_array($pasien)) {
                                        echo "<option value=".$data_pasien['id_pasien'].">".$data_pasien['nama_pasien']." - ".$data_pasien['nama_poli']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dokter</label>
                            <select name="dokter_id" id="" class="form-select">
                                <option value="">--Pilih Dokter--</option>
                                <?php
                                $dokter=mysqli_query($db,"SELECT * FROM dokter a JOIN poli b ON a.poli_id=b.id_poli ORDER BY poli_id");
                                while ($data_dokter=mysqli_fetch_array($dokter)) {
                                    echo "<option value=".$data_dokter['id_dokter']."> dr.".$data_dokter['nama_dokter']." - ".$data_dokter['nama_poli']."</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="">
                                <label class="form-label">Tanggal kunjungan</label>
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <select name="tgl" class="form-select">
                                            <option value="">Tanggal</option>
                                            <?php    
                                                $i = 1;
                                                do { 
                                                    echo "<option value=".$i.">".$i."</option>";
                                                    $i++;
                                                } while ($i <= 31);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <select name="bln" class="form-select">
                                            <option value="">Bulan</option>
                                            <?php
                                                $bln = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                                foreach ($bln as $key => $namaBln) {
                                                    echo "<option value=".$key.">".$namaBln."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <select name="thn" class="form-select">
                                            <option value="">Tahun</option>
                                            <?php    
                                                for ($i = 2023; $i >= 1950; $i--) { 
                                                    echo "<option value=".$i.">".$i."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Kunjungan :</label>
                            <input type="time" class="form-control" name="jam_kunjungan">
                        </div>
                        <div class="mb-3">
                            <div class="">
                                <label for="exampleFormControlTextarea1" class="form-label">Keluhan Pasien</label>
                                <select name="keluhan_pasien" class="form-select">
                                    <option value="">--Pilih Keluhan Pasien--</option>
                                    <?php
                                        $query_keluhan = "SELECT * FROM pasien a JOIN poli b ON a.poli_id=b.id_poli ORDER BY poli_id ";
                                        $result_keluhan = mysqli_query($db, $query_keluhan);
                                        while ($row_keluhan = mysqli_fetch_assoc($result_keluhan)) {
                                            echo "<option value='".$row_keluhan['keluhan']."'>".$row_keluhan['nama_pasien']." - ".$row_keluhan['keluhan']." - ".$row_keluhan['nama_poli']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="mb-3">
                            <div class="">
                                <label for="exampleFormControlTextarea1" class="form-label">Diagnosa</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    name="diagnosa"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_kunjungan">
                                <option value="">- Pilih Status -</option>
                                <?php
                                $statusOptions = array("Diminta", "Terkonfirmasi", "Selesai", "Batal");

                                foreach ($statusOptions as $option) {
                                    $selected = ($option == $data['status_kunjungan']) ? 'selected' : '';
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
            $edit=mysqli_query($db, "SELECT * FROM kunjungan WHERE id_kunjungan='$_GET[id_kunjungan_edit]'");
            $data=mysqli_fetch_array($edit);
            list($thn_kunjungan,$bln_kunjungan,$tgl_kunjungan)=explode('-', $data['tgl_kunjungan']);
            
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kunjungan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=kunjungan&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Edit Data kunjungan</h2>
                </div>
                <div class="card-body">
                    <form action="kunjungan_proses.php?proses=update" method="post">
                        <div class="mb-3">
                            <label class="form-label">Id kunjungan</label>
                            <input type="text" class="form-control" name="id_kunjungan" readonly
                                value="<?php echo $data['id_kunjungan']; ?>">
                            <input type="hidden" class="form-control" name="id_kunjungan_edit"
                                value="<?php echo $data['id_kunjungan']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Poli</label>
                            <select name="poli_id" id="" class="form-select">
                                <?php
                                $poli_query = mysqli_query($db, "SELECT * FROM poli");
                                while ($poli_data = mysqli_fetch_array($poli_query)) {
                                    $selected = ($poli_data['id_poli'] == $data['poli_id']) ? 'selected' : '';
                                    echo "<option value='" . $poli_data['id_poli'] . "' $selected>" . $poli_data['nama_poli'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pasien</label>
                            <select name="pasien_id" id="" class="form-select">
                                <option value="">--Pilih Pasien--</option>
                                <?php
                                    $query_pasien = "SELECT * FROM pasien a JOIN poli b ON a.poli_id=b.id_poli ORDER BY poli_id";
                                    $pasien = mysqli_query($db, $query_pasien);
                                    while ($data_pasien=mysqli_fetch_array($pasien)) {
                                        $selected = ($data_pasien['id_pasien'] == $data['pasien_id']) ? 'selected' : '';
                                        echo "<option value=".$data_pasien['id_pasien']."' $selected>".$data_pasien['nama_pasien']." - ".$data_pasien['nama_poli']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dokter</label>
                            <select name="dokter_id" id="" class="form-select">
                                <option value="">--Pilih Dokter--</option>
                                <?php
                                $dokter=mysqli_query($db,"SELECT * FROM dokter a JOIN poli b ON a.poli_id=b.id_poli ORDER BY poli_id");
                                while ($data_dokter=mysqli_fetch_array($dokter)) {
                                    $selected = ($data_dokter['id_dokter'] == $data['dokter_id']) ? 'selected' : '';
                                    echo "<option value=".$data_dokter['id_dokter']."' $selected> dr.".$data_dokter['nama_dokter']." - ".$data_dokter['nama_poli']."</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="">
                                <label class="form-label">Tanggal kunjungan</label>
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <select name="tgl" class="form-select">
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                $selected = ($i == $tgl_kunjungan) ? 'selected' : '';
                                                echo "<option value='$i' $selected>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <select name="bln" class="form-select">
                                            <?php
                                            $bln = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            foreach ($bln as $key => $namaBln) {
                                                $selected = ($key == $bln_kunjungan) ? 'selected' : '';
                                                echo "<option value='$key' $selected>$namaBln</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <select name="thn" class="form-select">
                                            <?php
                                            for ($i = 2023; $i >= 1950; $i--) {
                                                $selected = ($i == $thn_kunjungan) ? 'selected' : '';
                                                echo "<option value='$i' $selected>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jam Kunjungan :</label>
                            <input type="time" class="form-control" name="jam_kunjungan"
                                value="<?php echo $data['jam_kunjungan']; ?>">
                        </div>
                        <div class="mb-3">
                            <div class="">
                                <label for="exampleFormControlTextarea1" class="form-label">Keluhan Pasien</label>
                                <select name="keluhan_pasien" class="form-select">
                                    <option value="">--Pilih Keluhan Pasien--</option>
                                    <?php
                                        $query_keluhan = "SELECT * FROM pasien a JOIN poli b ON a.poli_id=b.id_poli ORDER BY poli_id ";
                                        $result_keluhan = mysqli_query($db, $query_keluhan);
                                        while ($row_keluhan = mysqli_fetch_assoc($result_keluhan)) {
                                            $selected = ($row_keluhan['keluhan'] == $data['keluhan_pasien']) ? 'selected' : '';
                                            echo "<option value='".$row_keluhan['keluhan']."' $selected>".$row_keluhan['nama_pasien']." - ".$row_keluhan['keluhan']." - ".$row_keluhan['nama_poli']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="mb-3">
                            <div class="">
                                <label for="exampleFormControlTextarea1" class="form-label">Diagnosa</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    name="diagnosa"><?= $data['diagnosa']; ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_kunjungan">
                                <option value="">- Pilih Status -</option>
                                <?php
                                $statusOptions = array("Diminta", "Terkonfirmasi", "Selesai", "Batal");

                                foreach ($statusOptions as $option) {
                                    $selected = ($option == $data['status_kunjungan']) ? 'selected' : '';
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