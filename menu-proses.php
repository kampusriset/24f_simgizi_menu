<?php
include 'koneksi.php';
$aksi = $_POST['aksi'] ?? $_GET['aksi'] ?? '';

if ($aksi == 'tambah') {
    $nama   = $_POST['nama_menu'];
    $jenis  = $_POST['jenis'];
    $tgl    = $_POST['tanggal_menu'];
    $sql = "INSERT INTO menu_makanan (nama_menu, jenis, tanggal_menu)
            VALUES ('$nama', '$jenis', '$tgl')";
    mysqli_query($conn, $sql);

} elseif ($aksi == 'edit') {
    $id    = $_POST['id_menu'];
    $nama  = $_POST['nama_menu'];
    $jenis = $_POST['jenis'];
    $tgl   = $_POST['tanggal_menu'];
    $sql = "UPDATE menu_makanan SET nama_menu='$nama', jenis='$jenis',
            tanggal_menu='$tgl' WHERE id_menu=$id";
    mysqli_query($conn, $sql);

} elseif ($aksi == 'hapus') {
    $id  = $_GET['id'];
    $sql = "DELETE FROM menu_makanan WHERE id_menu=$id";
    mysqli_query($conn, $sql);
}

header("Location: ../menu.php");
exit;