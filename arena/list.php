<?php
$page_title = 'Daftar Arena';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$search = $_GET['search'] ?? '';
if ($search !== '') {
    $stmt = $pdo->prepare("SELECT * FROM arena WHERE nama ILIKE :keyword OR kategori ILIKE :keyword ORDER BY id DESC");
    $stmt->execute(['keyword' => '%' . $search . '%']);
    $daftarArena = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $daftarArena = $pdo->query("SELECT * FROM arena ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<section class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="bg-aesthetic text-white p-4" style="background: linear-gradient(135deg, #4A6054 0%, #6b8676 100%);">
        <h3 class="fw-bold m-0"><i class="bi bi-grid-1x2-fill me-2"></i>Katalog Arena</h3>
        <p class="mb-0 text-white-50 small">Kelola daftar lapangan dan meja permainan dari database</p>
    </div>

    <div class="card-body p-4 bg-white">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <form method="GET" class="input-group shadow-sm" style="max-width: 350px;">
                <span class="input-group-text bg-white border-aesthetic text-aesthetic"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="form-control border-start-0 border-aesthetic" placeholder="Cari arena...">
            </form>
            <div class="d-flex gap-2">
                <a href="reset.php" class="btn text-danger bg-light rounded-pill px-4 shadow-sm border hover-lift" onclick="return confirm('Yakin ingin mengosongkan seluruh data arena?')"><i class="bi bi-trash me-1"></i> Reset Data</a>
                <a href="tambah.php" class="btn text-white rounded-pill px-4 bg-aesthetic shadow-sm hover-lift"><i class="bi bi-plus-lg me-1"></i> Tambah Arena</a>
            </div>
        </div>

        <div class="table-responsive rounded-3 border-0 shadow-sm">
            <table class="table table-hover align-middle mb-0 border-white">
                <thead class="bg-light text-secondary" style="border-bottom: 2px solid #eef3f0;">
                    <tr>
                        <th class="py-3 ps-4 text-uppercase" style="font-size: 0.85rem;">ID Arena</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Nama Arena</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Kategori</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Harga / Jam</th>
                        <th class="py-3 text-center text-uppercase" style="font-size: 0.85rem;">Status</th>
                        <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Waktu Ditambahkan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarArena)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">Belum ada data arena.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarArena as $arena): ?>
                            <tr>
                                <td class="ps-4 py-3 text-secondary"><?php echo htmlspecialchars($arena['id_arena']); ?></td>
                                <td class="py-3 fw-bold text-aesthetic"><?php echo htmlspecialchars($arena['nama']); ?></td>
                                <td class="py-3 text-secondary"><?php echo htmlspecialchars($arena['kategori']); ?></td>
                                <td class="py-3 fw-medium">Rp <?php echo number_format($arena['harga'], 0, ',', '.'); ?>/jam</td>
                                <td class="py-3 text-center">
                                    <?php if ($arena['status'] === 'Tersedia'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Tersedia</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Dipakai</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-secondary small">
                                    <?php echo !empty($arena['tanggal_ditambahkan']) ? date('d M Y, H:i', strtotime($arena['tanggal_ditambahkan'])) : '-'; ?>
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