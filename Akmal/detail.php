<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran Bimbel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
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
        "Transfer Bank" => 3000,
        "E-Wallet" => 2000,
        "Tunai" => 0
    ];

    include 'php/koneksi.php';

    $id = $_GET['id'] ?? 0;
    if (!$id) {
        die("ID tidak ditemukan");
    }

    $sql = "SELECT * FROM pendaftar WHERE id = $id";
    $query = mysqli_query($koneksi, $sql);

    if (!$query || mysqli_num_rows($query) == 0) {
        die("Data tidak ditemukan");
    }

    $data = mysqli_fetch_assoc($query);

    $nama = $data['nama'];
    $email = $data['email'];
    $paket = $data['pkt_b'];
    $lokasi = $data['lokasi'];
    $pymnt = $data['pymnt'];
    $total_biaya = $data['total_biaya'];
    $fasilitas = explode(', ', $data['fasilitas']);
    $note = isset($data['note']) ? $data['note'] : '-';

    $detail = [];
    $total = 0;

    if (isset($paketHarga[$paket])) {
        $biayaPaket = $paketHarga[$paket];
        $detail['Biaya Paket'] = $biayaPaket;
        $total += $biayaPaket;
    }

    $totalFasilitas = 0;
    $fasilitasList = "-";
    if (!empty($fasilitas) && $fasilitas[0] != '') {
        $fasilitasList = implode(", ", $fasilitas);
        foreach ($fasilitas as $f) {
            if (isset($fasilitasHarga[$f])) {
                $totalFasilitas += $fasilitasHarga[$f];
                $detail['Fasilitas: ' . $f] = $fasilitasHarga[$f];
            }
        }
        $total += $totalFasilitas;
    }

    if (isset($lokasiHarga[$lokasi])) {
        $biayaLokasi = $lokasiHarga[$lokasi];
        $detail['Biaya Lokasi'] = $biayaLokasi;
        $total += $biayaLokasi;
    }

    $biayaAdmin = $pembayaranHarga[$pymnt] ?? 0;
    if ($biayaAdmin > 0) {
        $detail['Biaya Layanan'] = $biayaAdmin;
        $total += $biayaAdmin;
    }

    if (isset($paketHarga[$paket])) {
        $pajak = $paketHarga[$paket] * 0.1;
        $detail['Pajak (10%)'] = $pajak;
        $total += $pajak;
    }

    if ($total != $total_biaya) {
        $total = $total_biaya;
    }
    ?>
    <center>
        <h2>Detail Pendaftaran Bimbel</h2>
    </center>

    <table class="table table-striped" style="margin: 10px;">
        <tr>
            <th>Nama</th>
            <td>
                <?= htmlspecialchars($nama) ?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <?= htmlspecialchars($email) ?>
            </td>
        </tr>
        <tr>
            <th>Paket Bimbel</th>
            <td>
                <?= $paket ?>
            </td>
        </tr>
        <tr>
            <th>Lokasi Belajar</th>
            <td>
                <?= $lokasi ?>
            </td>
        </tr>
        <tr>
            <th>Fasilitas Tambahan</th>
            <td>
                <?= $fasilitasList ?>
            </td>
        </tr>
        <tr>
            <th>Pajak</th>
            <td>
                <?= ($pajak > 0) ? "10%" : "0%" ?>
            </td>
        </tr>
        <tr>
            <th>Catatan</th>
            <td>
                <?= htmlspecialchars($note) ?>
            </td>
        </tr>
        <tr>
            <th>Metode Pembayaran</th>
            <td>
                <?= $pymnt ?>
            </td>
        </tr>
    </table>

    <center>
        <h3>Total Biaya</h3>
    </center>
    <table class="table table-striped" style="margin: 10px">
        <?php foreach ($detail as $key => $val): ?>
            <tr>
                <td>
                    <?= $key ?>
                </td>
                <td>Rp
                    <?= number_format($val, 0, ",", ".") ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (isset($paketHarga[$paket])): ?>
            <tr>
                <th>Total</th>
                <th>Rp
                    <?= number_format($total, 0, ",", ".") ?>
                </th>
            </tr>
        <?php endif; ?>
    </table>
    <center>
        <a href="akmal.php" class="btn btn-dark">Kembali ke Dashboard</a>
    </center>
</body>

</html>