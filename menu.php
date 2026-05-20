<?php
include 'koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM menu_makanan ORDER BY tanggal_menu DESC");
$menus = [];
while ($row = mysqli_fetch_assoc($result)) {
    $menus[] = $row;
}
// $menus siap dipakai frontend
?>