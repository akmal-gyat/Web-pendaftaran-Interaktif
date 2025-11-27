<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM BIMBEL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <form id="formBimbel" action="php/proses_add.php" method="POST" class="form">
        
    <h1 class="judul">BIMBEL BABARSARI</h1>

        <label for="nama">Nama :</label>
        <input type="text" name="nama" class="form-control" required><br><br>

        <label for="Email">Email : </label>
        <input type="email" name="email" class="form-control" required><br><br>

        <label for="Paket">Paket Bimbingan</label><br>
        <input type="radio" name="pkt_b" value="Paket Intensif SBMPTN"> Paket Intensif SBMPTN <br>
        <input type="radio" name="pkt_b" value="Paket Reguler"> Paket Reguler <br>
        <input type="radio" name="pkt_b" value="Paket Supercamp SBMPTN"> Paket Supercamp SBMPTN
        <br><br>

        <label for="Tambahan">Fasilitas Tambahan</label><br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Modul Cetak Lengkap"> Modul Cetak Lengkap <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Modul PDF"> Modul PDF <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Video Rekaman Kelas"> Video Rekaman Kelas <br>
        <input type="checkbox" name="fasilitas_tambahan[]" value="Grup Diskusi Telegram"> Grup Diskusi Telegram
        <br><br>

        <label for="Lokasi" class="lokasi">Lokasi Cabang : </label>
        <select name="lokasi" class="form-control">
            <option value="Jakarta Pusat" class="clokasi" name="lokasi">Jakarta Pusat</option>
            <option value="Surabaya" class="clokasi" name="lokasi">Surabaya</option>
            <option value="Yogyakarta" class="clokasi" name="lokasi">Yogyakarta</option>
            <option value="Makassar" class="clokasi" name="lokasi">Makassar</option>
            <option value="Aceh" class="clokasi" name="lokasi">Aceh</option>
        </select>
        <br><br>

        <label for="pymnt">Metode Pembayaran : </label>
        <select name="pymnt" class="form-control">
            <option value="Transfer Bank" name="pymnt">Transfer Bank +3000</option>
            <option value="Tunai" name="pymnt">Tunai</option>
            <option value="E-Wallet" name="pymnt">E-Wallet +2000</option>
        </select>
        <br><br>

        <label for="note">Note</label><br>
        <textarea name="note" id="note" placeholder="Write Your Additional Note Here" class="form-control"></textarea>
        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button> <br> <br>
        <a href="akmal.php" class="btn btn-dark">Kembali Ke Dahsboard</a>
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
                pesan.textContent = "Pesanan dibatalkan";
            }
        });
    </script>
</body>

</html>