<?php
include 'php/koneksi.php';

$id = $_GET['id'];

$sql = "SELECT * FROM pendaftar WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

$fasilitas_array = explode(', ', $data['fasilitas']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE FORM BIMBEL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <form id="formBimbel" action="php/proses_update.php" method="POST" class="form">
        <center>
            <h1 class="judul">UPDATE DATA BIMBEL BABARSARI</h1>
        </center>

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <label for="nama">Nama :</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required><br><br>

        <label for="Email">Email : </label>
        <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required><br><br>

        <label for="Paket">Paket Bimbingan</label><br>
        <input type="radio" name="pkt_b" value="Paket Intensif SBMPTN" 
            <?php echo ($data['pkt_b'] == 'Paket Intensif SBMPTN') ? 'checked' : ''; ?>> Paket Intensif SBMPTN <br>
        <input type="radio" name="pkt_b" value="Paket Reguler" 
            <?php echo ($data['pkt_b'] == 'Paket Reguler') ? 'checked' : ''; ?>> Paket Reguler <br>
        <input type="radio" name="pkt_b" value="Paket Supercamp SBMPTN" 
            <?php echo ($data['pkt_b'] == 'Paket Supercamp SBMPTN') ? 'checked' : ''; ?>> Paket Supercamp SBMPTN
        <br><br>

        <label for="Tambahan">Fasilitas Tambahan</label><br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Modul Cetak Lengkap" 
            <?php echo in_array('Modul Cetak Lengkap', $fasilitas_array) ? 'checked' : ''; ?>> Modul Cetak Lengkap <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Modul PDF" 
            <?php echo in_array('Modul PDF', $fasilitas_array) ? 'checked' : ''; ?>> Modul PDF <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Video Rekaman Kelas" 
            <?php echo in_array('Video Rekaman Kelas', $fasilitas_array) ? 'checked' : ''; ?>> Video Rekaman Kelas <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Grup Diskusi Telegram" 
            <?php echo in_array('Grup Diskusi Telegram', $fasilitas_array) ? 'checked' : ''; ?>> Grup Diskusi Telegram
        <br><br>

        <label for="Lokasi" class="lokasi">Lokasi Cabang : </label>
        <select name="lokasi" class="form-control">
            <option value="Jakarta Pusat" <?php echo ($data['lokasi'] == 'Jakarta Pusat') ? 'selected' : ''; ?>>Jakarta Pusat</option>
            <option value="Surabaya" <?php echo ($data['lokasi'] == 'Surabaya') ? 'selected' : ''; ?>>Surabaya</option>
            <option value="Yogyakarta" <?php echo ($data['lokasi'] == 'Yogyakarta') ? 'selected' : ''; ?>>Yogyakarta</option>
            <option value="Makassar" <?php echo ($data['lokasi'] == 'Makassar') ? 'selected' : ''; ?>>Makassar</option>
            <option value="Aceh" <?php echo ($data['lokasi'] == 'Aceh') ? 'selected' : ''; ?>>Aceh</option>
        </select>
        <br><br>

        <label for="pymnt">Metode Pembayaran : </label>
        <select name="pymnt" class="form-control">
            <option value="tf" <?php echo ($data['pymnt'] == 'tf') ? 'selected' : ''; ?>>Transfer Bank +3000</option>
            <option value="cash" <?php echo ($data['pymnt'] == 'cash') ? 'selected' : ''; ?>>Tunai</option>
            <option value="E-Wallet" <?php echo ($data['pymnt'] == 'E-Wallet') ? 'selected' : ''; ?>>E-Wallet +2000</option>
        </select>
        <br><br>

        <label for="note">Note</label><br>
        <textarea name="note" id="note" placeholder="Write Your Additional Note Here" class="form-control"><?php echo $data['note']; ?></textarea>
        <br>

        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-danger">Reset</button> <br> <br>
        <a href="akmal.php" class="btn btn-dark">Kembali Ke Dashboard</a>
    </form>

    <p id="pesan"></p>

    <script>
        const form = document.getElementById("formBimbel");
        const pesan = document.getElementById("pesan");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            const nama = form.nama.value;
            const paket = form.pkt_b.value;

            const yakin = confirm("Halo " + nama + ". Anda memilih paket bimbel " + paket + ". Apakah anda yakin ingin melanjutkan?");

            if (yakin) {
                form.submit();
            } else {
                pesan.textContent = "Update dibatalkan";
            }
        });
    </script>
</body>

</html>