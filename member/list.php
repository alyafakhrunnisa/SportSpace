<?php
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/header.php';

try {
    $stmt = $pdo->query("SELECT * FROM member ORDER BY id DESC");
    $members = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Gagal mengambil data member: " . $e->getMessage());
}
?>

<div class="container my-4">
    <h2>Daftar Member</h2>
    <a href="/member/tambah.php" class="btn btn-primary mb-3">Tambah Member</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($members) > 0): ?>
                <?php foreach ($members as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['id']); ?></td>
                        <td><?= htmlspecialchars($m['nama']); ?></td>
                        <td><?= htmlspecialchars($m['email']); ?></td>
                        <td><?= htmlspecialchars($m['no_telepon']); ?></td>
                        <td><?= htmlspecialchars($m['tanggal_daftar']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data member.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>