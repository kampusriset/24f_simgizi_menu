<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: menu.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Silakan Login</h2>
    
    <form action="login-proses.php" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Masuk</button>
    </form>
</body>
</html>