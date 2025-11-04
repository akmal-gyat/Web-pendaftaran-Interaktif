<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM BIMBEL</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form id="formBimbel" action="resultt.php" method="get">
        <center>
            <h1 class="judul">BIMBEL BABARSARI</h1>
        </center>

        <label for="nama">Nama :</label>
        <input type="text" name="nama" required><br><br>

        <label for="Email">Email : </label>
        <input type="email" name="email" required><br><br>

        <label for="Paket">Paket Bimbingan</label><br>
        <input type="radio" name="pkt_b" value="Paket Intensif SBMPTN"> Paket Intensif SBMPTN
        <input type="radio" name="pkt_b" value="Paket Reguler"> Paket Reguler
        <input type="radio" name="pkt_b" value="Paket Supercamp SBMPTN"> Paket Supercamp SBMPTN
        <br><br>

        <label for="Tambahan">Fasilitas Tambahan</label><br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Modul Cetak Lengkap"> Modul Cetak Lengkap <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Modul PDF"> Modul PDF <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Video Rekaman Kelas"> Video Rekaman Kelas <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Grup Diskusi Telegram"> Grup Diskusi Telegram
        <br><br>

        <label for="Lokasi">Lokasi Cabang : </label>
        <select name="lokasi">
            <option value="Jakarta Pusat">Jakarta Pusat</option>
            <option value="Surabaya">Surabaya</option>
            <option value="Yogyakarta">Yogyakarta</option>
            <option value="Makassar">Makassar</option>
            <option value="Aceh">Aceh</option>
        </select>
        <br><br>

        <label for="pymnt">Metode Pembayaran : </label>
        <select name="pymnt">
            <option value="tf">Transfer Bank +3000</option>
            <option value="cash">Tunai</option>
            <option value="E-Wallet">E-Wallet +2000</option>
        </select>
        <br><br>

        <label for="note">Note</label><br>
        <textarea name="note" style="width: 380px; height: 130px;"
            placeholder="Write Your Additional Note Here"></textarea>
        <br>

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>

    <p id="pesan"></p>

    <script>
        const form = document.getElementById("formBimbel");
        const pesan = document.getElementById("pesan");

        form.addEventListener("submit", function(e) {
            e.preventDefault(); // cegah submit default dulu

            const nama = form.nama.value;
            const paket = form.pkt_b.value;

            // tampil konfirmasi
            const yakin = confirm(`Halo, ${nama}. Anda memilih paket bimbel: ${paket}. Apakah Anda yakin ingin melanjutkan?`);

            if (yakin) {
                form.submit(); // lanjut kirim data
            } else {
                pesan.textContent = "Pesanan dibatalkan";
            }
        });
    </script>
</body>

</html>