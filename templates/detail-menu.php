<?php
include '../koneksi.php';

$id  = $_GET['id'];
$sql = "SELECT m.*, k.kalori, k.protein, k.lemak, k.karbohidrat
        FROM menu_makanan m
        LEFT JOIN kandungan_gizi k ON m.id_menu = k.id_menu
        WHERE m.id_menu = $id";

$result = mysqli_query($conn, $sql);
$menu   = mysqli_fetch_assoc($result);
// $menu siap dipakai frontend
?>