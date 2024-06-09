<?php
include("koneksi.php");

if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {

        $nama=$_POST['nama'];
        $poli_id=$_POST['poli_id'];
        $nik=$_POST['nik'];
        $hari=$_POST['tgl'];
        $bulan=$_POST['bln'];
        $tahun=$_POST['thn'];
        $tanggal_lahir="$tahun-$bulan-$hari";
        $jk=$_POST['jekel'];
        $alamat=$_POST['alamat'];
        $keluhan=$_POST['keluhan'];
        $sql = mysqli_query($db, "INSERT INTO pasien(nama_pasien, poli_id, nik, tgl_lahir, jenis_kelamin, alamat, keluhan) VALUES('$nama','$poli_id','$nik','$tanggal_lahir', '$jk','$alamat','$keluhan')");

        if ($sql) {
            header ("location:index.php?p=pasien");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
       
        $nama=$_POST['nama'];
        $poli_id=$_POST['poli_id'];
        $nik=$_POST['nik'];
        $hari=$_POST['tgl'];
        $bulan=$_POST['bln'];
        $tahun=$_POST['thn'];
        $tanggal_lahir="$tahun-$bulan-$hari";
        $jk=$_POST['jekel'];
        $alamat=$_POST['alamat'];
        $keluhan=$_POST['keluhan'];
        $sql=mysqli_query($db, "UPDATE pasien SET 
                                nama_pasien='$nama',
                                poli_id='$poli_id',
                                nik='$nik',
                                tgl_lahir='$tanggal_lahir',
                                jenis_kelamin='$jk',
                                alamat='$alamat',
                                keluhan='$keluhan'
                                WHERE id_pasien='$_POST[id_pasien_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=pasien'</script>";
        }
        else {
            echo "Data gagal disimpan";
        }
    }// query update
}

if ($_GET['proses']=='delete') {

   
    $hapus=mysqli_query($db,"DELETE FROM pasien WHERE id_pasien='$_GET[id_pasien_hapus]'");

    if($hapus) {
        // echo
  

        echo "<script>window.location='index.php?p=pasien'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}