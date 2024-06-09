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
        <h1 class="h3 mb-0 text-gray-800">Pasien</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-0">List Pasien</h2>
                        <a href="index.php?p=pasien&aksi=input"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Data Pasien</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tabel-pasien">
                        <thead>
                            <tr class="table-success">
                                <th class="text-center">No</th>
                                <th class="text-center">Poli</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Tanggal Lahir</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Keluhan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tampil=mysqli_query($db, "SELECT * FROM pasien INNER JOIN poli WHERE pasien.poli_id = poli.id_poli ORDER BY nama_poli");
                                $no=1;
                                while ($data=mysqli_fetch_array($tampil)) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $data['nama_poli']; ?></td>
                                <td><?php echo $data['nama_pasien']; ?></td>
                                <td><?php echo $data['nik']; ?></td>
                                <td><?php echo $data['tgl_lahir']; ?></td>
                                <td><?php echo ($data['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td><?php echo $data['keluhan']; ?></td>
                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="pasien_proses.php?proses=delete&id_pasien_hapus=<?= $data['id_pasien'] ?>"
                                        id="hapusLink<?= $data['id_pasien'] ?>" class="btn btn-danger">Hapus</a>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const hapusLink = document.getElementById(
                                            'hapusLink<?= $data['id_pasien'] ?>');

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
                                    <a href="index.php?p=pasien&aksi=edit&id_pasien_edit=<?= $data['id_pasien'] ?>"
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
<div class="container-fluid mx auto">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pasien</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-10">
            <a href="index.php?p=pasien&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Form Pasien</h2>
                </div>
                <div class="card-body">
                    <form action="pasien_proses.php?proses=insert" method="post">
                        <div class="row">
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="">
                                    <label class="form-label">Tanggal Lahir</label>
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
                            <div class="col-md-6 mb-3">
                                <div class="">
                                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="alamat"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="">
                                    <label for="exampleFormControlTextarea1" class="form-label">Keluhan</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        name="keluhan"></textarea>
                                </div>
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

            $edit=mysqli_query($db, "SELECT * FROM pasien WHERE id_pasien='$_GET[id_pasien_edit]'");
            $data=mysqli_fetch_array($edit);
            list($thn_lahir,$bln_lahir,$tgl_lahir)=explode('-', $data['tgl_lahir']);
    ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pasien</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <a href="index.php?p=pasien&aksi=list" class="btn btn-sm btn-success shadow-sm mb-3">Kembali</a>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="mb-2">Edit Data Pasien</h2>
                </div>
                <div class="card-body">
                    <form action="pasien_proses.php?proses=update" method="post">
                        <div class="mb-3">
                            <label class="form-label">Id Pasien</label>
                            <input type="text" class="form-control" name="id_pasien" disabled
                                value="<?php echo $data['id_pasien']; ?>">
                            <input type="hidden" class="form-control" name="id_pasien_edit"
                                value="<?php echo $data['id_pasien']; ?>">
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
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama"
                                    value="<?php echo $data['nama_pasien']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik" value="<?php echo $data['nik']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select name="tgl" class="form-select">
                                                <option value="">Tanggal</option>
                                                <?php    
                                    $i=1;
                                    do
                                    { 
                                        $selected=($i==$tgl_lahir) ? 'selected' : '';
                                        echo "<option value=".$i." $selected>".$i."</option>";
                                        $i++;
                                    }while ($i <=31);
                                ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="bln" class="form-select">
                                                <option value="">Bulan</option>
                                                <?php
                                    $bln=[1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                    foreach ($bln as $key => $namaBln) {
                                        $selected=($key==$bln_lahir) ? 'selected' : '';
                                        echo "<option value=".$key." $selected>".$namaBln."</option>";
                                    }
                                    ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="thn" class="form-select">=
                                                <option value="">Tahun</option>
                                                <?php    
                                    for ($i=2023; $i >=1950 ; $i--) { 
                                        $selected=($i==$thn_lahir) ? 'selected' : '';
                                        echo "<option value=".$i." $selected>".$i."</option>";
                                    }
                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
                            <div class="col-md-6 mb-3">
                                <div class="">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" rows="3"
                                        name="alamat"><?= $data['alamat']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="">
                                    <label class="form-label">Keluhan</label>
                                    <textarea class="form-control" rows="3"
                                        name="keluhan"><?= $data['keluhan']; ?></textarea>
                                </div>
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
}
    ?>