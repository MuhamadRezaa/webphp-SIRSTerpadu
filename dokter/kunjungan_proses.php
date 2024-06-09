<?php
include '../koneksi.php';

// proses insert
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $poli_id = $_POST['poli_id'];
        $pasien_id = $_POST['pasien_id'];
        $dokter_id = $_POST['dokter_id'];
        $hari=$_POST['tgl'];
        $bulan=$_POST['bln'];
        $tahun=$_POST['thn'];
        $tgl_kunjungan="$tahun-$bulan-$hari";
        $jam_kunjungan=$_POST['jam_kunjungan'];
        $keluhan_pasien=$_POST['keluhan_pasien'];
        $diagnosa=$_POST['diagnosa'];
        $status_kunjungan = $_POST['status_kunjungan'];

        $sql = mysqli_query($db, "INSERT INTO kunjungan (poli_id, pasien_id, dokter_id, tgl_kunjungan, 
                                        jam_kunjungan, keluhan_pasien, diagnosa, status_kunjungan)
                VALUES ('$poli_id', '$pasien_id', '$dokter_id','$tgl_kunjungan',
                        '$jam_kunjungan','$keluhan_pasien','$diagnosa','$status_kunjungan')");

        if ($sql) {
            header("Location: index.php?p=kunjungan");
        } else {
            echo "Data gagal disimpan: ";
        }
    }
}

// proses update
if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $poli_id = $_POST['poli_id'];
        $pasien_id = $_POST['pasien_id'];
        $dokter_id = $_POST['dokter_id'];
        $hari=$_POST['tgl'];
        $bulan=$_POST['bln'];
        $tahun=$_POST['thn'];
        $tgl_kunjungan="$tahun-$bulan-$hari";
        $jam_kunjungan=$_POST['jam_kunjungan'];
        $keluhan_pasien=$_POST['keluhan_pasien'];
        $diagnosa=$_POST['diagnosa'];
        $status_kunjungan = $_POST['status_kunjungan'];

        $sql = mysqli_query($db, "UPDATE kunjungan SET 
                                poli_id='$poli_id',
                                pasien_id='$pasien_id', 
                                dokter_id=$dokter_id,  
                                tgl_kunjungan='$tgl_kunjungan', 
                                jam_kunjungan='$jam_kunjungan', 
                                keluhan_pasien='$keluhan_pasien', 
                                diagnosa='$diagnosa',
                                status_kunjungan='$status_kunjungan'
                                WHERE id_kunjungan='$_POST[id_kunjungan_edit]'");


        if ($sql) {
            header("Location: index.php?p=kunjungan");
        } else {
            echo "Data gagal diupdate: ";
        }
    }
}

// proses delete
if ($_GET['proses'] == 'delete') {
    
    $hapus = mysqli_query($db, "DELETE FROM kunjungan WHERE id_kunjungan='$_GET[id_kunjungan_hapus]'");

    if ($hapus) {
        header("Location: index.php?p=kunjungan");
    } else {
        echo "Gagal Menghapus Data: ";
    }
}
?>