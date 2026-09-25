<?php
$page_title = 'Daftar Member';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$search = $_GET['search'] ?? '';
if ($search !== '') {
    $stmt = $pdo->prepare("SELECT * FROM member WHERE nama ILIKE :keyword OR id_member ILIKE :keyword ORDER BY id DESC");
    $stmt->execute(['keyword' => '%' . $search . '%']);
    $daftarMember = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $daftarMember = $pdo->query("SELECT * FROM member ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<section class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="p-4 text-white" style="background: linear-gradient(135deg, #8FA396 0%, #6b8676 100%);">
        <h3 class="fw-bold m-0"><i class="bi bi-people-fill me-2"></i>Daftar Member</h3>
        <p class="mb-0 text-white-50 small">Kelola data pelanggan dan keanggotaan dari database</p>
    </div>

    <div class="card-body p-4 bg-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <form method="GET" class="input-group shadow-sm" style="max-width: 350px;">
                <span class="input-group-text bg-white border-aesthetic text-aesthetic" style="border-color: #8FA396 !important;"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="form-control border-start-0 border-aesthetic" placeholder="Cari member...">
            </form>
            <div class="d-flex gap-2">
                <a href="reset.php" class="btn text-danger bg-light rounded-pill px-4 shadow-sm border hover-lift" onclick="return confirm('Yakin ingin mengosongkan seluruh data member?')"><i class="bi bi-trash me-1"></i> Reset Data</a>
                <a href="tambah.php" class="btn text-white rounded-pill px-4 shadow-sm hover-lift" style="background-color: #8FA396;"><i class="bi bi-person-plus-fill me-1"></i> Registrasi Member</a>
            </div>
        </div>
        
        <div class="table-responsive rounded-3 border-0 shadow-sm">
            <table class="table table-hover align-middle mb-0 border-white">
                <thead class="bg-light text-secondary" style="border-bottom: 2px solid #eef3f0;">
                    <tr>
                        <th class="py-3 ps-4 text-uppercase" style="font-size: 0.85rem;">ID Member</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Nama Lengkap</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Tipe</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">No. HP</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Email</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Bergabung Sejak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarMember)): ?>
                        <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada data member.</td></tr>
                    <?php else: ?>
                        <?php foreach ($daftarMember as $m): ?>
                            <tr>
                                <td class="ps-4 py-3 fw-medium text-secondary"><?php echo htmlspecialchars($m['id_member']); ?></td>
                                <td class="py-3 fw-bold text-aesthetic"><?php echo htmlspecialchars($m['nama']); ?></td>
                                <td class="py-3">
                                    <?php if ($m['tipe'] === 'VIP'): ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3"><i class="bi bi-star-fill me-1"></i> VIP</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">Reguler</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3"><?php echo htmlspecialchars($m['no_hp']); ?></td>
                                <td class="py-3 text-secondary"><?php echo htmlspecialchars($m['email']); ?></td>
                                <td class="py-3 text-secondary small">
                                    <?php echo !empty($m['tanggal_bergabung']) ? date('d M Y, H:i', strtotime($m['tanggal_bergabung'])) : '-'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>