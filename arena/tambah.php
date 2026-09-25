<?php
$page_title = 'Tambah Arena';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$errorMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_arena = trim($_POST['id_arena']);
    $nama = trim($_POST['nama']);
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("INSERT INTO arena (id_arena, nama, kategori, harga, status) VALUES (:id_arena, :nama, :kategori, :harga, :status)");
        $stmt->execute([
            'id_arena' => $id_arena,
            'nama' => $nama,
            'kategori' => $kategori,
            'harga' => $harga,
            'status' => $status
        ]);
        header("Location: list.php");
        exit;
    } catch (PDOException $e) {
        $errorMsg = "Gagal menyimpan: ID Arena sudah terdaftar atau terjadi kesalahan.";
    }
}
?>

<section class="card border-0 shadow-sm rounded-4 overflow-hidden mx-auto" style="max-width: 650px;">
    <div class="bg-aesthetic text-white p-4 text-center" style="background: linear-gradient(135deg, #4A6054 0%, #6b8676 100%);">
        <i class="bi bi-plus-square fs-1 text-warning mb-2 d-block"></i>
        <h3 class="fw-bold m-0">Tambah Fasilitas Baru</h3>
        <p class="mb-0 text-white-50 small">Masukkan data lapangan/meja ke database PostgreSQL</p>
    </div>
    
    <div class="card-body p-4 p-md-5 bg-white">
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">ID Arena</label>
                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm border-0 bg-light" name="id_arena" placeholder="Contoh: BD-01" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Kategori</label>
                    <select class="form-select form-select-lg rounded-3 shadow-sm border-0 bg-light" name="kategori">
                        <option value="Badminton">Badminton</option>
                        <option value="Biliar">Biliar</option>
                        <option value="Futsal">Futsal</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Nama Lapangan / Meja</label>
                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm border-0 bg-light" name="nama" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Harga per Jam (Rp)</label>
                    <input type="number" class="form-control form-control-lg rounded-3 shadow-sm border-0 bg-light" name="harga" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Status Saat Ini</label>
                    <select class="form-select form-select-lg rounded-3 shadow-sm border-0 bg-light" name="status">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipakai">Sedang Dipakai</option>
                    </select>
                </div>
                <div class="col-12 mt-5">
                    <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm bg-aesthetic hover-lift">
                        <i class="bi bi-save-fill me-2"></i>Simpan Data Arena ke Database
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>