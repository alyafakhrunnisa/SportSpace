<?php
$page_title = 'Tambah Member';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$errorMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_member = trim($_POST['id_member']);
    $tipe = $_POST['tipe'];
    $nama = trim($_POST['nama']);
    $no_hp = trim($_POST['no_hp']);
    $email = trim($_POST['email']);

    try {
        $stmt = $pdo->prepare("INSERT INTO member (id_member, tipe, nama, no_hp, email) VALUES (:id_member, :tipe, :nama, :no_hp, :email)");
        $stmt->execute([
            'id_member' => $id_member,
            'tipe'      => $tipe,
            'nama'      => $nama,
            'no_hp'     => $no_hp,
            'email'     => $email
        ]);
        // Kalau sukses, langsung pindah ke halaman list member
        header("Location: list.php");
        exit;
    } catch (PDOException $e) {
        // TUGAS 1: Tangani error UNIQUE jika ID Member kembar
        $errorMsg = "Gagal menyimpan: ID Member sudah terdaftar atau terjadi kesalahan.";
    }
}
?>

<section class="card border-0 shadow-sm rounded-4 overflow-hidden mx-auto" style="max-width: 650px;">
    <div class="bg-aesthetic text-white p-4 text-center" style="background: linear-gradient(135deg, #4A6054 0%, #6b8676 100%);">
        <i class="bi bi-person-plus-fill fs-1 text-warning mb-2 d-block"></i>
        <h3 class="fw-bold m-0">Pendaftaran Member Baru</h3>
        <p class="mb-0 text-white-50 small">Masukkan data pelanggan SportSpace ke database</p>
    </div>
    
    <div class="card-body p-4 p-md-5 bg-white">
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger shadow-sm"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">ID Member</label>
                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm border-0 bg-light" name="id_member" placeholder="Contoh: M-001" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Tipe Member</label>
                    <select class="form-select form-select-lg rounded-3 shadow-sm border-0 bg-light" name="tipe">
                        <option value="Reguler">Reguler</option>
                        <option value="VIP">VIP</option>
                        <option value="Pelajar">Pelajar</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm border-0 bg-light" name="nama" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">No. Handphone</label>
                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm border-0 bg-light" name="no_hp" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Email Aktif</label>
                    <input type="email" class="form-control form-control-lg rounded-3 shadow-sm border-0 bg-light" name="email">
                </div>
                <div class="col-12 mt-5">
                    <button type="submit" class="btn w-100 text-white fw-bold rounded-pill py-3 shadow-sm bg-aesthetic hover-lift" style="background: linear-gradient(135deg, #4A6054 0%, #6b8676 100%); border: none;">
                        <i class="bi bi-save-fill me-2"></i>Simpan Data Member
                    </button>
                    <div class="text-center mt-3">
                        <a href="list.php" class="text-secondary text-decoration-none small">Kembali ke Daftar Member</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>