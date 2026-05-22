<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    exit("Akses ditolak!");
}
$nama          = $_POST['nama'];
$username      = $_POST['username'];
$password_asli = $_POST['password'];
$role          = $_POST['role'];

$cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Gagal! Username sudah dipakai orang lain.'); window.location='form-user.php';</script>";
    exit;
}

$password_acak = password_hash($password_asli, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (nama, username, password, role) 
        VALUES ('$nama', '$username', '$password_acak', '$role')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Sukses! Akun baru berhasil dibuat.'); window.location='menu.php';</script>";
} else {
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}
?>