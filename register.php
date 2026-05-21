<?php
session_start();

// Kalau dia udah login (punya tiket), ngapain daftar lagi? Suruh langsung masuk menu aja
if (isset($_SESSION['id_user'])) {
    header("Location: menu.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun Baru</title>
</head>
<body>
    <h2>Form Pendaftaran Akun</h2>
    
    <form action="register-proses.php" method="POST">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required><br><br>
        
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <label>Role:</label><br>
        <select name="role" required>
            <option value="petugas">Petugas</option>
            <option value="dapur">Dapur</option>
            <option value="sekolah">Pihak Sekolah</option>
            </select><br><br>
        
        <button type="submit">Daftar Sekarang</button>
    </form>
    
    <br>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>