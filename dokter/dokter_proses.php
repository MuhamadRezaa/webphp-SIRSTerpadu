<?php
include 'koneksi.php';

// proses insert
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nama_dokter = $_POST['nama_dokter'];
        $poli_id = $_POST['poli_id'];
        $jk=$_POST['jekel'];
        $telp_dokter = $_POST['telp_dokter'];
        $status_dokter = $_POST['status_dokter'];

        $sql = mysqli_query($db, "INSERT INTO dokter (nama_dokter, poli_id, jenis_kelamin, telp_doc, status_dokter) 
                VALUES ('$nama_dokter', '$poli_id', '$jk','$telp_dokter', '$status_dokter')");

        if ($sql) {
            header("Location: index.php?p=dokter");
        } else {
            echo "Data gagal disimpan ";
        }
    }
}

// proses update
if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $nama_dokter = $_POST['nama_dokter'];
        $poli_id = $_POST['poli_id'];
        $jk=$_POST['jekel'];
        $telp_dokter = $_POST['telp_dokter'];
        $status_dokter = $_POST['status_dokter'];

        $sql = mysqli_query($db, "UPDATE dokter SET 
                                nama_dokter='$nama_dokter',
                                poli_id='$poli_id',
                                jenis_kelamin='$jk',
                                telp_doc='$telp_dokter',
                                status_dokter='$status_dokter'
                                WHERE id_dokter='$_POST[id_dokter_edit]'");

        if ($sql) {
            echo "<script>window.location='index.php?p=dokter'</script>";
        } else {
            echo "Data gagal diupdate";
        }
    }
}

// proses delete
if ($_GET['proses'] == 'delete') {
    
    $hapus = mysqli_query($db, "DELETE FROM dokter WHERE id_dokter='$_GET[id_dokter_hapus]'");

    if ($hapus) {
        echo "<script>window.location='index.php?p=dokter'</script>";
    } else {
        echo "Gagal Menghapus Data";
    }
}
?>