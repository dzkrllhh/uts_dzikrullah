<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_dikii";  // Nama database yang sudah Anda buat di phpMyAdmin

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data barang untuk ditampilkan
$sql = "SELECT * FROM tb_diki_stok";
$barang = $conn->query($sql);

// Menutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
</head>
<body>
    <h1>Daftar Barang</h1>
    <a href="create.php">Tambah Barang</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $barang->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['harga_beli']; ?></td>
                <td><?php echo $row['harga_jual']; ?></td>
                <td>
                    <a href="edit.php?id_barang=<?php echo $row['id_barang']; ?>">Edit</a> |
                    <a href="delete.php?delete=<?php echo $row['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
