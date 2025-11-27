<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'php/koneksi.php';

    $sql = "SELECT * FROM pendaftar";
    $query = mysqli_query($koneksi, $sql);
    ?>
    <br>
    <h1 style="margin-left: 35px">LIST PENDAFTAR PROGRAM BELAJAR</h1>

        <a href="add.php" class="btn btn-primary" style="margin-left: 35px">Tambah Data</a>

    <table class="table table-striped" style="margin: 50px auto; width: 1400px">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Paket</th>
            <th>Total Biaya</th>
            <th>Aksi</th>
        </tr>
        <?php
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['pkt_b'] . "</td>";
                echo "<td>" . $row['total_biaya'] . "</td>";
                echo "<td>
                        <a href='detail.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Detail</a>
                        <a href='update.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='php/hapus.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
        }
        ?>
    </table>

</body>

</html>