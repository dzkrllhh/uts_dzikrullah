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

// Menghapus data barang
if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];
    $stmt = $conn->prepare("DELETE FROM tb_diki_stok WHERE id_barang=?");
    $stmt->bind_param("i", $id_barang);
    $stmt->execute();
    header("Location: read.php");
}
?>
