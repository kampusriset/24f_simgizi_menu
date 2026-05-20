<?php
include '../koneksi.php';

$id  = $_GET['id'] ?? null;
$row = null;

if ($id) {
    $result = mysqli_query($conn, "SELECT * FROM menu_makanan WHERE id_menu=$id");
    $row = mysqli_fetch_assoc($result);
}
// $row berisi data lama (atau null jika mode tambah)
// Frontend pakai $row['nama_menu'], $row['jenis'], dst.
?>