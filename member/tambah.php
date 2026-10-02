<?php
session_start();
require __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa mengelola data.'];
    header('Location: list.php');
    exit;
}

$page_title = "Tambah Member";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_member = $_POST['id_member'];
    $tipe = $_POST['tipe'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $tanggal_bergabung = $_POST['tanggal_bergabung']; // Nangkep data kalender dari form

    try {
        $stmt = $pdo->prepare("INSERT INTO member (id_member, tipe, nama, no_hp, email, tanggal_bergabung) 
                               VALUES (:id_member, :tipe, :nama, :no_hp, :email, :tanggal_bergabung)");
        
        $stmt->execute([
            'id_member' => $id_member,
            'tipe' => $tipe,
            'nama' => $nama,
            'no_hp' => $no_hp,
            'email' => $email,
            'tanggal_bergabung' => $tanggal_bergabung
        ]);
        
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data member baru berhasil didaftarkan.'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        $error = "Gagal menyimpan data: " . $e->getMessage();
    }
}
?>

<main class="container my-5 d-flex justify-content-center">
    <section class="card border-0 shadow-sm rounded-4 overflow-hidden" style="max-width: 650px; width: 100%;">
    
        <div class="p-4 text-white text-center" style="background-color: #8fa396;">
            <div class="mb-2">
                <i class="bi bi-person-vcard-fill" style="color: #ffc107; font-size: 2.2rem;"></i>
            </div>
            <h3 class="fw-bold m-0">Registrasi Member</h3>
            <p class="mb-0 text-white-50 small mt-1">Daftarkan pelanggan setia baru</p>
        </div>
        
        <div class="card-body p-4 p-md-5 bg-white">
            <?php if ($error): ?>
                <div class="alert alert-danger rounded-3"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">ID MEMBER</label>
                        <input type="text" name="id_member" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" placeholder="Contoh: M-001" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">TIPE KEANGGOTAAN</label>
                        <select name="tipe" class="form-select border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                            <option value="Reguler">Reguler (Standar)</option>
                            <option value="VIP">VIP</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">NAMA LENGKAP</label>
                    <input type="text" name="nama" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">NO. HP / WHATSAPP</label>
                        <input type="text" name="no_hp" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">EMAIL AKTIF</label>
                        <input type="email" name="email" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;">
                    </div>
                </div>
                <div class="mb-5">
                    <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">TANGGAL BERGABUNG</label>
                    <input type="date" name="tanggal_bergabung" class="form-control border-0 rounded-3 py-2 fw-medium" style="background-color: #f8f9fa;" required>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn text-white rounded-pill px-4 py-3 w-100 fw-bold shadow-sm" style="background-color: #8fa396;">
                        <i class="bi bi-person-check-fill me-2"></i> Simpan Data Member
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
