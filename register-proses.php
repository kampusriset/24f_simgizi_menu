<?php
include 'koneksi.php';

$nama          = $_POST['nama'];
$username      = $_POST['username'];
$password_asli = $_POST['password'];
$role          = $_POST['role'];
$cek_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

if (mysqli_num_rows($cek_user) > 0) {
    echo "<script>alert('Username sudah dipakai orang lain'); window.location='register.php';</script>";
    exit;
}
$password_acak = password_hash($password_asli, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (nama, username, password, role) 
        VALUES ('$nama', '$username', '$password_acak', '$role')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Akun berhasil dibuat. Silakan login dengan akun barumu.'); window.location='login.php';</script>";
} else {

    echo "Gagal daftar: " . mysqli_error($conn);
}
?>