<?php
include '../koneksi.php';

// proses insert
if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        
        $sql = mysqli_query($db, "INSERT INTO obat (`nama_obat`, `deskripsi`) VALUES('$_POST[nama_obat]','$_POST[deskripsi]')");
        if ($sql) {
            header ("location:index.php?p=obat");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

// proses update
if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
     
        $sql=mysqli_query($db, "UPDATE obat SET 
                                nama_obat='$_POST[nama_obat]',
                                deskripsi='$_POST[deskripsi]'
                                WHERE id_obat='$_POST[id_obat_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=obat'</script>";
        }
        else {
            echo "Data gagal disimpan";
        }
    }// query update
}

// query deleted
if ($_GET['proses']=='delete') {

   
    $hapus=mysqli_query($db,"DELETE FROM obat WHERE id_obat='$_GET[id_obat_hapus]'");

    if($hapus) {
        // echo
  

        echo "<script>window.location='index.php?p=obat'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}