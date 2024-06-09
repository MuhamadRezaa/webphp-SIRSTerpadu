<?php
include("koneksi.php");

if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {

        $poli_id=$_POST['poli_id'];
        $dokter_id=$_POST['dokter_id'];
        $hari=$_POST['hari'];
        $jam_awal = $_POST['jam_awal'];
        $jam_selesai = $_POST['jam_selesai'];
        $status_layanan = $_POST['status_layanan'];
        $sql = mysqli_query($db, "INSERT INTO jadwal_dokter(poli_id, dokter_id, hari, jam_awal, jam_selesai, status_layanan) 
                               VALUES('$poli_id','$dokter_id','$hari', '$jam_awal', '$jam_selesai','$status_layanan')");
        if ($sql) {
            header ("location:index.php?p=jdw_dokter");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
       
        $poli_id=$_POST['poli_id'];
        $dokter_id=$_POST['dokter_id'];
        $hari=$_POST['hari'];
        $jam_awal = $_POST['jam_awal'];
        $jam_selesai = $_POST['jam_selesai'];
        $status_layanan = $_POST['status_layanan'];
        $sql = mysqli_query($db, "UPDATE jadwal_dokter SET 
                                    poli_id='$poli_id',
                                    dokter_id='$dokter_id',
                                    hari='$hari',
                                    jam_awal='$jam_awal',
                                    jam_selesai='$jam_selesai',
                                    status_layanan='$status_layanan'
                                    WHERE id_jadwal='$_POST[id_jadwal_edit]'");

        if ($sql) {
            echo "<script>window.location='index.php?p=jdw_dokter'</script>";
        }
        else {
            echo "Data gagal disimpan";
        }
    }// query update
}

if ($_GET['proses']=='delete') {

   
    $hapus=mysqli_query($db,"DELETE FROM jadwal_dokter WHERE id_jadwal='$_GET[id_jadwal_hapus]'");

    if($hapus) {
        // echo
  

        echo "<script>window.location='index.php?p=jdw_dokter'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}