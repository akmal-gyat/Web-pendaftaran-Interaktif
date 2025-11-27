<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$paket = $_POST['pkt_b'];
$lokasi = $_POST['lokasi'];
$pymnt = $_POST['pymnt'];

$fasilitas = isset($_POST['fasilitas_tambahan']) ? implode(', ', $_POST['fasilitas_tambahan']) : '';

$harga_paket = 0;
if ($paket == "Paket Intensif SBMPTN") $harga_paket = 500000;
elseif ($paket == "Paket Reguler") $harga_paket = 750000;
elseif ($paket == "Paket Supercamp SBMPTN") $harga_paket = 1000000;

$biaya_lokasi = 0;
if ($lokasi == "Jakarta Pusat") $biaya_lokasi = 100000;
elseif ($lokasi == "Yogyakarta") $biaya_lokasi = 80000;
elseif ($lokasi == "Aceh") $biaya_lokasi = 120000;
elseif ($lokasi == "Surabaya") $biaya_lokasi = 150000;
elseif ($lokasi == "Makassar") $biaya_lokasi = 115000;

$biaya_admin = 0;
if ($pymnt == "Transfer Bank") $biaya_admin = 3000;
elseif ($pymnt == "E-Wallet") $biaya_admin = 2000;

$biaya_fasilitas = 0;
if (isset($_POST['fasilitas_tambahan'])) {
    foreach ($_POST['fasilitas_tambahan'] as $fasil) {
        if ($fasil == "Modul Cetak Lengkap") $biaya_fasilitas += 50000;
        elseif ($fasil == "Modul PDF") $biaya_fasilitas += 25000;
        elseif ($fasil == "Video Rekaman Kelas") $biaya_fasilitas += 75000;
        elseif ($fasil == "Grup Diskusi Telegram") $biaya_fasilitas += 40000;
    }
}

$pajak = $harga_paket * 0.1;

$total_biaya = $harga_paket + $biaya_lokasi + $biaya_admin + $biaya_fasilitas + $pajak;

$sql = "UPDATE pendaftar SET 
        nama = '$nama',
        email = '$email',
        pkt_b = '$paket',
        fasilitas = '$fasilitas',
        lokasi = '$lokasi',
        pymnt = '$pymnt',
        total_biaya = $total_biaya
        WHERE id = $id";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    header('Location: ../akmal.php');
    exit();
} else {
    echo "Error updating record: " . mysqli_error($koneksi);
}
?>