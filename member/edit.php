<?php
session_start();
require __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa mengelola data.'];
    header('Location: list.php');
    exit;
}

$page_title = "Edit Member";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

// Cari data member berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM member WHERE id = :id");
$stmt->execute(['id' => $id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$member) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data member tidak ditemukan!'];
    header('Location: list.php');
    exit;
}
?>

<main class="container my-5 d-flex justify-content-center">
    <section class="card border-0 shadow-sm rounded-4 overflow-hidden" style="max-width: 650px; width: 100%;">
    
        <div class="p-4 text-white text-center" style="background-color: #5a7061;">
            <div class="mb-2">
                <i class="bi bi-pencil-square" style="color: #ffc107; font-size: 2.2rem;"></i>
            </div>
            <h3 class="fw-bold m-0">Edit Data Member</h3>
            <p class="mb-0 text-white-50 small mt-1">Perbarui informasi data pelanggan</p>
        </div>
        
        <div class="card-body p-4 p-md-5 bg-white">
            <form action="proses_edit.php" method="POST">
                <!-- ID Utama yang disembunyikan -->
                <input type="hidden" name="id" value="<?= $member['id'] ?>">

                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">ID MEMBER</label>
                        <input type="text" name="id_member" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($member['id_member']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">TIPE KEANGGOTAAN</label>
                        <select name="tipe" class="form-select border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                            <option value="Reguler" <?= $member['tipe'] == 'Reguler' ? 'selected' : '' ?>>Reguler (Standar)</option>
                            <option value="VIP" <?= $member['tipe'] == 'VIP' ? 'selected' : '' ?>>VIP</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">NAMA LENGKAP</label>
                    <input type="text" name="nama" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($member['nama']) ?>" required>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">NO. HP / WHATSAPP</label>
                        <input type="text" name="no_hp" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($member['no_hp']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">EMAIL AKTIF</label>
                        <input type="email" name="email" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($member['email'] ?? '') ?>">
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">TANGGAL BERGABUNG</label>
                    <input type="date" name="tanggal_bergabung" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" value="<?= htmlspecialchars($member['tanggal_bergabung'] ?? '') ?>" required>
                </div>

                <div class="d-flex gap-3 mt-2">
                    <a href="list.php" class="btn btn-light rounded-pill px-4 py-3 w-50 fw-bold shadow-sm text-secondary">Batal</a>
                    <button type="submit" class="btn text-white rounded-pill px-4 py-3 w-50 fw-bold shadow-sm" style="background-color: #8fa396;">
                        <i class="bi bi-save me-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>