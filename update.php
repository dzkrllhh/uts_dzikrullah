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

// Mengambil data barang untuk ditampilkan pada form edit
if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];
    $result = $conn->query("SELECT * FROM tb_diki_stok WHERE id_barang=$id_barang");
    $barang_edit = $result->fetch_assoc();
}

// Mengupdate data barang jika form disubmit
if (isset($_POST['edit_data'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    
    $stmt = $conn->prepare("UPDATE tb_diki_stok SET nama_barang=?, stok=?, harga_beli=?, harga_jual=? WHERE id_barang=?");
    $stmt->bind_param("siddi", $nama_barang, $stok, $harga_beli, $harga_jual, $id_barang);
    $stmt->execute();
    header("Location: read.php"); // Arahkan kembali ke halaman utama setelah berhasil update data
    exit();
}

// Menutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Data Barang</h1>
    <?php if ($barang_edit): ?>
    <form method="POST">
        <input type="hidden" name="id_barang" value="<?php echo $barang_edit['id_barang']; ?>">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?php echo $barang_edit['nama_barang']; ?>" required>
        <label>Stok:</label>
        <input type="number" name="stok" value="<?php echo $barang_edit['stok']; ?>" required>
        <label>Harga Beli:</label>
        <input type="number" name="harga_beli" value="<?php echo $barang_edit['harga_beli']; ?>" required step="0.01">
        <label>Harga Jual:</label>
        <input type="number" name="harga_jual" value="<?php echo $barang_edit['harga_jual']; ?>" required step="0.01">
        <button type="submit" name="edit_data">Simpan Perubahan</button>
    </form>
    <?php else: ?>
        <p>Data barang tidak ditemukan.</p>
    <?php endif; ?>
</body>
</html>
