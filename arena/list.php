<?php
session_start();
$page_title = "Daftar Arena";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Membaca data langsung dari tabel database PostgreSQL
$daftarArena = $pdo->query("SELECT * FROM arena ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container my-5">
    <section class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="bg-aesthetic text-white p-4" style="background: linear-gradient(135deg, #4A6054 0%, #6b8676 100%);">
            <h3 class="fw-bold m-0"><i class="bi bi-grid-1x2-fill me-2"></i>Katalog Arena</h3>
            <p class="mb-0 text-white-50 small">Kelola daftar lapangan dan meja permainan</p>
        </div>

        <div class="card-body p-4 bg-white">

            <?php if ($flash): ?>
                <div class="flash flash-<?php echo $flash['type']; ?> mb-4"><?php echo $flash['pesan']; ?></div>
            <?php endif; ?>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <div class="position-relative w-100" style="max-width: 400px;">
                    <i class="bi bi-search position-absolute text-secondary" style="top: 50%; left: 18px; transform: translateY(-50%);"></i>
                    <input type="text" id="search-input" class="form-control rounded-pill bg-light border-0 shadow-none py-2" style="padding-left: 48px;" placeholder="Cari arena...">
                </div>
                <div class="d-flex gap-2 flex-wrap justify-content-md-end">
                    <a href="reset.php" class="btn btn-outline-danger rounded-pill px-4 py-2 hover-lift fw-medium" onclick="event.stopImmediatePropagation(); return confirm('Yakin ingin mereset semua data arena?');">
                        <i class="bi bi-trash3 me-1"></i> Reset Data
                    </a>

                    <a href="#" class="btn bg-light text-secondary rounded-pill px-4 py-2 border-0 hover-lift fw-medium" onclick="document.querySelector('tbody').innerHTML = '<tr><td colspan=\'6\' class=\'text-center py-5 text-secondary\'><div class=\'spinner-border spinner-border-sm me-2\' role=\'status\'></div>Memuat data...</td></tr>'; setTimeout(() => { window.location.href = 'list.php'; }, 600); return false;">
                        <i class="bi bi-arrow-clockwise me-1"></i> Muat Ulang
                    </a>

                    <a href="tambah.php" class="btn text-white rounded-pill px-4 py-2 hover-lift fw-medium" style="background-color: #8FA396;">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Arena
                    </a>
                </div>

            </div>

            <div class="table-responsive rounded-3 border-0 shadow-sm">
                <table class="table table-hover align-middle mb-0 border-white">
                    <thead class="bg-light text-secondary" style="border-bottom: 2px solid #eef3f0;">
                        <tr>
                            <th class="py-3 ps-4 text-uppercase" style="font-size: 0.85rem;">ID Arena</th>
                            <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Nama Lapangan / Meja</th>
                            <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Kategori</th>
                            <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Harga / Jam</th>
                            <th class="py-3 text-center text-uppercase" style="font-size: 0.85rem;">Status</th>
                            <th class="py-3 text-center text-uppercase" style="font-size: 0.85rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarArena)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">Belum ada data arena di database.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($daftarArena as $arena): ?>
                                <?php
                                $badgeStatus = $arena['status'] === "Tersedia"
                                    ? '<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Tersedia</span>'
                                    : '<span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Dipakai</span>';
                                ?>
                                <tr>
                                    <td class="ps-4 py-3 fw-medium text-secondary"><?php echo htmlspecialchars($arena['id_arena']); ?></td>
                                    <td class="py-3 fw-bold text-aesthetic"><?php echo htmlspecialchars($arena['nama']); ?></td>
                                    <td class="py-3 text-secondary"><?php echo htmlspecialchars($arena['kategori']); ?></td>
                                    <td class="py-3 fw-medium">Rp <?php echo number_format($arena['harga'], 0, ',', '.'); ?>/jam</td>
                                    <td class="py-3 text-center"><?php echo $badgeStatus; ?></td>
                                    <td class="py-3 text-center">
                                        <button type="button" class="btn btn-edit-aes btn-sm rounded-pill px-3 mb-1"><i class="bi bi-pencil-square"></i></button>
                                        
                                        
                                        <a href="hapus.php?id=<?php echo $arena['id']; ?>" class="btn btn-hapus-aes btn-sm rounded-pill px-3 mb-1 hover-lift" onclick="event.stopImmediatePropagation(); return confirm('Yakin ingin menghapus arena \'<?php echo htmlspecialchars($arena['nama']); ?>\' secara permanen?');"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<script src="../assets/js/app.js"></script>
<?php include __DIR__ . '/../includes/footer.php'; ?>