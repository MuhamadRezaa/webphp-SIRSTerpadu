<?php
include '../koneksi.php';

// proses insert
if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        
        $sql = mysqli_query($db, "INSERT INTO poli (`nama_poli`, `keterangan`, `status_poli`) VALUES('$_POST[nama_poli]','$_POST[keterangan]','$_POST[status_poli]')");
        if ($sql) {
            header ("location:index.php?p=poli");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

// proses update
if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
     
        $sql=mysqli_query($db, "UPDATE poli SET 
                                nama_poli='$_POST[nama_poli]',
                                keterangan='$_POST[keterangan]',
                                status_poli='$_POST[status_poli]'
                                WHERE id_poli='$_POST[id_poli_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=poli'</script>";
        }
        else {
            echo "Data gagal disimpan";
        }
    }// query update
}

// query deleted
if ($_GET['proses']=='delete') {

   
    $hapus=mysqli_query($db,"DELETE FROM poli WHERE id_poli='$_GET[id_poli_hapus]'");

    if($hapus) {
        // echo
  

        echo "<script>window.location='index.php?p=poli'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}