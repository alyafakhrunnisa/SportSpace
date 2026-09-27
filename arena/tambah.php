<?php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="container my-4">
    <h2>Tambah Arena Baru</h2>
    <form action="/arena/proses_tambah.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Arena</label>
            <input type="text" name="nama_arena" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Olahraga</label>
            <input type="text" name="jenis_olahraga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga per Jam (Rp)</label>
            <input type="number" step="0.01" name="harga_per_jam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Tersedia">Tersedia</option>
                <option value="Tutup">Tutup</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/arena/list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>