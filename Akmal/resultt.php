<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran Bimbel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .center {
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .btn-success {
            background: #28a745;
        }

        .btn-primary {
            background: #007bff;
        }
    </style>
</head>

<body>
    <?php
    // Include model untuk koneksi database
    require_once 'pendaftar.php';

    // data harga
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

    // ambil data dari form
    $nama   = $_GET['nama'] ?? "-";
    $email  = $_GET['email'] ?? "-";
    $paket  = $_GET['pkt_b'] ?? "Undefined";
    $lokasi = $_GET['lokasi'] ?? "-";
    $note   = $_GET['note'] ?: "-";
    $pymnt  = $_GET['pymnt'] ?? "-";
    $fasilitas = $_GET['fasilitas_tambahan'] ?? [];

    // hitung harga
    $total = 0;
    $detail = [];

    if (isset($paketHarga[$paket])) {
        $total += $paketHarga[$paket];
        $detail['Paket'] = $paketHarga[$paket];
    }

    if (isset($lokasiHarga[$lokasi])) {
        $total += $lokasiHarga[$lokasi];
        $detail['Lokasi Belajar'] = $lokasiHarga[$lokasi];
    }

    $totalFasilitas = 0;
    $fasilitasList = "-";
    if (!empty($fasilitas)) {
        $fasilitasList = implode(", ", $fasilitas);
        foreach ($fasilitas as $f) {
            if (isset($fasilitasHarga[$f])) {
                $totalFasilitas += $fasilitasHarga[$f];
            }
        }
        $total += $totalFasilitas;
        $detail['Fasilitas Tambahan'] = $totalFasilitas;
    }

    $biayaAdmin = $pembayaranHarga[$pymnt] ?? 0;
    $total += $biayaAdmin;
    $detail['Biaya Layanan'] = $biayaAdmin;

    // pajak 10% hanya kalau paket valid
    $pajak = (isset($paketHarga[$paket])) ? $total * 0.1 : 0;
    $total += $pajak;
    if ($pajak > 0) {
        $detail['Pajak'] = $pajak;
    }

    // Simpan ke database
    $fasilitas_text = !empty($fasilitas) ? implode(", ", $fasilitas) : "-";
    
    $data_pendaftar = [
        'nama' => $nama,
        'email' => $email,
        'paket' => $paket,
        'fasilitas' => $fasilitas_text,
        'lokasi' => $lokasi,
        'metode_pembayaran' => $pymnt,
        'catatan' => $note,
        'price1' => $paketHarga[$paket] ?? 0,
        'price2' => $lokasiHarga[$lokasi] ?? 0,
        'price3' => $totalFasilitas,
        'price4' => $biayaAdmin,
        'tax' => 10,
        'taxes' => $pajak,
        'total_biaya' => $total
    ];

    $pendaftar = new Pendaftar();
    $simpan_berhasil = false;
    
    if (isset($paketHarga[$paket])) {
        $simpan_berhasil = $pendaftar->create($data_pendaftar);
    }

    ?>
    
    <?php if ($simpan_berhasil): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Sukses!</strong> Data berhasil disimpan ke database.
        </div>
    <?php endif; ?>

    <h2 class="center">Data Pendaftaran Bimbel</h2>
    <table>
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
                <?= ($pajak>0) ? "10%" : "0%" ?>
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

    <h3>Total Price</h3>
    <table>
        <?php foreach ($detail as $key => $val): ?>
        <tr>
            <td>
                <?= $key ?>
            </td>
            <td>Rp
                <?= number_format($val,0,",",".") ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(isset($paketHarga[$paket])): ?>
        <tr>
            <th>Total</th>
            <th>Rp
                <?= number_format($total,0,",",".") ?>
            </th>
        </tr>
        <?php endif; ?>
    </table>

    <div class="center">
        <a href="akmal.php" class="btn btn-primary">Daftar Lagi</a>
        <a href="index.php" class="btn btn-success">Lihat Dashboard</a>
    </div>
</body>

</html>