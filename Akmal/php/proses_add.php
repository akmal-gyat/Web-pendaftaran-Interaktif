<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$paket = $_POST['pkt_b'];
$lokasi = $_POST['lokasi'];
$pymnt = $_POST['pymnt'];
$note = isset($_POST['note']) ? $_POST['note'] : '';

$fasilitas = isset($_POST['fasilitas_tambahan']) ? implode(', ', $_POST['fasilitas_tambahan']) : '';

$paketHarga = [
    "Paket Intensif SBMPTN" => 500000,
    "Paket Reguler" => 750000,
    "Paket Supercamp SBMPTN" => 1000000
];

$fasilitasHarga = [
    "Modul Cetak Lengkap" => 50000,
    "Modul PDF" => 25000,
    "Video Rekaman Kelas" => 75000,
    "Grup Diskusi Telegram" => 40000
];

$lokasiHarga = [
    "Jakarta Pusat" => 100000,
    "Yogyakarta" => 80000,
    "Aceh" => 120000,
    "Surabaya" => 150000,
    "Makassar" => 115000
];

$pembayaranHarga = [
    "tf" => 3000,
    "E-Wallet" => 2000,
    "cash" => 0
];

$harga_paket = $paketHarga[$paket] ?? 0;

$totalFasilitas = 0;
if (!empty($fasilitas)) {
    $list = explode(', ', $fasilitas);
    foreach ($list as $f) {
        if (isset($fasilitasHarga[$f])) $totalFasilitas += $fasilitasHarga[$f];
    }
}

$harga_lokasi = $lokasiHarga[$lokasi] ?? 0;
$biayaAdmin = $pembayaranHarga[$pymnt] ?? 0;

$subtotal = $harga_paket + $totalFasilitas + $harga_lokasi + $biayaAdmin;
$pajak = ($harga_paket > 0) ? $subtotal * 0.1 : 0;
$total_biaya = $subtotal + $pajak;

$sql = "INSERT INTO pendaftar (nama, email, pkt_b, fasilitas, lokasi, pymnt, total_biaya) 
        VALUES ('$nama', '$email', '$paket', '$fasilitas', '$lokasi', '$pymnt', '$total_biaya')";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    header('Location: ../akmal.php');
    exit();
    exit();
} else {
    echo "Gagal menambah data: " . mysqli_error($koneksi);
}
?>