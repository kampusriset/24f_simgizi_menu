<?php
include 'koneksi.php';

$aksi = $_POST['aksi'] ?? $_GET['aksi'] ?? '';

if ($aksi == 'tambah' || $aksi == 'edit') {

    $utama = $_POST['utama'] ?: '-';
    $lauk  = $_POST['lauk'] ?: '-';
    $sayur = $_POST['sayur'] ?: '-';
    $buah  = $_POST['buah'] ?: '-';
    $susu  = $_POST['susu'] ?: '-';

    $nama_menu_gabungan = "$utama, $lauk, $sayur, $buah, $susu";
    
    $jenis = $_POST['jenis'];
    $tgl   = $_POST['tanggal_menu'];

    if ($aksi == 'tambah') {
        $sql = "INSERT INTO menu_makanan (nama_menu, jenis, tanggal_menu)
                VALUES ('$nama_menu_gabungan', '$jenis', '$tgl')";
    } else {
        $id  = $_POST['id_menu'];
        $sql = "UPDATE menu_makanan SET nama_menu='$nama_menu_gabungan', jenis='$jenis',
                tanggal_menu='$tgl' WHERE id_menu=$id";
    }
    mysqli_query($conn, $sql);

} elseif ($aksi == 'hapus') {
    $id  = $_GET['id'];
    $sql = "DELETE FROM menu_makanan WHERE id_menu=$id";
    mysqli_query($conn, $sql);
}

header("Location: menu.php");
exit;
?>