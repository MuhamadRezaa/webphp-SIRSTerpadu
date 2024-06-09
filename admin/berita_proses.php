<?php
session_start();
include '../koneksi.php';

// proses insert
if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        
        $nama=$_FILES['gambar']['name'];
        $nama_tmp=$_FILES['gambar']['tmp_name'];
        $dir_upload="img/gambarBerita/";
    //    if($_FILES['gambar']['type'] != 'image/jpg' OR $_FILES['gambar']['type'] != 'image/png') {
    //         die ("<h1>Silahkan upload gambar JPG atau PNG </h1>");
    //    }
    //    else {

       
        $upload=move_uploaded_file($nama_tmp,$dir_upload.$nama);

        $sql=mysqli_query($db,"INSERT INTO berita(poli_id,user_id,judul,isi_berita,gambar) VALUES('$_POST[poli_id]','$_SESSION[user_id]','$_POST[judul]','$_POST[isi_berita]','$nama')");
        if ($sql) {
            header ("location:index.php?p=berita");
        }
        else {
            echo "Data gagal disimpan";
        }
    // }


        
    }
}

// proses update
if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {

        $nama=$_FILES['gambar']['name'];
        $nama_tmp=$_FILES['gambar']['tmp_name'];
        $dir_upload="img/gambarBerita/";

        if (!empty($nama)) {
            $upload = move_uploaded_file($nama_tmp, $dir_upload.$nama);
        } else {
            $nama = $_POST['gambar_lama'];
        }


        $sql = mysqli_query($db, "UPDATE berita SET 
                                    poli_id='$_POST[poli_id]',
                                    judul='$_POST[judul]',
                                    isi_berita='$_POST[isi_berita]',
                                    gambar='$nama'
                                    WHERE id_berita='$_POST[id_berita_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=berita'</script>";
        } else {
            echo "Data gagal disimpan";
        }
    }// query update
}

// query deleted
if ($_GET['proses']=='delete') {

   
    $hapus=mysqli_query($db,"DELETE FROM berita WHERE id_berita='$_GET[id_hapus]'");

    if($hapus) {
        // echo
  

        echo "<script>window.location='index.php?p=berita'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}
?>