<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Maaf, hanya Admin yang boleh bikin akun!'); window.location='menu.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Akun Pengguna</title>
</head>
<body>
    <h2>Buat Akun Baru</h2>
    
    <form action="user-proses.php" method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required><br><br>
        
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <label>Jabatan (Role):</label><br>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="dapur">Dapur</option>
            <option value="sekolah">Sekolah</option>
        </select><br><br>
        
        <button type="submit">Simpan Akun</button>
        <a href="menu.php">Batal</a>
    </form>
</body>
</html>