<?php
session_start();
include 'koneksi.php';
$cek_admin = mysqli_query($conn, "SELECT * FROM users WHERE username = 'admin'");
if ($cek_admin && mysqli_num_rows($cek_admin) == 0) {
    $pass_acak = password_hash("admin123", PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (nama, username, password, role) 
                         VALUES ('Admin Utama', 'admin', '$pass_acak', 'admin')");
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['nama']    = $user['nama'];
        $_SESSION['role']    = $user['role'];
        
        header("Location: menu.php");
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Username tidak ada di database!'); window.location='login.php';</script>";
}
?>