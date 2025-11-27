<?php
include 'koneksi.php';    

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $check = mysqli_query($koneksi, "SELECT id FROM pendaftar WHERE id = $id");
    if(mysqli_num_rows($check) > 0) {
        $sql = "DELETE FROM pendaftar WHERE id = $id";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            header('Location: ../akmal.php');
            exit();
        } else {
            die("Gagal menghapus data: " . mysqli_error($koneksi));
        }
    } else {
        die("Data tidak ditemukan");
    }
} else {
    die("ID tidak diberikan");
}
?>