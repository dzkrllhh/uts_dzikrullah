<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_dikii";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambahkan data barang
if (isset($_POST['add'])) {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stmt = $conn->prepare("INSERT INTO tb_diki_stok (nama_barang, stok, harga_beli, harga_jual) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sidd", $nama_barang, $stok, $harga_beli, $harga_jual);
    $stmt->execute();
    header("Location: read.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Barang</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h2 divv class=" containeer">Tambah Data Barang</h2>
    <form method="POST">
        <input type="text" name="nama_barang" placeholder="Nama Barang" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <input type="number" name="harga_beli" placeholder="Harga Beli" required step="0.01">
        <input type="number" name="harga_jual" placeholder="Harga Jual" required step="0.01">
        <button type="submit" name="add">Tambah Barang</button>
    </form>
</body>
</html>
