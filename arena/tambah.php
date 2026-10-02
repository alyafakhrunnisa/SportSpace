<?php
session_start();
require __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa mengelola data.'];
    header('Location: list.php');
    exit;
}

$page_title = "Tambah Arena";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_arena = $_POST['id_arena'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = str_replace(['Rp', '.', ' '], '', $_POST['harga']); 
    $status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("INSERT INTO arena (id_arena, nama, kategori, harga, status) 
                               VALUES (:id_arena, :nama, :kategori, :harga, :status)");
        
        $stmt->execute([
            'id_arena' => $id_arena,
            'nama' => $nama,
            'kategori' => $kategori,
            'harga' => $harga,
            'status' => $status
        ]);
        
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data arena baru berhasil ditambahkan!'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        $error = "Gagal menyimpan data arena: " . $e->getMessage();
    }
}
?>

<main class="container my-5 d-flex justify-content-center">
    <section class="card border-0 shadow-sm rounded-4 overflow-hidden" style="max-width: 600px; width: 100%;">
        <div class="p-4 text-white text-center" style="background-color: #5a7061;">
            <div class="mb-2">
                <i class="bi bi-plus-square text-warning" style="font-size: 2rem;"></i>
            </div>
            <h3 class="fw-bold m-0">Tambah Fasilitas Baru</h3>
            <p class="mb-0 text-white-50 small mt-1">Masukkan data lapangan/meja ke dalam sistem</p>
        </div>
        
        <div class="card-body p-4 p-md-5 bg-white">
            <?php if ($error): ?>
                <div class="alert alert-danger rounded-3"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">ID ARENA</label>
                        <input type="text" name="id_arena" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" placeholder="Contoh: BD-01" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">KATEGORI</label>
                        <select name="kategori" class="form-select border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                            <option value="Badminton">Badminton</option>
                            <option value="Biliar">Biliar</option>
                            <option value="Futsal">Futsal</option>
                            <option value="Basket">Basket</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">NAMA LAPANGAN / MEJA</label>
                    <input type="text" name="nama" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">HARGA PER JAM (RP)</label>
                        <input type="number" name="harga" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">STATUS SAAT INI</label>
                        <select name="status" class="form-select border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Dipakai">Dipakai</option>
                            <option value="Perbaikan">Perbaikan</option>
                        </select>
                    </div>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn text-white rounded-pill px-4 py-3 w-100 fw-bold shadow-sm" style="background-color: #4a6054;">
                        <i class="bi bi-box-arrow-down me-2"></i> Simpan Data Arena
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>