<?php
session_start();
$page_title = "Daftar Member";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Ambil data dari database PostgreSQL
$daftarMember = $pdo->query("SELECT * FROM member ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

    <main class="container my-5">
        <section class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="p-4 text-white" style="background: linear-gradient(135deg, #8FA396 0%, #6b8676 100%);">
                <h3 class="fw-bold m-0"><i class="bi bi-people-fill me-2"></i>Daftar Member</h3>
                <p class="mb-0 text-white-50 small">Kelola data pelanggan dan keanggotaan</p>
            </div>

            <div class="card-body p-4 bg-white">
                
                <?php if ($flash): ?>
                    <div class="flash flash-<?php echo $flash['type']; ?> mb-4"><?php echo $flash['pesan']; ?></div>
                <?php endif; ?>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                    
                    <div class="position-relative w-100" style="max-width: 400px;">
                        <i class="bi bi-search position-absolute text-secondary" style="top: 50%; left: 18px; transform: translateY(-50%);"></i>
                        <input type="text" id="search-input" class="form-control rounded-pill bg-light border-0 shadow-none py-2" style="padding-left: 48px;" placeholder="Cari nama, email...">
                    </div>
                    
                    <div class="d-flex gap-2 flex-wrap justify-content-md-end">
                        <a href="reset.php" class="btn btn-outline-danger rounded-pill px-4 py-2 hover-lift fw-medium" onclick="event.stopImmediatePropagation(); return confirm('Yakin ingin mereset semua data member?');">
                            <i class="bi bi-trash3 me-1"></i> Reset Data
                        </a>
                        
                        <a href="#" class="btn bg-light text-secondary rounded-pill px-4 py-2 border-0 hover-lift fw-medium" onclick="document.querySelector('tbody').innerHTML = '<tr><td colspan=\'7\' class=\'text-center py-5 text-secondary\'><div class=\'spinner-border spinner-border-sm me-2\' role=\'status\'></div>Memuat data...</td></tr>'; setTimeout(() => { window.location.href = 'list.php'; }, 600); return false;">
                            <i class="bi bi-arrow-clockwise me-1"></i> Muat Ulang
                        </a>
                        
                        <a href="tambah.php" class="btn text-white rounded-pill px-4 py-2 hover-lift fw-medium" style="background-color: #8FA396;">
                            <i class="bi bi-person-plus-fill me-1"></i> Tambah Anggota
                        </a>
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
                                <th class="py-3 text-uppercase" style="font-size: 0.85rem;">Tgl Gabung</th>
                                <th class="py-3 text-center text-uppercase" style="font-size: 0.85rem;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($daftarMember)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-secondary py-4">Belum ada data member. Silakan tambah member baru.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($daftarMember as $member): ?>
                                    <?php 
                                        $badgeTipe = $member['tipe'] === "VIP"  
                                            ? '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3"><i class="bi bi-star-fill me-1"></i> VIP</span>'  
                                            : '<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">Reguler</span>';
                                        $tgl_tampil = !empty($member['tanggal_bergabung']) ? date('d M Y', strtotime($member['tanggal_bergabung'])) : '-';
                                    ?>
                                    <tr>
                                        <td class="ps-4 py-3 fw-medium text-secondary"><?php echo htmlspecialchars($member['id_member']); ?></td>
                                        <td class="py-3 fw-bold text-aesthetic"><?php echo htmlspecialchars($member['nama']); ?></td>
                                        <td class="py-3"><?php echo $badgeTipe; ?></td>
                                        <td class="py-3"><?php echo htmlspecialchars($member['no_hp']); ?></td>
                                        <td class="py-3 text-secondary"><?php echo htmlspecialchars($member['email'] ?? '-'); ?></td>
                                        <td class="py-3 text-secondary"><?php echo $tgl_tampil; ?></td>
                                        <td class="py-3 text-center">
                                            <button type="button" class="btn btn-edit-aes btn-sm rounded-pill px-3 mb-1 hover-lift"><i class="bi bi-pencil-square"></i></button>
                                            
                                            <!-- Tombol Hapus -->
                                            <a href="hapus.php?id=<?php echo $member['id']; ?>" class="btn btn-hapus-aes btn-sm rounded-pill px-3 mb-1 hover-lift" onclick="event.stopImmediatePropagation(); return confirm('Yakin ingin menghapus \'<?php echo htmlspecialchars($member['nama']); ?>\' secara permanen?');"><i class="bi bi-trash"></i></a>
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