<?php
include 'koneksi.php';
$tanggal = $_GET['tanggal'] ?? '';

if (!$tanggal) {
    header("Location: menu.php");
    exit;
}

$sql = "SELECT * FROM menu_makanan WHERE tanggal_menu = '$tanggal' ORDER BY jenis ASC";
$result = mysqli_query($conn, $sql);
$tanggal_tampil = date('d M Y', strtotime($tanggal));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Menu Harian</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #f8fafc; 
            font-family: 'Inter', sans-serif; 
            padding: 40px 20px; 
            display: flex;
            justify-content: center;
        }
        .card { 
            background: #fff; 
            width: 100%;
            max-width: 550px; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
        }
        h2 { 
            color: #0f172a; 
            margin-bottom: 5px; 
            text-align: center;
        }
        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
        }
        .menu-item { 
            border: 1px solid #e2e8f0; 
            padding: 16px; 
            border-radius: 10px; 
            margin-bottom: 15px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            background: #f8fafc;
        }
        .menu-info { 
            display: flex; 
            flex-direction: column; 
            gap: 6px; 
        }
        .badge { 
            background: #e0f2fe; 
            color: #0284c7; 
            padding: 4px 10px; 
            border-radius: 6px; 
            font-size: 11px; 
            font-weight: 700; 
            width: fit-content;
            text-transform: uppercase;
        }
        .nama-menu {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
        }
        .btn-group { 
            display: flex; 
            gap: 8px; 
        }
        .btn { 
            padding: 8px 12px; 
            border-radius: 6px; 
            text-decoration: none; 
            font-size: 13px; 
            font-weight: 600; 
            color: white; 
            border: none;
            cursor: pointer;
        }
        .btn-edit { background-color: #f59e0b; }
        .btn-edit:hover { background-color: #d97706; }
        .btn-hapus { background-color: #ef4444; }
        .btn-hapus:hover { background-color: #dc2626; }
        .btn-back { 
            display: block; 
            text-align: center; 
            margin-top: 25px; 
            color: #64748b; 
            text-decoration: none;
            font-weight: 500;
        }
        .btn-back:hover { color: #0f172a; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Menu: <?= $tanggal_tampil ?></h2>
        <p class="subtitle">Pilih data mana yang ingin kamu perbaiki atau hapus.</p>
        
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="menu-item">
                <div class="menu-info">
                    <span class="badge"><?= $row['jenis'] ?></span>
                    <span class="nama-menu"><?= htmlspecialchars($row['nama_menu']) ?></span>
                </div>
                <div class="btn-group">
                    <a href="templates/form-menu.php?id=<?= $row['id_menu'] ?>" class="btn btn-edit">Edit</a>
                    
                    <a href="menu-proses.php?aksi=hapus&id=<?= $row['id_menu'] ?>" class="btn btn-hapus" onclick="return confirm('Kamu yakin mau hapus menu ini?')">Hapus</a>
                </div>
            </div>
        <?php } ?>

        <a href="menu.php" class="btn-back">Batal & Kembali ke Dasbor</a>
    </div>

</body>
</html>