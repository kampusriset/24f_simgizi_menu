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
echo "
<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Memproses...</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap' rel='stylesheet'>
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
            margin: 0; 
            height: 100vh; 
        }
    </style>
</head>
<body>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Akun berhasil dibuat. Silakan login dengan akun barumu.',
            icon: 'success',
            confirmButtonColor: '#0ea5e9', 
            confirmButtonText: 'Lanjut Login',
            allowOutsideClick: false 
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke halaman login setelah tombol diklik
                window.location.href = 'login.php'; 
            }
        });
    </script>
</body>
</html>
";
} else {

    echo "Gagal daftar: " . mysqli_error($conn);
}
?>