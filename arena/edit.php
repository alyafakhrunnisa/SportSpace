<?php
session_start();
require __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa mengelola data.'];
    header('Location: list.php');
    exit;
}

$page_title = "Edit Arena";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM arena WHERE id = :id");
$stmt->execute(['id' => $id]);
$arena = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$arena) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data arena tidak ditemukan!'];
    header('Location: list.php');
    exit;
}
?>

<main class="container my-5 d-flex justify-content-center">
    <section class="card border-0 shadow-sm rounded-4 overflow-hidden" style="max-width: 600px; width: 100%;">
        <div class="p-4 text-white text-center" style="background-color: #5a7061;">
            <div class="mb-2">
                <i class="bi bi-pencil-square text-warning" style="font-size: 2rem;"></i>
            </div>
            <h3 class="fw-bold m-0">Edit Fasilitas</h3>
            <p class="mb-0 text-white-50 small mt-1">Ubah data lapangan atau meja biliar</p>
        </div>
        
        <div class="card-body p-4 p-md-5 bg-white">
            <form action="proses_edit.php" method="POST">
                <!-- ID Utama yang disembunyikan -->
                <input type="hidden" name="id" value="<?= $arena['id'] ?>">

                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">ID ARENA</label>
                        <input type="text" name="id_arena" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($arena['id_arena']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">KATEGORI</label>
                        <select name="kategori" class="form-select border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                            <option value="Badminton" <?= $arena['kategori'] == 'Badminton' ? 'selected' : '' ?>>Badminton</option>
                            <option value="Biliar" <?= $arena['kategori'] == 'Biliar' ? 'selected' : '' ?>>Biliar</option>
                            <option value="Futsal" <?= $arena['kategori'] == 'Futsal' ? 'selected' : '' ?>>Futsal</option>
                            <option value="Basket" <?= $arena['kategori'] == 'Basket' ? 'selected' : '' ?>>Basket</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">NAMA LAPANGAN / MEJA</label>
                    <input type="text" name="nama" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($arena['nama']) ?>" required>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">HARGA PER JAM (RP)</label>
                        <input type="number" name="harga" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($arena['harga']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">STATUS SAAT INI</label>
                        <select name="status" class="form-select border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                            <option value="Tersedia" <?= $arena['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Dipakai" <?= $arena['status'] == 'Dipakai' ? 'selected' : '' ?>>Dipakai</option>
                            <option value="Perbaikan" <?= $arena['status'] == 'Perbaikan' ? 'selected' : '' ?>>Perbaikan</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-2">
                    <a href="list.php" class="btn btn-light rounded-pill px-4 py-3 w-50 fw-bold shadow-sm text-secondary">Batal</a>
                    <button type="submit" class="btn text-white rounded-pill px-4 py-3 w-50 fw-bold shadow-sm" style="background-color: #4a6054;">
                        <i class="bi bi-save me-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>