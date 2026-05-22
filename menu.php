<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM menu_makanan ORDER BY tanggal_menu DESC");
$menus = [];
while ($row = mysqli_fetch_assoc($result)) {
    $menus[] = $row;
}
?>

<?php 
if ($_SESSION['role'] == 'admin') { 
    echo '<a href="form-user.php" style="background-color: blue; color: white; padding: 5px; text-decoration: none;">+ Buat Akun Baru</a> | ';
} 
?>

<a href="logout.php" style="background-color: red; color: white; padding: 5px; text-decoration: none;">Keluar (Logout)</a>
<br><br>