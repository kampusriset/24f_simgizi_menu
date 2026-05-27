<?php
include '../koneksi.php'; // Diubah jadi langsung 'koneksi.php' karena fungsinya udah dipindah ke folder utama

$id  = $_GET['id'] ?? null;
$row = null;

if ($id) {
    $result = mysqli_query($conn, "SELECT * FROM menu_makanan WHERE id_menu=$id");
    $row = mysqli_fetch_assoc($result);
}
// $row berisi data lama (atau null jika mode tambah)
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Menu - MBG</title>
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
            max-width: 500px; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
        }
        h2 { 
            color: #0284c7; 
            margin-bottom: 20px; 
            text-align: center;
        }
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 500; 
            font-size: 14px; 
            color: #334155;
        }
        input, select { 
            width: 100%; 
            padding: 12px; 
            margin-bottom: 20px; 
            border: 1px solid #cbd5e1; 
            border-radius: 8px; 
            box-sizing: border-box; 
            font-family: 'Inter', sans-serif;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }
        .note { 
            font-size: 12px; 
            color: #64748b; 
            margin-top: -15px; 
            margin-bottom: 20px; 
            display: block; 
            background: #f1f5f9;
            padding: 8px;
            border-radius: 6px;
            line-height: 1.5;
        }
        .btn { 
            background: #10b981; 
            color: white; 
            padding: 14px 20px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-weight: 600; 
            width: 100%; 
            font-size: 15px;
            margin-bottom: 10px;
        }
        .btn:hover { background: #059669; }
        .btn-batal { 
            background: #f1f5f9; 
            color: #64748b; 
            text-align: center; 
            display: block; 
            text-decoration: none; 
            padding: 14px 20px; 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 15px;
        }
        .btn-batal:hover { background: #e2e8f0; color: #334155; }
    </style>
</head>
<body>

    <div class="card">
        <h2><?= $id ? '✏️ Edit Menu Makanan' : '🍴 Tambah Menu Baru' ?></h2>
        
        <form action="menu-proses.php" method="POST">
            <input type="hidden" name="aksi" value="<?= $id ? 'edit' : 'tambah' ?>">
            <?php if ($id): ?>
                <input type="hidden" name="id_menu" value="<?= $id ?>">
            <?php endif; ?>

            <label>Tanggal Menu</label>
            <input type="date" name="tanggal_menu" value="<?= $row['tanggal_menu'] ?? '' ?>" required>

            <label>Jenis Waktu Makan</label>
            <select name="jenis" required>
                <option value="Sarapan" <?= (isset($row['jenis']) && $row['jenis'] == 'Sarapan') ? 'selected' : '' ?>>Sarapan</option>
                <option value="Siang" <?= (isset($row['jenis']) && $row['jenis'] == 'Siang') ? 'selected' : '' ?>>Siang</option>
            </select>

            <label>Daftar Menu</label>
            <input type="text" name="nama_menu" value="<?= $row['nama_menu'] ?? '' ?>" placeholder="Contoh: Nasi Putih, Ayam Goreng, Tumis Buncis, Pisang, Susu" required>
            <span class="note"><b>💡 Tips Pengisian:</b> Pisahkan nama makanan dengan tanda koma (,) sesuai urutan: Makanan Utama, Lauk Pauk, Sayuran, Buah, Susu. Gunakan tanda strip (-) jika ada komponen gizi yang tidak ada.</span>

            <button type="submit" class="btn">Simpan Menu</button>
            <a href="menu.php" class="btn-batal">Batal</a>
        </form>
    </div>

</body>
</html>