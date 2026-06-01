<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$result = mysqli_query($conn, "SELECT * FROM menu_makanan ORDER BY tanggal_menu DESC, jenis ASC");

$db_error = !$result ? mysqli_error($conn) : null;

$menus_grouped = [];
if ($result) while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['tanggal_menu'])) {
        $tanggal_key = $row['tanggal_menu']; // Digunakan untuk link parameter ID/Tanggal
        $tanggal_tampil = date('d M Y', strtotime($row['tanggal_menu']));
    } else {
        $tanggal_key = "NULL";
        $tanggal_tampil = "Tanggal Belum Diatur"; 
    }
    // Kelompokkan data berdasarkan tanggal tampil, sekalian simpan tanggal asli untuk kebutuhan edit
    $menus_grouped[$tanggal_tampil]['tanggal_asli'] = $tanggal_key;
    $menus_grouped[$tanggal_tampil]['items'][] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Menu Makanan - MBG</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
            color: #1e293b;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-logo {
            width: 40px;
            height: auto;
            border-radius: 6px;
        }

        .nav-brand h2 {
            color: #0284c7;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-success {
            background-color: #10b981;
            color: #ffffff;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .btn-danger {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .btn-danger:hover {
            background-color: #fca5a5;
            color: #b91c1c;
        }

        /* Tombol Edit Khusus Hari/Tanggal */
        .btn-edit-hari {
            margin-top: 10px;
            padding: 6px 12px;
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
            border: 1px solid #bae6fd;
        }

        .btn-edit-hari:hover {
            background-color: #0ea5e9;
            color: #ffffff;
            border-color: #0ea5e9;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 24px;
            color: #0f172a;
            margin-bottom: 5px;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
        }

        .table-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background-color: #f1f5f9;
            border-bottom: 2px solid #e2e8f0;
        }

        th {
            padding: 16px 20px;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 20px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .tanggal-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .badge-tanggal {
            font-weight: 600;
            color: #0284c7;
            background-color: #f0f9ff;
            padding: 6px 14px;
            border-radius: 6px;
            display: inline-block;
            border: 1px solid #e0f2fe;
        }

        .badge-jenis {
            font-size: 11px;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 12px;
            text-align: center;
        }

        .jenis-sarapan {
            background-color: #fef3c7;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .jenis-siang {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .waktu-block {
            background-color: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.01);
        }

        .waktu-block:last-child {
            margin-bottom: 0;
        }

        .gizi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
        }

        .gizi-item {
            background-color: #f8fafc;
            padding: 10px 12px;
            border-radius: 6px;
            border-left: 3px solid #cbd5e1;
        }

        .gizi-item.utama { border-left-color: #0284c7; }
        .gizi-item.lauk { border-left-color: #f59e0b; }
        .gizi-item.sayur { border-left-color: #10b981; }
        .gizi-item.buah { border-left-color: #ec4899; }
        .gizi-item.susu { border-left-color: #6366f1; }

        .gizi-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .gizi-nama {
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-style: italic;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand">
            <img src="images.png" alt="Logo MBG" class="nav-logo">
            <h2>SIM Gizi MBG</h2>
        </div>
        <div class="nav-menu">
            <a href="logout.php" class="btn btn-danger">Keluar</a>
        </div>
    </nav>

    <main class="container">
        <div class="page-header">
            <div>
                <h1>Daftar Menu Makanan</h1>
            </div>
            <a href="templates/form-menu.php" class="btn btn-success">+ Input Menu</a>
        </div>

        <?php if ($db_error): ?>
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:16px 20px;border-radius:10px;margin-bottom:20px;font-size:14px;">
            <strong>⚠️ Error Database:</strong> <?= htmlspecialchars($db_error) ?><br>
            <small>Pastikan tabel <code>menu_makanan</code> sudah dibuat di database <code>sim_gizi</code>.</small>
        </div>
        <?php endif; ?>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th width="22%">Tanggal Menu</th>
                        <th>Rincian Gizi Seimbang</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($menus_grouped)) { ?>
                        <tr>
                            <td colspan="3" class="empty-state">Belum ada data di tabel menu_makanan.</td>
                        </tr>
                    <?php } else { ?>
                        
                        <?php $no = 1; foreach ($menus_grouped as $tanggal_tampil => $data) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <div class="tanggal-container">
                                        <span class="badge-tanggal"><?= $tanggal_tampil; ?></span>
                                        
                                        <a href="edit-menu.php?tanggal=<?= $data['tanggal_asli']; ?>" class="btn-edit-hari">
                                            Edit Menu
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <?php foreach ($data['items'] as $item) { 
                                        $jenis_class = ($item['jenis'] == 'Sarapan') ? 'jenis-sarapan' : 'jenis-siang';
                                        
                                        $komponen = explode(',', $item['nama_menu']);
                                        
                                        $makanan_utama = trim($komponen[0] ?? '-');
                                        $lauk_pauk     = trim($komponen[1] ?? '-');
                                        $sayuran       = trim($komponen[2] ?? '-');
                                        $buah          = trim($komponen[3] ?? '-');
                                        $susu          = trim($komponen[4] ?? '-');
                                    ?>
                                        <div class="waktu-block">
                                            <span class="badge-jenis <?= $jenis_class; ?>">
                                                <?= htmlspecialchars($item['jenis']); ?>
                                            </span>
                                            
                                            <div class="gizi-grid">
                                                <div class="gizi-item utama">
                                                    <div class="gizi-label">Makanan Utama</div>
                                                    <div class="gizi-nama"><?= htmlspecialchars($makanan_utama); ?></div>
                                                </div>
                                                <div class="gizi-item lauk">
                                                    <div class="gizi-label">Lauk Pauk</div>
                                                    <div class="gizi-nama"><?= htmlspecialchars($lauk_pauk); ?></div>
                                                </div>
                                                <div class="gizi-item sayur">
                                                    <div class="gizi-label">Sayuran</div>
                                                    <div class="gizi-nama"><?= htmlspecialchars($sayuran); ?></div>
                                                </div>
                                                <div class="gizi-item buah">
                                                    <div class="gizi-label">Buah</div>
                                                    <div class="gizi-nama"><?= htmlspecialchars($buah); ?></div>
                                                </div>
                                                <div class="gizi-item susu">
                                                    <div class="gizi-label">Susu</div>
                                                    <div class="gizi-nama"><?= htmlspecialchars($susu); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>