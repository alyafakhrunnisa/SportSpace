<?php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="container my-4">
    <h2>Tambah Member Baru</h2>
    <form action="/member/proses_tambah.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" name="no_telepon" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/member/list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>