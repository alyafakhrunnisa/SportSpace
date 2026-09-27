<?php
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/header.php';

try {
    $stmt = $pdo->query("SELECT * FROM arena ORDER BY id DESC");
    $arenas = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Gagal mengambil data: " . $e->getMessage());
}
?>

<div class="container my-4">
    <h2>Daftar Arena</h2>
    <a href="/arena/tambah.php" class="btn btn-primary mb-3">Tambah Arena</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Arena</th>
                <th>Jenis Olahraga</th>
                <th>Harga / Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($arenas) > 0): ?>
                <?php foreach ($arenas as $arena): ?>
                    <tr>
                        <td><?= htmlspecialchars($arena['id']); ?></td>
                        <td><?= htmlspecialchars($arena['nama_arena']); ?></td>
                        <td><?= htmlspecialchars($arena['jenis_olahraga']); ?></td>
                        <td>Rp <?= number_format($arena['harga_per_jam'], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($arena['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data arena.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>