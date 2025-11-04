<?php
require_once 'models/Pendaftar.php';

$pendaftar = new Pendaftar();
$data = $pendaftar->getAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran Bimbel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-tambah {
            background: #28a745;
            color: white;
            margin-bottom: 20px;
        }
        .btn-detail {
            background: #17a2b8;
            color: white;
        }
        .btn-update {
            background: #ffc107;
            color: black;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Pendaftaran Bimbel</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="success">
                <?php 
                if ($_GET['success'] == 1) echo "Data berhasil ditambahkan!";
                elseif ($_GET['success'] == 2) echo "Data berhasil diupdate!";
                elseif ($_GET['success'] == 3) echo "Data berhasil dihapus!";
                ?>
            </div>
        <?php endif; ?>
        
        <a href="add.php" class="btn btn-tambah">Tambah Data</a>
        
        <?php if ($data->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Paket</th>
                        <th>Lokasi</th>
                        <th>Total Biaya</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['paket']); ?></td>
                        <td><?php echo htmlspecialchars($row['lokasi']); ?></td>
                        <td>Rp <?php echo number_format($row['total_biaya'], 0, ',', '.'); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_daftar'])); ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-detail">Detail</a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-update">Update</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">
                <h2>Tidak ada data</h2>
                <p>Silakan tambah data pendaftar baru dengan mengklik tombol "Tambah Data" di atas.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>