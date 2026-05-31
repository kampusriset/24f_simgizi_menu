<?php
include '../koneksi.php';

$id  = $_GET['id'] ?? null;
$row = null;

$makanan_utama = '';
$lauk_pauk     = '';
$sayuran       = '';
$buah          = '';
$susu          = '';

if ($id) {
    $result = mysqli_query($conn, "SELECT * FROM menu_makanan WHERE id_menu=$id");
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $komponen = explode(',', $row['nama_menu']);
        $makanan_utama = trim($komponen[0] ?? '-');
        $lauk_pauk     = trim($komponen[1] ?? '-');
        $sayuran       = trim($komponen[2] ?? '-');
        $buah          = trim($komponen[3] ?? '-');
        $susu          = trim($komponen[4] ?? '-');
    }
}
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
            max-width: 550px; 
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
            margin-bottom: 6px; 
            font-weight: 600; 
            font-size: 14px; 
            color: #334155;
        }
        input, select { 
            width: 100%; 
            padding: 11px; 
            margin-bottom: 18px; 
            border: 1px solid #cbd5e1; 
            border-radius: 8px; 
            box-sizing: border-box; 
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }
        .gizi-group {
            background-color: #f8fafc;
            padding: 20px 15px 5px 15px;
            border-radius: 10px;
            border: 1px dashed #cbd5e1;
            margin-bottom: 20px;
        }
        .gizi-group h3 {
            font-size: 14px;
            color: #64748b;
            margin-top: 0;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .note { 
            font-size: 12px; 
            color: #64748b; 
            margin-top: -10px; 
            margin-bottom: 18px; 
            display: block; 
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
        <h2><?= $id ? 'Edit Menu Makanan' : 'Tambah Menu Baru' ?></h2>
        
        <form action="../menu-proses.php" method="POST">
            
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

            <div class="gizi-group">
                <h3>Rincian Komponen Gizi</h3>
                
                <label>Makanan Utama</label>
                <input type="text" name="utama" value="<?= htmlspecialchars($makanan_utama) ?>" placeholder="Contoh: Nasi Putih / Bubur Kacang Hijau">

                <label>Lauk Pauk</label>
                <input type="text" name="lauk" value="<?= htmlspecialchars($lauk_pauk) ?>" placeholder="Contoh: Ayam Teriyaki / Telur Rebus">

                <label>Sayuran</label>
                <input type="text" name="sayur" value="<?= htmlspecialchars($sayuran) ?>" placeholder="Contoh: Tumis Sawi / Sup Sayur">

                <label>Buah</label>
                <input type="text" name="buah" value="<?= htmlspecialchars($buah) ?>" placeholder="Contoh: Pisang / Jeruk">

                <label>Susu</label>
                <input type="text" name="susu" value="<?= htmlspecialchars($susu) ?>" placeholder="Contoh: Susu Putih / Susu Coklat">
                
                <span class="note"><i>*Kosongkan saja kotak isiannya jika komponen gizi tersebut tidak ada. Nanti otomatis berubah jadi tanda setrip (-) oleh sistem.</i></span>
            </div>

            <button type="submit" class="btn">Simpan Menu</button>
            <a href="../menu.php" class="btn-batal">Batal</a>
        </form>
    </div>

</body>
</html>